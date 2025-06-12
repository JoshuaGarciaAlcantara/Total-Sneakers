<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="..//styles/login.css">
    <link rel="stylesheet" href="..//styles/navbar.css">
    <link rel="stylesheet" href="..//styles/footer.css">
    <link rel="stylesheet" href="..//styles/index.css">
    <script src="../scripts/login.js"></script>
</head>
<body>
   <?php include "navbar.php" ?>

<div class="signContainer">
  <form action="../../server/signup.php"  method="post">
    <h2>Crear cuenta</h2>
    <input type="text" name="name" required placeholder="Nombre" class="signInputs">
    <input type="text" name="lastName" required placeholder="Apellidos" class="signInputs">
    <input type="email" name="email" required placeholder="Correo electrónico" class="signInputs">
    <input type="password" name="password" required placeholder="Confrimación de contraseña" class="signInputs">
    <input type="password" name="passwordConfirmation" required placeholder="Contraseña" class="signInputs">
    <button type="submit">Registrarse</button>
  </form>
  </div>



  <?php include "footer.php" ?>
</body>
</html>