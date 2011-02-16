<?php

require_once 'Zend/Tool/Project/Provider/Abstract.php';
require_once 'Zend/Tool/Project/Provider/Exception.php';

class OfeliaProvider extends Zend_Tool_Project_Provider_Abstract
{
    public function install()
    {
        $this->_registry
             ->getResponse()
             ->appendContent('This is not implemented yet.');
    }

    public function uninstall()
    {
        $this->_registry
             ->getResponse()
             ->appendContent('This is not implemented yet.');
    }
}
