<?php

namespace models;

use controllers\Connection;
use Dotenv\Dotenv;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/PHPMailer/src/Exception.php';
require './vendor/PHPMailer/src/PHPMailer.php';
require './vendor/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/vendor/autoload.php';

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv-> load();


class Mailer {
    protected $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->CharSet = "UTF-8";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPSecure = 'tls'; // Corrected 'tsl' to 'tls'
        $this->mail->Port = 587;
        $this->mail->Username = $_ENV['DB_MAIL_USER'];
        $this->mail->Password = $_ENV['DB_MAIL_PASS'];
        $this->mail->FromName = "Sistema de gestión Maradey";
        $this->mail->From = "";
    }

    public function sendVerificationMail($to, $token) {
        $this->mail->addAddress($to, '');
        $this->mail->addReplyTo('', '');
        $this->mail->isHTML(true);
        $this->mail->Subject = 'Completar el registro';
        
        $this->mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
            </head>
            <body style="text-align: center">
                <h1>Gracias por registrarte</h1>
                <p>
                    Tu cuenta ha sido satisfactoriamente creada. Para poder continuar utilizando tu cuenta, no olvides confirmar tu dirección de correo en el link inferior.
                </p>
                <p>
                    <a href="https://example.com">
                        Complete su registro
                    </a>
                </p>
            </body>
            </html>
        ';


        $this->mail->AltBody = '

         gestor de correo parece algo desactualizado.    Para ver este correo de forma completa, acceda     desde un navegador más reciente.

        ';

        try {
            $this->mail->send();
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function verifyEmail(Connection $connection, $token) {
        $con = $connection->get_connection();
        $stmt = $con->prepare("UPDATE users SET mail_verified=1 WHERE token=:token");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        return $stmt->execute();
    }


}
