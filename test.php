<?php

include_once './global.inc.php';

echo json_encode(ReservationHelper::getResByHallDate(0, "2014-08-01"));

