<?php

namespace Model\Repository;

class UserRepository
{
    private $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
        return $this;
    }
    
    public function findByEmailPass($email, $password)
    {
        $sth = $this->pdo->prepare('SELECT * FROM user WHERE email = :email AND password = :password AND active = 1 LIMIT 1');
        $sth->execute(compact('email', 'password'));
        $data = $sth->fetch(\PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }
        
        return (new User())
            ->setEmail($data['email'])
            ->setRole($data['role'])
        ;
    }
}