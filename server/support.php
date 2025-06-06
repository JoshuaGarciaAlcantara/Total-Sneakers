<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Soporte</title>
  <link rel="stylesheet" href="../client/styles/navbar.css">
  <link rel="stylesheet" href="../client/styles/footer.css">
  <link rel="stylesheet" href="../client/styles/index.css">
  <link rel="stylesheet" href="../client/styles/login.css">
  <script src="../client/scripts/navbar.js"></script>
  <script src="../client/scripts/login.js"></script>
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
        <a class="nav-link" href="../../server/sneakersRefresh.php" onclick="closeMenu()">Total kids</a>
        <a class="nav-link" href="../../server/sneakersRefresh.php" onclick="closeMenu()">Total teens</a>
        <a class="nav-link" href="../../server/sneakersRefresh.php" onclick="closeMenu()">Total senior</a>
        <a class="nav-link" href="../../server/sneakersRefresh.php" onclick="closeMenu()">Total lady</a>
        <a class="nav-link" href="../../server/sneakersRefresh.php" onclick="closeMenu()">Total All stars</a>
      </div>
    </div>

    <a class="nav-link" href="#" onclick="closeMenu()">Ayuda</a>
  </div>
</div>
<div class="signContainer">
  <form action="send_support.php" method="POST">
    <h2>Ayuda al cliente</h2>
    <input type="text" name="nombre" required placeholder="Nombre">
    <input type="email" name="email" required placeholder="Email">
    <textarea name="mensaje" rows="5" required placeholder="Mensaje"></textarea>

    <button type="submit">Enviar</button>
  </form>
  </div>
  <footer>
        <h3>
            ¿Listo para ser un cliente <strong>TOTAL</strong>!
        </h3>
        <ul id="">
            <div id="socialMedia">
            <li>
                <img src="https://cdn-icons-png.flaticon.com/512/20/20673.png" alt="F-img">
                <a href="https://www.facebook.com/nike/?locale=es_LA" target="_blank">
                    Facebook
                </a>
                
            </li>
            <li>
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384031.png" alt="I-Img">
                <a href="https://www.instagram.com/nike/" target="_blank">
                    Instagram
                </a>
              </li>
            <li>
                <img src="https://images.icon-icons.com/1558/PNG/512/353427-logo-twitter_107479.png" alt="t-img">
                <a href="https://x.com/nike" target="_blank">
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
