<?php

/*
 * Has the database access functions need for room_history page
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
    case "getHistory":
        getHistory($dbCon, $username);
        break;
    case "getRequest":
        getReqDetails($dbCon);
        break;
}

function getHistory($dbCon, $usr) {     //gets the list of past reservations for the rooms a user admin
    $currentDate = $_POST['param_2'];
    $currentTime = $_POST['param_3'];

    $str = "SELECT reserve_id,room_id,room_name,username,first_name,last_name,reserve_date,begin_time,end_time,reason,req_items 
            FROM reservations NATURAL JOIN rooms NATURAL JOIN users 
            WHERE (reserve_date < '" . $currentDate . "'
            OR (reserve_date = '" . $currentDate . "' AND end_time < '" . $currentTime . "'))
            AND room_id IN 
            (SELECT room_id FROM admins WHERE username = '" . $usr . "') ORDER BY reserve_date DESC";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="80px">Room ID</th>
                <th width="100px">Reserved by</th>
                <th width="100px">Date</th>
                <th width="150px">Time Slot</th>                
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            
            $params = $row[0].",".$row[1].",'".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."'";     
            echo '<tr onclick="showResDetails(' . $params . ')">
                    <td>' . $row[1] . '</td>
                    <td>' . $row[3] . '</td>
                    <td>' . $row[6] . '</td>
                    <td>' . $row[7] . ' - ' . $row[8] . '</td>
                  </tr>';
        }
    } else {
        echo 'No Reservation History.';
    }
}

//function getReqDetails($dbCon) {     //gets the full details of a particular request
//    $resId = $_POST['param_2'];
//
//    $str = "SELECT room_id,room_name,username,first_name,last_name,reserve_date,begin_time,end_time,reason,req_items 
//            FROM reservations NATURAL JOIN rooms NATURAL JOIN users
//            WHERE reserve_id = '" . $resId . "'";
//    $statement = $dbCon->prepare($str);
//    $statement->execute();
//
//    if ($statement->rowCount() > 0) {
//        $result = $statement->fetchAll();
//        
//    } else {
//        echo 'No Such Reservation.';
//    }
//}
?>
