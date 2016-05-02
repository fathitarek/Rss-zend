<?php

class ListController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->model = new Application_Model_Rss();
    }

    public function listAction() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
           // $this->view->list = $this->model->listAllRss();
           //  $this->view->list = $this->model->listRss($id);
        } else {
            $data = $auth->getIdentity();
            // $username = $data->name;
            $id = $data->id;
            //$uid=Zend_Session::getId();
            // echo "Name :".$username;
            // echo " <br> id:". $id;
            $this->view->list = $this->model->listRss($id);
            $this->render('list');
    
        }
    }

}
