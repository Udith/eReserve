$(document).ready(function() {

    var today = new Date();
    var hallId = 0;
    var resDate = formatDate(new Date());

    $('#calendar-datepicker').datetimepicker({
        pickTime: false,
        minDate: (today.getFullYear() - 5) + "-1-1",
        maxDate: (today.getFullYear() + 5) + "-1-1",
        defaultDate: formatDate(today)
    });

    //table showing halls
    var calTable = $('#calendar-table').DataTable({
        columns: [
            {"data": "id"},
            {"data": "name"},
            {"data": "department"},
            {"data": "faculty"},
            {"data": "capacity"},
            {"data": "ac"},
            {"data": "com_lab"}
        ],
        columnDefs: [
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
        ajax: {
            "url": "php_scripts/halls.get.php",
            "type": "POST",
            "dataSrc": "halls"
        },
        language: {
            "emptyTable": "No halls available"
        }
    });

    //table showing reservations
    var resTable = $('#reserve-table').DataTable({
        columns: [
            {
                "data": function(data) {
                    return data.begin_time + " - " + data.end_time;
                }
            },
            {"data": "reason"}
        ],
        ajax: {
            "url": "php_scripts/reservations.get.php",
            "data": function() {
                return {
                    "hall_id": hallId,
                    "reserve_date": resDate 
                };
            },
            "type": "POST",
            "dataSrc": "reservations"
        },
        paging: false,
        info: false,
        ordering: false,
        searching: false,
        language: {
            "emptyTable": "No existing reservations"
        }
    });


//    $.ajax({
//        url: "php_scripts/reservations.get.php",
//        type: 'POST',
//        data: "hall_id=5504&reserve_date=2014-08-01",
//        success: function(data, textStatus, jqXHR) {
//            console.log(data);
//        }
//    });

    //click event of calTable row
    calTable.on('click', 'tr:not(.col-header)', function() {
        hallId = calTable.row(this).data().id;
        $("#hall-name").html(calTable.row(this).data().name);
        $("#hall-id").html(calTable.row(this).data().id);
        showReservations();
    });

    //show reservations dialog
    function showReservations() {        
        resDate = formatDate(new Date($("#calendar-datepicker").data("DateTimePicker").getDate()));
        resTable.ajax.reload();
        $('#calendar-modal').modal('show');
    }

    //date changed event
    $('#calendar-datepicker').change(function() {
        resDate = formatDate(new Date($("#calendar-datepicker").data("DateTimePicker").getDate()));
        resTable.ajax.reload();
    });
});