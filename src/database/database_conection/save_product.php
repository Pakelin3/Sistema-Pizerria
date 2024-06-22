<?php
include './conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_mercancia = $_POST['nombre_mercancia'];
    $tipo_mercancia = $_POST['tipo_mercancia'];
    $cantidad_gramos = isset($_POST['cantidad_gramos']) ? $_POST['cantidad_gramos'] : 0;
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;

    if ($tipo_mercancia == 1) {
        $sql_ingredientes = "INSERT INTO Ingredientes (Nombre_Ingrediente, Cantidad_Inventario) VALUES (?, ?)";
        $stmt_ingredientes = $conn->prepare($sql_ingredientes);
        $stmt_ingredientes->bind_param("si", $nombre_mercancia, $cantidad_gramos);
        if ($stmt_ingredientes->execute()) {
            echo "Se han añadido " . $cantidad_gramos . "g de " . $nombre_mercancia . " al inventario de ingredientes.";
        } else {
            http_response_code(500);
            echo "Error: " . $sql_ingredientes . "<br>" . $conn->error;
        }
    } else {
        $sql = "INSERT INTO Productos (ID_Tipo_Producto, Nombre, Requiere_Inventario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $requiere_inventario = ($tipo_mercancia == 1) ? false : true;
        $stmt->bind_param("isi", $tipo_mercancia, $nombre_mercancia, $requiere_inventario);

        if ($stmt->execute()) {
            $last_id = $stmt->insert_id;
            if ($tipo_mercancia == 2) {
                $sql_inventario = "INSERT INTO Inventario (ID_Producto, Cantidad) VALUES (?, ?)";
                $stmt_inventario = $conn->prepare($sql_inventario);
                $stmt_inventario->bind_param("ii", $last_id, $cantidad);
                $stmt_inventario->execute();
                echo "Se han añadido " . $cantidad . " " . $nombre_mercancia . " al inventario.";
            }
        } else {
            http_response_code(500);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    http_response_code(405);
    echo "Método no permitido";
}
if (isset($conn)) {
    $conn->close();
}
