<?php
require_once '../vendor/autoload.php';
require_once '../src/controllers/Connection.php';
require_once '../src/models/User.php';

use controllers\Connection;
use models\User;

$connection = new Connection();
$email = User::escapeData($_POST['email']);
$password = $_POST['password'];

if (User::login($connection, $email, $password)) {
    session_start();
    $_SESSION['user'] = $email;
    $connection->close_connection();
    header('Location: ./index');
    exit(); // Termina la ejecución del script
} else {
    header('Location: ./login.php?errors=true');
    exit(); // Termina la ejecución del script
}


