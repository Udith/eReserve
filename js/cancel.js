var ovrShow = false;

$(function() {
    loadReservations = function loadReservations() {

        var today = new Date();
        var day = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        document.getElementById("reserveTable").innerHTML = "Please wait...";
        var params = ["getReservations", day, time];
        sendHttpReq("reserveTable", params, "./scripts/CancelScript.php");
    };
});

$(function() {
    loadRequests = function loadRequests() {

        var today = new Date();
        var day = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        document.getElementById("requestTable").innerHTML = "Please wait...";
        var params = ["getRequests", day, time];
        sendHttpReq("requestTable", params, "./scripts/CancelScript.php");
    };
});

$(document).ready(function() {
    loadReservations();
    loadRequests();
    $("#nBtn").click(toggleCancelOverlay);
    $("#yBtn").click(cancelRequest);
});

function toggleCancelOverlay() {
    ovrShow = toggleOverlay(ovrShow, "overlay");
}

function confirmReserveCancel(id) {
    document.getElementById("opID").value = id;
    document.getElementById("opType").value = 1;
    toggleCancelOverlay();
}

function confirmRequestCancel(id) {
    document.getElementById("opID").value = id;
    document.getElementById("opType").value = 2;
    toggleCancelOverlay();
}

function cancelRequest() {
    var id = document.getElementById("opID").value;
    var type = document.getElementById("opType").value;

    if (type == "1") {
        var params = ["removeReservation", id];
        sendHttpReq("", params, "./scripts/CancelScript.php");
        loadReservations();
    } else if (type == "2") {
        var params = ["removeRequest", id];
        sendHttpReq("", params, "./scripts/CancelScript.php");
        loadRequests();
    }
    toggleCancelOverlay();
}

