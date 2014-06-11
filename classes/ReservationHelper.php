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

    public static function getResByUser($user_id, $isPast) {
        $db = new DB();
        $currentDate = date("Y-m-d");

        if ($isPast) {
            $resArr = $db->join("reservations", "halls", "hall_id", "hall_id", "username='$user_id' AND reserve_date<='$currentDate'");
        } else {
            $resArr = $db->join("reservations", "halls", "hall_id", "hall_id", "username='$user_id' AND reserve_date>'$currentDate'");
        }

        $reservations = array();

        foreach ($resArr as $currentRes) {
            $reservation = new Reservation($currentRes["reserve_id"], $currentRes["hall_id"], $currentRes["username"], $currentRes["reserve_date"], $currentRes["begin_time"], $currentRes["end_time"], $currentRes["reason"], $currentRes["req_items"], $currentRes["auth_by"], $currentRes["feedback"], $currentRes["hall_name"] . " - " . $currentRes["dept_name"]);
            array_push($reservations, $reservation);
        }

        return $reservations;
    }

}
