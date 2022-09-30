$(document).ready(function() {
    $('#table').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "bPaginate": false,
        "paging": false,
        "info": false,
    });

    $('#table2').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "bPaginate": false,
        "paging": false,
        "info": false,
    });

    $('#listyear').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "bPaginate": false,
        "paging": false,
        "info": false,
    });

    $('#typeroomtable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "bPaginate": true,
        "paging": false,
        "info": false,
        "bFilter": true,
    });
});
