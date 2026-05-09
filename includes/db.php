<?php
$host = "IP_PUBLICA_DE_TU_VM_MYSQL";
$user = "aventura_user";
$password = "ClaveSegura123*";
$database = "aventura_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}
?>