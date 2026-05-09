<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo_usuario"] !== "administrador") {
    header("Location: login.php");
    exit;
}

require_once "app/equipos_service.php";

$equipos = obtenerEquiposDisponibles();
$trazabilidad = obtenerTrazabilidadEquipos();

include("includes/header.php");
?>

<div class="container mt-5">
    <h2>Panel de inventario y trazabilidad</h2>
    <p class="text-muted">
        Esta vista permite al administrador supervisar stock, estado de equipos y eventos de trazabilidad.
    </p>

    <h4 class="mt-4">Inventario actual</h4>

    <div class="table-responsive mt-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Equipo</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Precio Día</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($equipos)): ?>
                    <tr>
                        <td class="fw-bold">#<?php echo $row["id_equipo"]; ?></td>
                        <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                        <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($row["categoria"]); ?></span></td>
                        <td><span class="badge bg-dark"><?php echo $row["stock"]; ?></span></td>
                        <td>
                            <?php if ($row["estado"] === "disponible"): ?>
                                <span class="badge bg-success-subtle text-success">Disponible</span>
                            <?php else: ?>
                                <span class="badge bg-warning-subtle text-warning">Mantenimiento</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-primary fw-bold">S/ <?php echo number_format($row["precio_alquiler_dia"], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <h4 class="mt-5">Trazabilidad de equipos</h4>

    <div class="table-responsive mt-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Equipo</th>
                    <th>Evento</th>
                    <th>Observación</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($trazabilidad)): ?>
                    <tr>
                        <td class="text-muted small"><?php echo $row["fecha_registro"]; ?></td>
                        <td class="fw-bold"><?php echo htmlspecialchars($row["equipo"]); ?></td>
                        <td>
                            <span class="badge bg-info-subtle text-info text-capitalize">
                                <?php echo str_replace('_', ' ', $row["tipo_evento"]); ?>
                            </span>
                        </td>
                        <td class="small"><?php echo htmlspecialchars($row["observacion"]); ?></td>
                        <td>
                            <span class="badge bg-light text-dark border"><?php echo $row["estado_equipo"]; ?></span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php"); ?>