<?php

require dirname(__DIR__) . '\includes\init.php';
$connection = dirname(__DIR__) . '\includes\db.php';

class UserController
{
    private $userInstance;

    public function __construct()
    {
        $this->userInstance = new User();
    }

    public function create($conn, $email, $firstName, $lastName)
    {
        $this->userInstance->addUser($conn, $email, $firstName, $lastName);
    }

    public function getAll($conn)
    {
        return $this->userInstance->getAll($conn);
    }

    public function checkUser($conn, $email)
    {
        return $this->userInstance->checkUser($conn, $email);
    }
}
