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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <h2>Section title</h2>

                <div class="table-responsive">
                    <table></table>
                </div>
            </main>
        </div>

    </div>




    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Otros scripts personalizados -->
    <script src="../public/js/script.js"></script>
</body>
</html>

