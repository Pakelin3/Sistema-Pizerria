<?php
header('Content-Type: application/json');

include './conection.php';

$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

if (empty($filter)) {
    echo json_encode(['error' => 'Invalid filter: filter is empty']);
    exit;
}

$sql = '';
if ($filter === '1') {
    $sql = "SELECT * FROM inventario_ingredientes";
} elseif ($filter === '2') {
    $sql = "SELECT * FROM inventario_productos";
} else {
    echo json_encode(['error' => 'Invalid filter: unknown value']);
    exit;
}

$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

if (isset($conn)) {
    $conn->close();
}