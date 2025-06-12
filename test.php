<?php
$host = 'mysql://root:XzzrorWdekBHbGAaAJNzEDgIBmtFkqAV@yamanote.proxy.rlwy.net:19623/railway'; // El host real
$user = 'root';
$password = 'XzzrorWdekBHbGAaAJNzEDgIBmtFkqAV';
$database = 'railway';
$port = 3306; // Railway normalmente usa este puerto, pero verifícalo

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
} else {
    echo "✅ Conexión exitosa con Railway desde local.";
}

$conn->close();
?>
