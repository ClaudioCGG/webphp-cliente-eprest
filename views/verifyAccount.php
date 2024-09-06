<?php
require_once '../src/controllers/Connection.php';
require_once '../models/User.php';
require_once '../src/controllers/VerifyMailController.php';

use controllers\Connection;
use models\User;

$connection = new Connection();

$token = $_GET['token'];

$user = User::verifyEmail($connection, $token);
var_dump( $user );