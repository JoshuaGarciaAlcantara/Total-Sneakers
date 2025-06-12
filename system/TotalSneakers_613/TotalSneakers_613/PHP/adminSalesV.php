<?php
include 'connection.php';
session_start();

// Inicializar carrito en sesión si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Manejar agregar al carrito
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_to_cart'])) {
    $name = $_POST['name'];
    $quantity = (int)$_POST['quantity'];

    // Buscar el producto en DB para verificar stock
    $stmt = $conn->prepare("SELECT quantity FROM sneakers WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 1) {
        $product = $res->fetch_assoc();
        $stock = (int)$product['quantity'];

        // Verificar que la cantidad pedida no exceda stock
        if ($quantity > 0 && $quantity <= $stock) {
            // Agregar o actualizar carrito
            if (isset($_SESSION['cart'][$name])) {
                // Sumar cantidades pero no superar stock
                $newQty = $_SESSION['cart'][$name] + $quantity;
                $_SESSION['cart'][$name] = min($newQty, $stock);
            } else {
                $_SESSION['cart'][$name] = $quantity;
            }
            $message = "Producto agregado al carrito.";
        } else {
            $error = "Cantidad inválida o mayor al stock disponible ($stock).";
        }
    } else {
        $error = "Producto no encontrado.";
    }
    $stmt->close();
}

// Manejar eliminar producto del carrito
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['remove_from_cart'])) {
    $name = $_POST['name'];
    if (isset($_SESSION['cart'][$name])) {
        unset($_SESSION['cart'][$name]);
        $message = "Producto eliminado del carrito.";
    }
}

// Manejar finalizar venta
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['finalize_sale'])) {
    if (empty($_SESSION['cart'])) {
        $error = "El carrito está vacío.";
    } else {
        // Aquí debes capturar datos de venta, para simplificar pongo datos dummy:
        $id_vendedor = 1; // Ejemplo fijo
        $id_cliente = 1; // Ejemplo fijo
        $fecha = date("Y-m-d");
        $hora_venta = date("Y-m-d H:i:s");
        $registro = date("Y-m-d H:i:s");
        $rfc = "XAXX010101000"; // Dummy
        $tipo_persona = "Moral"; // Dummy
        $metodo_pago = "Efectivo"; // Dummy

        $conn->begin_transaction();
        try {
            foreach ($_SESSION['cart'] as $name => $qty) {
                // Obtener id, price, cantidad disponible
                $stmt = $conn->prepare("SELECT id, price, quantity FROM sneakers WHERE name = ?");
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows !== 1) throw new Exception("Producto no encontrado: $name");
                $product = $res->fetch_assoc();
                $stock = (int)$product['quantity'];
                $price = (float)$product['price'];
                $id_producto = $product['id'];

                if ($qty > $stock) throw new Exception("Cantidad insuficiente en stock para $name.");

                // Insertar venta (puedes adaptarlo para registrar productos y cantidades)
                $stmtInsert = $conn->prepare("INSERT INTO ventas (nombre, id_vendedor, id_cliente, Fecha, Hora_venta, REGISTRO, RFC, TIPO_PERSONA, METODO_PAGO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmtInsert->bind_param("siissssss", $name, $id_vendedor, $id_cliente, $fecha, $hora_venta, $registro, $rfc, $tipo_persona, $metodo_pago);
                $stmtInsert->execute();

                // Actualizar stock y estado en sneakers
                $nuevo_stock = $stock - $qty;
                $estado_nuevo = $nuevo_stock > 0 ? "Existente" : "Ya no hay";

                $stmtUpdate = $conn->prepare("UPDATE sneakers SET quantity = ?, state = ? WHERE id = ?");
                $stmtUpdate->bind_param("isi", $nuevo_stock, $estado_nuevo, $id_producto);
                $stmtUpdate->execute();

                $stmtInsert->close();
                $stmtUpdate->close();
            }

            $conn->commit();
            $_SESSION['cart'] = []; // Vaciar carrito
            $message = "Venta registrada y stock actualizado correctamente.";

        } catch (Exception $e) {
            $conn->rollback();
            $error = "Error al registrar la venta: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Carrito de Ventas - Sneakers</title>
<link rel="stylesheet" href="../CSS/access.css" />
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }
  table { border-collapse: collapse; width: 100%; margin-top: 20px; }
  th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
  th { background-color: #0077b6; color: white; }
  input[type=number] { width: 60px; }
  .message { color: green; }
  .error { color: red; }
  form.inline { display: inline; }
  button[disabled], input[disabled] {
    background-color: #ccc !important;
    cursor: not-allowed !important;
  }
</style>
</head>
<body>

<h1>Inventario de Sneakers</h1>

<?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

<h2>Agregar productos al carrito</h2>

<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Stock Disponible</th>
      <th>Estado</th>
      <th>Cantidad a Comprar</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
<?php
$result = $conn->query("SELECT * FROM sneakers");
while ($row = $result->fetch_assoc()):
?>
  <tr>
    <td><?=htmlspecialchars($row['name'])?></td>
    <td><?=htmlspecialchars($row['description'])?></td>
    <td>$<?=number_format($row['price'], 2)?></td>
    <td><?= (int)$row['quantity'] ?></td>
    <td><?=htmlspecialchars($row['state'])?></td>
    <td>
      <form method="POST" class="inline">
        <input type="hidden" name="name" value="<?=htmlspecialchars($row['name'])?>" />
        <input type="number" name="quantity" min="1" max="<?= (int)$row['quantity'] ?>" value="1" required
          <?= $row['quantity'] == 0 ? 'disabled' : '' ?> />
    </td>
    <td>
        <button type="submit" name="add_to_cart" <?= $row['quantity'] == 0 ? 'disabled' : '' ?>>Agregar</button>
      </form>
    </td>
  </tr>
 
<?php endwhile; ?>
  </tbody>
</table>

<h2>Carrito de Compra</h2>

<?php if (empty($_SESSION['cart'])): ?>
  <p>El carrito está vacío.</p>
<?php else: ?>
<table>
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Cantidad</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($_SESSION['cart'] as $name => $qty): ?>
      <tr>
        <td><?=htmlspecialchars($name)?></td>
        <td><?=$qty?></td>
        <td>
          <form method="POST" class="inline">
            <input type="hidden" name="name" value="<?=htmlspecialchars($name)?>" />
            <button type="submit" name="remove_from_cart">Eliminar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<form method="POST">
  <button type="submit" name="finalize_sale">Finalizar Venta</button>
</form>
<?php endif; ?>
<a href="../HTML/store.html" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
  Regresar a store
</a>
</body>
</html>