<?php
include './conection.php';

$query = "SELECT ID_Ingrediente, Nombre_Ingrediente AS Nombre FROM ingredientes";
$result = mysqli_query($conn, $query);

$ingredient_names = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ingredient_names[] = array(
        'id' => $row['ID_Ingrediente'],
        'name' => $row['Nombre']
    );
}

echo json_encode($ingredient_names);

mysqli_close($conn);
