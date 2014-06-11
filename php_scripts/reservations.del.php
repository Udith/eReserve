<?php

include_once '../global.inc.php';

if (isset($_POST["reserve_id"])) {
    $reserve_id = $_POST["reserve_id"];
}

$delSuccess = ReservationHelper::deleteRes($reserve_id);
echo json_encode($delSuccess);
