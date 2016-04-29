<?php
class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction()
    {
        // action body

    }

    public function loginAction()
    {
        // action body
        $login_form = new Application_Form_Login();
        
        $this->view->login = $login_form;

        $login_model = new Application_Model_Users();
        if ($login_form->isValid($_POST)) {
            $email = $this->_request->getParam('email');
            $password = $this->_request->getParam('password');
            $username = $this->_request->getParam('name');
            $db = Zend_Db_Table::getDefaultAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'email', 'password');

            $authAdapter->setIdentity($email);
            $authAdapter->setCredential(md5($password));
            $result = $authAdapter->authenticate();
            if ($result->isValid()) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($authAdapter->getResultRowObject(array('email','password','name')));
                $this->_redirect('categories/main');
                echo "welcome";
            }
        }
    }

    public function registerAction()
    {
        // action body
        $register_model = new Application_Model_Users();
        $form = new Application_Form_Registration();
        $this->view->register =$form;
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                           
               $data = $form->getValues();
                echo "hello";
                
               //$data=$this->preparedata($data);
//
//                if ($register_model->checkUnique($data['email'])) {
//                    $this->view->errorMessage = "Name already taken. Please choose another one.";
//                    return;
//                }

                $register_model->insert($data);
                //$accept=$this->sendConfirmationEmail($data);
               
                 $this->redirect('users/login');        
            
            
        }
    }

    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Users();

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getParams())) {
                $user_info = $form->getValues();
                $user_model = new Application_Model_Users();
                $user_model->addUser($user_info);
            }
        }

        $this->view->form = $form;
    }

   

    public function homeAction()
    {
        // action body
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        if (!$data) {
            $this->_redirect('users/login');
        }
        //$this->view->users = $data['name'];
    }

    public function deleteAction()
    {
        // action body
         $id = $this->_request->getParam("id");
        if (!empty($id)) {
            $user_model = new Application_Model_Users();
            $user_model->deleteUser($id);
        }
        $this->redirect("users/list");
    }

    public function logoutAction()
    {
        $user = Zend_Auth::getInstance();
        $user->clearIdentity();
        $this->_redirect('users/login');
    }



}



















