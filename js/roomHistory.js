/*
 * Has JS functions need for room history page
 */

var ovrState = false;

$(function() {
    loadHistory = function loadHistory() {  //loads history for the user
        var today = new Date();
        var day = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        document.getElementById("historyTable").innerHTML = "Please wait...";
        var params = ["getHistory", day, time];
        sendHttpReq("historyTable", params, "./scripts/RoomHistoryScript.php");
    };
});

$(document).ready(function() {
    loadHistory();
    
    $("#closeBtn").click(toggleResOverlay);
});

function showResDetails() {  //shows the full details of the reservation
    toggleResOverlay();
    document.getElementById("rsID").innerHTML = arguments[0];
    document.getElementById("rmID").innerHTML = arguments[1];
    document.getElementById("rmName").innerHTML = arguments[2];
    document.getElementById("uID").innerHTML = arguments[3];
    document.getElementById("uName").innerHTML = arguments[4] + " " + arguments[5];
    document.getElementById("rsDate").innerHTML = arguments[6];
    document.getElementById("rsTime").innerHTML = arguments[7] + " - " + arguments[8];
    document.getElementById("rsPurpose").innerHTML = arguments[9];
    document.getElementById("rsEquip").innerHTML = arguments[10];
}

function toggleResOverlay() {
    ovrState = toggleOverlay(ovrState, "overlay");
}
