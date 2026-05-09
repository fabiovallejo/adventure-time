<?php
require_once "app/auth_service.php";

$mensaje = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $clave = $_POST["clave"];

    if (registrarUsuario($nombres, $apellidos, $correo, $telefono, $clave)) {
        $mensaje = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
    } else {
        $error = "No se pudo registrar el usuario. Verifica que el correo no exista.";
    }
}
?>

<?php include("includes/header.php"); ?>

<div class="container mt-5">
    <div class="auth-card mx-auto">
        <h2>Registro de cliente</h2>
        <p class="text-muted">Crea una cuenta para reservar equipos de aventura.</p>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Nombres</label>
                <input type="text" name="nombres" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Apellidos</label>
                <input type="text" name="apellidos" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control">
            </div>

            <div class="mb-3">
                <label>Clave</label>
                <input type="password" name="clave" class="form-control" required>
            </div>

            <button class="btn btn-success w-100">Registrarme</button>
        </form>
    </div>
</div>

<?php include("includes/footer.php"); ?>