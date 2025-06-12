let carrito = [];
let total = 0;

function agregarAlCarrito(nombre, precio) {
  carrito.push({ nombre, precio });
  actualizarCarrito();
}

function actualizarCarrito() {
  const lista = document.getElementById('lista-carrito');
  const totalElemento = document.getElementById('total');
  lista.innerHTML = '';
  total = 0;

  carrito.forEach((item) => {
    total += item.precio;
    const li = document.createElement('li');
    li.textContent = `${item.nombre} - $${item.precio}`;
    lista.appendChild(li);
  });

  totalElemento.textContent = `Total: $${total}`;
}

function vaciarCarrito() {
  carrito = [];
  actualizarCarrito();
}

function filtrarProductos() {
  const input = document.getElementById('buscador').value.toLowerCase();
  const productos = document.querySelectorAll('.producto');

  productos.forEach(producto => {
    const texto = producto.innerText.toLowerCase();
    producto.style.display = texto.includes(input) ? 'inline-block' : 'none';
  });
}

function goToMenu(){
  window.location.href = "store.html"
}