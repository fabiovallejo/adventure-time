<?php
$host = "68.211.88.103";
$user = "Kurogumo";
$password = "krgm.shrkm";
$database = "aventura_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error de conexión con la base de datos: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>