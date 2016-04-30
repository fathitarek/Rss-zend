<?php

class Application_Model_Users extends Zend_Db_Table_Abstract {

    protected $_name = "users";

    function addUser($data) {
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->email = $data['email'];
        $row->password = md5($data['password']);

        return $row->save();
    }
        function checkUnique($email)
    {
        $select = $this->_db->select()
                            ->from($this->_name,array('email'))
                            ->where('email=?',$email);
        $result = $this->getAdapter()->fetchOne($select);
        if($result){
            return true;
        }
        return false;

	}

}
