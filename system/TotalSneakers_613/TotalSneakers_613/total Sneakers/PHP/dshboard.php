<?php
include 'connection.php';

// Cambiar estado del producto
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['change_state'])) {
    $product_id = intval($_POST['product_id']);
    $new_state = $_POST['new_state'] === 'existente' ? 'existente' : 'sin stock'; // solo esos dos estados permitidos

    $stmt = $conn->prepare("UPDATE sneakers SET state = ? WHERE id = ?");
    $stmt->bind_param("si", $new_state, $product_id);
    $stmt->execute();
    $stmt->close();
}

// Obtener lista de productos
$result = $conn->query("SELECT * FROM sneakers");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard Sneakers</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
<style>
  body {
    font-family: 'Roboto', sans-serif;
    margin: 20px;
  }
  .hero {
    margin-bottom: 20px;
  }
  .hero button {
    margin-right: 10px;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
  }
  .hero button:hover {
    background-color: #0056b3;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
  }
  select {
    padding: 5px;
  }
  button.change-state {
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 6px 10px;
    cursor: pointer;
  }
  button.change-state:hover {
    background-color: #1e7e34;
  }
</style>
</head>
<body>

<section class="hero">
  <h2>Check out our Sneakers</h2>
  <button onclick="location.href='agregar_producto.php'">Add Product</button>
  <button onclick="location.href='ventas.php'">Go to Sales</button>
</section>

<h3>Lista de Sneakers</h3>
<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Estado</th>
      <th>Cambiar Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>$<?= htmlspecialchars($row['price']) ?></td>
        <td><?= htmlspecialchars($row['state']) ?></td>
        <td>
          <form method="POST" style="margin:0;">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <select name="new_state" required>
              <option value="existente" <?= $row['state'] === 'existente' ? 'selected' : '' ?>>Existente</option>
              <option value="sin stock" <?= $row['state'] === 'sin stock' ? 'selected' : '' ?>>Sin Stock</option>
            </select>
            <button type="submit" name="change_state" class="change-state">Cambiar</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>