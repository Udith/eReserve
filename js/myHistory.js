/*
 * Has JS functions need for history page
 */

$(function() {
    loadHistory = function loadHistory() {  //loads history for the user
        var today = new Date();
        var day = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        document.getElementById("historyTable").innerHTML = "Please wait...";
        var params = ["getHistory", day, time];
        sendHttpReq("historyTable", params, "./scripts/MyHistoryScript.php");
    };
});

$(document).ready(function() {
    loadHistory();
});

