<?php
include 'connection.php';

// Manejar agregar nuevo producto
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $state = $_POST['state'];
    $quantity = $_POST['quantity'];

    // Insertar nuevo producto
    $stmt = $conn->prepare("INSERT INTO sneakers (name, description, price, state, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $name, $description, $price, $state, $quantity);
    $stmt->execute();
    $stmt->close();

    $message = "Producto agregado correctamente.";
}

// Manejar actualizar stock
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_stock'])) {
    $id = $_POST['id'];
    $new_quantity = (int)$_POST['new_quantity'];

    // Actualizar cantidad y estado según cantidad
    $new_state = $new_quantity > 0 ? "available" : "unavailable";
    $stmt = $conn->prepare("UPDATE sneakers SET quantity = ?, state = ? WHERE id = ?");
    $stmt->bind_param("isi", $new_quantity, $new_state, $id);
    $stmt->execute();
    $stmt->close();

    $message = "Stock actualizado correctamente.";
}

// Manejar eliminar producto
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_product'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM sneakers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $message = "Producto eliminado correctamente.";
}

// Obtener lista actualizada de productos
$result = $conn->query("SELECT * FROM sneakers");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Administrar Sneakers</title>
    <link rel="stylesheet" href="../CSS/access.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #0077b6; color: white; }
        input[type=number] { width: 60px; }
        .message { color: green; }
        form.inline { display: inline; }
        button { cursor: pointer; }
    </style>
</head>
<body>

<h2>Agregar un nuevo Sneaker</h2>

<?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

<form method="POST">
  <input type="hidden" name="add_product" value="1" />
  <label for="name">Nombre:</label>
  <input type="text" id="name" name="name" required>

  <label for="description">Descripción:</label>
  <textarea id="description" name="description" rows="3"></textarea>

  <label for="price">Precio ($):</label>
  <input type="number" id="price" name="price" step="0.01" required>

  <label for="state">Estado:</label>
  <select id="state" name="state" required>
    <option value="available">Disponible</option>
    <option value="unavailable">No disponible</option>
  </select>

  <label for="quantity">Cantidad:</label>
  <input type="number" id="quantity" name="quantity" min="0" required>

  <button type="submit">Agregar Producto</button>
</form>

<h2>Inventario de Sneakers</h2>

<?php if ($result->num_rows === 0): ?>
    <p>No hay productos en inventario.</p>
<?php else: ?>
<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio ($)</th>
      <th>Estado</th>
      <th>Cantidad</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['description']) ?></td>
      <td><?= number_format($row['price'], 2) ?></td>
      <td><?= htmlspecialchars($row['state'] === 'available' ? 'Disponible' : 'No disponible') ?></td>
      <td>
        <form method="POST" class="inline">
          <input type="hidden" name="update_stock" value="1" />
          <input type="hidden" name="id" value="<?= $row['id'] ?>" />
          <input type="number" name="new_quantity" min="0" value="<?= (int)$row['quantity'] ?>" required />
          <button type="submit">Actualizar</button>
        </form>
      </td>
      <td>
        <form method="POST" class="inline" onsubmit="return confirm('¿Eliminar este producto?');">
          <input type="hidden" name="delete_product" value="1" />
          <input type="hidden" name="id" value="<?= $row['id'] ?>" />
          <button type="submit" style="background-color:#dc3545; color:white; border:none; padding:5px 10px; border-radius:3px;">Eliminar</button>
        </form>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<a href="../HTML/store.html" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
  Regresar a store
</a>
<?php endif; ?>

</body>
</html>