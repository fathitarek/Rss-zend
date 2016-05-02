<?php

class Application_Form_Registration extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $id = $this->createElement('hidden', 'id');
        $name = $this->createElement('text', 'name');
        $name->setLabel('Name:')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StripTags');
        $name->setAttrib("class", "form-control");
        $name->setAttrib("placeholder", "Name");
        $email = $this->createElement('text', 'email');
        $email->setLabel('Email: *')
                ->setRequired(true)
                ->addFilters(array('StringTrim', 'StripTags'))
                ->addValidator('EmailAddress', TRUE)
                ->addErrorMessage('Please enter your email like example@example.ex');
        $email->setAttrib("class", "form-control");
        $email->setAttrib("placeholder", "Email");



        $password = $this->createElement('password', 'password');
        $password->setLabel('Password: *')
                ->setRequired(true);
        $password->setAttrib("class", "form-control");
        $password->setAttrib("placeholder", "Password");


        $register = $this->createElement('submit', 'register');
        $register->setLabel('Sign up');
        $register->setAttrib("class", "btn btn-primary")
                ->setIgnore(true);


        $this->addElements(array(
            $name,
            $email,
            $password,
            $register,
            $id
        ));
    }

}
