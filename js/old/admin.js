/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var requests;
var existing;
var reqMatrix;
var ovrState = false;

$(function() {                          //load the list of rooms with pending requests
    loadRooms = function loadRooms() {
        document.getElementById('roomsTable').innerHTML = "Please wait...";
        var params = ["getRoomList"];
        sendHttpReq("roomsTable", params, "./scripts/AdminScript.php");
    };
});

$(document).ready(function() {
    loadRooms();
    $("#closeOvr").click(toggleAdminOverlay);
    $("#acceptBtn").click(accept);
    $("#rejectBtn").click(reject);
    $("#saveBtn").click(saveAll);
});

function loadRequests(roomID, roomName, date) { //load the reservation for a given room for a given day
    document.getElementById("roomID").innerHTML = "<b>Room ID: </b>" + roomID;
    document.getElementById("roomName").innerHTML = "<b>Room Name: </b>" + roomName;
    document.getElementById("date").innerHTML = "<b>Date: </b>" + date;

    document.getElementById('reqTable').innerHTML = "Please wait...";

    loadExistingData(roomID, roomName, date);
    loadNewData(roomID, roomName, date);

    showHidden();
    var warn = document.getElementById("ovrlapWarn");
    warn.style.display = "none";
}

function loadExistingData(roomID, roomName, date) { //get existing reservations
    $.ajax({
        type: 'POST',
        url: './scripts/AdminScript.php',
        data: 'param_1=getReservations&param_2=' + roomID + '&param_3=' + date,
        dataType: 'json',
        cache: false,
        success: function(result) {
            populateExisting(result, roomID, roomName, date);
        },
    });
}

function populateExisting(r, roomID, roomName, date) {//stores existing reservations
    existing = new Array(14);

    for (var i = 0; i < r.length; i++) {
        var id = r[i][0];
        var start = r[i][1] - 8;
        var end = r[i][2] - 8;

        for (var j = 0; j < 14; j++) {
            if ((start <= j) && (end > j)) {
                existing[j] = id;
            }
        }
    }
}

function loadNewData(roomID, roomName, date) {//get new requests
    $.ajax({
        type: 'POST',
        url: './scripts/AdminScript.php',
        data: 'param_1=getRequests&param_2=' + roomID + '&param_3=' + date,
        dataType: 'json',
        cache: false,
        success: function(result) {
            populateNew(result);
        },
    });
}

function populateNew(r) {   //stores new requests
    requests = new Array();
    reqMatrix = new Array();

    for (var i = 0; i < r.length; i++) {
        requests[i] = {id: r[i][0], start: r[i][1], end: r[i][2], username: r[i][3], name: r[i][4], reputation: r[i][5], purpose: r[i][6], equipment: r[i][7], status: "n", email: r[i][8], room: r[i][9], date: r[i][10]};
    }

    for (var i = 0; i < r.length; i++) {
        var id = requests[i].id;
        var start = requests[i].start - 8;
        var end = requests[i].end - 8;

        reqMatrix[i] = new Array(14);
        for (var j = 0; j < 14; j++) {
            if ((start <= j) && (end > j)) {
                reqMatrix[i][j] = id;
            }
            else {
                reqMatrix[i][j] = -1;
            }
        }
    }
    drawTimeLine();
}

function drawTimeLine() {   //draws the timeline view
    var headRow = '<tr><th rowspan="2" width="80px">Request ID</th><th colspan="14">Time Slots</th></tr>';
    headRow += '<tr>';
    for (var c = 1; c <= 14; c++) {
        headRow += '<th>' + c + '</th>';
    }
    headRow += '</tr>';
    document.getElementById('reqTable').innerHTML = headRow;

    var row = '<tr><td width="80px">Reserved</td>';
    for (var j = 0; j < 14; j++) {
        var cell = "empty";
        if (existing[j] != null) {
            cell = "res";
        }
        row += '<td class="' + cell + '"></td>';
    }
    row += '</tr>'
    document.getElementById('reqTable').innerHTML += row;

    for (var i = 0; i < reqMatrix.length; i++) {
        var row = '<tr onClick="showDetails(' + i + ');"><td class="rI" width="80px">' + requests[i].id + '</td>';

        for (var j = 0; j < 14; j++) {
            var cell = "empty";
            if (reqMatrix[i][j] != -1) {
                if (requests[i].status == "n")
                    cell = "neutral";
                else if (requests[i].status == "a")
                    cell = "accept";
                else if (requests[i].status == "r")
                    cell = "reject";
            }

            row += '<td class="' + cell + '"></td>';
        }
        row += '</tr>'
        document.getElementById('reqTable').innerHTML += row;
    }
    $(window).scrollTop($(document).height());
}

function showDetails(row) { //shows the details of the request
    document.getElementById("row").innerHTML = row;
    document.getElementById("oID").innerHTML = requests[row].id;
    document.getElementById("oName").innerHTML = requests[row].name + " (" + requests[row].username + ")";
    document.getElementById("oRep").innerHTML = requests[row].reputation;
    document.getElementById("oPurpose").innerHTML = requests[row].purpose;
    document.getElementById("oEquip").innerHTML = requests[row].equipment;
    document.getElementById("oEmail").innerHTML = requests[row].email;
    toggleAdminOverlay();
}

function accept() { //accept the reservation
    var row = document.getElementById("row").innerHTML;
    requests[row].status = "a";
    toggleAdminOverlay();
    drawTimeLine();

    var warn = document.getElementById("ovrlapWarn");
    warn.style.display = "none";
}

function reject() { //reject the reservation
    var row = document.getElementById("row").innerHTML;
    requests[row].status = "r";
    toggleAdminOverlay();
    drawTimeLine();

    var warn = document.getElementById("ovrlapWarn");
    warn.style.display = "none";
}

function toggleAdminOverlay() {
    ovrState = toggleOverlay(ovrState, "overlay");
}

function checkOverlap() {   //check for any overlaping requests
    for (var i = 0; i < 14; i++) {
        var exist = false;
        var accepted = false;

        if (existing[i] != null) {
            exist = true;
        }

        for (var j = 0; j < requests.length; j++) {
            var id = reqMatrix[j][i];
            if (id != -1) {
                var status = requests[j].status;
                if (status == "a") {
                    if (exist || accepted) {
                        return false;
                    }
                    else {
                        accepted = true;
                    }
                }
            }
        }
    }

    return true;
}

function saveAll() {    //save all permanently
    var overlapCheck = checkOverlap();
    if (!overlapCheck) {
        var warn = document.getElementById("ovrlapWarn");
        warn.style.display = "inline";
    }
    else {
        document.getElementById("saveBtn").innerHTML = "Saving...";
        document.getElementById("saveBtn").disabled = true;
        review();
    }
}

function review() {
    $.ajax({
        type: 'POST',
        url: './scripts/ReviewRequests.php',
        data: 'param_1=' + JSON.stringify(requests),
        dataType: 'json',
        cache: false,
        success: function(result) {
            if(result){
                window.location = "admin.php";
            }
        },
    });
}

function showHidden() { //shows the key
    var save = document.getElementById("save");
    save.style.display = "block";
    var time = document.getElementById("timeslots");
    time.style.display = "table";
}