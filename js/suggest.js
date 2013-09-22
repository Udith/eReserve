var resDate = "";
var resSTime = "";
var resETime = "";
var resRoomID = "";
var ovrState = false;

$(document).ready(function() {
    var today = new Date();

    loadYears(today, "year");
    loadMonths(today, "month", "year");
    loadDates(today, "date", "month", "year");
    loadTimeSlots(8, 22, "fromT", "toT");
    loadFaculties("fac", "dep");

    $("#year").change(function() {
        yearChanged(today, "date", "month", "year");
    });
    $("#month").change(function() {
        monthChanged(today, "date", "month", "year");
    });
    $("#fromT").change(function() {
        loadEndTimeSlot(22, "fromT", "toT");
    });
    $("#fac").change(function() {
        facultyChanged("fac", "dep");
    });

    $("#closeOvr").click(toggleSuggestOverlay);
    $("#requestBtn").click(makeRequest);
    $("#sugBtn").click(getSuggestions);
});

/*Gets the list of suggested rooms according to given requirements*/
function getSuggestions() {

    //Get input values from page
    var year = document.getElementById("year").value;
    var month = document.getElementById("month").value;
    var date = document.getElementById("date").value;
    var dateString = year + "-" + month + "-" + date;

    var fromT = document.getElementById("fromT").value;
    var toT = document.getElementById("toT").value;

    var faculty = document.getElementById("fac").value;
    var dept = document.getElementById("dep").value;

    var capacity = document.getElementById("capacity").value;

    var airCon = 'N';
    if (document.getElementById("airCon").checked)
        airCon = 'Y';
    var comLab = 'N';
    if (document.getElementById("comLab").checked)
        comLab = 'Y';

    //checks whether the capacity value is a NON-ZERO NUMBER
    if (!isNumber(capacity) || (capacity < 0)) {
        document.getElementById("capacity_error").innerHTML = "Invalid";   //shows error message
        return;
    }
    else {
        document.getElementById("capacity_error").innerHTML = "";
    }

    resDate = dateString;
    resSTime = fromT;
    resETime = toT;

    var table = document.getElementById('sugTable');
    table.scrollIntoView();

    //sendHttpRequest
    document.getElementById("sugTable").innerHTML = "Please wait...";
    var params = ["getSuggestions", dateString, fromT, toT, faculty, dept, capacity, airCon, comLab];
    sendHttpReq("sugTable", params, "./scripts/SuggestScript.php");
}

function isNumber(n) {
    return !isNaN(parseInt(n)) && isFinite(n);
}

function requestReservation(id, name) {
//    alert(id+":::::"+name);   
    resRoomID = id;
    toggleSuggestOverlay();
    document.getElementById("oID").innerHTML = id;
    document.getElementById("oName").innerHTML = name;
    document.getElementById("oDate").innerHTML = resDate;
    var timeStr = document.getElementById("oTime").innerHTML = resSTime + " - " + resETime;
    document.getElementById("reqResult").innerHTML = "";
}

function toggleSuggestOverlay() {
    ovrState = toggleOverlay(ovrState, "overlay");
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