<?php

class ReservationHelper {

    public static function getReservation($id) {
        $db = new DB();
        $resArr = $db->select("reservations", "reserve_id='$id'", TRUE);

        if (count($resArr) == 0) {
            return NULL;
        }
        $reservation = new Reservation($resArr["reserve_id"], $resArr["hall_id"], $resArr["username"], $resArr["reserve_date"], $resArr["begin_time"], $resArr["end_time"], $resArr["reason"], $resArr["req_items"], $resArr["auth_by"], $resArr["feedback"]);

        return $reservation;
    }

    public static function getResByHallDate($hall_id, $date) {
        $db = new DB();
        $resArr = $db->selectOrder("reservations", "begin_time", "hall_id='$hall_id' AND reserve_date='$date'");

        $reservations = array();
        foreach ($resArr as $currentRes) {
            $reservation = new Reservation($currentRes["reserve_id"], $currentRes["hall_id"], $currentRes["username"], $currentRes["reserve_date"], $currentRes["begin_time"], $currentRes["end_time"], $currentRes["reason"], $currentRes["req_items"], $currentRes["auth_by"], $currentRes["feedback"]);
            array_push($reservations, $reservation);
        }

        return $reservations;
    }

//    public static function getAllHalls() {
//        $db = new DB();
//        $hallArr = $db->join("halls", "departments", "dept_name", "dept_name", 1);
//
//        $halls = array();
//        foreach ($hallArr as $currentHall) {
//            $isAc = ($currentHall['aircondition'] == 1) ? TRUE : FALSE;
//            $isComLab = ($currentHall['com_lab'] == 1) ? TRUE : FALSE;
//            $hall = new Hall($currentHall['hall_id'], $currentHall['hall_name'], $currentHall['dept_name'], $currentHall['faculty_name'], (int) $currentHall['capacity'], $isAc, $isComLab);
//            
//            array_push($halls, $hall);
//        }
//
//        return $halls;
//    }
}
