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
        $request = $this->getRequest();
        $form = $this->getForm();
        
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $this->view->values = $form->getValues();
                
                // Auth
                
            } else {
                $this->view->form = $form;
                $this->render('index');
            }
        } else {
            return $this->_redirect('/user/index');
        }
    }


}



