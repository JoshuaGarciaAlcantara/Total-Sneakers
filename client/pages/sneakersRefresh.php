<?php
include '../../server/connection.php';

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
<?php
include __DIR__ . "/../config/urls.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Sneakers</title>
  <link rel="stylesheet" href="<?php echo $sneakersStyle;?>">
</head>
<body>
  <?php include "navbar.php" ?>



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
  <div class="sneakersContainer">
  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      
      <a class="sneaker" href="sneaker.php?name=<?= urlencode($row['name']) ?>" type="submit">
        <img src="https://d1lfxha3ugu3d4.cloudfront.net/exhibitions/images/2015_Sneaker_Culture_1._AJ_1_from_Nike_4000W.jpg.jpg" alt="">
        <h3><?= htmlspecialchars($row['name']) ?></h3>
        <p><?= htmlspecialchars($row['description']) ?></p>
        <div class="price">$<?= number_format($row['price'], 2) ?></div>
    </a>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No se encontraron sneakers para esta categoría.</p>
  <?php endif; ?>
  </div>

  <?php
    $stmt->close();
    $conn->close();
  ?>

<?php include "footer.php";?>
</body>
</html>