<?php

include_once '../global.inc.php';

if(isset($_POST['hall_id'])){
    $hall_id = $_POST['hall_id'];
}

//sleep(3);

if(isset($hall_id)){
    $hall = HallHelper::getHall($hall_id);
    if ($hall) {
        echo json_encode(array("halls" => array($hall)));
    } else {
        echo json_encode(array("halls" => array()));
    }
}
else{
    $halls = HallHelper::getAllHalls();
//    echo json_encode(array("halls" => array()));
    echo json_encode(array("halls" => $halls));
}