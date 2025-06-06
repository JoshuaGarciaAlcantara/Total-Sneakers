<?php
 session_start();
$_SESSION['compra'] = [
    'producto' => 'Sneakers Lady Total',
    'cantidad' => 2,
    'precio_unitario' => 899,
    'total' => 1798,
    'fecha' => date('Y-m-d H:i:s')
];

session_start();

if (!isset($_SESSION['compra'])) {
    echo "No hay info de compra";
    exit;
}

$compra = $_SESSION['compra'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de tu compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            padding: 2rem;
        }

        .resumen {
            background: #111;
            border: 1px solid #f00;
            padding: 2rem;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }

        h2 {
            color: red;
            text-align: center;
        }

        .resumen p {
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>
    <div class="resumen">
        <h2>🎉 ¡Gracias por tu compra!</h2>
        <p><strong>Producto:</strong> <?= htmlspecialchars($compra['producto']) ?></p>
        <p><strong>Cantidad:</strong> <?= $compra['cantidad'] ?></p>
        <p><strong>Precio unitario:</strong> $<?= $compra['precio_unitario'] ?></p>
        <p><strong>Total pagado:</strong> $<?= $compra['total'] ?></p>
        <p><strong>Fecha:</strong> <?= $compra['fecha'] ?></p>
    </div>
</body>
</html>
