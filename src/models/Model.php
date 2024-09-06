<?php

namespace models;

use controllers\Connection;

abstract class Model {
    public abstract function save(Connection $connection);

    //Propósito: Este método es utilizado para sanitizar y limpiar datos de entrada, generalmente para prevenir ataques de inyección SQL y Cross-Site Scripting (XSS).
    public static function escapeData($input){
        $input = trim($input);
        $input = htmlspecialchars($input);
        return stripslashes($input);
    }
}