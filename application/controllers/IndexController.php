<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->model = new Application_Model_Rss();
    }

    public function indexAction() {
        // action body
        $this->view->index = $this->model->listRss();
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

}
