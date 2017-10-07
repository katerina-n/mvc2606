<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;
use Framework\Router;
use Framework\Session;
use Model\Form\FeedbackForm;
use Model\Entity\Feedback;
use Model\Repository\FeedbackRepository;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');
    }
    
    public function feedbackAction(Request $request)
    {
        $form = new FeedbackForm(
            $request->post('email'),  // $_POST['email']
            $request->post('message')
        );
        
        if ($request->isPost()) {
            if ($form->isValid()) {
                
                $feedback = new Feedback(
                    $form->email,
                    $form->message
                );
                
                FeedbackRepository::save($feedback);
                // $repo->save
                
                Session::setFlash('Saved');
                
                $this
                    ->container
                    ->get('router')
                    ->redirect('/index.php?controller=default&action=feedback')
                ;
                
            }
            
            Session::setFlash('Invalid form');
        }
            
        return $this->render('feedback.phtml', ['form' => $form]);
    }
    
    
    
    
    
    
    
}