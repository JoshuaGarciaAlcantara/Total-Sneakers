
function loadProducts() {
  fetch('../PHP/getProducts.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('products-container').innerHTML = data;
    })
    .catch(error => console.error('Error loading products:', error));
}

// Load on page load
window.onload = loadProducts;

