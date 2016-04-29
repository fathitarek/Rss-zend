<?php

class Application_Model_Rss extends Zend_Db_Table_Abstract {

    protected $_name = "feeds";

    function listRss() {
        return $this->fetchAll()->toArray();
    }

    function addRss($data) {
        $row = $this->createRow();
        $row->rss = $data['rss'];
        return $row->save();
    }

}
