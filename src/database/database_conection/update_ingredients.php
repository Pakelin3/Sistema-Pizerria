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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST['idProducto'];
    $nombreProducto = $_POST['nombreProducto'];
    $cantidad = $_POST['cantidad'];

    $sql = "UPDATE Ingredientes SET Cantidad_Inventario = Cantidad_Inventario + ? WHERE ID_Ingrediente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cantidad, $idProducto);

    if ($stmt->execute()) {
        registrarMovimiento($conn, $nombreProducto, 2, "Se han añadido $cantidad gramos de $nombreProducto al inventario de ingredientes.", null, $idProducto);
        echo "Se han añadido " . $cantidad . " gramos de " . $nombreProducto . " al inventario de ingredientes.";
    } else {
        http_response_code(500);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
} else {
    http_response_code(405);
    echo "Método no permitido";
}

if (isset($conn)) {
    $conn->close();
}
