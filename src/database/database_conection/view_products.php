<?php
include './conection.php';

$query = "SELECT ID_Producto, Nombre FROM productos";
$result = mysqli_query($conn, $query);

$product_names = array();

while ($row = mysqli_fetch_assoc($result)) {
    $product_names[] = array(
        'id' => $row['ID_Producto'],
        'name' => $row['Nombre']
    );
}

echo json_encode($product_names);

mysqli_close($conn);
