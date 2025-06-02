<?php
include "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashedPassword);
    
    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION["user_id"] = $id;
        include "../client/index.html";
        echo "Inicio de sesión exitoso. Bienvenido.";
        // header("Location: index.html"); // Descomenta esto si quieres redirigir
    } else {
        include "../client/pages/login.html";
        echo "Correo o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
}
?>
