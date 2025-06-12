<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $conn->query("INSERT INTO clients (nombre, correo, direccion) VALUES ('$nombre', '$correo', '$direccion')");
}
$result = $conn->query("SELECT * FROM clients");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Administrar Clientes</title>
  <link rel="stylesheet" href="../CSS/access.css">
</head>
<body>
  <h1>Clientes</h1>

  <form method="POST">
    <input name="nombre" placeholder="Nombre" required>
    <input name="correo" placeholder="Correo" type="email" required>
    <input name="direccion" placeholder="Dirección">
    <button type="submit">Agregar</button>
    <a href="menu.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
  Regresar al menú
</a>
  </form>

  <h2>Lista de Clientes</h2>
  <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li><?= $row['nombre'] ?> - <?= $row['correo'] ?> - <?= $row['direccion'] ?></li>
    <?php endwhile; ?>
  </ul>
</body>
</html>
