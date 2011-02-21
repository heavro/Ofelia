<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setAction('/user/login')
             ->setMethod('post')
             ->setName('login');
         
        // Create and configure username element:
        $username = $this->createElement('text', 'username');
        $username->setLabel('Username')
                 ->addValidator('alnum')
                 ->addValidator('regex', false, array('/^[a-z]+/'))
                 ->addValidator('stringLength', false, array(6, 20))
                 ->setRequired(true)
                 ->addFilter('StringToLower');
         
        // Create and configure password element:
        $password = $this->createElement('password', 'password');
        $password->setLabel('Password')
                 ->addValidator('StringLength', false, array(6))
                 ->setRequired(true);
        
        // Add some CSRF protection
        $csfr = $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
         
        // Add elements to form:
        $this->addElement($username)
             ->addElement($password)
             ->addElement('hash', 'csrf', array('ignore' => true))
             ->addElement('submit', 'login', array('label' => 'Login'));
    }
}
