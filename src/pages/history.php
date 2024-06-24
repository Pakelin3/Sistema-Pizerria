<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/datatables.min.css">
    <link rel="stylesheet" href="../styles/sidebar_style.css">
    <title>Historial</title>
</head>

<body style="background-color: #C2E6FF;">

    <?php
    $page_title = 'Historial';
    $page_current = './history.php';
    include '../components/header.php';
    ?>

    <!-- sidebar -->
    <?php include '../components/sidebar.php'; ?>

    <div class="d-flex min-vw-100 justify-content-between px-5 my-4 "
        style="padding-left: 198px !important; height:48px;">
        <h1 class=" fw-semibold m-0">Historial de movimientos</h1>
        <div class=" d-flex w-50 align-items-center justify-content-end">
            <div class="input-group mb-3" style="margin-right: 25px;" id="">
                <span class="input-group-text">Desde</span>
                <input type="date" class="form-control" aria-label="">
            </div>
            <div class="input-group mb-3" id="">
                <span class="input-group-text">Hasta</span>
                <input type="date" class="form-control" aria-label="">
            </div>
        </div>
    </div>

    <!-- Cuerpo de la pagina -->
    <div class="d-column align-items-start justify-content-center" style="padding-left:150px;">
        <!-- Tabla de datos -->
        <div class="container rounded-2 border py-2" style="background-color: white;">
            <!-- Tabla de datos para historial -->
            <div id="historialTable" class="table-responsive">
                <table id="historial" class="display" style="width:100%">
                    <thead class="border-bottom">
                        <tr id="historialHeaders">
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Tipo de Movimiento</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tfoot class="border-top">
                        <tr id="historialFooters">
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Tipo de Movimiento</th>
                            <th>Descripción</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/bootstrap js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/datatables.min.js"></script>
    <script src="../scripts/modals_funtion.js"></script>
    <script>
    $(document).ready(function() {
        $('#historial').DataTable({
            "ajax": "../database/database_conection/get_historial_data.php",
            "columns": [{
                    "data": "Nombre_Producto_Insumo"
                },
                {
                    "data": "Fecha"
                },
                {
                    "data": "Tipo_Movimiento"
                },
                {
                    "data": "Descripcion"
                }
            ]
        });
    });
    </script>
</body>

</html>