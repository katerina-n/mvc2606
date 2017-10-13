<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;
use Framework\Session;

class CartController extends Controller
{
    public function indexAction(Request $request)
    {
        $currentCart = Session::get('cart', []);
        
        $books = $this
            ->container
            ->get('repository_factory')
            ->createRepository('Book')
            ->findByIds($currentCart);
        
        return $this->render('index.phtml', ['books' => $books]);
    }
    
    public function addToCartAction(Request $request)
    {
        $id = $request->get('id');
        
        // todo: separate class CartService
        // todo: 
        $currentCart = Session::get('cart', []);
        $currentCart[] = $id;
        // $currentCart[$id]++;
        
        Session::set('cart', array_unique($currentCart));
        $this->container->get('router')->redirect('https://mvc2606-andrii-popov.c9users.io/index.php?controller=book&action=index');
    }
    
    public function removeFromCartAction()
    {
        
    }
    
    public function clearCartAction()
    {
        
    }
}