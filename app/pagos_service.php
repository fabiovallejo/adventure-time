<?php
require_once __DIR__ . "/../config/db.php";

function obtenerPagos() {
    global $conn;

    $sql = "SELECT 
                p.id_pago,
                p.id_reserva,
                p.fecha_pago,
                p.monto,
                p.metodo_pago,
                p.estado_pago
            FROM pagos p
            ORDER BY p.id_pago DESC";

    return mysqli_query($conn, $sql);
}
?>