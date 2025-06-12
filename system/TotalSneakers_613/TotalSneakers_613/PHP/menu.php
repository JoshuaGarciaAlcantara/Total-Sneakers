<head>
    <link rel="stylesheet" href="../CSS/access.css">
</head>

<h1>¡BIENVENIDO@!</h1>
<p>
    Bienvenido/a
Si estás viendo esta pantalla, es porque has ingresado con las credenciales correctas y tienes permisos de administrador al menú de management de Total Sneakers.
Desde aquí, puedes realizar todas las acciones necesarias para gestionar el sistema.
Te recordamos que, como administrador, cuentas con acceso a funciones avanzadas.
Por favor, procede con responsabilidad.
Haz lo que necesites. Esta área está diseñada para ti.


function loadProducts() {
  fetch('getProducts.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('products-container').innerHTML = data;
    })
    .catch(error => console.error('Error loading products:', error));
}
<script>
window.onload = loadProducts;

function p(){
  window.location.href = "adminUsers.php"; 
}
function s(){
  window.location.href = "../HTML/store.html"; 
}
function ad(){

  window.location.href = "adminProducts.php"; 
}
function ads(){
  window.location.href = "adminSales.php"; 
}
function prov(){
  window.location.href = "adminProveedores.php"; 
}

</script>

</p>
<button onclick="p()">
    inspeccionar usuarios
</button>
<button onclick="s()">
    Inspeccionar store
</button>
<button onclick="ad()">
    añadir sneaker
</button>
<button onclick="ads()">
    inspeccionar las ventas
</button>
<button onclick="prov()">
    inspeccionar registros
</button>