<?php

class User {

    public $username;
    public $firstName;
    public $lastName;
    public $level;
    public $reputation;

    function __construct($username, $firstName, $lastName, $level, $reputation) {
        $this->username = isset($username) ? $username : "";
        $this->firstName = isset($firstName) ? $firstName : "";
        $this->lastName = isset($lastName) ? $lastName : "";
        $this->level = isset($level) ? $level : "";
        $this->reputation = isset($reputation) ? $reputation : "";
    }

}
