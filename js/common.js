var months = new Array("January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December");

function loadYears() {
    /*
     * arg 0 = date object
     * arg 1 = id of html dropdownlist to view year
     */
    var year = arguments[0].getFullYear();
    for (i = 0; i <= 5; i++) {
        var y = year + i;
        var str = '<option value="' + y + '">' + y + '</option>';
        document.getElementById(arguments[1]).innerHTML += str;
    }
}

function loadMonths() {
    /*
     * arg 0 = date object
     * arg 1 = id of html dropdownlist to view month
     * arg 2 = id of html dropdownlist having year
     */
    var month = arguments[0].getMonth();
    var year = arguments[0].getFullYear();
    var yearValue = document.getElementById(arguments[2]).value;

    var limit = 0;
    if (yearValue == year)
        limit = month;

    document.getElementById(arguments[1]).innerHTML = "";
    for (i = limit; i < months.length; i++) {
        var str = '<option value="' + (i + 1) + '">' + months[i] + '</option>';
        document.getElementById(arguments[1]).innerHTML += str;
    }
}

function loadDates() {
    /*
     * arg 0 = date object
     * arg 1 = id of html dropdownlist to view date
     * arg 2 = id of html dropdownlist having month
     * arg 3 = id of html dropdownlist having year
     */
    var date = arguments[0].getDate();
    var month = arguments[0].getMonth();
    var year = arguments[0].getFullYear();

    var monthValue = document.getElementById(arguments[2]).value;
    var yearValue = document.getElementById(arguments[3]).value;

    var eLimit = 31;
    if (monthValue == '4' || monthValue == '6' || monthValue == '9' || monthValue == '11') {
        eLimit = 30;
    } else if (monthValue == '2') {
        var yearValue = parseInt(document.getElementById(arguments[3]).value);
        if ((yearValue % 4 == 0) && (yearValue % 400 != 0)) {
            eLimit = 29;
        } else {
            eLimit = 28;
        }
    }

    sLimit = 1;
    if ((yearValue == year) && (monthValue == (month + 1))) {
        sLimit = date;
    }

    document.getElementById(arguments[1]).innerHTML = "";
    for (i = sLimit; i <= eLimit; i++) {
        var str = '<option value="' + i + '">' + i + '</option>';
        document.getElementById(arguments[1]).innerHTML += str;
    }
}

function yearChanged() {
    /*
     * arg 0 = date object
     * arg 1 = id of html dropdownlist to view date
     * arg 2 = id of html dropdownlist having month
     * arg 3 = id of html dropdownlist having year
     */
    loadMonths(arguments[0], arguments[2], arguments[3]);
    loadDates(arguments[0], arguments[1], arguments[2], arguments[3]);
}

function monthChanged() {
    /*
     * arg 0 = date object
     * arg 1 = id of html dropdownlist to view date
     * arg 2 = id of html dropdownlist having month
     * arg 3 = id of html dropdownlist having year
     */
    loadDates(arguments[0], arguments[1], arguments[2], arguments[3]);
}

function loadFaculties() {
    /*
     * arg 0 = id of html dropdownlist to view faculties
     * arg 1 = id of html dropdownlist to view departments
     */
    var params = ["getFaculties"];
    sendHttpReq(arguments[0], params, "./scripts/CommonScript.php");
    document.getElementById(arguments[1]).disabled = true;
}

function facultyChanged() {
    /*
     * arg 0 = id of html dropdownlist to view faculties
     * arg 1 = id of html dropdownlist to view departments
     */
    var fac_name = document.getElementById(arguments[0]).value;
    if (fac_name == "any")
        document.getElementById(arguments[1]).disabled = true;
    else {
        document.getElementById(arguments[1]).disabled = false;
        var params = ["getDepartments", fac_name];
        sendHttpReq(arguments[1], params, "./scripts/CommonScript.php");
    }
}

function toggleOverlay() {
    /*
     * arg 0 = name of boolean variable showing toggle state
     * arg 1 = id of overlay element
     * return = new toggle state
     */    
    if (arguments[0]) {
        var overlay = document.getElementById(arguments[1]);
        overlay.style.display = "none";
        return false;      
    }
    else {
        var overlay = document.getElementById(arguments[1]);
        overlay.style.display = "block";
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        return true;        
    }
}

function sendHttpReq(elementId, params, script) {
    /*
     * arg 0 = id of element to show results
     * arg 1 = array of parameters to the php script
     * arg 2 = name of the php script
     */    
    var xhr;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft,XMLHTTP");
    }

    var data = "param_1=" + params[0];
    for (var i = 1; i < params.length; i++) {
        data += "&param_" + (i + 1) + "=" + params[i];
    }
    
    xhr.open("POST", script, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data);

    xhr.onreadystatechange = display_data;
    function display_data() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                document.getElementById(elementId).innerHTML = xhr.responseText;
            } else {
                document.getElementById(elementId).innerHTML = "An error occured: Error code " + xhr.status;
            }
        }
        else {
            document.getElementById(elementId).innerHTML = "An error occured: Error code " + xhr.readyState;
        }
    }
}