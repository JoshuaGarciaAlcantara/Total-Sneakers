<?php
include __DIR__ . "/../config/urls.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Navbar Desplegable Completo</title>
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="stylesheet" href="../styles/footer.css">
  <link rel="stylesheet" href="../styles/navbar.css">
  <link rel="stylesheet" href="../styles/scrollAnimation.css">
  <style>
    /* scroll animation */
    @keyframes scrollAnimation{
    from{
        opacity: 0;
        scale: 10%;
    }
    to{
        opacity: 1;
        scale: 100%;
    }
}
    /* basic style */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      overflow-x: visible;
    }
    
    /*thing for the particles called sparks  */
    /* th efollowing one will be just to ensure the sparks hoover */
    
    #spark1{
      background-color: #000;
      height: 200px;
      width: 100vw;
      position: absolute;
      bottom: 200px;
      z-index: -21;
      transform: rotate(44deg);
      transition-duration: 1s;
    }
    #spark2{
      background-color: rgba(203, 35, 35, 0.6);
      height: 200px;
      width: 100vw;
      position: absolute;
      bottom: 200px;
      right: 200px;
      z-index: -20;
      transform: rotate(44deg);
      transition: 1s;
    }
    #spark2:hover{
      background-color: rgb(203, 35, 35);

    }
    #spark3{
      position: absolute;
      width: 300px;
      height: 300px;
      right: 1px;
      animation: sparksAnimation1 20s infinite linear;
      z-index: -25;
    }
    #spark4{
      position: absolute;
      background-color: rgb(158, 33, 33);
      animation: sparksAnimation2 10s infinite linear;
      width: 10px;
      height: 10px;
      right: 100px;
      bottom: 1px
    }
    #spark5{
      object-fit: contain;
      position: absolute;
      animation: sparksAnimation3 10s infinite linear;
      width: 200px;
      height: 200px;
      bottom: 1px;
      z-index: -21;
    }
    #spark6{
      position: absolute;
      background-color: rgb(158, 33, 33);
      animation: sparksAnimation2 8s infinite linear;
      width: 50px;
      height: 50px;
      right: 20px;
      top: 1px
    }

    @keyframes sparksAnimation1{
      from{
        transform: translateX(100%);
        transition-duration: 1s;
      }
      to {
        transform: translateX(-450%) rotate(-40deg);
        transition-duration: 1s;
        opacity: 0;
        background-color: transparent;
      }
    }
    @keyframes sparksAnimation2{
      from{
        transform: translateX(100%);
        background-color: transparent;
        transition-duration: 1s;
      }
      50%{
        background-color: rgb(158, 33, 33);
        transition-duration: 1s;
      }
      to {
        transform: translateX(-450%) rotate(60deg);
        background-color: transparent;
        opacity: 0;
        transition-duration: 1s;
      }
    }
    @keyframes sparksAnimation3{
      from{
        transform: translateX(-100%);
        transition-duration: 1s;
      }
      to {
        transform: translateX(400%) rotate(60deg);
        background-color: transparent;
        opacity: 0;
        transition-duration: 1s;
      }
    }
    /* in this part ends the sparks animations */
    main > img {
      height: 100dvh;
      object-fit: cover;
      position: fixed;
      z-index: -1;
      transition-duration: 1s;
      animation: ease;
      filter: drop-shadow(5px 5px 10px #000000) grayscale(100%);
    }
    main >img:hover{
      transition-duration: 1s;
      filter: grayscale(0%) drop-shadow(5px 5px 10px #000000);
    }
    header{
      display: grid;
      justify-content: center;
    }

    main {
      height: 300dvh;
      display: grid;
      justify-items: center;
    }
    
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #FFF;
      color: #000000;
      font-size: 20px;
    }
    /* navbar code */

    /* 3rd section */
    #section_2{
        display: grid;
        grid-template-columns: 1fr 1fr;
        place-items: center;
        color: #FFF;
        background-image: linear-gradient(transparent ,  #000 50%);
    }
    #section_2 > h2{
      width: fit-content;
      height: fit-content;
      bottom: 100;
        align-content: center;
        text-align: center;
        transition: .5s;
    }
    #section_2 > h2:hover{
        scale: 1.1
    }
    #section_2 > iframe{
        align-content: center;
        align-self: center;
    }
    iframe{
      border-radius: 20px;
      margin: 0 20px 0 0;
      transition: 1s;
      animation: ease-in-out;
    }
    iframe:hover{
      border-radius: 20px;
      margin: 0 20px 0 0;
      scale: .98;
    }
    /* first section */
    header{
        display: grid;
        position: absolute;
        justify-content: center;
        bottom:-500px;
    }
    header >h1{
      width: 100vw;
        font-size: 100px;
        margin-bottom: 0;
        text-align: center;
        transition-duration: 0.5s;
        /* the following code is for animation */
        view-timeline-name: --show;
        animation-name: scrollAnimation;
        animation-fill-mode: both;
        animation-timeline: --show;
        animation-range: entry 25% cover 50%;
    }
    header >h1:hover{
      width: 100vw;
      font-size: 110px;
      color: #fff;
      text-shadow: 0px 3px 21px rgba(0,0,0,0.6);
    }
    header >h6{
        height: 30px;
        color: #FFF;
        margin: 0;
        display: inline-block;
        white-space: nowrap;
        animation: floatText 30s infinite linear;
        padding-left: 100%; /*Initial offset, which places the text off-screen*/
        color:#000000;
    }
    header >h6:hover{
      color: rgb(171, 20, 20);
    }
    
    @keyframes floatText {
      to {
        transform: translateX(-200%);
        transition-duration: 1s;
      }
}


    /* 2nd section */
    #who{
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-bottom: 1000px;
        background-color: #000;
        color: #FFF;
        justify-content: center;
    }
    #who  >p{
      align-content: center;
      /* the following code is for animation */
        view-timeline-name: --show;
        animation-name: scrollAnimation;
        animation-fill-mode: both;
        animation-timeline: --show;
        animation-range: entry 25% cover 50%;
    }
    #who > h2{
        font-size: 100px;
        align-content: center;
        text-align: center;
        overflow-wrap: anywhere;
        transition: .5s;
        /* the following code is for animation */
        view-timeline-name: --show;
        animation-name: scrollAnimation;
        animation-fill-mode: both;
        animation-timeline: --show;
        animation-range: entry 25% cover 50%;
    }
    @media (max-width: 768px) {
      #who{ 
        h2{
        font-size: 50px;
        }
        p{
          font-size: 10px;
        }
      }

      header> h1{
        font-size: 50px;
      }
      /* 1st section */
      header >h1:hover{
        font-size: 60px;
      }
      /* 2nd section */
      #who{
        text-overflow: ellipsis;
        padding: 0 50px;
    }
      #section2{
        background-color: antiquewhite;
        grid-template-columns: 1fr;
        grid-template-rows: 1fr 1fr;
      }
  }

    /*this is for navbar
    /* This is to exapend the menu but i think it loooks kinda weird, so i just comment it */
    
  </style>
