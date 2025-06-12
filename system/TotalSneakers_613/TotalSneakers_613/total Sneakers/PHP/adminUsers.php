<?php
include 'connection.php';

// Agregar usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_user'])) {
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Seguridad
    $access = $_POST['access'];
    $conn->query("INSERT INTO users (email, pass, access) VALUES ('$email', '$pass', '$access')");
}

// Actualizar permiso de usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_access'])) {
    $id = $_POST['user_id'];
    $new_access = $_POST['new_access'];
    $conn->query("UPDATE users SET access = '$new_access' WHERE id = $id");
}

// Agregar cliente
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_client'])) {
    $nombre = $_POST['nombre_cliente'];
    $correo = $_POST['correo_cliente'];
    $direccion = $_POST['direccion_cliente'];
    $conn->query("INSERT INTO clients (nombre, correo, direccion) VALUES ('$nombre', '$correo', '$direccion')");
}

// Agregar proveedor
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_provider'])) {
    $nombre = $_POST['nombre_proveedor'];
    $telefono = $_POST['telefono_proveedor'];
    $empresa = $_POST['empresa_proveedor'];
    $conn->query("INSERT INTO proveedores (nombre, telefono, empresa) VALUES ('$nombre', '$telefono', '$empresa')");
}

// Consultas
$result_users = $conn->query("SELECT id, email, access FROM users");
$result_clients = $conn->query("SELECT * FROM clients");
$result_providers = $conn->query("SELECT * FROM proveedores");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Administración</title>
  <link rel="stylesheet" href="../CSS/access.css">
  <style>
    table { border-collapse: collapse; width: 100%; margin-bottom: 30px;}
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left;}
    form.inline { display: inline; }
    button { cursor: pointer; }
  </style>
</head>
<body>
  <h1>Administración de Usuarios, Clientes y Proveedores</h1>

  <!-- USUARIOS -->
  <h2>Agregar Usuario</h2>
  <form method="POST">
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="pass" placeholder="Contraseña" required>
    <select name="access" required>
      <option value="admin">Admin</option>
      <option value="client">Client</option>
      <option value="vendedor">Vendedor</option>
      <option value="proveedor">Proveedor</option>
    </select>
    <button type="submit" name="add_user">Agregar Usuario</button>
  </form>

  <h2>Lista de Usuarios</h2>
  <table>
    <tr>
      <th>Email</th>
      <th>Acceso actual</th>
      <th>Modificar acceso</th>
    </tr>
    <?php while ($row = $result_users->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['access']) ?></td>
        <td>
          <form method="POST" class="inline">
            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
            <select name="new_access" required>
              <option value="admin" <?= $row['access'] === 'admin' ? 'selected' : '' ?>>Admin</option>
              <option value="client" <?= $row['access'] === 'client' ? 'selected' : '' ?>>Client</option>
              <option value="vendedor" <?= $row['access'] === 'vendedor' ? 'selected' : '' ?>>Vendedor</option>
              <option value="proveedor" <?= $row['access'] === 'proveedor' ? 'selected' : '' ?>>Proveedor</option>
            </select>
            <button type="submit" name="update_access">Actualizar</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <hr>

  <!-- CLIENTES -->
  <h2>Agregar Cliente</h2>
  <form method="POST">
    <input name="nombre_cliente" placeholder="Nombre" required>
    <input name="correo_cliente" type="email" placeholder="Correo" required>
    <input name="direccion_cliente" placeholder="Dirección">
    <button type="submit" name="add_client">Agregar Cliente</button>
  </form>

  <h3>Lista de Clientes</h3>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Dirección</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result_clients->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['correo']) ?></td>
          <td><?= htmlspecialchars($row['direccion']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <hr>

  <!-- PROVEEDORES -->
  <h2>Agregar Proveedor</h2>
  <form method="POST">
    <input name="nombre_proveedor" placeholder="Nombre" required>
    <input name="telefono_proveedor" placeholder="Teléfono">
    <input name="empresa_proveedor" placeholder="Empresa">
    <button type="submit" name="add_provider">Agregar Proveedor</button>
  </form>

  <h3>Lista de Proveedores</h3>
  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Empresa</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result_providers->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['telefono']) ?></td>
          <td><?= htmlspecialchars($row['empresa']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Botón regreso -->
  <a href="menu.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
    Regresar al menú
  </a>

</body>
</html>