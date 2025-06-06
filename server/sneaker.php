<?php
include 'connection.php';

if (!isset($_GET['name'])) {
    die('No se proporcionó el nombre del producto.');
}

$name = $_GET['name'];

$stmt = $conn->prepare("SELECT name, description, price, stock FROM sneakers WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Producto no encontrado.');
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link rel="stylesheet" href="../client/styles/index.css">
    <link rel="stylesheet" href="../client/styles/navbar.css">
    <link rel="stylesheet" href="../client/styles/footer.css">
    <link rel="stylesheet" href="../client/styles/sneakers.css">
    <style>
        .product-page {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background: #fff;
            text-align: center;
        }
        .product-page img {
            max-width: 300px;
            border-radius: 10px;
        }
        .product-page h1 {
            font-size: 2rem;
            margin: 20px 0 10px;
        }
        .product-page p {
            font-size: 1rem;
            margin: 10px 0;
        }
        .price {
            font-size: 1.5rem;
            color: green;
            margin: 15px 0;
        }
        .buy-section {
            margin-top: 20px;
        }
        .buy-section input[type="number"] {
            padding: 5px;
            width: 60px;
            margin-right: 10px;
        }
        .buy-section button {
            padding: 10px 20px;
            background-color: #222;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
        }
        .buy-section button:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="product-page">
    <img src="https://d1lfxha3ugu3d4.cloudfront.net/exhibitions/images/2015_Sneaker_Culture_1._AJ_1_from_Nike_4000W.jpg.jpg" alt="<?= htmlspecialchars($product['name']) ?>">
    
    <h1><?= htmlspecialchars($product['name']) ?></h1>
    <p><?= htmlspecialchars($product['description']) ?></p>
    <div class="price">$<?= number_format($product['price'], 2) ?></div>
    <p><strong>Stock disponible:</strong> <?= $product['stock'] ?></p>

    <div class="buy-section">
        <form method="POST" action="buy.php">
            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
            <label for="quantity">Cantidad:</label>
            <input type="number" name="quantity" min="1" max="<?= $product['stock'] ?>" value="1" required>
            <button type="submit">Comprar</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
