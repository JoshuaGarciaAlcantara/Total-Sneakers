<?php
include "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta SQL
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Resultados esperados: id, name, hashedPassword
    $stmt->bind_result($id, $name, $hashedPassword);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;

            echo "<script>
            alert('Inicio de sesión exitoso. Bienvenido, $name!');
            window.location.href='../client/pages/landing.php';
            </script>";
        } else {
            echo "<script>
            alert('Contraseña incorrecta.');
            window.location.href='../client/pages/login.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Correo no encontrado.');
        window.location.href='../client/pages/login.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
