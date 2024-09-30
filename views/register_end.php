<?php
    require_once __DIR__ . '/../src/controllers/Connection.php';
    require_once __DIR__ . '/../src/models/User.php';
    require_once __DIR__ . '/../src/controllers/MailerController.php'; // Asegúrate que este archivo tiene el namespace correcto

    use controllers\Connection;
    use controllers\MailerController;
    use models\User;

    $connection = new Connection();
    $name = User::escapeData($_POST['name']);
    $email = User::escapeData($_POST['email']);
    $password = $_POST['password'];
    $sector = User::escapeData($_POST['sector']);

    if (User::validate($name, $email, $sector, $password)) {
        $user = new User($name, $email, $sector, $password);

        $user->save($connection);

        $mailerController = new MailerController();
        $mailerController->verificationMail($email, $user->getToken());

        $connection->close_connection();
        header('Location: ./email_not_verified.php');
        exit();
    } else {
        header("Location: ./register.php?errors=true");
    }

?>

