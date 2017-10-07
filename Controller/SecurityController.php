<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;
use Model\Form\LoginForm;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $form = new LoginForm(
            $request->post('email'), 
            $request->post('password')
        );
        
        if ($request->isPost()) {
            if ($form->isValid()) {
                
            }
        }
        
        return $this->render('login.phtml', ['form' => $form]);
    }
    
    public function logoutAction()
    {
        
    }
    
    public function changePasswordAction()
    {
        
    }
    
    public function registerAction()
    {
        
    }
    
    public function activateAccountAction()
    {
        
    }
}