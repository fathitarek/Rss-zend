<?php

class Application_Model_Users extends Zend_Db_Table_Abstract {

    protected $_name = "users";

    function addUser($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->password = md5($data['password']);
        $row->email = $data['email'];
        return $row->save();
    }

}
