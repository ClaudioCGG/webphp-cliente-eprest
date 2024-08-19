<?php
namespace controllers;

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv-> load();

require_once __DIR__ . '/vendor/autoload.php';

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
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function get_connection() {
        return $this->connection;
    }

    public function close_connection() {
         $this->connection = null;
    }
}
