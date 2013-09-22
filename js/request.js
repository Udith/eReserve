/*
 * Has JS functions need for request page
 */

var emptyID = false;
var resRoomID = "";
var resDate = "";
var resSTime = "";
var resETime = "";
var ovrState = false;

$(document).ready(function() {
    var today = new Date();

    loadYears(today, "year");
    loadMonths(today, "month", "year");
    loadDates(today, "date", "month", "year");
    loadTimeSlots(8, 22, "fromT", "toT");

    $("#year").change(function() {
        yearChanged(today, "date", "month", "year");
    });
    $("#month").change(function() {
        monthChanged(today, "date", "month", "year");
    });

    $("#fromT").change(function() {
        loadEndTimeSlot(22, "fromT", "toT");
    });

    $("#roomID").keyup(function() {
        if (emptyID) {
            var wrongID = document.getElementById("wrongID");
            wrongID.style.display = "none";
            emptyID = false;
        }
    });
    $("#availCheck").click(checkAvailability);
    $("#closeOvr").click(toggleRequestOverlay);
    $("#requestBtn").click(makeRequest);

});

function checkAvailability() {  //check the availability
    var id = document.getElementById("roomID").value;
    if (!id || /^\s*$/.test(id)) {
        var wrongID = document.getElementById("wrongID");
        wrongID.style.display = "inline";
        emptyID = true;
        return;
    }

    var year = document.getElementById("year").value;
    var month = document.getElementById("month").value;
    var date = document.getElementById("date").value;

    var dateString = year + "-" + month + "-" + date;
    var startTime = document.getElementById("fromT").value;
    var endTime = document.getElementById("toT").value;

    resRoomID = id;
    resDate = dateString;
    resSTime = startTime;
    resETime = endTime;

    document.getElementById("availFeed").innerHTML = "Checking availability...";
    var params = ["isAvailable", id, dateString, startTime, endTime];
    sendHttpReq("availFeed", params, "./scripts/RequestScript.php");
}

function makeRequest() {    //make a request for a room in a given date and timeslot
    document.getElementById("emptyPurpose").innerHTML = "";
    var purpose = document.getElementById("oPurpose").value;
    if (!purpose || /^\s*$/.test(purpose)) {
        document.getElementById("emptyPurpose").innerHTML = "Specify the Purpose";
        return;
    }
    var items = document.getElementById("oItems").value;
    params = ["makeRequest", resRoomID, resDate, resSTime, resETime, purpose, items];
    document.getElementById("reqResult").innerHTML = "Please wait...";
    sendHttpReq("reqResult", params, "./scripts/RequestScript.php");
    document.getElementById("availFeed").innerHTML = "";
}

function requestReserve() { //request a reservation
    var resRoomName = document.getElementById("rName").innerHTML;
    resRoomName = resRoomName.slice(resRoomName.indexOf(":") + 2);
    toggleRequestOverlay();
    document.getElementById("oID").innerHTML = resRoomID;
    document.getElementById("oName").innerHTML = resRoomName;
    document.getElementById("oDate").innerHTML = resDate;
    var timeStr =
            document.getElementById("oTime").innerHTML = resSTime + " - " + resETime;
    document.getElementById("reqResult").innerHTML = "";
}

function cancelAvailability() { 
    document.getElementById("availFeed").innerHTML = "";
}

function toggleRequestOverlay() {
    ovrState = toggleOverlay(ovrState, "overlay");
}