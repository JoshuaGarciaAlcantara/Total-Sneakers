<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Soporte</title>
  <style>
    body{
        margin: 0;
    }
    form { background: #222; padding: 20px; border-radius: 10px; max-width: 500px; margin: auto; }
    input, textarea { field-sizing:content; 100%; padding: 10px; margin-top: 10px; background: #333; color: white; border: none; border-radius: 5px; }
    button { background: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; margin-top: 15px; cursor: pointer; }
  </style>
  <link rel="stylesheet" href="../client/styles/navbar.css">
  <link rel="stylesheet" href="../client/styles/footer.css">
  <link rel="stylesheet" href="../client/styles/index.css">
  <script src="../client/scripts/navbar.js"></script>
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
  <h1>Soporte Total Sneakers</h1>
  <form action="send_support.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required>

    <label for="mensaje">Mensaje:</label>
    <textarea name="mensaje" rows="5" required></textarea>

    <button type="submit">Enviar</button>
  </form>
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
