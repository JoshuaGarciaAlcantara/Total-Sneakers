<?php
$baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$baseURL .= "://" . $_SERVER['HTTP_HOST'];
$baseURL .= "/web%20page";
$navbar = $baseURL . "/client/pages/navbar.php";
$landing = $baseURL . "/client/pages/landing.php";
$signin = $baseURL . "/client/pages/login.php";
$signup = $baseURL . "/client/pages/signup.php";
$support = $baseURL . "/client/pages/support.php";
$sneakers = $baseURL . "/client/pages/sneakersRefresh.php";

//for includes
// $basePath = realpath(__DIR__ . "/..");  // un nivel arriba de config
// $navbarPath = $basePath . "/pages/navbar.php";    // ruta física para include
// $footerPath = $basePath . "/pages/footer.php";

$footerStyle = $baseURL . "/client/styles/footer.css";
$indexStyle = $baseURL . "/client/styles/index.css";
$loginStyle = $baseURL . "/client/styles/login.css";
$navbarStyle = $baseURL . "/client/styles/navbar.css";
$scrollAnimationStyle = $baseURL . "/client/styles/scrollAnimation.css";
$sneakersStyle = $baseURL . "/client/styles/sneakers.css";
$imagesJS = $baseURL . "/client/scripts/images.js";
$indexJS = $baseURL . "/client/scripts/index.js";
$indexBackgroundJS = $baseURL . "/client/scripts/indexBackground.js";
$loginJS = $baseURL . "/client/scripts/login.js";
$navbarJS = $baseURL . "/client/scripts/navbar.js";
?>