<?php
session_start();
require_once "app/auth_service.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    $usuario = loginUsuario($correo, $clave);

    if ($usuario) {
        $_SESSION["usuario"] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        $error = "Correo o clave incorrectos.";
    }
}
?>

<?php include("includes/header.php"); ?>

<div class="container mt-5">
    <div class="auth-card mx-auto">
        <h2>Iniciar sesión</h2>
        <p class="text-muted">Accede para reservar equipos o revisar tus solicitudes.</p>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Clave</label>
                <input type="password" name="clave" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Ingresar</button>
        </form>

        <p class="mt-3 text-center">
            Usuario de prueba: <strong>ana@gmail.com</strong> / clave: <strong>123456</strong>
        </p>
    </div>
</div>

<?php include("includes/footer.php"); ?>