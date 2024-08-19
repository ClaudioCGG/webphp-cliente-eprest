<?php
namespace Controller;

require_once '../models/Mailer.php';

use Models\Mailer;

class VerifyMailController {

    public static function sendVerificationMail($to, $token) {
        $mail = new Mailer();
        $mail->sendVerificationMail($to, $token);
    }
}
