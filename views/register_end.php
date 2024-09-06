    <?php
    require_once '../src/controllers/Connection.php';
    require_once '../src/models/User.php';
    require_once '../src/controllers/VerifyMailController.php';

    use controllers\Connection;
    use controllers\VerifyMailController;
    use models\User;

    $connection = new Connection();
    $name = User::escapeData($_POST['name']);
    $email = User::escapeData($_POST['email']);
    $password = $_POST['password'];
    $sector = User::escapeData($_POST['sector']);





    // Esta validacion no la puedo verificar  ya que los filtros previos limpian este tipo de errores.
        if (!User::validate($name, $email, $sector, $password)) {
            header("Location: ./register.php?errors=true");
        

        } else {
            $user = new User($name, $email, $sector, $password);

            if ($user->save($connection)) {

                VerifyMailController::sendVerificationMail($email, $user->getToken());
/*                 session_start();
                $_SESSION['user'] = $mail; */
                $connection->close_connection();
                header('Location: ./email_not_verified.php');
                exit(); // Es buena práctica incluir exit() después de una redirección
            }


    }
