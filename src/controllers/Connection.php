<?php

namespace controllers;

use PDO;
use PDOException;
use Dotenv\Dotenv;

// Cargar las variables de entorno

require 'C:\wamp64\www\proyecto1\vendor\autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Connection {
    protected $connection;
    protected $servername;
    protected $username;
    protected $password;

    public function __construct() {
        try {
            $this->username = $_ENV['DB_HOST_SERVER_USER'];
            $this->password = $_ENV['DB_HOST_SERVER_PASS'];
            $this->servername = $_ENV['DB_HOST_SERVER'];
            $this->connection = new PDO("mysql:host=$this->servername;dbname=proyecto1", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Considera registrar el error en lugar de mostrarlo
            error_log("Connection failed: " . $e->getMessage());
            echo "Connection failed. Please contact the administrator.";
        }
    }

    public function get_connection() {
        return $this->connection;
    }

    public function close_connection() {
        $this->connection = null;
    }
}
