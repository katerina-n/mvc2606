<?php

namespace Model\Repository;

use Model\Entity\Book;

class BookRepository
{
    private $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
        return $this;
    }
    
    public function save(Book $book)
    {
        // todo: implement - check ID: if id===null => insert into.., else: update...
    }
    
    public function find($id)
    {
        $pdo = $this->pdo;
        
        $sth = $pdo->prepare('SELECT * FROM book WHERE id = :id');
        $sth->execute(['id' => $id]);
        $data = $sth->fetch(\PDO::FETCH_ASSOC);
        
        return (new Book())
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setPrice($data['price'])
            ->setActive($data['active'])
            ->setCreated($data['created'])
            ->setCategory($data['category_id'])
        ;
    }
    
    public function findAll()
    {
        $pdo = $this->pdo;
        
        $collection = [];
        $sth = $pdo->query('SELECT * FROM book ORDER BY title');
        
        while ($data = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $book = (new Book())
                ->setId($data['id'])
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setPrice($data['price'])
                ->setActive($data['active'])
                ->setCreated($data['created'])
                ->setCategory($data['category_id'])
            ;
            
            $collection[] = $book;
        }
        
        return $collection;
    }
    
    public function findActive()
    {
    }
}