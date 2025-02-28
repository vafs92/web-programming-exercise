$(document).ready(function () {
    $('#example2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    })
});