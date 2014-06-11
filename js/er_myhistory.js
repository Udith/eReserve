$(document).ready(function() {

    var myHistTable = $('#my-hist-table').DataTable({
        order: [[0, "desc"]],
        columns: [
            {"data": "date"},
            {"data": "hall_id"},
            {"data": "reason"},
            {"data": "begin_time"},
            {"data": "end_time"}
        ],
        columnDefs: [
            {
                "render": function(data, type, row) {                    
                    return '<span data-toggle="tooltip" data-placement="left" title="' + row['hall_details'] + '">' + data + '</spans>';
                },
                "targets": [1]
            },
            {'sortable': false, 'targets': [2, 3, 4]}
        ],
        ajax: {
            "url": "php_scripts/reservations.get.php",
            "data": {
                "user_id": "user11",
                "isPast": "1"
            },
            "type": "POST",
            "dataSrc": "reservations"
        },
        language: {
            "emptyTable": "No reservation history"
        }
    });
});

