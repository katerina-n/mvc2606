<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');
    }
    
    public function feedbackAction(Request $request)
    {
        // if form is valid...
    
        return $this->render('feedback.phtml');
    }
}