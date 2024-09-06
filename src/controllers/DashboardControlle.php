<?php
namespace controllers;

require '../models/User.php';
require '../controllers/Connection.php';

use controllers\Connection;
use models\User;



class DashboardControlle {
    
    public static function perfil() {
        $connection = new Connection();
        return User::usersDetail($connection, $_SESSION['user']);
    }

    public static function sectores($sector) {
        $sectores = array(
            'IT Department',
            'Sales',
            'Graphic Design',
            'Marketing'
        );
        $clave_a_borrar = array_search($sector, $sectores);
        unset($sectores[$clave_a_borrar]);
        return $sectores;
    }

    public static function guardar_datos_user($name, $email, $sector, $id) {
        if ($email) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $email;
        }
    
        return User::actualizar(
            new Connection(),
            $name,
            $email,
            $sector,
            $id
        );
    }


}


