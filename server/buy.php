<?php
$product = $_POST['product_name'];
$quantity = (int)$_POST['quantity'];

$escaped_product = escapeshellarg($product);
$escaped_quantity = escapeshellarg($quantity);

// Ejecutar script Python con ruta absoluta a python.exe para evitar confusiones
$command = "C:\\Python312\\python.exe createFile.py $escaped_product $escaped_quantity 2>&1";
$output = shell_exec($command);
$output = trim($output);  // Aquí está el warning, si $output es null

// Para depurar, imprime el output
if (!$output) {
    die("Error: El script Python no devolvió el nombre del archivo PDF.\nSalida: $output");
}

$pdf_file = $output;

if (file_exists($pdf_file)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($pdf_file) . '"');
    readfile($pdf_file);
    exit;
} else {
    die("Error: No se encontró el archivo PDF generado. Ruta recibida: $pdf_file");
}
?>
