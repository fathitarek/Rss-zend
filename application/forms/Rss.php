<?php

class Application_Form_Rss extends Zend_Form {

    public function init() {
        $user_id =new Zend_Form_Element_Hidden("user_id");
        $rss = new Zend_Form_Element_Text("rss");
        $rss->setRequired();
        $rss->setlabel("RSS is :");
        $rss->setAttrib("placeholder", "Enter your RSS");
        $submit = new Zend_Form_Element_Submit('submit');
        $this->addElements(array($user_id, $rss, $submit));
    }

}
