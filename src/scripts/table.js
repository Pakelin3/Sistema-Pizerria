$(document).ready(function () {
    $.getJSON('../utils/spanish.txt', function (language) {
        var tableIngredientes = $('#ingredientes').DataTable({
            language: language,
            columns: [
                { "title": "Nombre", "data": "Nombre" },
                { "title": "Cantidad", "data": "Cantidad" }
            ]
        });

        var tableProductos = $('#productos').DataTable({
            language: language,
            columns: [
                { "title": "Nombre", "data": "Nombre" },
                { "title": "Cantidad", "data": "Cantidad" },
                { "title": "Precio", "data": "Precio" }
            ]
        });

        function loadData(filterValue) {
            console.log('Enviando filtro:', filterValue);
            $.ajax({
                url: '../database/database_conection/get_inventory_data.php',
                type: 'POST',
                data: { filter: filterValue },
                success: function (response) {
                    console.log('Respuesta recibida:', response);
                    if (response.error) {
                        console.error(response.error);
                        return;
                    }
                    if (filterValue == '1') {
                        $('#productosTable').hide();
                        $('#ingredientesTable').show();
                        tableIngredientes.clear().draw();

                        $.each(response, function (index, item) {
                            tableIngredientes.row.add({
                                "Nombre": item.Nombre,
                                "Cantidad": item.Cantidad
                            }).draw();
                        });
                    } else if (filterValue == '2') {
                        $('#ingredientesTable').hide();
                        $('#productosTable').show();
                        tableProductos.clear().draw();

                        $.each(response, function (index, item) {
                            tableProductos.row.add({
                                "Nombre": item.Nombre,
                                "Cantidad": item.Cantidad,
                                "Precio": item.Precio
                            }).draw();
                        });
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
});
