<?php

include 'connection.php';

$correo = $_POST['email'] ?? '';
$pass = $_POST['pass'] ?? '';
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $correo); // solo un parámetro tipo string
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();
if($fila == NULL && $fila["email"] !=$correo){
    echo "se va a crear";
    $postUser = $conn->prepare("INSERT INTO users (email, pass, access)
VALUES (?, ?, 1);");
    $postUser->bind_param("ss", $correo, $pass);
    $postUser->execute();
    if ($postUser->affected_rows === 1) {
        echo "Usuario registrado correctamente";
        include 'index.html';
    } else {
        echo "Error al registrar usuario";
    }
}
else{
    echo "el usuario ya existe";
}
?>