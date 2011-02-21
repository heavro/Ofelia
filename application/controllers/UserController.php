<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function getForm()
    {
        $form = new Application_Form_Login;
        return $form;
    }

    public function indexAction()
    {
        $form = $this->getForm();
        $this->view->form = $form;
    }

    public function loginAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->_redirect('/user/index');
        }
        $form = $this->getForm();
        if (!$form->isValid($_POST)) {
            // Failed validation; redisplay form
            $this->view->form = $form;
            $this->render('index');
        }
 
        $this->view->values = $form->getValues();
        // now try and authenticate....
    }


}



