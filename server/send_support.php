<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = escapeshellarg($_POST['nombre']);
    $email = escapeshellarg($_POST['email']);
    $msj = escapeshellarg($_POST['mensaje']);

    // Llamar al script de Python
    $command = "python send_email.py " . escapeshellarg($name) . " " . escapeshellarg($email) . " " . escapeshellarg($msj);;
    $output = shell_exec($command);

    if (strpos($output, 'ENVIADO') !== false) {
        echo "<script src=\"https://cdn.jsdelivr.net/npm/@simondmc/popup-js@1.4.3/popup.min.js\">
        </script><script>
        window.location.href='../client/pages/support.php';
        const myPopup = new Popup({
            id: \"my-popup\",
            title: \"202\",
            content: `
                Tu mensaje ha sido enviado con éxito`,
            showImmediately: true
        });
        </script>";
    } else {
        echo "<script>
        alert('Error al enviar el mensaje.\\n$output'); 
        window.location.href='ayuda.php';</script>";
    }
}
?>
