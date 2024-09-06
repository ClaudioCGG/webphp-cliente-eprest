<?php

namespace models;

use controllers\Connection;
use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';
require 'C:\wamp64\www\proyecto1\vendor\autoload.php'; // Cargar PHPMailer y otras librerías necesarias

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Mailer {
    protected $email;

    public function __construct() {

        $this->email = new PHPMailer(true);
        $this->email->SMTPDebug = 0;
        $this->email->isSMTP();
        $this->email->SMTPAuth = true;
        $this->email->CharSet = "UTF-8";
        $this->email->Host = 'smtp.gmail.com';
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->email->Port = 587;
        $this->email->Username = getenv('DB_MAIL_USER');
        $this->email->Password = getenv('DB_MAIL_PASS');
        $this->email->setFrom(getenv('DB_MAIL_USER'), "Sistema de gestión Maradey");
    }

    public function sendVerificationMail($to, $token) {

        $this->email->addAddress($to);
        $this->email->addReplyTo("", "No responder");
        $this->email->isHTML(true);
        $this->email->Subject = 'Validar registro, hacer click en el link adjunto...';
        $this->email->Body = "
            <html>
                <head>
                    <meta charset='utf-8'>
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
                </head>
                <body style='text-align: center'>
                    <h1>Gracias por registrarte</h1>
                    <p>
                        Tu cuenta ha sido satisfactoriamente creada. Haz clic en el siguiente enlace para activar tu cuenta: 
                        <a href='http://localhost/proyecto1/views/verifyAccount.php?token=".$token."'> Verificar cuenta </a>
                    </p>
                </body>
            </html>
        ";

        $this->email->AltBody = 'Haz click en el siguiente enlace para activar tu cuenta: http://localhost/proyecto1/views/verifyAccount.php?token=' . $token;

        try {
            $this->email->send();
            return true;
        } catch (\Exception $e) {
            error_log('PHPMailer Error: ' . $this->email->ErrorInfo, 3, "C:/wamp64/logs/php_error.log");
            return $e->getMessage();
        }
    }

}
?>
