<?php

/*
 * Has the database access functions need for staff page
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
    case "getComplaintList":
        getComplaintList($dbCon, $username);
        break;
    case "getComplaintDetails":
        getComplaintDetails($dbCon);
        break;
    case "review":
        review($dbCon, $username);
        break;
}

function getComplaintList($dbCon, $username) {
    
    $str = "SELECT complaint_id,room_id,made_by,complaint FROM complaints NATURAL JOIN reservations
            WHERE reviewed='N'
            AND room_id IN (SELECT admins.room_id FROM admins WHERE admins.username='".$username."')";

    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="80px">Complaint ID</th>
                <th width="80px">Room ID</th>
                <th width="80px">Complained by</th>
                <th>Complaint</th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            echo '<tr onclick="complaintDetails('.$row[0].');">
                    <td>' . $row[0] . '</td>
                    <td>' . $row[1] . '</td>   
                    <td>' . $row[2] . '</td>
                    <td style="text-align:left;">' . $row[3] . '</td>
                  </tr>';
        }
    } else {
        echo 'No Complaints to be Reviewed.';
    }
}

function getComplaintDetails($dbCon) {
    $compId = $_POST['param_2'];

    $str = "SELECT complaint_id,made_by,complaint,reservations.room_id,rooms.room_name,users.username,users.first_name,users.last_name,
                    reservations.reserve_date, reservations.begin_time, reservations.end_time 
            FROM complaints,reservations,rooms,users
            WHERE complaint_id = '" . $compId . "'
            AND complaints.reserve_id=reservations.reserve_id
            AND reservations.room_id=rooms.room_id
            AND reservations.username = users.username";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $retArray;

        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $retArray = array($row[0], $row[1], $row[2], $row[4]." (".$row[3].")",$row[6]." ".$row[7]." (".$row[5].")", $row[8], $row[9]." - ".$row[10]);
        }
        echo json_encode($retArray);
    } else {
        echo json_encode(NULL);
    }
}

function review($dbCon,$user) {
    $compId = $_POST['param_2'];

    $str = "UPDATE complaints
            SET reviewed='Y'
            WHERE complaint_id='".$compId."'";
    $statement = $dbCon->prepare($str);
    $statement->execute();
        
    echo json_encode(TRUE);
    
}
?>
