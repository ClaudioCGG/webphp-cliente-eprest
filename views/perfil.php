<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ./login.php");
    exit(); // Asegúrate de usar exit después de redirigir para evitar que el script continúe ejecutándose.
}
?>

<!DOCTYPE html>
<html lang="es">

<?php include './components/head.php'; ?>

<body>
    <?php include './components/top-nav-bar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include './components/side-navbar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2 class="mt-3">Información del perfil:</h2><br>

                <?php
                require '../src/controllers/DashboardControlle.php';

                use controllers\DashboardControlle;

                $user = DashboardControlle::perfil();
                $sectores = DashboardControlle::sectores($user["sector"]);
                ?>

                <br>

                <form action="save_profile.php" method="post" class="form-group">

                <input
                    type="hidden"
                    name="id"
                    class="form-control"
                    value="<?php echo $user['id']; ?>"
                    required
                />


                    <label for="name">Nombre del usuario:</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required />
                    <br />

                    <label for="email">Correo del usuario:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required />
                    <br />

                    <label for="sector">Sector:</label>
                    <select name="sector" class="form-select">
                        <option selected value="<?php echo $user["sector"]; ?>">
                            <?php echo $user["sector"]; ?>
                        </option>
                        <?php foreach ($sectores as $sector) { ?>
                            <option value="<?php echo $sector; ?>">
                                <?php echo $sector; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br/>

                    <button type="submit" class="btn btn-success">Actualizar</button>

                </form>
            </main>
        </div>
    </div>
</body>

</html>
