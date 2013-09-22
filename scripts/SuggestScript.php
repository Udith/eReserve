<?php

/*
 * Has the database access functions need for suggestions page
 */

include 'MyDB.php';
include 'CheckCookie.php';

$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

switch ($func_name) {
    case "getSuggestions":
        getSuggestions($dbCon);
        break;
}

function getSuggestions($dbCon) {
    $date = $_POST['param_2'];
    $start = $_POST['param_3'];
    $end = $_POST['param_4'];
    $fac = $_POST['param_5'];
    $dep = $_POST['param_6'];
    $cap = $_POST['param_7'];
    $air = $_POST['param_8'];
    $com = $_POST['param_9'];

    $str = "SELECT room_id,room_name,faculty_name,dept_name,capacity,aircondition,com_lab FROM rooms NATURAL JOIN departments
            WHERE capacity >= '" . $cap . "' AND aircondition='" . $air . "' AND com_lab='" . $com . "'";

    if ($fac != "any") {
        $str = $str . " AND faculty_name='" . $fac . "'";

        if ($dep != "any") {
            $str = $str . " AND dept_name='" . $dep . "'";
        }
    }

    $str1 = "SELECT room_id FROM reservations WHERE reserve_date='" . $date . "' AND (
            (begin_time > '" . $start . "' AND begin_time < '" . $end . "') OR
            (end_time > '" . $start . "' AND end_time < '" . $end . "') OR
            (begin_time <= '" . $start . "' AND end_time >= '" . $end . "'))";

    $str2 = "SELECT room_id FROM requests WHERE request_date='" . $date . "' AND (
            (begin_time > '" . $start . "' AND begin_time < '" . $end . "') OR
            (end_time > '" . $start . "' AND end_time < '" . $end . "') OR
            (begin_time <= '" . $start . "' AND end_time >= '" . $end . "'))";

    $str_req = $str . " AND room_id NOT IN (" . $str1 . ")";
    $str = $str_req . " AND room_id NOT IN (" . $str2 . ")";

    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                
                <th>Room Name</th>
                <th width="100px">Faculty</th>
                <th width="100px">Department</th>
                <th width="80px">Capacity</th>
                <th width="50px">A/C</th>
                <th width="60px">Computer Lab</th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $name = "'" . $row[1] . "'";
            echo '<tr onclick="requestReservation(' . $row[0] . ',' . $name . ');">
                    
                    <td style="text-align:left;">' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                    <td>' . $row[4] . '</td>
                    <td>' . $row[5] . '</td>
                    <td>' . $row[6] . '</td>
                  </tr>';
        }
//        return;
    } else {
        echo 'No suitable Rooms Found! Please try without applying filters.';
    }

//    $statement = $dbCon->prepare($str_req);
//    $statement->execute();
//
//    if ($statement->rowCount() > 0) {
//        echo 'No vacant rooms found for your requirements. The following rooms are not reserved but have pending requests.
//            You can still request such a room';
//        echo '<table>';
//        echo '<tr>
//                <th width="30px">Room ID</th>
//                <th>Room Name</th>
//                <th width="100px">Faculty</th>
//                <th width="100px">Department</th>
//                <th width="30px">Capacity</th>
//                <th width="50px">A/C</th>
//                <th width="50px">Computer Lab</th>
//              </tr> ';
//        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
//            echo '<tr>
//                    <td>' . $row[0] . '</td>
//                    <td style="text-align:left;">' . $row[1] . '</td>
//                    <td>' . $row[2] . '</td>
//                    <td>' . $row[3] . '</td>
//                    <td>' . $row[4] . '</td>
//                    <td>' . $row[5] . '</td>
//                    <td>' . $row[6] . '</td>
//                  </tr>';
//        }
//        echo '</table>';
//    } else {
//        echo 'No suitable Rooms Found! Please try without applying filters.';
//    }
}

?>
