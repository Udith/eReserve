<?php

/*
 * Has the database access functions need for admin page
 */

include 'MyDB.php';
include 'CheckCookie.php';

$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

$chc = new CheckCookie();
$results = $chc->checkCook($dbCon, "radmin");
$username = $results[0];


switch ($func_name) {
    case "getRoomList":
        getRoomsList($dbCon, $username);
        break;
    case "getRequests":
        getRequests($dbCon);
        break;
    case "getReservations":
        getReservations($dbCon);
        break;
}

function getRoomsList($dbCon, $username) {
    $str = "SELECT room_id,room_name,request_date,COUNT(*) FROM requests NATURAL JOIN rooms
            WHERE room_id IN 
            (SELECT room_id FROM admins WHERE admins.username = '" . $username . "')
            GROUP BY room_id,request_date";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="80px">Room ID</th>
                <th>Room Name</th>
                <th width="100px">Date</th>
                <th width="100px">Pending Requests</th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $rName = "'" . $row[1] . "'";
            $date = "'" . $row[2] . "'";
            echo '<tr onclick="loadRequests(' . $row[0] . ',' . $rName . ',' . $date . ')">
                    <td>' . $row[0] . '</td>
                    <td style="text-align:left;">' . $row[1] . '</td>   
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                  </tr>';
        }
    } else {
        echo 'No Pending Requests.';
    }
}

function getReservations($dbCon) {
    $roomId = $_POST['param_2'];
    $date = $_POST['param_3'];

    $str = "SELECT reserve_id,begin_time,end_time 
            FROM reservations
            WHERE room_id = '" . $roomId . "'
            AND reserve_date = '" . $date . "'";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $retArray = array();
        $count = 0;

        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $id = $row[0];
            $start = strchr($row[1], ":", true);
            $end = strchr($row[2], ":", true);

            $retArray[] = array($id, $start, $end);
            $count++;
        }
        echo json_encode($retArray);
    } else {
        echo json_encode(NULL);
    }
}

function getRequests($dbCon) {
    $roomId = $_POST['param_2'];
    $date = $_POST['param_3'];

    $str = "SELECT request_id,begin_time,end_time,username,first_name,last_name,reputation,reason,req_items,email 
            FROM requests NATURAL JOIN users
            WHERE room_id = '" . $roomId . "'
            AND request_date = '" . $date . "'";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $retArray = array();
        $count = 0;

        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $id = $row[0];
            $start = strchr($row[1], ":", true);
            $end = strchr($row[2], ":", true);
            $user = $row[3];
            $name = $row[4] . " " . $row[5];
            $rep = $row[6];
            $purpose = $row[7];
            $equip = $row[8];
            $email = $row[9];

            $retArray[] = array($id, $start, $end, $user, $name, $rep, $purpose, $equip, $email, $roomId, $date);
            $count++;
        }
        echo json_encode($retArray);
    } else {
        echo json_encode(NULL);
    }
}
?>

