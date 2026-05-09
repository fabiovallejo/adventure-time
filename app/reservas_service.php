<?php
require_once __DIR__ . "/../config/db.php";

function crearReserva($id_usuario, $id_equipo, $fecha_inicio, $fecha_fin, $cantidad) {
    global $conn;

    mysqli_begin_transaction($conn);

    try {
        $sqlEquipo = "SELECT precio_alquiler_dia, stock, estado 
                      FROM equipos 
                      WHERE id_equipo = ? 
                      FOR UPDATE";

        $stmtEquipo = mysqli_prepare($conn, $sqlEquipo);
        mysqli_stmt_bind_param($stmtEquipo, "i", $id_equipo);
        mysqli_stmt_execute($stmtEquipo);
        $resultEquipo = mysqli_stmt_get_result($stmtEquipo);
        $equipo = mysqli_fetch_assoc($resultEquipo);

        if (!$equipo) {
            throw new Exception("El equipo no existe.");
        }

        if ($equipo["estado"] !== "disponible") {
            throw new Exception("El equipo no está disponible.");
        }

        if ($equipo["stock"] < $cantidad) {
            throw new Exception("No hay stock suficiente.");
        }

        $dias = max(1, (strtotime($fecha_fin) - strtotime($fecha_inicio)) / 86400);
        $precio_dia = $equipo["precio_alquiler_dia"];
        $subtotal = $precio_dia * $cantidad * $dias;
        $total = $subtotal;

        $sqlReserva = "INSERT INTO reservas (id_usuario, fecha_inicio, fecha_fin, estado, total)
                       VALUES (?, ?, ?, 'pendiente', ?)";

        $stmtReserva = mysqli_prepare($conn, $sqlReserva);
        mysqli_stmt_bind_param($stmtReserva, "issd", $id_usuario, $fecha_inicio, $fecha_fin, $total);
        mysqli_stmt_execute($stmtReserva);

        $id_reserva = mysqli_insert_id($conn);

        $sqlDetalle = "INSERT INTO detalle_reserva (id_reserva, id_equipo, cantidad, precio_dia, subtotal)
                       VALUES (?, ?, ?, ?, ?)";

        $stmtDetalle = mysqli_prepare($conn, $sqlDetalle);
        mysqli_stmt_bind_param($stmtDetalle, "iiidd", $id_reserva, $id_equipo, $cantidad, $precio_dia, $subtotal);
        mysqli_stmt_execute($stmtDetalle);

        $sqlStock = "UPDATE equipos SET stock = stock - ? WHERE id_equipo = ?";
        $stmtStock = mysqli_prepare($conn, $sqlStock);
        mysqli_stmt_bind_param($stmtStock, "ii", $cantidad, $id_equipo);
        mysqli_stmt_execute($stmtStock);

        $sqlTraza = "INSERT INTO trazabilidad_equipo (id_equipo, tipo_evento, observacion, estado_equipo)
                     VALUES (?, 'reserva', ?, 'reservado')";

        $observacion = "Reserva registrada desde la web. Cantidad: " . $cantidad;
        $stmtTraza = mysqli_prepare($conn, $sqlTraza);
        mysqli_stmt_bind_param($stmtTraza, "is", $id_equipo, $observacion);
        mysqli_stmt_execute($stmtTraza);

        mysqli_commit($conn);
        return true;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        return $e->getMessage();
    }
}

function obtenerReservasPorUsuario($id_usuario, $tipo_usuario) {
    global $conn;

    if ($tipo_usuario === "administrador") {
        $sql = "SELECT 
                    r.id_reserva,
                    CONCAT(u.nombres, ' ', u.apellidos) AS cliente,
                    r.fecha_inicio,
                    r.fecha_fin,
                    r.estado,
                    r.total
                FROM reservas r
                INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
                ORDER BY r.id_reserva DESC";

        return mysqli_query($conn, $sql);
    }

    $sql = "SELECT 
                r.id_reserva,
                CONCAT(u.nombres, ' ', u.apellidos) AS cliente,
                r.fecha_inicio,
                r.fecha_fin,
                r.estado,
                r.total
            FROM reservas r
            INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
            WHERE r.id_usuario = ?
            ORDER BY r.id_reserva DESC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}
?>