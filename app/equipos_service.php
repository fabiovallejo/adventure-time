<?php
require_once __DIR__ . "/../config/db.php";

function obtenerEquiposDisponibles() {
    global $conn;

    $sql = "SELECT 
                e.id_equipo,
                e.nombre,
                e.descripcion,
                e.marca,
                e.stock,
                e.precio_alquiler_dia,
                e.estado,
                e.imagen_url,
                c.nombre AS categoria
            FROM equipos e
            INNER JOIN categorias c ON e.id_categoria = c.id_categoria
            ORDER BY e.id_equipo ASC";

    return mysqli_query($conn, $sql);
}

function obtenerEquipoPorId($id_equipo) {
    global $conn;

    $sql = "SELECT * FROM equipos WHERE id_equipo = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_equipo);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function obtenerTrazabilidadEquipos() {
    global $conn;

    $sql = "SELECT 
                t.id_trazabilidad,
                e.nombre AS equipo,
                t.fecha_registro,
                t.tipo_evento,
                t.observacion,
                t.estado_equipo
            FROM trazabilidad_equipo t
            INNER JOIN equipos e ON t.id_equipo = e.id_equipo
            ORDER BY t.fecha_registro DESC";

    return mysqli_query($conn, $sql);
}
?>