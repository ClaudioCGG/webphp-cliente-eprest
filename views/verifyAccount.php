<?php
require_once '../src/controllers/Connection.php';
require_once '../src/models/User.php';


use controllers\Connection;
use models\User;

$connection = new Connection();

$token = $_GET['token'];

$user = User::verifyEmail($connection, $token);
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../public/css/app.css" rel="stylesheet">
        <title>Document</title>

    </head>
    <body>


    <body class="d-flex text-center text-white bg-dark" style="height: 100vh;">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <?php include './components/header-inicio.php'; ?>
            <main class="px-3">
                <h1>Cuenta Verificada!!!</h1>
            </main>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>