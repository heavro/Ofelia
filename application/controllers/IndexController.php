<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->flashMessenger = $this->_helper->FlashMessenger;
    }

    public function indexAction()
    {
        $this->flashMessenger->addMessage('This is a message test');
#        $this->flashMessenger->addMessage('This is another message test');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
#        $this->flashMessenger->addMessage('and another...');
    }
}

