<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = escapeshellarg($_POST['nombre']);
    $email = escapeshellarg($_POST['email']);
    $mensaje = escapeshellarg($_POST['mensaje']);

    // Llamar al script de Python
    $comando = "python send_email.py " . escapeshellarg($nombre) . " " . escapeshellarg($email) . " " . escapeshellarg($mensaje);;
    $salida = shell_exec($comando);

    if (strpos($salida, 'ENVIADO') !== false) {
        echo "<script>alert('Mensaje enviado correctamente.'); window.location.href='support.php';</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje.\\n$salida'); window.location.href='ayuda.php';</script>";
    }
}
?>
