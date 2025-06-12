<?php
include 'connection.php';

header('Content-Type: application/json');

$sql = "SELECT id, name, description, price, state FROM sneakers";
$result = $conn->query($sql);

$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);
$conn->close();
?>
