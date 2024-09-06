<?php


namespace controllers;

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';
require 'C:\wamp64\www\proyecto1\vendor\autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class MailerController
{
    protected $email;

    public function __construct()
    {
        $this->email = new PHPMailer(true);
        $this->email->isSMTP();
        $this->email->SMTPAuth = true;
        $this->email->CharSet = "UTF-8";
        $this->email->Host = "smtp.gmail.com";
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->email->Port = 587;
        $this->email->Username = getenv('DB_MAIL_USER');
        $this->email->Password = getenv('DB_MAIL_PASS');
        $this->email->setFrom(getenv('DB_MAIL_USER'), "Sistema de gestión Maradey");
    }

    public function sendVerificationMail($to, $token)
    {
        $this->email->addAddress($to);
        $this->email->addReplyTo("");
        $this->email->isHTML(true);
        $this->email->Subject = "";
        $this->email->Body = "
            <html>
                <body style='text-align: center'>
                    <h1>Gracias por registrarte</h1>
                    <p>
                        Tu cuenta ha sido satisfactoriamente creada. 
                        Para poder continuar utilizando tu cuenta, no olvides
                        confirmar tu dirección de correo en el link inferior.
                    </p>
                    <p>
                        <a href='http://localhost/proyecto1/views/verifyAccount.php?token=".$token."'></a>
                    </p>
                </body>
            </html>
        ";

        $this->email->AltBody = "";

        try{
            $this->email->send();
            return true;
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

}