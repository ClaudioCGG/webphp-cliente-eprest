<?php

namespace controllers;

use models\Mailer;

class MailerController {

    public static function verificationMail($email, $token) {
        $mailer = new Mailer();
        $result = $mailer->sendVerificationMail($email, $token);

        if ($result === true) {
            echo "Correo enviado con éxito";
        } else {
            echo "Error al enviar correo: " . $result;
        }
    }
}
