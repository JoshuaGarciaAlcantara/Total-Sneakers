<?php
$host = "localhost";
$user = "root";
$pass = ""; // Cambia por tu contraseña si tienes una
$dbname = "sneakers_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
