/*
 * Has JS functions need for cancel page
 */

var ovrShow = false;

$(function() {
    loadReservations = function loadReservations() {    //show the list of pending reservations

        var today = new Date();
        var day = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        document.getElementById("reserveTable").innerHTML = "Please wait...";
        var params = ["getReservations", day, time];
        sendHttpReq("reserveTable", params, "./scripts/CancelScript.php");
    };
});

$(function() {
    loadRequests = function loadRequests() {    //show the list of pending requests

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
//    $("#nBtn").click(toggleCancelOverlay);
//    $("#yBtn").click(cancelRequest);
});

function toggleCancelOverlay() {    //toggle overlay
    ovrShow = toggleOverlay(ovrShow, "overlay");
}

function confirmReserveCancel(id) {     //shows the confirm dialogue for a reservation
    document.getElementById("opID").value = id;
    document.getElementById("opType").value = 1;
    document.getElementById("confirmBody").innerHTML = "Do you really want to Cancel this Reservation?<br/>";
    document.getElementById("confirmBody").innerHTML += "<button id='yBtn' name='yBtn' class='greenBtn' type='button' onclick='cancelRequest();'>Yes</button> ";
    document.getElementById("confirmBody").innerHTML += "<button id='nBtn' name='nBtn' class='redBtn' type='button' onclick='toggleCancelOverlay();'>No</button>";
            
    toggleCancelOverlay();
}

function confirmRequestCancel(id) {     //shows the confirm dialogue for a request
    document.getElementById("opID").value = id;
    document.getElementById("opType").value = 2;
    document.getElementById("confirmBody").innerHTML = "Do you really want to Cancel this Request?<br/>";
    document.getElementById("confirmBody").innerHTML += "<button id='yBtn' name='yBtn' class='greenBtn' type='button' onclick='cancelRequest();'>Yes</button> ";
    document.getElementById("confirmBody").innerHTML += "<button id='nBtn' name='nBtn' class='redBtn' type='button' onclick='toggleCancelOverlay();'>No</button>";
    toggleCancelOverlay();
}

function cancelRequest() {  //cancel a request/reservation
    
    var id = document.getElementById("opID").value;
    var type = document.getElementById("opType").value;

    if (type == "1") {
        var params = ["removeReservation", id];
        sendHttpReq("confirmBody", params, "./scripts/CancelScript.php");
        
    } else if (type == "2") {
        var params = ["removeRequest", id];
        sendHttpReq("confirmBody", params, "./scripts/CancelScript.php");        
    }
    
}

function doneResCancel(){
    loadReservations();
    toggleCancelOverlay();
}

function doneReqCancel(){
    loadRequests();
    toggleCancelOverlay();
}

