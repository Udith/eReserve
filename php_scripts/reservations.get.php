<?php

include_once '../global.inc.php';

if (isset($_POST["hall_id"])) {
    $hall_id = $_POST["hall_id"];
}

if (isset($_POST["reserve_date"])) {
    $reserve_date = $_POST["reserve_date"];
}

if(isset($hall_id) && isset($reserve_date)){
    $reservations = ReservationHelper::getResByHallDate($hall_id, $reserve_date);
    echo json_encode(array("reservations" => $reservations));
}