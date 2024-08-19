<?php
    session_start();

    // Verificar si hay errores y definir la clase de error
    $errorsClass = 'errors';
    if (isset($_REQUEST['errors']) && $_REQUEST['errors'] == true) {
        $errorsClass = 'errors-active';
    }

    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi aplicación</title>
    <link href="../public/css/app.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex text-center text-white bg-dark" style="height: 100vh;">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php include './components/header-inicio.php'; ?>
        <main class="px-3">
        <form id="registerForm" action="register_end.php" method="post" class="form-group">
            <label for="name">Ingrese nombre</label>
            <input type="text" name="name" class="form-control" required />
            <br>
            <label for="email">Ingrese correo</label>
            <input type="email" name="email" class="form-control" required />
            <br>
            <label for="password">Ingrese una contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required />
            <br>
            <label for="confirm_password">Confirme la contraseña</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
            <div id="passwordError" class="text-danger" style="display: none;">Las contraseñas no coinciden.</div>
            <br>
            <label for="sector">Departamento</label>
            <select name="sector" id="" class="form-select">
                <option value="IT Department">IT Department</option>
                <option value="Sales">Sales</option>
                <option value="Graphic Design">Graphic Design</option>
                <option value="Marketing">Marketing</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success">Registrarse</button>

            <span class="errors text-center <?php echo $errorsClass; ?>">
                La validación ha fallado, revise que todos los  campos esten completos.
            </span>
            <br>
        </form>
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Otros scripts personalizados -->
    <script src="../public/js/script.js"></script>
</body>
</html>
