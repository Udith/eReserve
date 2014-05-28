<?php

class Hall {

    public $id;
    public $name;
    public $department;
    public $faculty;
    public $capacity;
    public $ac;
    public $com_lab;

    function __construct($id, $name, $department, $faculty, $capacity, $ac, $com_lab) {
        $this->id = isset($id) ? $id : "";
        $this->name = isset($name) ? $name : "";
        $this->department = isset($department) ? $department : "";
        $this->faculty = isset($faculty) ? $faculty : "";
        $this->capacity = isset($capacity) ? $capacity : "";
        $this->ac = isset($ac) ? $ac : "";
        $this->com_lab = isset($com_lab) ? $com_lab : "";
    }

}
