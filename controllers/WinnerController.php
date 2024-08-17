<?php

require dirname(__DIR__) . '\includes\init.php';
$connection = dirname(__DIR__) . '\includes\db.php';

class WinnerController
{
    private $winnerInstance;
    private $userController;

    public function __construct()
    {
        $this->winnerInstance = new Winner();
        $this->userController = new UserController();
    }

    public function create($conn,  $email_participation)
    {
        $result = false;

        // $date_test = date('2024-08-01 15:08:32');
        $date_redimido = date('Y-m-d H:i:s');
        $record_id = mt_rand(0, strtotime(date('Y-m-d H:i:s')));

        $userExists = $this->userController->checkUser($conn, $email_participation);

        if (!$userExists) {
            $result = $this->winnerInstance->update($conn, $date_redimido, $email_participation, $record_id);
        }

        return $result;
    }

    public function getAll($conn)
    {
        return  $this->winnerInstance->getAll($conn);
    }
}
