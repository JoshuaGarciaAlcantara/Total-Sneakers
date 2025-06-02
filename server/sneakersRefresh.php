<?php
include 'connection.php';

// Categorías válidas para filtrar
$valid_categories = ['Total kids', 'Total teens', 'Total senior', 'Total lady', 'Total all stars'];

// Obtener categoría del GET, si no está o no es válida mostrar todos
$category = isset($_GET['category']) && in_array($_GET['category'], $valid_categories) ? $_GET['category'] : '';

if ($category) {
    $stmt = $conn->prepare("SELECT name, description, price, stock FROM sneakers WHERE category = ?");
    $stmt->bind_param("s", $category);
} else {
    $stmt = $conn->prepare("SELECT name, description, price, stock FROM sneakers");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Sneakers</title>
  <style>
    body {
      background-color: #000;
      color: white;
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    h2 {
      color: #e50914;
      margin-bottom: 20px;
      text-align: center;
    }
    select {
      padding: 8px;
      font-size: 16px;
      margin-bottom: 30px;
      border-radius: 5px;
      border: none;
    }
    .sneaker {
      background-color: #111;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 8px;
    }
    .sneaker h3 {
      margin: 0 0 8px;
      color: #e50914;
    }
    .sneaker p {
      margin: 0 0 8px;
      color: #ccc;
    }
    .price {
      font-weight: bold;
      margin-bottom: 8px;
    }
    .buy-btn {
      background-color: #e50914;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }
  </style>
  <link rel="stylesheet" href="../client/styles/navbar.css">
</head>
<body>
  <div class="navbar">
  <button class="toggle-btn" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </button>
  <div id="navMenu" class="nav-menu">
    <a class="nav-link" href="index.html" onclick="closeMenu()">Inicio</a>
    <a class="nav-link" href="login.html" onclick="closeMenu()">Iniciar sesión</a>
    
    <div class="nav-item">
      <span class="nav-link" onclick="toggleDropdown()">Sneakers ▼</span>
      <div id="dropdown" class="dropdown">
        <a class="nav-link" href="kids.html" onclick="closeMenu()">Total kids</a>
        <a class="nav-link" href="teens.html" onclick="closeMenu()">Total teens</a>
        <a class="nav-link" href="senior.html" onclick="closeMenu()">Total senior</a>
        <a class="nav-link" href="lady.html" onclick="closeMenu()">Total lady</a>
        <a class="nav-link" href="allStars.html" onclick="closeMenu()">Total All stars</a>
      </div>
    </div>

    <a class="nav-link" href="#" onclick="closeMenu()">Ayuda</a>
  </div>
</div>

  <h2>Catálogo de Sneakers</h2>

  <form method="GET" id="categoryForm">
    <label for="category">Filtrar por categoría:</label>
    <select name="category" id="category" onchange="document.getElementById('categoryForm').submit()">
      <option value="">Todas</option>
      <?php foreach ($valid_categories as $cat): ?>
        <option value="<?= htmlspecialchars($cat) ?>" <?= $cat === $category ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="sneaker">
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><?= htmlspecialchars($row['description']) ?></p>
        <div class="price">$<?= number_format($row['price'], 2) ?></div>
        <button class="buy-btn" <?= $row['stock'] > 0 ? '' : 'disabled' ?>>
          <?= $row['stock'] > 0 ? 'Comprar' : 'Agotado' ?>
        </button>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No se encontraron sneakers para esta categoría.</p>
  <?php endif; ?>

  <?php
    $stmt->close();
    $conn->close();
  ?>

</body>
</html>