<?php
include __DIR__ . "/../config/urls.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="<?php echo $loginStyle;?>">
    <script src="<?php echo $navbarJS; ?>"></script>
</head>
<body>
<?php 
 include "navbar.php";
?>

<div class="signContainer">
  <form action="../../server/login.php" method="POST">
    <h2>Iniciar sesión</h2>
    <input type="email" name="email" required placeholder="Correo electrónico" class="signInputs">
    <div >
      <input type="password" name="password" required placeholder="Contraseña" class="signInputs">
      <p>¿No tienes cuenta? <a href="signup.php">Crea una</a></p>
    </div>
    <button type="submit">Entrar</button>
  </form>
</div>
    <?php include "footer.php" ?>
    <script src="<?php echo $loginJS; ?>"></script>
</body>
</html>