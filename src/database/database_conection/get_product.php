<?php
include './conection.php';

$query = "SELECT Nombre, Cantidad, Precio FROM inventario_productos";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

$conn->close();
