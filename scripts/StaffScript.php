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
$results = $chc->checkCook($dbCon, "staff");
$username = $results[0];


switch ($func_name) {
    case "getRoomList":
        getRoomsList($dbCon, $username);
        break;
    case "rate":
        rate($dbCon, $username);
        break;
}

function getRoomsList($dbCon, $username) {
    date_default_timezone_set('Asia/Colombo');
    $str = "SELECT room_id,room_name,begin_time,end_time,reason,req_items,reserve_id FROM reservations NATURAL JOIN rooms
            WHERE reserve_date='" . date('Y-m-d') . "'  
            AND feedback='0' 
            AND room_id IN 
            (SELECT room_id FROM staff WHERE staff.username = '" . $username . "')
            ORDER BY begin_time ASC";

    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="80px">Room ID</th>
                <th>Room Name</th>
                <th width="150px">Time Slot</th>
                <th>Purpose</th>
                <th>Equipment</th>
                <th width="50px">Done</th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td style="text-align:left;">' . $row[1] . '</td>   
                    <td>' . $row[2] . ' - ' . $row[3] . '</td>
                    <td style="text-align:left;">' . $row[4] . '</td>
                    <td style="text-align:left;">' . $row[5] . '</td>
                    <td style="padding:0;">
                    <button id="' . $row[6] . '" name="cancelBtn" class="greenBtn doneBtn" type="button" onclick="completed(' . $row[6] . ');">
                        YES
                    </button>
                    </td>  
                  </tr>';
        }
    } else {
        echo 'No Pending Reservations.';
    }
}

function rate($dbCon, $user) {
    $id = $_POST['param_2'];
    $rating = $_POST['param_3'];
    $complain = $_POST['param_4'];

    //enter the feedback rating to reservation table
    $str = "UPDATE reservations
            SET feedback='" . $rating . "'
            WHERE reserve_id='" . $id . "'";

    $statement = $dbCon->prepare($str);
    $statement->execute();
    
    //update user's reputation
    $repAdd = $rating * 5;    
    $str = "UPDATE users
            SET reputation=(reputation+'" . $repAdd . "')
            WHERE username=
            (SELECT username FROM reservations WHERE reserve_id='" . $id . "')";

    $statement = $dbCon->prepare($str);
    $statement->execute();
    
    //add complain if exists
    if (!(trim($complain) === '')) {
        $str = "INSERT INTO complaints(reserve_id,complaint,made_by,reviewed)
                VALUES ('" . $id . "','" . trim($complain) . "','" . $user . "','N')";

        $statement = $dbCon->prepare($str);
        $statement->execute();
    }
    
    echo json_encode(TRUE);
}

?>
