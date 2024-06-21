$(document).ready(function () {
    $.getJSON('../utils/spanish.txt', function (language) {
        $('#example').DataTable({
            ajax: '../utils/arrays.txt',
            language: language
        });
    });
});
