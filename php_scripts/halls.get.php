<?php

include_once '../global.inc.php';

if(isset($_POST['hall_id'])){
    $hall_id = $_POST['hall_id'];
}

if(isset($hall_id)){
    $hall = HallHelper::getHall($hall_id);
    echo json_encode(array("halls" => array($hall)));
}
else{
    $halls = HallHelper::getAllHalls();
    echo json_encode(array("halls" => $halls));
}