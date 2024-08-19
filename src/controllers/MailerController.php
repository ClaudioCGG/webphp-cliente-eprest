<?php


namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailerController
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->CharSet = "UTF-8";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPSecure = 'tsl'; //
        $this->mail->Port = 587;
        $this->mail->Username = "";
        $this->mail->Password = "";
        $this->mail->FromName = "Sistema de gestión";
        $this->mail->From = "";
    }

    public function sendVerificationMail($to, $token)
    {
        $this->mail->addAddress("", '');
        $this->mail->addReplyTo("", '');
        $this->mail->isHTML(true);
        $this->mail->Subject = "";
        $this->mail->Body = "
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

        $this->mail->AltBody = "";

        try{
            $this->mail->send();
            return true;
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

}