<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $name = $_POST["name"];
    $lastName = $_POST["lastName"];


    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Este correo ya está registrado.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email,name, lastName, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $name, $lastName,$password);
        if ($stmt->execute()) {
            $user = $name;
            echo "
            <script>
            alert(\"Registro exitoso. Puedes iniciar sesión.\");
            window.location.href='../client/pages/login.php';</script>
            ";
        } else {
            echo "
            <script>
            alert(\"Error al registrar usuario.\");
            window.location.href='../client/pages/login.php';</script>";
        }
    }

    $check->close();
    $conn->close();
}
?>