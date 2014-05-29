$(document).ready(function() {
    
    var today = new Date();

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
            },
            {'sortable': false, 'targets': [5, 6]}
        ],
        "ajax": {
            "url": "php_scripts/halls.get.php",
            "type": "POST",
            "dataSrc": "halls"
        }

    });

//    $('#calendar-table tfoot th').each(function() {
//        var title = $('#calendar-table thead th').eq($(this).index()).text();
//        $(this).html('<input type="text" placeholder="Search" size="5" />');
//    });
//
//    $("#calendar-table tfoot input").on('keyup change', function() {
//        table.column($(this).parent().index() + ':visible');
//    });

    table.on('click', 'tr:not(.col-header)', function() {
        var hallId = $(this).find("td").first().html();
        showReservations(hallId);
    });

    function showReservations(hall_id) {
        $('#calendar-modal').find("#hall-id").val(hall_id);
        $('#calendar-datepicker').datetimepicker({
            pickTime: false,
            minDate: (today.getFullYear() - 5) + "-1-1",
            maxDate: (today.getFullYear() + 5) + "-1-1",
            defaultDate: formatDate(today)
        });


        $('#calendar-modal').modal('show');
    }

    $('#calendar-datepicker').change(function(){
       console.log("changed");
       alert(formatDate(new Date($(this).data("DateTimePicker").getDate())));
    });
    
    function formatDate(date){
        return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    }

});