<?php
include './conection.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

$whereClauses = [];

if ($filter === '1') {
    $sql = "SELECT * FROM historial_ingredientes";
} elseif ($filter === '2') {
    $sql = "SELECT * FROM historial_productos";
} elseif ($filter === '3') {
    $sql = "SELECT * FROM historial_movimientos";
}

if (!empty($startDate)) {
    $whereClauses[] = "Fecha >= '$startDate'";
}

if (!empty($endDate)) {
    $whereClauses[] = "Fecha <= '$endDate'";
}

if (count($whereClauses) > 0) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
}

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode(array("data" => $data));

if (isset($conn)) {
    $conn->close();
}
