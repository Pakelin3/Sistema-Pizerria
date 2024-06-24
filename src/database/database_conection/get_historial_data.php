<?php
include './conection.php';

$sql = "SELECT * FROM historial_movimientos";

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
