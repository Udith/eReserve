<?php

class HallHelper {

    public static function getHall($id) {
        $db = new DB();
        $hallArr = $db->join("halls", "departments", "dept_name", "dept_name", "hall_id='$id'", TRUE);

        if (count($hallArr) == 0) {
            return NULL;
        }

        $isAc = ($hallArr['aircondition'] == 1) ? TRUE : FALSE;
        $isComLab = ($hallArr['com_lab'] == 1) ? TRUE : FALSE;
        $hall = new Hall($hallArr['hall_id'], $hallArr['hall_name'], $hallArr['dept_name'], $hallArr['faculty_name'], (int) $hallArr['capacity'], $isAc, $isComLab);

        return $hall;
    }

    public static function getAllHalls() {
        $db = new DB();
        $hallArr = $db->join("halls", "departments", "dept_name", "dept_name", 1);

        if (count($hallArr) == 0) {
            return NULL;
        }

        $halls = array();
        foreach ($hallArr as $currentHall) {
            $isAc = ($currentHall['aircondition'] == 1) ? TRUE : FALSE;
            $isComLab = ($currentHall['com_lab'] == 1) ? TRUE : FALSE;
            $hall = new Hall($currentHall['hall_id'], $currentHall['hall_name'], $currentHall['dept_name'], $currentHall['faculty_name'], (int) $currentHall['capacity'], $isAc, $isComLab);
            
            array_push($halls, $hall);
        }

        return $halls;
    }

}
