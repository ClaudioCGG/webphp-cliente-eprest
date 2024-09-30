<?php
namespace models;

require_once __DIR__ . '/Model.php';
use controllers\Connection;
use PDO;

class User extends Model {
    protected $name;
    protected $email;
    protected $password;
    protected $sector;
    protected $token;
    protected $mail_verified;
    protected $creation;

    //Constructor de un usuario
    public function __construct($name='', $email='', $sector='', $password='') {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->sector = $sector;
        $this->token = (new \AfaanBilal\RandomString\RandomString(20))->generate();
        $this->mail_verified = false;
        $this->creation = null;
    }

    // Método para registrar un usuario
    public function save(Connection $connection) {
        $con = $connection->get_connection();
        $stmt = $con->prepare("INSERT INTO users (name, email, password, sector, token, mail_verified, creation) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$this->name, $this->email, $this->password, $this->sector, $this->token, $this->mail_verified]);
    }

    // Metodo para levantar los datos del Usuario por medio del mail
    public static function usersDetail(Connection $connection, $email) {
        $con = $connection->get_connection();
        $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute(array($email));
        return $stmt->fetch();
    }

    // Metodo para verificar si el usuario esta validado
    public static function validate($name, $mail, $password, $sector) {
        if($name == null || $mail == null || $password == null || $sector == null)
        {
            return false;
        }
        return true;
    }

    // Metodo para loguear un usuario
    public static function login(Connection $connection, $email, $password) {
        $con = $connection->get_connection();

        $stmt = $con->prepare("SELECT email, password, mail_verified FROM users WHERE email = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if ($user && $user['mail_verified'] && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

    // Metodo para actualizar datos del usuario
    public static function actualizar(Connection $connection, $name, $email, $sector, $id) {
        $con = $connection->get_connection();

        $name = self::escapeData($name);
        $email = self::escapeData($email);
        $sector = self::escapeData($sector);
        $id = self::escapeData($id);

        $stmt = $con->prepare("UPDATE users SET name = :name, email = :email, sector = :sector WHERE id = :id");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':sector', $sector, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Metodo para actualizar el mail como verificado
    public static function verifyEmail(Connection $connection, $token)
    {
        $con = $connection->get_connection();
        $stmt = $con->prepare("UPDATE users SET mail_verified=1 WHERE token=:token");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        $con = $connection->get_connection();
        $stmt = $con->prepare("SELECT email FROM users WHERE token= ?");
        $stmt->execute(array($token));

        return $stmt->fetch();
    }


    public function getToken(){
        return $this->token;
    }
}

?>
