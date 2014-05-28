$(document).ready(function() {

    var table = $('#calendar-table').dataTable({
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {"data": "department"},
            {"data": "faculty"},
            {"data": "capacity"},
            {"data": "ac"},
            {"data": "com_lab"}
        ],
        "columnDefs": [
            {
                "render": function(data, type, row) {
                    if (data === true) {
                        return "<span class='glyphicon glyphicon-ok'></span>";
                    } else {
                        return "<span class='glyphicon glyphicon-remove'></span>";
                    }
                },
                "targets": [5, 6]
            }
        ],
        "ajax": {
            "url": "php_scripts/halls.get.php",
            "type": "POST",
            "dataSrc": "halls"
        }

    });
    
    table.on( 'click', 'tr', function () {
        console.log($(this).find("td").first().html());
        $('#calendar-modal').modal('show');
    } );
});