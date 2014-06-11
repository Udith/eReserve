<?php

class Reservation {

    public $reserve_id;
    public $hall_id;
    public $username;
    public $date;
    public $begin_time;
    public $end_time;
    public $reason;
    public $req_items;
    public $auth_by;
    public $feedback;
    public $hall_details;

    function __construct($reserve_id, $hall_id, $username, $date, $begin_time, $end_time, $reason, $req_items, $auth_by, $feedback, $hall_details = "") {
        $this->reserve_id = isset($reserve_id) ? $reserve_id : "";
        $this->hall_id = isset($hall_id) ? $hall_id : "";
        $this->username = isset($username) ? $username : "";
        $this->date = isset($date) ? $date : "";
        $this->begin_time = isset($begin_time) ? substr($begin_time, 0, 5) : "";
        $this->end_time = isset($end_time) ? substr($end_time, 0, 5) : "";
        $this->reason = isset($reason) ? $reason : "";
        $this->req_items = isset($req_items) ? $req_items : "";
        $this->auth_by = isset($auth_by) ? $auth_by : "";
        $this->feedback = isset($feedback) ? $feedback : "";
        $this->hall_details = isset($hall_details) ? $hall_details : "";
    }

}
