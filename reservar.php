<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once "app/equipos_service.php";
require_once "app/reservas_service.php";

$equipos = obtenerEquiposDisponibles();
$mensaje = "";
$error = "";

$id_equipo_preseleccionado = isset($_GET["id_equipo"]) ? intval($_GET["id_equipo"]) : 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_SESSION["usuario"]["id_usuario"];
    $id_equipo = intval($_POST["id_equipo"]);
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_fin = $_POST["fecha_fin"];
    $cantidad = intval($_POST["cantidad"]);

    $resultado = crearReserva($id_usuario, $id_equipo, $fecha_inicio, $fecha_fin, $cantidad);

    if ($resultado === true) {
        $mensaje = "Reserva registrada correctamente. El stock fue actualizado.";
    } else {
        $error = $resultado;
    }
}
?>

<?php include("includes/header.php"); ?>

<div class="container mt-5">
    <div class="form-card mx-auto">
        <h2>Realizar reserva</h2>
        <p class="text-muted">
            Esta acción registra la solicitud, descuenta stock y genera trazabilidad del equipo.
        </p>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Equipo</label>
                <select name="id_equipo" class="form-control" required>
                    <option value="">Seleccione un equipo</option>

                    <?php mysqli_data_seek($equipos, 0); ?>
                    <?php while ($equipo = mysqli_fetch_assoc($equipos)): ?>
                        <option value="<?php echo $equipo["id_equipo"]; ?>"
                            <?php echo ($id_equipo_preseleccionado == $equipo["id_equipo"]) ? "selected" : ""; ?>>
                            <?php echo $equipo["nombre"]; ?> - Stock: <?php echo $equipo["stock"]; ?> - S/ <?php echo $equipo["precio_alquiler_dia"]; ?>/día
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Fecha de inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Fecha de fin</label>
                <input type="date" name="fecha_fin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Cantidad</label>
                <input type="number" name="cantidad" class="form-control" min="1" value="1" required>
            </div>

            <button class="btn btn-primary w-100">Registrar reserva</button>
        </form>
    </div>
</div>

<?php include("includes/footer.php"); ?>