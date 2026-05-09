<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once "app/reservas_service.php";

$id_usuario = $_SESSION["usuario"]["id_usuario"];
$tipo_usuario = $_SESSION["usuario"]["tipo_usuario"];
$reservas = obtenerReservasPorUsuario($id_usuario, $tipo_usuario);

include("includes/header.php");
?>

<div class="container mt-5">
    <h2>Reservas registradas</h2>
    <p class="text-muted">
        Permite realizar seguimiento de las solicitudes de alquiler.
    </p>

    <div class="table-responsive mt-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID Reserva</th>
                    <th>Cliente</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($reservas && mysqli_num_rows($reservas) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($reservas)): ?>
                        <tr>
                            <td class="fw-bold">#<?php echo $row["id_reserva"]; ?></td>
                            <td><?php echo htmlspecialchars($row["cliente"]); ?></td>
                            <td class="small"><?php echo $row["fecha_inicio"]; ?></td>
                            <td class="small"><?php echo $row["fecha_fin"]; ?></td>
                            <td>
                                <?php 
                                $status_class = "bg-secondary-subtle text-secondary";
                                if ($row["estado"] === "confirmada") $status_class = "bg-success-subtle text-success";
                                if ($row["estado"] === "pendiente") $status_class = "bg-warning-subtle text-warning";
                                ?>
                                <span class="badge <?php echo $status_class; ?> text-capitalize">
                                    <?php echo $row["estado"]; ?>
                                </span>
                            </td>
                            <td class="text-primary fw-bold">S/ <?php echo number_format($row["total"], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
<?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No hay reservas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php"); ?>