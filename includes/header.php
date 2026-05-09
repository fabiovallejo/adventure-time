<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuarioLogueado = isset($_SESSION["usuario"]);
$tipoUsuario = $usuarioLogueado ? $_SESSION["usuario"]["tipo_usuario"] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdventureTime</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">AdventureTime</a>

        <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-outline-light btn-sm" href="index.php">Inicio</a>
            <a class="btn btn-outline-light btn-sm" href="equipos.php">Equipos</a>

            <?php if ($usuarioLogueado): ?>
                <a class="btn btn-outline-light btn-sm" href="reservar.php">Reservar</a>
                <a class="btn btn-outline-light btn-sm" href="mis_reservas.php">Mis reservas</a>
                <a class="btn btn-outline-light btn-sm" href="pagos.php">Pagos</a>

                <?php if ($tipoUsuario === "administrador"): ?>
                    <a class="btn btn-warning btn-sm" href="admin_inventario.php">Inventario</a>
                <?php endif; ?>

                <a class="btn btn-danger btn-sm" href="logout.php">Salir</a>
            <?php else: ?>
                <a class="btn btn-primary btn-sm" href="login.php">Ingresar</a>
                <a class="btn btn-success btn-sm" href="registro.php">Registrarse</a>
            <?php endif; ?>
        </div>
    </div>
</nav>