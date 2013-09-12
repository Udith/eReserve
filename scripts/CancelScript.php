<?php

include 'MyDB.php';
include 'CheckCookie.php';

$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

$chc = new CheckCookie($dbCon);
$results = $chc->checkCook("user");
$username = $results[0];


switch ($func_name) {
    case "getReservations":
        getReservations($dbCon, $username);
        break;
    case "getRequests":
        getRequests($dbCon, $username);
        break;
    case "removeReservation":
        removeReservation($dbCon);
        break;
    case "removeRequest":
        removeRequest($dbCon);
        break;
}

function getReservations($dbCon, $usr) {

    $currentDate = $_POST['param_2'];
    $currentTime = $_POST['param_3'];

    $str = "SELECT room_id,reserve_date,begin_time,end_time,reason,reserve_id FROM reservations WHERE username='" . $usr . "'
            AND (reserve_date > '" . $currentDate . "'
            OR (reserve_date = '" . $currentDate . "' AND begin_time > '" . $currentTime . "'))";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="30px">Room ID</th>
                <th width="50px">Date</th>
                <th width="100px">Time Slot</th>
                <th>Purpose</th>
                <th width="80px"></th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '-' . $row[3] . '</td>
                    <td>' . $row[4] . '</td>
                    <td style="padding:0;">
                    <button id="' . $row[5] . '" name="cancelBtn" class="redBtn canBtn" type="button" onclick="confirmReserveCancel(' . $row[5] . ');">
                        Cancel
                    </button>
                    </td>
                  </tr>';
        }
    } else {
        echo 'No Pending Reservations.';
    }
}

function getRequests($dbCon, $usr) {

    $currentDate = $_POST['param_2'];
    $currentTime = $_POST['param_3'];

    $str = "SELECT room_id,request_date,begin_time,end_time,reason,request_id FROM requests WHERE username='" . $usr . "'
            AND (request_date > '" . $currentDate . "'
            OR (request_date = '" . $currentDate . "' AND begin_time > '" . $currentTime . "'))";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="30px">Room ID</th>
                <th width="50px">Date</th>
                <th width="100px">Time Slot</th>
                <th>Purpose</th>
                <th width="80px"></th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '-' . $row[3] . '</td>
                    <td>' . $row[4] . '</td>
                    <td style="padding:0;">
                    <button id="' . $row[5] . '" name="cancelBtn" class="redBtn canBtn" type="button" onclick="confirmRequestCancel(' . $row[5] . ');">
                        Cancel
                    </button>
                    </td>
                  </tr>';
        }
    } else {
        echo 'No Pending Requests.';
    }
}

function removeReservation($dbCon) {

    $id = $_POST['param_2'];

    $str = "DELETE FROM reservations WHERE reserve_id='" . $id . "'";
    $statement = $dbCon->prepare($str);
    $statement->execute();
}

function removeRequest($dbCon) {

    $id = $_POST['param_2'];

    $str = "DELETE FROM requests WHERE request_id='" . $id . "'";
    $statement = $dbCon->prepare($str);
    $statement->execute();
}

?>
