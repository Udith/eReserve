var ovrState = false;

$(function() {                          //load the list of complaits to be reviewed
    loadComplaints = function loadComplaints() {
        document.getElementById('complaintTable').innerHTML = "Please wait...";
        var params = ["getComplaintList"];
        sendHttpReq("complaintTable", params, "./scripts/ComplaintScript.php");
    };
});

$(document).ready(function() {
    loadComplaints();

    $("#closeOvr").click(toggleComplaintOverlay);
    $("#reviewBtn").click(reviewComplaint);
});

function complaintDetails(id) {
    $.ajax({
        type: 'POST',
        url: './scripts/ComplaintScript.php',
        data: 'param_1=getComplaintDetails&param_2=' + id,
        dataType: 'json',
        cache: false,
        success: function(result) {
            loadComplaintDetails(result);
        },
    });
}

function loadComplaintDetails(r) {
    toggleComplaintOverlay();
    var details = {comp_id: r[0], made_by: r[1], complaint: r[2], room: r[3], user: r[4], date: r[5], time: r[6]};
    document.getElementById('oID').innerHTML = details['comp_id'];
    document.getElementById('oBy').innerHTML = details['made_by'];
    document.getElementById('oComp').innerHTML = details['complaint'];
    document.getElementById('oRoom').innerHTML = details['room'];
    document.getElementById('oResBy').innerHTML = details['user'];
    document.getElementById('oDate').innerHTML = details['date'];
    document.getElementById('oTime').innerHTML = details['time'];
}

function reviewComplaint() {
    var id = document.getElementById('oID').innerHTML;
    $.ajax({
        type: 'POST',
        url: './scripts/ComplaintScript.php',
        data: 'param_1=review&param_2=' + id,
        dataType: 'json',
        cache: false,
        success: function(result) {
            if (result) {
                window.location = "complaints.php";
            }
        },
    });
}

function toggleComplaintOverlay() {
    ovrState = toggleOverlay(ovrState, "overlay");
}

//
//function completed(id) {
//    document.getElementById('reservation').innerHTML = id;
//    toggleStaffOverlay();
//}
//
////function hideComp(){
////    var compRow = document.getElementById('compRow');
////    compRow.style.display = "none";
////}
////
////function showComp(){    
////    var compRow = document.getElementById('compRow');
////    compRow.style.display = "table-row";
////}
//
//function rate() {
//    var id = document.getElementById('reservation').innerHTML;
//    var rating = $('input:radio[name=rating]:checked').val();
//    var complain = document.getElementById('complaint').value;
//
//    $.ajax({
//        type: 'POST',
//        url: './scripts/StaffScript.php',
//        data: 'param_1=rate&param_2=' + id + '&param_3=' + rating + '&param_4=' + complain,
//        dataType: 'json',
//        cache: false,
//        success: function(result) {
//            if (result) {
//                window.location = "staff.php";                
//            }
//        },
//    });
//}
//
//function toggleStaffOverlay() {
//    ovrState = toggleOverlay(ovrState, "overlay");
//}