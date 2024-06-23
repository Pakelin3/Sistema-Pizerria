<?php
header('Content-Type: application/json');

include './conection.php';

$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

if (empty($filter)) {
    echo json_encode(['error' => 'Invalid filter: filter is empty']);
    exit;
}

if ($filter === '1') {
    $sql = "SELECT Nombre_Ingrediente AS Nombre, CONCAT(Cantidad_Inventario, 'g') AS Cantidad FROM Ingredientes";
} elseif ($filter === '2') {
    $sql = "SELECT p.Nombre, i.Cantidad, i.Precio FROM Inventario i JOIN Productos p ON i.ID_Producto = p.ID_Producto";
} else {
    echo json_encode(['error' => 'Invalid filter: unknown value']);
    exit;
}

$result = $conn->query($sql);

$ingredientes = [];
$productos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($filter === '1') {
            $ingredientes[] = $row;
        } elseif ($filter === '2') {
            $productos[] = $row;
        }
    }
}

echo json_encode(['ingredientes' => $ingredientes, 'productos' => $productos]);

if (isset($conn)) {
    $conn->close();
}
