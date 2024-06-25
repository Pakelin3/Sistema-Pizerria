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

<body>

    <?php
    $page_title = 'Historial';
    $page_current = './history.php';
    include '../components/header.php';
    ?>

    <!-- sidebar -->
    <?php include '../components/sidebar.php'; ?>

    <div class="d-flex min-vw-100 justify-content-between px-5 my-4 " style="padding-left: 198px !important; height:48px;">
        <h1 class="fw-semibold m-0 w-50">Historial de movimientos</h1>
        <div class="d-flex w-50 align-items-center justify-content-end">
            <div class="input-group mr_25px">
                <button id="filterButton" class="btn btn-outline-success" type="button">Filtrar</button>
                <select class="form-select" id="inputGroupSelect03" aria-label="filtrar por">
                    <option value="0" disabled selected>Por...</option>
                    <option value="1">Ingredientes</option>
                    <option value="2">Consumibles</option>
                    <option value="3">Todo</option>
                </select>
            </div>
            <div class="input-group mr_25px">
                <span class="input-group-text">Desde</span>
                <input type="date" class="form-control" id="startDate" aria-label="">
            </div>
            <div class="input-group">
                <span class="input-group-text">Hasta</span>
                <input type="date" class="form-control" id="endDate" aria-label="">
            </div>
        </div>
    </div>

    <!-- Cuerpo de la pagina -->
    <div class="d-column align-items-start justify-content-center" style="padding-left:150px;">
        <!-- Tabla de datos -->
        <div class="container rounded-2 border py-2" style="background-color: white;">
            <!-- Tabla de datos para historial -->
            <div id="historialTable" class="table-responsive">
                <table id="historial" class="table table-striped w-100 h-50">
                    <thead>
                        <tr id="historialHeaders">
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Tipo de Movimiento</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tfoot style="border: white;">
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
    <script>
        $(document).ready(function() {
            function loadData(filterValue, startDate = '', endDate = '') {
                $.getJSON('../utils/spanish.txt', function(language) {
                    $('#historial').DataTable({
                        "language": language,
                        "destroy": true,
                        "ajax": {
                            "url": "../database/database_conection/get_historial_data.php",
                            "data": {
                                "filter": filterValue,
                                "startDate": startDate,
                                "endDate": endDate
                            },
                            "dataSrc": "data"
                        },
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
                }).fail(function() {
                    console.error('Error al cargar el archivo de traducción.');
                });
            }

            loadData('3');
            $('#inputGroupSelect03').val('3');

            $('#filterButton').click(function() {
                var filterValue = $('#inputGroupSelect03').val();
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                if (filterValue !== "Por...") {
                    loadData(filterValue, startDate, endDate);
                }
            });
        });
    </script>

</body>

</html>