<?php

require_once './vendor/autoload.php';
require_once './src/controllers/Connection.php';
require_once './src/models/User.php';

use controllers\Connection;
use models\User;

// Crear una instancia de conexión
$connection = new Connection();

// Llamar a la función usersDetail con un email que existe en tu base de datos
$email = 'cguirado.ln@gmail.com'; // Reemplaza con un email válido en tu base de datos
$userDetail = User::usersDetail($connection, $email);

// Mostrar el resultado
echo '<pre>';
print_r($userDetail);
echo '</pre>';

// Cerrar la conexión
$connection->close_connection();

?>
