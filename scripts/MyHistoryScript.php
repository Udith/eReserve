<?php
/*
 * Has the database access functions need for my_history page
 */

include 'MyDB.php';
include 'CheckCookie.php';

$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

$chc = new CheckCookie();
$results = $chc->checkCook($dbCon,"user");
$username = $results[0];


switch ($func_name) {
    case "getHistory":
        getHistory($dbCon, $username);
        break;
}

function getHistory($dbCon, $usr) {     //gets the list of past reservations for a user form DB

    $currentDate = $_POST['param_2'];
    $currentTime = $_POST['param_3'];

    $str = "SELECT room_id,reserve_date,begin_time,end_time,reason FROM reservations WHERE username='" . $usr . "'
            AND (reserve_date < '" . $currentDate . "'
            OR (reserve_date = '" . $currentDate . "' AND end_time < '" . $currentTime . "'))";
    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="80px">Room ID</th>
                <th width="100px">Date</th>
                <th width="150px">Time Slot</th>
                <th>Purpose</th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            echo '<tr>
                    <td>' . $row[0] . '</td>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '-' . $row[3] . '</td>
                    <td style="text-align:left;">' . $row[4] . '</td>
                  </tr>';
        }
    } else {
        echo 'No Reservation History.';
    }
}

?>
