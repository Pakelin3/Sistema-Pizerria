<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/datatables.min.css">
    <link rel="stylesheet" href="../styles/roboto_font.css">
    <link rel="stylesheet" href="../styles/sidebar_style.css">
    <link rel="stylesheet" href="../styles/buttons.css">
    <title>Inventario</title>
    <script src="../scripts/jquery.js"></script>
</head>

<body>
    <?php
    $page_title = 'Inventario';
    $page_current = './inventory.php';
    include '../components/header.php';
    ?>

    <div class="d-flex min-vw-100 justify-content-between px-5 my-4"
        style="padding-left: 198px !important; height:48px;">
        <h1 class="fw-semibold m-0 w-50">Gestión de inventario</h1>
        <div class="d-flex align-items-center justify-content-end w-75">
            <div class="input-group w-25">
                <button id="filterButton" class="btn btn-outline-success" type="button">Filtrar</button>
                <select class="form-select" id="inputGroupSelect03" aria-label="filtrar por">
                    <option value="0" disabled selected>Por...</option>
                    <option value="1">Ingredientes</option>
                    <option value="2">Consumibles</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary option_btn" data-bs-toggle="modal"
                data-bs-target="#agregar_inventario">
                <svg xmlns="http://www.w3.org/2000/svg" class="side_icon" width="15" height="15" viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg> Agregar mercancía
            </button>
            <button type="button" class="btn btn-secondary option_btn" data-bs-toggle="modal"
                data-bs-target="#añadir_inventario">Nueva mercancía</button>
        </div>
    </div>

    <!-- sidebar -->
    <?php include '../components/sidebar.php'; ?>

    <!-- Modal añadir -->
    <div class="modal fade modal-lg" id="añadir_inventario" tabindex="-1" aria-labelledby="ModalAñadirMercancia"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Añadir mercancía</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nombreSpan">Nombre de la mercancía</span>
                            <input type="text" name="nombre_mercancia" class="form-control"
                                placeholder="Escriba aquí el nombre" id="Product_name" aria-label="Product_name"
                                aria-describedby="Nombre de la mercancía" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="tipoMercanciaS">Seleccione tipo de mercancía</span>
                            <select class="form-select" id="addProductType" name="tipo_mercancia" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">Ingrediente</option>
                                <option value="2">Consumible</option>
                            </select>
                        </div>
                        <div class="input-group mb-3" id="Q_G">
                            <span class="input-group-text" id="cantidadGramosSpan">Cantidad en gramos</span>
                            <input type="number" id="quantity_grams" name="cantidad_gramos" class="form-control"
                                placeholder="" aria-label="Cantidad en gramos">
                        </div>
                        <div class="input-group mb-3" id="Q">
                            <span class="input-group-text" id="cantidadSpan">Cantidad</span>
                            <input type="number" id="quantity" name="cantidad" class="form-control" placeholder=""
                                aria-label="Cantidad" required>
                        </div>
                        <div class="input-group mb-3" id="P">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                            <input type="text" class="form-control" name="precio" id="price"
                                aria-label="Precio en dólares (con puntos y dos decimales)">
                        </div>
                    </form>
                    <div id="responseMessage"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="limpiarFormulario()">Cerrar operación</button>
                    <button type="button" onclick="submitProductForm();" id="addNewProductBtn"
                        class="btn btn-primary">Guardar mercancía</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar -->
    <div class="modal fade modal-lg" id="agregar_inventario" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Agregar mercancía existente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="product_type">Seleccione tipo de mercancía</label>
                            <select class="form-select" id="product_type" name="product_type" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">Ingrediente</option>
                                <option value="2">Consumible</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="choiceProduct">Seleccione la mercancía a
                                agregar</label>
                            <select class="form-select" id="choiceProduct" name="choiceProduct">
                                <option disabled selected>Elija la opción...</option>
                            </select>
                        </div>
                        <div class="input-group mb-3" id="quantityGroup" style="display:none;">
                            <span id="Q_infoType" class="input-group-text">Cantidad</span>
                            <input type="number" id="quantity1" name="quantity" class="form-control"
                                placeholder="Cantidad" min="1" aria-label="Ingrese la cantidad solicitada" required>
                        </div>
                    </form>
                    <div id="responseMessage1"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="limpiarFormulario()">Cerrar operación</button>
                    <button type="button" onclick="addProductToInventory()" id="agregarMercanciaBtn"
                        class="btn btn-primary">Agregar mercancía al
                        inventario</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cuerpo de la página -->
    <div class="d-column align-items-start justify-content-center" style="padding-left:150px;">
        <!-- Tabla de datos -->
        <div class="container rounded-2 border py-2" style="background-color: white;">
            <!-- Tabla de datos para ingredientes -->
            <div id="ingredientesTable" class="table-responsive">
                <table id="ingredientes" class="table table-striped w-100 h-50">
                    <thead>
                        <tr id="ingredientesHeaders">
                            <th>Nombre</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tfoot style="border: white;">
                        <tr id="ingredientesFooters">
                            <th>Nombre</th>
                            <th>Cantidad</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- Tabla de datos para productos -->
            <div id="productosTable" class="table-responsive" style="display: none;">
                <table id="productos" class="table table-striped w-100 h-50">
                    <thead>
                        <tr id="productosHeaders">
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tfoot style="border: white;">
                        <tr id="productosFooters">
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
    function actualizarTabla(tablaId, newData) {
        var tabla = $('#' + tablaId).DataTable();
        tabla.clear().draw();
        tabla.rows.add(newData).draw();
    }

    function submitProductForm() {
        var isValid = true;
        var productType = $('#product_type').val();

        // Validacion | campos vacios
        $('#productForm input:visible').each(function() {
            var span = $(this).siblings('.input-group-text');
            if ($(this).val().trim() === '') {
                span.removeClass('bg-success-subtle').addClass('bg-danger-subtle');
                isValid = false;
            } else {
                span.removeClass('bg-danger-subtle').addClass('bg-success-subtle');
            }
        });

        // Validacion | numeros positivos 
        var cantidad = $('#quantity').val();
        var cantidadGramos = $('#quantity_grams').val();
        if (cantidad < 0 || cantidadGramos < 0) {
            $('#responseMessage').html('<div class="alert alert-danger">La cantidad debe ser mayor a 0</div>');
            return;
        }

        // Validacion | seleccion de tipo de mercancia
        var tipoMercancia = $('#addProductType').val();
        var tipoMercanciaS = $('#tipoMercanciaS');
        if (tipoMercancia === null || tipoMercancia === '') {
            tipoMercanciaS.removeClass('bg-success-subtle').addClass('bg-danger-subtle');
            isValid = false;
        } else {
            tipoMercanciaS.removeClass('bg-danger-subtle').addClass('bg-success-subtle');
        }

        // Validacion | formato de precio (ajuro se necesita 2 decimales)
        var tipoMercancia = $('#addProductType').val();
        if (tipoMercancia === "2") {
            var precio = $('#price').val();
            if (!/^\d+(\.\d{1,2})?$/.test(precio) || parseFloat(precio) <= 0.00) {
                $('#responseMessage').html(
                    '<div class="alert alert-danger">El precio debe tener el formato correcto (por ejemplo, 1.00) y ser mayor que 0.00</div>'
                );
                $('#price').siblings('.input-group-text').removeClass('bg-success-subtle').addClass('bg-danger-subtle');
                return;
            } else {
                $('#price').siblings('.input-group-text').removeClass('bg-danger-subtle').addClass('bg-success-subtle');
            }
        }

        if (!isValid) {
            $('#responseMessage').html('<div class="alert alert-danger">Todos los campos son obligatorios</div>');
            return;
        }

        var formData = $('#productForm').serialize();

        $.ajax({
            url: '../database/database_conection/save_product.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#addNewProductBtn').prop('disabled', true);
            },
            success: function(response) {
                console.log('Respuesta del servidor:', response);
                if (response.error) {
                    $('#responseMessage').html('<div class="alert alert-danger">' + response.error +
                        '</div>');
                } else {
                    $('#responseMessage').html('<div class="alert alert-success">' + response.message +
                        '</div>');
                    setTimeout(function() {
                        $('#productForm')[0].reset();
                        $('.input-group-text').removeClass('bg-success-subtle bg-danger-subtle');
                        $('#addNewProductBtn').prop('disabled', false);
                        $.ajax({
                            url: '../database/database_conection/get_inventory_data.php',
                            type: 'POST',
                            data: {
                                filter: productType
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log('Datos de inventario actualizados:',
                                    response);
                                if (productType == 1) {
                                    actualizarTabla('ingredientes', response);
                                } else if (productType == 2) {
                                    actualizarTabla('productos', response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(
                                    'Error al obtener datos actualizados del inventario:',
                                    xhr.responseText);
                            }
                        });
                    }, 3500);
                    setTimeout(function() {
                        $('#responseMessage').html('<div class="alert d-none"></div>');
                    }, 6000);
                }
            },
            error: function(xhr, status, error) {
                $('#responseMessage').html('<div class="alert alert-danger">Error: ' + xhr.responseText +
                    '</div>');
                $('#addNewProductBtn').prop('disabled', false);
            }
        });
    }



    $(document).ready(function() {
        loadProductOptions();
        $('#product_type').change(function() {
            loadProductOptions();
        });
    });

    function loadProductOptions() {
        var productType = $('#product_type').val();
        var url = '';

        if (productType == 1) {
            url = '../database/database_conection/view_ingredients.php';
        } else if (productType == 2) {
            url = '../database/database_conection/view_products.php';
        } else {
            return;
        }

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var items = JSON.parse(response);
                var options = '<option disabled selected>Elija la opción...</option>';
                items.forEach(function(item) {
                    options += '<option value="' + item.id + '">' + item.name +
                        '</option>';
                });
                $('#choiceProduct').html(options);
            },
            error: function() {
                alert('Error al cargar los nombres.');
            }
        });
    };

    function addProductToInventory() {
        var productId = $('#choiceProduct').val();
        var productName = $('#choiceProduct option:selected').text();
        var quantity = $('#quantity1').val();
        var productType = $('#product_type').val();
        var updateUrl = '';

        // Validacion | todos los campos llenos
        if (productId === '' || quantity === '' || productType === '') {
            $('#responseMessage1').html('<div class="alert alert-danger">Todos los campos son obligatorios</div>');
            return;
        }

        // Verificar | cantidad valida
        if (quantity < 0) {
            $('#responseMessage1').html('<div class="alert alert-danger">' + 'Solo se puede agregar al inventario' +
                '</div>');
            return;
        }

        if (productType == 1) {
            updateUrl = '../database/database_conection/update_ingredients.php';
        } else if (productType == 2) {
            updateUrl = '../database/database_conection/update_products.php';
        } else {
            alert('Tipo de producto no válido');
            return;
        }

        $.ajax({
            url: updateUrl,
            type: 'POST',
            data: {
                idProducto: productId,
                nombreProducto: productName,
                cantidad: quantity
            },
            success: function(response) {
                $('#responseMessage1').html('<div class="alert alert-success">' + response + '</div>');
                $.ajax({
                    url: '../database/database_conection/get_inventory_data.php',
                    type: 'POST',
                    data: {
                        filter: productType
                    },
                    success: function(response) {
                        setTimeout(function() {
                            if (productType == 1) {
                                actualizarTabla('ingredientes', response);
                            } else if (productType == 2) {
                                actualizarTabla('productos', response);
                            } else {
                                return;
                            }
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al obtener datos actualizados del inventario:', xhr
                            .responseText);
                    }
                });
            },
            error: function(xhr, status, error) {
                $('#responseMessage1').html('<div class="alert alert-danger">Error: ' + xhr.responseText +
                    '</div>');
            }
        });
    }
    </script>


    <script src="../scripts/bootstrap js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/datatables.min.js"></script>
    <script src="../scripts/table.js"></script>
    <script src="../scripts/modals_funtion.js"></script>
</body>

</html>