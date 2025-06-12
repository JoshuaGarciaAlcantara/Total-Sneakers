<?php
include __DIR__ . "/../config/urls.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Soporte</title>
  <link rel="stylesheet" href="../client/styles/navbar.css">
    <link rel="stylesheet" href="../footer.css">
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="stylesheet" href="../styles/login.css">
  <script src="../client/scripts/navbar.js"></script>
  <script src="../client/scripts/login.js"></script>
</head>
<body>
<?php 
include "navbar.php";
?>
<div class="signContainer">
  <form action="../../server/send_support.php" method="POST">
    <h2>Ayuda al cliente</h2>
    <input type="text" name="nombre" required placeholder="Nombre">
    <input type="email" name="email" required placeholder="Email">
    <textarea name="mensaje" rows="5" required placeholder="Mensaje"></textarea>

    <button type="submit">Enviar</button>
  </form>
  </div>
  <?php
    include "footer.php"; 
    ?>
</body>
</html>
