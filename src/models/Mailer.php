<?php

namespace models;

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../../vendor/autoload.php'; // Cargar PHPMailer y otras librerías necesarias

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Mailer {
    protected $mail;

    public function __construct() {

        // Configuración del servidor SMTP
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = 0; // desactive la depuracion SMTP::DEBUG_SERVER
        //$this->mail->SMTPDebug = SMTP::DEBUG_CONNECTION; // Muestra detalles de la conexión
        //$this->mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;   // Muestra incluso los comandos y respuestas SMTP en detalle
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
        $this->mail->Username = $_ENV['DB_MAIL_USER'];
        $this->mail->Password = $_ENV['DB_MAIL_PASS'];
        $this->mail->setFrom($_ENV['DB_MAIL_USER'], 'SISTEMA DE GESTION DE CONSORCIO MARADEY');

    }

    // Configuración para el envio de mail
    public function sendVerificationMail($to, $token) {

        $this->mail->addAddress($to,'');
        $this->mail->addReplyTo('cguirado.ln@gmail.com', 'No responder');
        $this->mail->isHTML(true);
        $this->mail->Subject = 'Validar registro, hacer click en el link adjunto...';
        $this->mail->Body = "
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

        $this->mail->AltBody = 'Haz click en el siguiente enlace para activar tu cuenta: http://localhost/proyecto1/views/verifyAccount.php?token=' . $token;

        try {
            $this->mail->send();
            return true;
        } catch (Exception $e) {
    
          return $e->getMessage();
        }




    }

}
?>
