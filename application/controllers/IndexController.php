<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->model = new Application_Model_Rss();
        
  
    
    }

    public function indexAction() {
        // action body
        $auth = Zend_Auth::getInstance();
if (!$auth->hasIdentity()) {
     $this->view->index = $this->model->listAllRss();
} else {
    $data = $auth->getIdentity();
   // $username = $data->name;
        $id = $data->id;
    //$uid=Zend_Session::getId();
   // echo "Name :".$username;
   // echo " <br> id:". $id;
                $this->view->index = $this->model->listRss($id);

} 
        // $feedUrl =  'http://feeds.reuters.com/reuters/healthNews';
        //   $feed = Zend_Feed_Reader::import($feedUrl);
        //  print_r($feed);
//        $this->view->gettinstareted = array();
//        foreach ($feed as $entry) {
//            if (array_search('Getting started', $entry->getCategories()->getValues())) {
//                $this->view->gettinstareted[$entry->getLink()] = $entry->getTitle();
//            }
//        }
//        foreach ($feed as $item) {
//            echo $item->getTitle() . "<br/>";
//            echo $item->getlink() . "<br/>";
//        }
        // $this->redirect('rss/index'); 
//        $this->view->feed = $feed;
//        $this->renderScript('index/index.phtml', $feed);
    }

    public function addAction() {
        $data = $this->getRequest()->getParams();
        $form = new Application_Form_Rss();
        //if ($this->getRequest()->isPost()) {
        if ($form->isValid($data)) {
            if ($this->model->addRss($data)) {
                $this->redirect('index/index');
            }
        }
        // }
        $this->view->form = $form;
        $this->render('add');
    }
    
    public function deleteAction(){
	$id = $this->getRequest()->getParam('id');
	if($id){
	 if ($this->model->deleteRss($id))
		$this->redirect('index/index');
        
    } else {
		$this->redirect('index/index');
	}
	}

}