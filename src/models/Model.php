<?php

namespace models;

use controllers\Connection;

abstract class Model {

    protected $db;

    // Constructor de la conexion
    public function __construct() {
        $this->db = $this->getConnection();
    }

    // Método de conexión a la base de datos
    protected function getConnection() {
        try {
            $conn = new \PDO('mysql:host=' . $_ENV['DB_HOST_SERVER'] . ';dbname=proyecto1', $_ENV['DB_HOST_SERVER_USER'], $_ENV['DB_HOST_SERVER_PASS']);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    //Escapar datos para evitar inyecciones
    public static function escapeData($input){
        $input = trim($input);
        $input = htmlspecialchars($input);
        return stripslashes($input);
    }
}