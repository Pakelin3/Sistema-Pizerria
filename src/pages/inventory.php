<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/datatables.min.css">
    <link rel="stylesheet" href="../styles/roboto_font.css">
    <link rel="stylesheet" href="../styles/sidebar_style.css">
    <title>Inventario</title>
</head>

<body style="background-color: #C2E6FF;">

    <div class="d-flex flex-column vw-100 border-bottom shadow py-2"
        style=" padding-left: 150px; height:175px; background: white;">

        <div class="d-flex px-0 mx-5">
            <h1 class="text-start h-75">Inventario</h1>
        </div>
        <div class="d-flex align-items-end px-0 border-top border-2 mt-5 ">
            <div class="d-flex align-items-center justify-content-start pt-3 mx-5">
                <a class="link-secondary link-opacity-75 link-offset-2 link-underline link-underline-opacity-10"
                    href="./index.php">Inicio </a>
                <div class="mx-2">/</div>
                <a class="link-secondary link-offset-2 link-underline link-underline-opacity-10"
                    href="./inventory.php ">
                    Inventario</a>
            </div>
        </div>
    </div>

    <div class="d-flex min-vw-100 justify-content-between px-5 my-4" style="padding-left: 198px !important;">
        <h1 class=" fw-semibold">Gestión de inventario</h1>
        <button type=" button" class="btn btn-primary" style="width:175px; height:48px;" data-bs-toggle="modal"
            data-bs-target="#exampleModal">+ Añadir
            mercancía</button>
    </div>

    <!-- sidebar -->
    <?php include '../components/sidebar.php'; ?>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir mercancía</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nombre de la mercancía</span>
                            <input type="text" name="nombre_mercancia" class="form-control"
                                placeholder="Escriba aquí el nombre" id="Product_name" aria-label="Product_name"
                                aria-describedby="Nombre de la mercancía" required>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect02">Seleccione tipo de
                                mercancía</label>
                            <select class="form-select" id="inputGroupSelect02" name="tipo_mercancia" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">Ingrediente</option>
                                <option value="2">Consumible</option>
                            </select>
                        </div>

                        <div class="input-group mb-3" id="Q_G">
                            <span class="input-group-text" id="cantidadSpan">Cantidad en</span>
                            <button type="button"
                                class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="updateCantidad('Gramos')">Gramos</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="updateCantidad('Kilogramos')">Kilogramos</a></li>
                            </ul>
                            <input type="number" id="quantity_grams" name="cantidad_gramos" class="form-control"
                                placeholder="" aria-label="Cantidad en gramos">
                        </div>

                        <div class="input-group mb-3" id="Q">
                            <span class="input-group-text">Cantidad</span>
                            <input type="number" id="quantity" name="cantidad" class="form-control" placeholder=""
                                aria-label="Cantidad">
                        </div>
                        <div class="input-group mb-3" id="P">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                            <input type="text" class="form-control" name="precio" id="price"
                                aria-label="Precio en dolares (con puntos y dos decimales)">
                        </div>
                    </form>
                    <div id="responseMessage"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar
                        operación</button>
                    <button type="button" onclick="submitProductForm();" id="guardarMercanciaBtn"
                        class="btn btn-primary">Guardar mercancía</button>
                </div>
            </div>
        </div>
    </div>


    <script>
    function cargarDatosTabla() {
        $('#example').DataTable().ajax.reload();
    }

    function submitProductForm() {
        // Validación | campos vacios
        var inputs = $('#productForm input:visible');
        var isValid = true;
        inputs.each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                return false;
            }
        });
        if (!isValid) {
            $('#responseMessage').html('<div class="alert alert-danger">Todos los campos son obligatorios</div>');
            return;
        }

        // Validacion | numeros positivos 
        var cantidad = $('#quantity').val();
        var cantidadGramos = $('#quantity_grams').val();
        if (cantidad < 0 || cantidadGramos < 0) {
            $('#responseMessage').html('<div class="alert alert-danger">La cantidad debe ser un número positivo</div>');
            return;
        }

        // Validacion | formato de precio (ajuro se necesita 2 decimales)
        var precio = $('#price').val();
        if (!/^\d+(\.\d{1,2})?$/.test(precio)) {
            $('#responseMessage').html(
                '<div class="alert alert-danger">El precio debe tener el formato correcto (por ejemplo, 0.00)</div>'
            );
            return;
        }


        var formData = $('#productForm').serialize();

        $.ajax({
            url: '../database/database_conection/save_product.php',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#guardarMercanciaBtn').prop('disabled', true);
            },
            success: function(response) {
                $('#guardarMercanciaBtn').prop('disabled', false);
                $('#responseMessage').html(
                    '<div class="alert alert-success">' +
                    response +
                    '</div>');
                setTimeout(function() {
                    $('#productForm')[0].reset();
                    cargarDatosTabla();
                }, 3500);
                setTimeout(function() {
                    $('#guardarMercanciaBtn').prop('disabled', false);
                    $('#responseMessage').html('<div class="alert d-none">' + '' +
                        '</div>');
                }, 6000);
            },
            error: function(xhr, status, error) {
                $('#guardarMercanciaBtn').prop('disabled', false);
                $('#responseMessage').html('<div class="alert alert-danger">Error: ' + xhr
                    .responseText + '</div>');
            }
        });
    }
    </script>


    <!-- Cuerpo de la pagina -->
    <div class="d-column align-items-start justify-content-center" style="padding-left:150px;">
        <!-- Tabla de datos -->
        <div class="container rounded-2 border py-2" style="background-color: white;">
            <div class="table-responsive">
                <table id="example" class="display" style="width:100%">
                    <thead class="border-bottom">
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tfoot class="border-top">
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <script src="../scripts/jquery.js"></script>
        <script src="../scripts/bootstrap js/bootstrap.bundle.min.js"></script>
        <script src="../scripts/datatables.min.js"></script>
        <script src="../scripts/table.js"></script>
        <script src="../scripts/modals_funtion.js"></script>
</body>

</html>