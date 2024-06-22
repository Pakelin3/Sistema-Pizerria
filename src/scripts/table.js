$(document).ready(function () {
    $.getJSON('../utils/spanish.txt', function (language) {
        $('#example').DataTable({
            language: language,
            "ajax": "../database/database_conection/get_product.php",
            "columns": [{
                "data": "Nombre"
            },
            {
                "data": "Cantidad"
            },
            {
                "data": "Precio"
            }
            ]
        });
    });
});