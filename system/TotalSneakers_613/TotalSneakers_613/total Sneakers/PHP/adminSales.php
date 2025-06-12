<?php
include 'connection.php';

// Insertar venta si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $id_vendedor = $_POST['id_vendedor'];
    $id_cliente = $_POST['id_cliente'];
    $fecha = $_POST['fecha'];
    $hora_venta = $_POST['hora_venta'];
    $registro = date("Y-m-d H:i:s"); // Registro actual
    $rfc = $_POST['rfc'];
    $tipo_persona = $_POST['tipo_persona'];
    $metodo_pago = $_POST['metodo_pago'];

    $conn->query("INSERT INTO ventas (nombre, id_vendedor, id_cliente, Fecha, Hora_venta, REGISTRO, RFC, TIPO_PERSONA, METODO_PAGO)
    VALUES ('$nombre', '$id_vendedor', '$id_cliente', '$fecha', '$hora_venta', '$registro', '$rfc', '$tipo_persona', '$metodo_pago')");
}

// Obtener ventas registradas
$result_ventas = $conn->query("SELECT * FROM ventas");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ventas</title>
    <link rel="stylesheet" href="../CSS/access.css">
</head>
<body>
    <h2>Registrar Venta</h2>
    <form method="POST">
        <label for="nombre">Nombre del Cliente:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="id_vendedor">ID del Vendedor:</label>
        <input type="number" id="id_vendedor" name="id_vendedor" required>

        <label for="id_cliente">ID del Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required>

        <label for="fecha">Fecha de Venta:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="hora_venta">Hora de Venta:</label>
        <input type="datetime-local" id="hora_venta" name="hora_venta" required>

        <label for="rfc">RFC:</label>
        <input type="text" id="rfc" name="rfc" maxlength="13" required>

        <label for="tipo_persona">Tipo de Persona:</label>
        <input type="text" id="tipo_persona" name="tipo_persona" required>

        <label for="metodo_pago">Método de Pago:</label>
        <select id="metodo_pago" name="metodo_pago" required>
            <option value="Efectivo">Efectivo</option>
            <option value="Tarjeta">Tarjeta</option>
            <option value="Transferencia">Transferencia</option>
            <option value="Otro">Otro</option>
        </select>

        <button type="submit">Registrar Venta</button>
    </form>

    <a href="menu.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
        Regresar al menú
    </a>

    <h2>Ventas Registradas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>ID Vendedor</th>
                <th>ID Cliente</th>
                <th>Fecha</th>
                <th>Hora Venta</th>
                <th>Registro</th>
                <th>RFC</th>
                <th>Tipo Persona</th>
                <th>Método de Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($venta = $result_ventas->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($venta['id']) ?></td>
                    <td><?= htmlspecialchars($venta['nombre']) ?></td>
                    <td><?= htmlspecialchars($venta['id_vendedor']) ?></td>
                    <td><?= htmlspecialchars($venta['id_cliente']) ?></td>
                    <td><?= htmlspecialchars($venta['Fecha']) ?></td>
                    <td><?= htmlspecialchars($venta['Hora_venta']) ?></td>
                    <td><?= htmlspecialchars($venta['REGISTRO']) ?></td>
                    <td><?= htmlspecialchars($venta['RFC']) ?></td>
                    <td><?= htmlspecialchars($venta['TIPO_PERSONA']) ?></td>
                    <td><?= htmlspecialchars($venta['METODO_PAGO']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>