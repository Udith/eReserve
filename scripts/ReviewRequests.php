<?php

/*
 * Reviews the requests
 */

include 'MyDB.php';
include 'CheckCookie.php';
include 'Email.php';

//$p = json_decode($_POST['param_1'], TRUE);
//echo json_encode($p);

$db = new Database();
$dbCon = $db->getConnection();

$chc = new CheckCookie();
$results = $chc->checkCook($dbCon, "radmin");
$admin = $results[0];

reviewReservations($dbCon, $admin);

function reviewReservations($dbCon, $admin) {
    $requests = json_decode($_POST['param_1'], TRUE);
    $email = new Email();

    for ($i = 0; $i < count($requests); $i++) {
        $status = ($requests[$i]['status']);
        $request = ($requests[$i]['id']);

        if ($status == "a") {
            $res = accept($dbCon, $request, $admin);
            if ($res) {
                $message = getMessage($requests[$i]['name'], $requests[$i]['room'], $requests[$i]['date'], $requests[$i]['start'] . "-" . $requests[$i]['end'], $requests[$i]['purpose'], TRUE);
                $email->sendEmail($requests[$i]['email'], "Reservation Request Review", $message);
            }
        } else if ($status == "r") {
            $res = reject($dbCon, $request);            
            if ($res) {
                $message = getMessage($requests[$i]['name'], $requests[$i]['room'], $requests[$i]['date'], $requests[$i]['start'] . "-" . $requests[$i]['end'], $requests[$i]['purpose'], FALSE);
                $email->sendEmail($requests[$i]['email'], "Reservation Request Review", $message);
            }
        }
    }
    echo json_encode(TRUE);
}

function accept($dbCon, $request, $admin) {
    $str = "INSERT INTO reservations (room_id,username,reserve_date,begin_time,end_time,reason,req_items,auth_by) 
            (SELECT room_id,username,request_date,begin_time,end_time,reason,req_items,'" . $admin . "' FROM requests
             WHERE request_id='" . $request . "')";
    $statement = $dbCon->prepare($str);
    $result = $statement->execute();

    if ($result) {
        $str = "DELETE FROM requests WHERE request_id='" . $request . "'";
        $statement = $dbCon->prepare($str);
        $result = $statement->execute();
    }

    return $result;
}

function reject($dbCon, $request) {
    $str = "DELETE FROM requests WHERE request_id='" . $request . "'";
    $statement = $dbCon->prepare($str);
    $result = $statement->execute();

    return $result;
}

function getMessage($name, $room, $date, $time, $purpose, $accept) {
    $retMessage = "Dear " . $name . ",\n";
    $retMessage = $retMessage . "Your request for\n";
    $retMessage = $retMessage . "Room ID: " . $room . "\n";
    $retMessage = $retMessage . "Date: " . $date . "\n";
    $retMessage = $retMessage . "TimeSlot: " . $time . "\n";
    $retMessage = $retMessage . "Purpose: " . $purpose . "\n";

    if ($accept) {
        $retMessage = $retMessage . "was ACCEPTED.";
    } else {
        $retMessage = $retMessage . "was NOT ACCEPTED.";
    }

    return $retMessage;
}
?>

