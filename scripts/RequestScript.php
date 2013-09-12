<?php

include 'MyDB.php';
include 'CheckCookie.php';

$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

switch ($func_name) {
    case "isAvailable":
        isAvailable($dbCon);
        break;
    case "makeRequest":
        makeRequest($dbCon);
        break;
}

function isAvailable($dbCon) {

    $id = $_POST['param_2'];
    $date = $_POST['param_3'];
    $start = $_POST['param_4'];
    $end = $_POST['param_5'];

    $str = "SELECT room_name,dept_name FROM rooms WHERE room_id='" . $id . "'";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll();
        $room_name = $result[0]['room_name'];
        $dept_name = $result[0]['dept_name'];
        echo '<span id="rName" ><b>Room Name: </b>' . $room_name . ' - ' . $dept_name . '</span>';
    } else {
        echo '<span id="rName" style="color:#f00;">Invalid Room ID</span>';
        return;
    }

    $str = "SELECT reserve_id FROM reservations WHERE room_id='" . $id . "' AND reserve_date='" . $date . "' AND (
            (begin_time > '" . $start . "' AND begin_time < '" . $end . "') OR
            (end_time > '" . $start . "' AND end_time < '" . $end . "') OR
            (begin_time <= '" . $start . "' AND end_time >= '" . $end . "'))";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll();
        $reserve_id = $result[0]['reserve_id'];
        echo '<br/><span id="availability" style="color:#f00;"><b>Room is Unavailable</b></span>';
        return;
    }

    $str = "SELECT request_id FROM requests WHERE room_id='" . $id . "' AND request_date='" . $date . "' AND (
            (begin_time > '" . $start . "' AND begin_time < '" . $end . "') OR
            (end_time > '" . $start . "' AND end_time < '" . $end . "') OR
            (begin_time <= '" . $start . "' AND end_time >= '" . $end . "'))";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll();
        $request_id = $result[0]['request_id'];
        echo '<br/><span id="availability" style="color:#038006;"><b>There are pending Requests</b></span><br/>';
        echo '
            <button id="resRoom" name="resRoom" class="greenBtn" type="button" onclick="requestReserve();">Request Room</button>
            <button id="canRoom" name="cancelRoom" class="redBtn" type="button" onclick="cancelAvailability();">Cancel</button>            
            ';
    } else {
        echo '<br/><span id="availability" style="color:#038006;"><b>Room is Available</b></span><br/>';
        echo '
            <button id="resRoom" name="resRoom" class="greenBtn" type="button" onclick="requestReserve();">Request Room</button>
            <button id="canRoom" name="cancelRoom" class="redBtn" type="button" onclick="cancelAvailability();">Cancel</button>            
            ';
    }
}

function makeRequest($dbCon) {
    $chc = new CheckCookie($dbCon);
    $results = $chc->checkCook("user");

    $username = $results[0];
    $room_id = $_POST['param_2'];
    $date = $_POST['param_3'];
    $sTime = $_POST['param_4'];
    $eTime = $_POST['param_5'];
    $purpose = $_POST['param_6'];
    $items = $_POST['param_7'];

    $values = "'" . $room_id . "','" . $username . "','" . $date . "','" . $sTime . "','" . $eTime . "','" . $purpose . "','" . $items . "'";
    $statement = $dbCon->prepare("INSERT INTO requests(room_id,username,request_date,begin_time,end_time,reason,req_items) VALUES (" . $values . ")");
    $success = $statement->execute();

    if ($success)
        echo '<span style="color:#038006;">Room is Requested Successfully</span>';
    else
        echo '<span style="color:#f00;">Room is not Requested</span>';

//    echo $usrname . ' ' . $room_id . ' ' . $date . ' ' . $sTime . ' ' . $eTime . ' ' . $purpose . ' ' . $items;
}
?>

