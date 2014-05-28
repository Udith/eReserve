$(document).ready(function() {

    $('#calendar-table').dataTable({
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
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    if(data === true){
                        return "<span class='glyphicon glyphicon-ok'></span>";
                    }else{
                        return "<span class='glyphicon glyphicon-remove'></span>";
                    }
                },
                "targets": [5,6]
            }
        ],
        "ajax": {
            "url": "php_scripts/halls.get.php",
            "type": "POST",
            "dataSrc": "halls"
        }
        
    });
//    $("#calendar-table tfoot th").each(function(i) {
//        var select = $('<select><option value=""></option></select>');
//        select.appendTo($(this).empty()).on('change', function() {
//            table.column(i).search($(this).val()).draw();
//        });
//
//        $("#calendar-table tfoot th").column(i).data().unique().sort().each(function(d, j) {
//            select.append('<option value="' + d + '">' + d + '</option>');
//        });
//    });
});