<?php
include './conection.php';

function registrarMovimiento($conn, $nombre, $idTipoMovimiento, $descripcion, $idProducto = null, $idIngrediente = null)
{
    $sql = "INSERT INTO Historial (Nombre_Producto_Insumo, Fecha, ID_Tipo_Movimiento, Descripcion, ID_Producto, ID_Ingrediente) 
            VALUES (?, NOW(), ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisii", $nombre, $idTipoMovimiento, $descripcion, $idProducto, $idIngrediente);
    $stmt->execute();
    $stmt->close();
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_mercancia = $_POST['nombre_mercancia'];
    $tipo_mercancia = $_POST['tipo_mercancia'];
    $cantidad_gramos = isset($_POST['cantidad_gramos']) ? $_POST['cantidad_gramos'] : 0;
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 0;

    if ($tipo_mercancia == 1) {
        $sql_ingredientes = "INSERT INTO Ingredientes (Nombre_Ingrediente, Cantidad_Inventario) VALUES (?, ?)";
        $stmt_ingredientes = $conn->prepare($sql_ingredientes);
        $stmt_ingredientes->bind_param("si", $nombre_mercancia, $cantidad_gramos);
        if ($stmt_ingredientes->execute()) {
            $last_id = $stmt_ingredientes->insert_id;
            registrarMovimiento($conn, $nombre_mercancia, 1, "Se han añadido $cantidad_gramos gramos de $nombre_mercancia al inventario de ingredientes.", null, $last_id);
            $response['message'] = "Se han añadido " . $cantidad_gramos . "g de " . $nombre_mercancia . " al inventario de ingredientes.";
        } else {
            http_response_code(500);
            $response['error'] = "Error: " . $sql_ingredientes . "<br>" . $conn->error;
        }
        $stmt_ingredientes->close();
    } else {
        $sql = "INSERT INTO Productos (ID_Tipo_Producto, Nombre, Requiere_Inventario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $requiere_inventario = ($tipo_mercancia == 1) ? false : true;
        $stmt->bind_param("isi", $tipo_mercancia, $nombre_mercancia, $requiere_inventario);

        if ($stmt->execute()) {
            $last_id = $stmt->insert_id;
            if ($tipo_mercancia == 2) {
                $sql_inventario = "INSERT INTO Inventario (ID_Producto, Cantidad, Precio) VALUES (?, ?, ?)";
                $stmt_inventario = $conn->prepare($sql_inventario);
                $stmt_inventario->bind_param("iid", $last_id, $cantidad, $precio);
                $stmt_inventario->execute();
                registrarMovimiento($conn, $nombre_mercancia, 1, "Se han añadido $cantidad unidades de $nombre_mercancia al inventario con un precio de $precio.", $last_id);
                $response['message'] = "Se han añadido " . $cantidad . " " . $nombre_mercancia . " al inventario.";
                $stmt_inventario->close();
            }
        } else {
            http_response_code(500);
            $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
} else {
    http_response_code(405);
    $response['error'] = "Método no permitido";
}

if (isset($conn)) {
    $conn->close();
}

header('Content-Type: application/json');
echo json_encode($response);
