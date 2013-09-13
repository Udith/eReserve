/*
 * Has JS functions need for calendar page
 */

var ovrShow = false;

$(function() {      //load the list of rooms
    loadRooms = function loadRooms() {
        document.getElementById('roomSheetData').innerHTML = "Please wait...";
        var params = ["getRooms"];
        sendHttpReq("roomSheetData", params, "./scripts/CalendarScript.php");
    };
});

$(document).ready(function() {
    var today = new Date();

    loadYears(today, "year");
    loadMonths(today, "month", "year");
    loadDates(today, "date", "month", "year");
    loadFaculties("fac", "dep");
    loadRooms();

    $("#year").change(function() {
        yearChanged(today, "date", "month", "year");
    });
    $("#month").change(function() {
        monthChanged(today, "date", "month", "year");
    });
    $("#fac").change(function() {
        facultyChanged("fac", "dep");
    });
    $("#showBtn").click(filterRooms);
    $("#reg3").change(filterRooms);
    $("#closeOvr").click(toggleCalendarOverlay);
    $("#dateSelector").change(getReservations);
    $("#reqRes").click(goRequest);
});

function filterRooms() {    //filters the list of rooms according to given filters
    var fac_name = document.getElementById("fac").value;
    var dep_name = document.getElementById("dep").value;
    var type = $('input[name="roomS"]:checked').val();
    var searchV = document.getElementById("roomID").value;

    var params = ["getRooms", type, searchV, fac_name, dep_name];
    sendHttpReq("roomSheetData", params, "./scripts/CalendarScript.php");
}

function showReservations(roomID, roomName) {   //show reservations for a given room
    toggleCalendarOverlay();
    document.getElementById('ovrID').innerHTML = roomID;
    document.getElementById('ovrName').innerHTML = roomName;
    getReservations();
}

function toggleCalendarOverlay() {      //toggle overlay
    ovrShow = toggleOverlay(ovrShow, "overlay");
    if (!ovrShow)
        document.getElementById('resDataSheet').innerHTML = "";
}

function getReservations() {    //show reservations for a given room in a given day
    var id = document.getElementById('ovrID').innerHTML;
    var y = document.getElementById('year').value;
    var m = document.getElementById('month').value;
    var d = document.getElementById('date').value;
    var dateStr = y + "-" + m + "-" + d;

    document.getElementById('resDataSheet').innerHTML = "<i>Please wait...</i>";
    var params = ["getReservations", id, dateStr];
    sendHttpReq("resDataSheet", params, "./scripts/CalendarScript.php");
}

function goRequest() {  //goto request page
    var id = document.getElementById('ovrID').innerHTML;
    window.location.href = "request.php?id=" + id;
}

