<?php

class Application_Model_Rss extends Zend_Db_Table_Abstract {

    protected $_name = "feeds";

    function listRss($user_id) {
        // return $this->fetchAll()->where('user_id='.$user_id)->toArray();
        //return $this->find($user_id)->toArray();
        $rss = $this->select()->where("user_id = '$user_id'");
        return $this->fetchAll($rss)->toArray();
    }

    function listAllRss() {
        return $this->fetchAll()->toArray();
    }

    function addRss($data) {

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            //echo 'no user found';
        } else {
            $datas = $auth->getIdentity();
            $username = $datas->name;
            $id = $datas->id;
            echo "Name :" . $username;
            echo " <br> id:" . $id;

            $row = $this->createRow();
            $row->rss = $data['rss'];
            $row->user_id = $datas->id;

            return $row->save();
        }
    }

}
