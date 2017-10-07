<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;
use Framework\UserNotFoundException;
use Framework\Session;
use Model\Form\LoginForm;
use Model\Entity\User;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        error_reporting(E_ALL);
        
        $form = new LoginForm(
            $request->post('email'), 
            $request->post('password')
        );
        
        $container = $this->container;
        
        if ($request->isPost()) {
            if ($form->isValid()) {
                $user = $container
                    ->get('repository_factory')
                    ->createRepository('User')
                    ->findByEmail($form->email)
                ;
                
                if (!$user) {
                    throw new UserNotFoundException();
                }
                
                $this->verify($form->password, $user);
                Session::set('user', $user->getEmail());
                $container->get('router')->redirect('/admin/index.php?controller=default&action=index');
            }
            
            Session::setFlash('Invalid form');
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
    
    private function verify($password, User $user)
    {
        $result = password_verify($password, $user->getPassword());
        
        if ($result) {
            return true;
        }
        
        throw new UserNotFoundException();
    }
}