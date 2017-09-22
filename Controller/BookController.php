<?php

namespace Controller;

use Framework\Controller;

class BookController extends Controller
{
    public function indexAction()
    {
        $books = ['book1', 'book2'];
        $authors = ['author1', 'author2'];
        
        return $this->render('index.phtml', [
            'books' => $books, 
            'authors' => $authors
        ]);
    }
}