var ovrState = false;

$(function() {                          //load the list of complaints to be reviewed
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

function complaintDetails(id) { //get the full details of the reservation
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

function loadComplaintDetails(r) {//load the full details of the reservation
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

function reviewComplaint() {    //mark the complaint as reviewed
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

