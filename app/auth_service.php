<?php
require_once __DIR__ . "/../config/db.php";

function loginUsuario($correo, $clave) {
    global $conn;

    $sql = "SELECT id_usuario, nombres, apellidos, correo, tipo_usuario 
            FROM usuarios 
            WHERE correo = ? AND clave = ? 
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $correo, $clave);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function registrarUsuario($nombres, $apellidos, $correo, $telefono, $clave) {
    global $conn;

    $sql = "INSERT INTO usuarios (nombres, apellidos, correo, telefono, tipo_usuario, clave)
            VALUES (?, ?, ?, ?, 'cliente', ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nombres, $apellidos, $correo, $telefono, $clave);

    return mysqli_stmt_execute($stmt);
}
?>