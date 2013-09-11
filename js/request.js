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
    $("#availCheck").click(checkAvailability);
});

function loadTimeSlots() {
    /*
     * arg 0 = start time
     * arg 1 = end time
     * arg 2 = id of html dropdownlist to view start slots
     * arg 3 = id of html dropdownlist to view end slots
     */
    var start = arguments[0];
    var end = arguments[1];
    for (var i = start; i < end; i++) {
        var timeStr = i + ":00";
        var str = "<option value='" + timeStr + ":00'>" + timeStr + "</option>";
        document.getElementById(arguments[2]).innerHTML += str;
    }
    loadEndTimeSlot(end, arguments[2], arguments[3]);
}

function loadEndTimeSlot() {
    /*
     * arg 0 = end time
     * arg 1 = id of html dropdownlist having start slots
     * arg 2 = id of html dropdownlist to view end slots
     */
    var limit = document.getElementById(arguments[1]).value;
    limit = parseInt(limit.slice(0, limit.indexOf(":"))) + 1;
    
    document.getElementById(arguments[2]).innerHTML = "";
    var end = arguments[0];

    for (var i = limit; i <= end; i++) {
        var timeStr = i + ":00";
        var str = "<option value='" + timeStr + ":00'>" + timeStr + "</option>";

        document.getElementById(arguments[2]).innerHTML += str;
    }
}

function checkAvailability() {
    alert(document.getElementById("fromT").value);
    alert(document.getElementById("toT").value);
}


