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

<body>

    <header class="d-flex py-3 text-bg-dark fixed-top min-vw-100" style="height: 80px; margin-left: 150px;">
        <div class="vertical-line"></div>
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir
            mercancia</button>
    </header>

    <!-- sidebar -->
    <?php include '../components/sidebar.php'; ?>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir mercancia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="">

                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control"
                                aria-label="Cantidad en dolares (con punto y 2 decimales)">
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <section id="inventory_menu">
        <div>
        </div>
    </section>


    <!-- Cuerpo de la pagina -->
    <div class="d-column align-items-start justify-content-center" style="padding-left:150px; margin-top:80px;">
        <!-- Tabla de datos -->
        <div class="container">
            <div class="table-responsive">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn.</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Extn.</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <h1 class="roboto-thin">This is Roboto Thin</h1>
        <p class="roboto-light">This is Roboto Light</p>
        <p class="roboto-regular">This is Roboto Regular</p>
        <p class="roboto-medium">This is Roboto Medium</p>
        <p class="roboto-bold">This is Roboto Bold</p>
        <p class="roboto-black">This is Roboto Black</p>
    </div>




    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/bootstrap js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/datatables.min.js"></script>
    <script src="../scripts/table.js"></script>
</body>

</html>