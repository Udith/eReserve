var ovrState = false;

$(function() {                          //load the list of rooms with pending requests for today
    loadRooms = function loadRooms() {
        document.getElementById('roomsTable').innerHTML = "Please wait...";
        var params = ["getRoomList"];
        sendHttpReq("roomsTable", params, "./scripts/StaffScript.php");
    };
});

$(document).ready(function() {
    loadRooms();

    $("#closeOvr").click(toggleStaffOverlay);
    $("#rateBtn").click(rate);

});

function completed(id) {
    document.getElementById('reservation').innerHTML = id;
    toggleStaffOverlay();
}

function rate() {
    var id = document.getElementById('reservation').innerHTML;
    var rating = $('input:radio[name=rating]:checked').val();
    var complain = document.getElementById('complaint').value;

    $.ajax({
        type: 'POST',
        url: './scripts/StaffScript.php',
        data: 'param_1=rate&param_2=' + id + '&param_3=' + rating + '&param_4=' + complain,
        dataType: 'json',
        cache: false,
        success: function(result) {
            if (result) {
                window.location = "staff.php";                
            }
        },
    });
}

function toggleStaffOverlay() {
    ovrState = toggleOverlay(ovrState, "overlay");
}