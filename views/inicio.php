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
    $user = User::usersDetail($connection, $email);
    
    if ($user['mail_verified'] == 0) {
        header("Location: ./email_not_verified.php");
    }
    
    session_start();
    $_SESSION['user'] = $email;
    $connection->close_connection();
    header("Location: ./index.php");
}
else
{
    header("Location: ./login.php?errors=true");
}




