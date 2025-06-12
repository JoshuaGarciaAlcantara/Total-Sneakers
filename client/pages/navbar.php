<?php
session_start();
include __DIR__ . "/../config/urls.php";
header("Cache-Control: no-cache, must-revalidate"); // Opcional, pero útil para evitar cache
?>

<link rel="stylesheet" href="<?php echo $navbarStyle ?>">
<link rel="stylesheet" href="<?php echo $indexStyle ?>">

<nav class="navbar">
  <button class="toggle-btn" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </button>
  <div id="navMenu" class="nav-menu">
    <a class="nav-link" href="<?php echo $landing ?>">Inicio</a>

    <?php if (isset($_SESSION["user_id"])): ?>
      <span class="nav-link">Hola, <?php echo htmlspecialchars($_SESSION["user_name"]); ?></span>
      <a class="nav-link" href="<?php echo $logout ?>" onclick="return confirmLogout()">Cerrar sesión</a>
    <?php else: ?>
      <a class="nav-link" href="<?php echo $signin ?>">Iniciar sesión</a>
    <?php endif; ?>

    <!-- Dropdown Sneakers -->
    <div class="nav-item">
      <span class="nav-link" onclick="toggleDropdown()">Sneakers ▼</span>
      <div id="dropdown" class="dropdown">
        <a class="nav-link" href="<?php echo $sneakers;?>" onclick="closeMenu()">Total kids</a>
        <a class="nav-link" href="<?php echo $sneakers;?>" onclick="closeMenu()">Total teens</a>
        <a class="nav-link" href="<?php echo $sneakers;?>" onclick="closeMenu()">Total senior</a>
        <a class="nav-link" href="<?php echo $sneakers;?>" onclick="closeMenu()">Total lady</a>
        <a class="nav-link" href="<?php echo $sneakers;?>" onclick="closeMenu()">Total All stars</a>
      </div>
    </div>

    <a class="nav-link" href="<?php echo $support?>" onclick="closeMenu()">Ayuda</a>
  </div>
</nav>

<script>
function confirmLogout() {
  return confirm("¿Estás seguro de que deseas cerrar sesión?");
}
</script>
