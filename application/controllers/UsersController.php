<?php

class UsersController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function loginAction() {
        // action body
        $login_form = new Application_Form_Login();

        $this->view->login = $login_form;

        $login_model = new Application_Model_Users();
        if ($login_form->isValid($_POST)) {


            $email = $this->_request->getParam('email');
            $password = $this->_request->getParam('password');
            $username = $this->_request->getParam('name');
            $user_id = $this->_request->getParam('id');
            $db = Zend_Db_Table::getDefaultAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'email', 'password');
            $authAdapter->setIdentity($email);
            $authAdapter->setCredential(md5($password));
            $result = $authAdapter->authenticate();
            if ($result->isValid()) {
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $storage->write($authAdapter->getResultRowObject(array('id','email', 'password', 'name')));
                $this->_redirect('index');
                $this->_redirect('users/login');
            }
        }
    }

    public function registerAction() {
        // action body
        $register_model = new Application_Model_Users();
        $form = new Application_Form_Registration();
        $this->view->register = $form;

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {

                $data = $form->getValues();
                // echo "hello";

                $data = $this->preparedata($data);
                // $data =  $this-> preparemail($data);
                if ($register_model->checkUnique($data['email'])) {
                    $this->view->errorMessage = "Name already taken. Please choose another one.";
                    return;
                }

                $register_model->insert($data);
                //$accept=$this->sendConfirmationEmail($data);

                $this->redirect('users/login');
            }
        }
    }

    public function addAction() {
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

    public function homeAction() {
        // action body
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        if (!$data) {
            $this->_redirect('users/login');
        }
    }

    public function preparedata($data) {
        $data['password'] = md5($data['password']);
        return $data;
    }

//    public function preparemail($data) {
//        $validator = new Zend_Validate_EmailAddress();
//        if ($validator->isValid($data['email'])) {
//            //$data['email'] = md5($data['email']);
//            return $data;
//        } else {
//
//            return false;
//        }
//    }

    public function logoutAction() {
        $user = Zend_Auth::getInstance();
        $user->clearIdentity();
        $this->_redirect('users/login');
    }

}