<?php
namespace controllers;

use models\Mailer;

require_once __DIR__ . '/../models/Mailer.php';


class VerifyMailController {

    public static function sendVerificationMail($to, $token) {
        $email = new Mailer();
        $email->sendVerificationMail($to, $token);
    }
}
