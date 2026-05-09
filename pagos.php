<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once "app/pagos_service.php";
$pagos = obtenerPagos();

include("includes/header.php");
?>

<div class="container mt-5">
    <h2>Pagos registrados</h2>
    <p class="text-muted">
        Visualización de pagos asociados a reservas del sistema.
    </p>

    <div class="table-responsive mt-4">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID Pago</th>
                    <th>Reserva</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Método</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($pagos)): ?>
                    <tr>
                        <td class="fw-bold">#<?php echo $row["id_pago"]; ?></td>
                        <td><span class="badge bg-light text-dark border">#<?php echo $row["id_reserva"]; ?></span></td>
                        <td class="small text-muted"><?php echo $row["fecha_pago"]; ?></td>
                        <td class="text-primary fw-bold">S/ <?php echo number_format($row["monto"], 2); ?></td>
                        <td class="text-capitalize small"><?php echo str_replace('_', ' ', $row["metodo_pago"]); ?></td>
                        <td>
                            <?php 
                            $status_class = "bg-secondary-subtle text-secondary";
                            if ($row["estado_pago"] === "completado") $status_class = "bg-success-subtle text-success";
                            if ($row["estado_pago"] === "pendiente") $status_class = "bg-warning-subtle text-warning";
                            ?>
                            <span class="badge <?php echo $status_class; ?> text-capitalize">
                                <?php echo $row["estado_pago"]; ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php"); ?>