<?php 

class Zend_View_Helper_Messages extends Zend_View_Helper_Abstract
{
    public $_flashMessenger = null;
    public $messages = null;
    public $messagesFormated = null;
    public $view;
 
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    
    public function messages()
    {
        $flashMessenger = Zend_Controller_Action_HelperBroker::getExistingHelper('FlashMessenger');
        $messages = $flashMessenger->getMessages()
                  + $flashMessenger->getCurrentMessages();
        
        foreach ($messages as $key => $value)
        {
            $this->messagesFormated .= <<< EOF
<span class="message" id="messageid{$key}">$value</span>

EOF;
        }
        
        $flashMessenger->clearCurrentMessages();
        
        return $this->messagesFormated;
    }
}
