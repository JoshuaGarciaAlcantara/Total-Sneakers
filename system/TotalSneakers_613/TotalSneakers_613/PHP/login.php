<?php

include 'connection.php';

if ($conn) {
    echo "sí pudiste<br>";
}

// Obtener datos del formulario
$correo = $_POST['email'] ?? '';
$contraseña = $_POST['pass'] ?? '';


// Preparar la consulta (solo 1 parámetro)
$stmt = $conn->prepare("SELECT pass, access  FROM users WHERE email = ?");
$stmt->bind_param("s", $correo); // solo un parámetro tipo string
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    // Comparar contraseñas (sin hash)
    if($fila['access']=== "admin"){
        include 'menu.php';
    }
    elseif ($contraseña === $fila['pass']) {
        echo "Inicio de sesión exitoso su usuario tiene acceso " . $fila['access'];
        include '../HTML/store.html';
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
    include '../HTML/index.html';
}

$stmt->close();
$conn->close();

?>
