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
  <link rel="stylesheet" href="../client/styles/index.css">
  <link rel="stylesheet" href="../client/styles/navbar.css">
  <link rel="stylesheet" href="../client/styles/footer.css">
  <link rel="stylesheet" href="../client/styles/sneakers.css">
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
<footer>
        <h3>
            ¿Listo para ser un cliente <strong>TOTAL</strong>!
        </h3>
        <ul id="">
            <div id="socialMedia">
            <li>
                <img src="https://cdn-icons-png.flaticon.com/512/20/20673.png" alt="F-img">
                <a href="https://www.facebook.com/nike/?locale=es_LA" target="_blank" id="facebook">
                    Facebook
                </a>
                
            </li>
            <li>
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384031.png" alt="I-Img">
                <a href="https://www.instagram.com/nike/" target="_blank" id="instagram">
                    Instagram
                </a>
              </li>
            <li>
                <img src="https://images.icon-icons.com/1558/PNG/512/353427-logo-twitter_107479.png" alt="t-img">
                <a href="https://x.com/nike" target="_blank" id="Twitter">
                    Twitter
                </a>
            </li>
        </div>
            <p>
            Creado por 
            
            <a href=""><b>Joshua García Alcántara</b></a>
            <img src="https://images.icon-icons.com/3685/PNG/512/github_logo_icon_229278.png" alt="">
        </p>
        </ul>
    </footer>
</body>
</html>