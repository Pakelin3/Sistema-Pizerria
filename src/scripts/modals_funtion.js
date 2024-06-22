document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('inputGroupSelect02');
    const quantityGramsDiv = document.getElementById('Q_G');
    const quantityDiv = document.getElementById('Q');
    const priceDiv = document.getElementById('P');
    quantityGramsDiv.style.display = 'none';
    quantityDiv.style.display = 'none';
    priceDiv.style.display = 'none';

    selectElement.addEventListener('change', function () {
        const selectedValue = this.value;

        quantityGramsDiv.style.display = 'none';
        quantityDiv.style.display = 'none';
        priceDiv.style.display = 'none';

        if (selectedValue === '1') {
            quantityGramsDiv.style.display = 'flex';
        } else if (selectedValue === '2') {
            quantityDiv.style.display = 'flex';
            priceDiv.style.display = 'flex';
        }
    });
});

function updateCantidad(option) {
    document.getElementById('cantidadSpan').textContent = 'Cantidad de ' + option;
}

function negativos_noNumeros(inputId) {
    $('#' + inputId).on('input', function () {
        var value = $(this).val();
        $(this).val(value.replace(/[^0-9.]/g, ''));
        if (value.indexOf('-') !== -1) {
            $(this).val(value.replace('-', ''));
        }
    });
}

negativos_noNumeros('quantity');
negativos_noNumeros('quantity_grams');
negativos_noNumeros('price');
