<?php
/*
 * Has the database access functions need for calendar page
 */

include 'MyDB.php';

$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

switch ($func_name) {
    case "getRooms":
        getRooms($dbCon);
        break;
    case "getReservations":
        getReservations($dbCon);
        break;
}

function getRooms($dbCon) { //gets the list of rooms from DB filtered according to parameters

    $whereSet = FALSE;
    $str = "SELECT room_id,room_name,faculty_name,dept_name FROM rooms NATURAL JOIN departments";

    if ((isset($_POST['param_4'])) && ($_POST['param_4'] != '') && ($_POST['param_4'] != 'any')) {
        $str = $str . " WHERE faculty_name='" . $_POST['param_4'] . "'";
        $whereSet = TRUE;
    }

    if ((isset($_POST['param_5'])) && ($_POST['param_5'] != '') && ($_POST['param_5'] != 'any')) {
        $str = $str . " AND dept_name='" . $_POST['param_5'] . "'";
    }

    if (isset($_POST['param_2'])) {
        $searchBy = $_POST['param_2'];
        if ((isset($_POST['param_3'])) && ($_POST['param_3'] != '')) {

            if ($whereSet) {
                $str = $str . " AND";
            } else {
                $str = $str . " WHERE";
            }

            if ($searchBy == "1") {
                $str = $str . " room_id LIKE ";
            } else {
                $str = $str . " room_name LIKE ";
            }
            $str = $str . "'%" . $_POST['param_3'] . "%'";
        }
    }

    $str = $str . " ORDER BY room_id";

    $statement = $dbCon->prepare($str);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr>
                <th width="100px">Room ID</th>
                <th>Room Name</th>
                <th width="100px">Faculty</th>
                <th width="100px">Department</th>
              </tr> ';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $name = "'" . $row[1] . "'";
            echo '<tr onclick="showReservations(' . $row[0] . ',' . $name . ');">
                    <td>' . $row[0] . '</td>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                  </tr>';
        }
    } else {
        echo 'No Rooms Found! Please try without applying filters.';
    }
}

function getReservations($dbCon) {  //gets the list of reservations from DB for a given room in a given day
    $room_id = $_POST['param_2'];
    $date = $_POST['param_3'];

    $statement = $dbCon->prepare("SELECT begin_time,end_time,reason FROM reservations WHERE room_id='" . $room_id . "' AND reserve_date='" . $date . "' ORDER BY begin_time");
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo '<tr><th width="200px">Time Slot</th><th>Reservation</th></tr>';
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $timeStr = substr($row[0], 0, 5) . " - " . substr($row[1], 0, 5);
            echo '<tr><td>' . $timeStr . '</td><td>' . $row[2] . '</td></tr>';
        }
    } else {
        echo 'No reservations for the day';
    }
}

?>
