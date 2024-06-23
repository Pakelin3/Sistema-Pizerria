$(document).ready(function () {
    var ingredientesTable;
    var productosTable;

    $.getJSON('../utils/spanish.txt', function (language) {
        ingredientesTable = $('#ingredientes').DataTable({
            language: language,
            columns: [
                { "title": "Nombre", "data": "Nombre" },
                { "title": "Cantidad", "data": "Cantidad" }
            ]
        });

        productosTable = $('#productos').DataTable({
            language: language,
            columns: [
                { "title": "Nombre", "data": "Nombre" },
                { "title": "Cantidad", "data": "Cantidad" },
                { "title": "Precio", "data": "Precio" }
            ]
        });
    });

    function loadData(filterValue) {
        $.ajax({
            url: '../database/database_conection/get_inventory_data.php',
            type: 'POST',
            data: { filter: filterValue },
            success: function (response) {
                if (response.error) {
                    console.error(response.error);
                    return;
                }

                ingredientesTable.clear().rows.add(response.ingredientes).draw();
                productosTable.clear().rows.add(response.productos).draw();

                if (filterValue === '1') {
                    $('#ingredientesTable').show();
                    $('#productosTable').hide();
                } else if (filterValue === '2') {
                    $('#ingredientesTable').hide();
                    $('#productosTable').show();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener datos del inventario:', xhr.responseText);
            }
        });
    }

    loadData('2');
    $('#inputGroupSelect03').val('2');

    $('#filterButton').click(function () {
        var filterValue = $('#inputGroupSelect03').val();
        if (filterValue !== "Por...") {
            loadData(filterValue);
        }
    });
});