</head>
<body>

<?php 
  include "navbar.php";
?>
<script src="../scripts/navbar.js"></script>
<script type="module" src="../scripts/indexBackground.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@simondmc/popup-js@1.4.3/popup.min.js"></script>

  <div id="spark1"></div>
  <div id="spark2"></div>
  <img id="spark3" src="https://cdn11.bigcommerce.com/s-azs446wiic/images/stencil/1280x1280/products/545/6907/l0b8nlhbafxuusgbci7v__51564.1688060921.png?c=2" alt="sneaker2">
  <div id="spark4">
  </div>
    <img id="spark5" src="https://www.hogan.com/medias/107-Hogan.png?context=bWFzdGVyfGltYWdlc3wxNTE4ODd8aW1hZ2UvcG5nfGltYWdlcy9oMzUvaGRjLzkzMzU2MTkxMjUyNzgucG5nfDE3NzcwYzMyMWNhYWE5ZWQzMWExNDI1NDExNzVhYjJhZmI5YmJjMzE1ZTVlZjI1YmNjMjk5MDk1OTdhMmI3NDY" alt="sneaker2">
  <div id="spark6"></div>
  <div id="spark7"></div>
  <div id="spark8"></div>
  <div id="spark9"></div>
  <div id="spark10"></div>
  <div id="spark11"></div>
  <div id="spark12"></div>
  <div id="spark13"></div>

<header>
    <h1>
            T O T A L
            <br>
            S N E A K E R S
        </h1>
        <h6>● Envío gratis en compras mayores a $999 ● Paga por transferencia y recibe 5% de descuento ● Compra a meses sin intereses ● Cambios y devoluciones sin costo ● Nuevas colecciones disponibles ● Regístrate y obtén 10% en tu primera compra ●</h6></header>
    <main>
    
    </main>

    <section id="who">
        <p>
            Somos más que una tienda de zapatillas; somos una comunidad basada en una pasión compartida por el calzado, el estilo y la autoexpresión.
            <br><br>
            En Totala, creemos que cada par de zapatillas cuenta una historia. 
            <br><br>
            Nuestra misión es simple: conectar a las personas con las zapatillas que les llaman la atención. 
        </p>
        <h2>¿Quiénes somos nosotros?
        </h2>
    </section>
    <section id="section_2">
        <h2>
            Más de 500 sucrulsales en chilanngolandia
        </h2>
      <iframe width="80%" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=C.%20Cam.%20a%20Nextengo,%20Santa%20Apolonia,%20Azcapotzalco,%2002790%20Ciudad%20de%20M%C3%A9xico,%20CDMX+(TOTAL%20SNEAKERS)&amp;t=p&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/collections/sports-gps/">Cycling gps</a></iframe>
    </section>

    <?php
    include "footer.php"; 
    ?>
</body>
</html>