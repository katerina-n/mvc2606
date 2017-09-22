<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;

class BookController extends Controller
{
    public function indexAction(Request $request)
    {
        $books = ['book1', 'book2'];
        $authors = ['author1', 'author2'];
        
        return $this->render('index.phtml', [
            'books' => $books, 
            'authors' => $authors
        ]);
    }
}