<?php
namespace models;

require_once 'Model.php';
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

    public function __construct($name, $email, $sector, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->sector = $sector;
        $this->token = (new \AfaanBilal\RandomString\RandomString(20))->generate();
        $this->mail_verified = false;
        $this->creation = null;

    }

    public function save(Connection $connection) {
        $con = $connection->get_connection();

        $stmt = $con->prepare(
            "INSERT INTO users (name, email, password, sector, token, mail_verified, creation)
            VALUES (:name, :email, :password, :sector, :token, :mail_verified,now())"
        );

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":sector", $this->sector);
        $stmt->bindParam(":token", $this->token);
        $stmt->bindParam(":mail_verified", $this->mail_verified);

        // No necesitas un marcador de posición para :creation ya que la fecha y hora actuales
        // se insertarán directamente mediante la función NOW() en la consulta SQL.
        // $stmt->bindParam(":creation", $this->creation);

        $stmt->execute();
    }

    public static function login(Connection $connection, $email, $password) {
        $con = $connection->get_connection();

        $stmt = $con->prepare("SELECT email, password FROM users WHERE email = ?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

    public static function validate($name, $email, $password, $sector) {
        if ($name == null || $email == null || $password == null || $sector == null) {
            return false;
        }
        return true;
    }

    public static function usersDetail(Connection $connection, string $email) {
        $con = $connection->get_connection();
        $stmt = $con->prepare("SELECT * FROM users WHERE email= ?");
        $stmt->execute(array($email));
        return $stmt->fetch();
    }

    public static function actualizar(Connection $connection, $name, $email, $sector, $id) {
        $con = $connection->get_connection();

        $name = self::escapeData($name);
        $email = self::escapeData($email);
        $sector = self::escapeData($sector);
        $id = self::escapeData($id);


        $stmt = $con->prepare(
            "UPDATE users SET name=:name, email=:email, sector=:sector WHERE id=:id"
        );
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':sector', $sector, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getToken(){
        return    $this->token;
    }

}

?>
