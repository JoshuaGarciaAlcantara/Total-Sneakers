<?php
include 'connection.php';

// Recibir búsquedas
$search_user = $_GET['search_user'] ?? '';
$search_client = $_GET['search_client'] ?? '';
$search_provider = $_GET['search_provider'] ?? '';

// Eliminar usuario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_user'])) {
    $id = intval($_POST['user_id']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Eliminar cliente
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_client'])) {
    $id = intval($_POST['client_id']);
    $conn->query("DELETE FROM clients WHERE id = $id");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Eliminar proveedor
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_provider'])) {
    $id = intval($_POST['provider_id']);
    $conn->query("DELETE FROM proveedores WHERE id = $id");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Consultas con búsqueda
$sql_users = "SELECT id, email, access FROM users WHERE email LIKE '%" . $conn->real_escape_string($search_user) . "%'";
$result_users = $conn->query($sql_users);

$sql_clients = "SELECT * FROM clients WHERE nombre LIKE '%" . $conn->real_escape_string($search_client) . "%'";
$result_clients = $conn->query($sql_clients);

$sql_providers = "SELECT * FROM proveedores WHERE nombre LIKE '%" . $conn->real_escape_string($search_provider) . "%' OR empresa LIKE '%" . $conn->real_escape_string($search_provider) . "%'";
$result_providers = $conn->query($sql_providers);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Administración Completa</title>
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

  <!-- BUSCAR USUARIOS -->
  <h2>Buscar Usuarios</h2>
  <form method="GET">
    <input type="text" name="search_user" placeholder="Buscar por correo" value="<?= htmlspecialchars($search_user) ?>">
    <button type="submit">Buscar</button>
  </form>

  <?php if ($result_users && $result_users->num_rows > 0): 
    $user_to_delete = $result_users->fetch_assoc();
  ?>
    <form method="POST" style="margin-top: 10px;">
      <input type="hidden" name="user_id" value="<?= $user_to_delete['id'] ?>">
      <button type="submit" name="delete_user" style="background-color: #e74c3c; color: white; padding: 8px 12px; border: none; border-radius: 5px;">Eliminar usuario: <?= htmlspecialchars($user_to_delete['email']) ?></button>
    </form>
  <?php endif; ?>

  <h3>Usuarios</h3>
  <table>
    <tr>
      <th>Email</th>
      <th>Acceso</th>
    </tr>
    <?php if ($result_users && $result_users->num_rows > 0): ?>
      <?php
      $result_users->data_seek(0);
      while ($row = $result_users->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['access']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="2">No se encontraron usuarios.</td></tr>
    <?php endif; ?>
  </table>

  <hr>

  <!-- BUSCAR CLIENTES -->
  <h2>Buscar Clientes</h2>
  <form method="GET">
    <input type="text" name="search_client" placeholder="Buscar por nombre" value="<?= htmlspecialchars($search_client) ?>">
    <button type="submit">Buscar</button>
  </form>

  <?php if ($result_clients && $result_clients->num_rows > 0): 
    $client_to_delete = $result_clients->fetch_assoc();
  ?>
    <form method="POST" style="margin-top: 10px;">
      <input type="hidden" name="client_id" value="<?= $client_to_delete['id'] ?>">
      <button type="submit" name="delete_client" style="background-color: #e74c3c; color: white; padding: 8px 12px; border: none; border-radius: 5px;">
        Eliminar cliente: <?= htmlspecialchars($client_to_delete['nombre']) ?>
      </button>
    </form>
  <?php endif; ?>

  <h3>Clientes</h3>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Dirección</th>
    </tr>
    <?php if ($result_clients && $result_clients->num_rows > 0): ?>
      <?php
      $result_clients->data_seek(0);
      while ($row = $result_clients->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['correo']) ?></td>
          <td><?= htmlspecialchars($row['direccion']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="3">No se encontraron clientes.</td></tr>
    <?php endif; ?>
  </table>

  <hr>

  <!-- BUSCAR PROVEEDORES -->
  <h2>Buscar Proveedores</h2>
  <form method="GET">
    <input type="text" name="search_provider" placeholder="Buscar por nombre o empresa" value="<?= htmlspecialchars($search_provider) ?>">
    <button type="submit">Buscar</button>
  </form>

  <?php if ($result_providers && $result_providers->num_rows > 0): 
    $provider_to_delete = $result_providers->fetch_assoc();
  ?>
    <form method="POST" style="margin-top: 10px;">
      <input type="hidden" name="provider_id" value="<?= $provider_to_delete['id'] ?>">
      <button type="submit" name="delete_provider" style="background-color: #e74c3c; color: white; padding: 8px 12px; border: none; border-radius: 5px;">
        Eliminar proveedor: <?= htmlspecialchars($provider_to_delete['nombre']) ?>
      </button>
    </form>
  <?php endif; ?>

  <h3>Proveedores</h3>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Empresa</th>
    </tr>
    <?php if ($result_providers && $result_providers->num_rows > 0): ?>
      <?php
      $result_providers->data_seek(0);
      while ($row = $result_providers->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['nombre']) ?></td>
          <td><?= htmlspecialchars($row['telefono']) ?></td>
          <td><?= htmlspecialchars($row['empresa']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="3">No se encontraron proveedores.</td></tr>
    <?php endif; ?>
  </table>
  <a href="menu.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
  Regresar al menú
</a>

</body>
</html>