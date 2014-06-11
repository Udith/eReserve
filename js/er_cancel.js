$(document).ready(function() {

    var pendReqTable = $("#pend-req-table").DataTable({
        language: {
            "emptyTable": "No pending reservation requests"
        }
    });

    var pendResTable = $("#pend-res-table").DataTable({
        columns: [
            {"data": "reserve_id"},
            {"data": "hall_id"},
            {"data": "reason"},
            {"data": "date"},
            {"data": function(data) {
                    return data.begin_time + " - " + data.end_time;
                }
            }
        ],
        columnDefs: [
            {
                "render": function(data, type, row) {
                    return '<button class="btn btn-danger del-res" res-id="' + row['reserve_id'] + '"><span class="glyphicon glyphicon-trash"></span></button>';
                },
                "targets": [5]
            },
            {
                "render": function(data, type, row) {
                    return '<span data-toggle="tooltip" data-placement="left" title="' + row['hall_details'] + '">' + data + '</spans>';
                },
                "targets": [1]
            },
            {'sortable': false, 'targets': [2, 4]}
        ],
        ajax: {
            "url": "php_scripts/reservations.get.php",
            "data": {
                "user_id": "user11",
                "isPast": "0"
            },
            "type": "POST",
            "dataSrc": "reservations"
        },
        language: {
            "emptyTable": "No pending reservations"
        }
    });

    $(document).on("click", ".del-res", function() {
//        console.log("delete clicked");
        var resId = $(this).attr("res-id");
        
        $.ajax({
            url: "php_scripts/reservations.del.php",
            type: 'POST',
            data: "reserve_id=" + resId,
            success: function(data, textStatus, jqXHR) {
                if(JSON.parse(data)){
                    displayAlert("success", "Reservation Number <b>"+resId+"</b> canceled successfully");
                }
                else{
                    displayAlert("danger", "Reservation cancellation failed");
                }
            },
            error: function(jqXHR, textStatus, error) {
                displayAlert("danger", "Reservation cancellation failed");
            },
            complete: function(jqXHR, status){
                pendResTable.ajax.reload();
            }
        });
    });

});

