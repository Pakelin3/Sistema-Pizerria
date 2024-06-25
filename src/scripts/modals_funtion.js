document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('addProductType');
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

document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('choiceProduct');
    const quantityGroupDiv = document.getElementById('quantityGroup');
    const typeDiv = document.getElementById('product_type');
    const infoTypeSpan = document.getElementById('Q_infoType');
    const infoPlaceholderInput = document.getElementById('quantity1');

    // Ocultar la cantidad al cargar la página
    quantityGroupDiv.style.display = 'none';

    typeDiv.addEventListener('change', function () {
        const productType = this.value;

        // Limpiar el contenido de choiceProduct
        selectElement.innerHTML = '<option disabled selected>Elija la opción...</option>';
        quantityGroupDiv.style.display = 'none';

        // Cambiar el contenido de Q_infoType y el placeholder según el tipo de mercancía
        if (productType == '1') {
            infoTypeSpan.textContent = 'Cantidad en gramos';
            infoPlaceholderInput.placeholder = 'Cantidad en gramos';
        } else if (productType == '2') {
            infoTypeSpan.textContent = 'Unidades';
            infoPlaceholderInput.placeholder = 'Unidades';
        }

        // Recargar las opciones de mercancía según el tipo seleccionado
        loadProductOptions();
    });

    selectElement.addEventListener('change', function () {
        const selectedValue = this.value;

        if (selectedValue !== 'Elija la opción...') {
            quantityGroupDiv.style.display = 'flex';
        } else {
            quantityGroupDiv.style.display = 'none';
        }
    });
});



// function updateCantidad(option) {
//     document.getElementById('cantidadSpan').textContent = 'Cantidad de ' + option;
// }
function limpiarFormulario() {
    $('#responseMessage').empty();
    $('#productForm')[0].reset();
    $('.input-group-text').removeClass('bg-success-subtle bg-danger-subtle');
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
