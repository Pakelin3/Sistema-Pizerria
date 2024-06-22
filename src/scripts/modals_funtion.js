document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('inputGroupSelect02');
    const quantityGramsDiv = document.getElementById('Q_G');
    const quantityDiv = document.getElementById('Q');
    quantityGramsDiv.style.display = 'none';
    quantityDiv.style.display = 'none';

    selectElement.addEventListener('change', function () {
        const selectedValue = this.value;

        // Hide both divs initially
        quantityGramsDiv.style.display = 'none';
        quantityDiv.style.display = 'none';

        // Show the appropriate div based on the selected value
        if (selectedValue === '1') {
            quantityGramsDiv.style.display = 'flex';
        } else if (selectedValue === '2') {
            quantityDiv.style.display = 'flex';
        }
    });
});