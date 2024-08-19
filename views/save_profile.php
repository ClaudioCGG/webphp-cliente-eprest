<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ./login.php");
}

require '../src/controllers/DashboardControlle.php';
use controllers\DashboardControlle;

DashboardControlle::guardar_datos_user(
    $_POST['name'],
    $_POST['email'],
    $_POST['sector'],
    $_POST['id']
);

header('Location: perfil.php');
