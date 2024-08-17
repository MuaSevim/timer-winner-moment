<?php
header('Content-Type: application/json');

require_once './controllers/WinnerController.php';
require_once './controllers/UserController.php';
$connection = require_once './includes/db.php';


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
// Storing Request Data
$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';


// Instances
$winnerController = new WinnerController();
$userController = new UserController();

// Checkin the Action
switch ($requestMethod) {
    case 'GET':
        if ($action === 'getWinnerUsers') {
            $winnerUsers = $userController->getAll($connection);
            echo json_encode($winnerUsers);
        }

        if ($action === 'getWinners') {
            $winners = $winnerController->getAll($connection);
            echo json_encode($winners);
        }

        break;

    case 'POST':
        if ($action === 'createWinnerDate') {
            $data = json_decode((file_get_contents('php://input')), true);
            $result = $winnerController->create($connection, $data['email']);
            if ($result)
                $userController->create($connection, $data['email'], $data['firstName'], $data['lastName']);
            echo json_encode(['status' => 'success']);
        }
        break;
}
