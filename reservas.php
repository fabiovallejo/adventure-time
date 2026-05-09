<?php
require_once "app/reservas_service.php";
$reservas = obtenerReservas();

include("includes/header.php");
?>

<div class="container mt-5">
    <h2 class="mb-4">Reservas registradas</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID Reserva</th>
                    <th>Cliente</th>
                    <th>Fecha Reserva</th>
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
                            <td><?php echo $row["id_reserva"]; ?></td>
                            <td><?php echo $row["cliente"]; ?></td>
                            <td><?php echo $row["fecha_reserva"]; ?></td>
                            <td><?php echo $row["fecha_inicio"]; ?></td>
                            <td><?php echo $row["fecha_fin"]; ?></td>
                            <td><?php echo $row["estado"]; ?></td>
                            <td>S/ <?php echo $row["total"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay reservas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php"); ?>