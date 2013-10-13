<?php

require 'Hasher.php';

class AddNew {

    private $db = NULL;

    function __construct($dbCon) {        
        $this->db = $dbCon;
    }

    function addUser() {
        $username = $_POST['userName'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $password = $_POST["passw"];
        $repassword = $_POST["repassw"];
        $email = $_POST["email"];
        $type = $_POST["usrtype"];

        if ($this->checkValidity(array($username, $firstName, $lastName, $password, $repassword, $email))) {

            if($password != $repassword){
                return '<span id="fbError">Two passwords do not match!</span>';
            }
            
            $hasher = new Hasher();
            $hash = $hasher->hashIt($password);

            $values = "'" . $username . "','" . $hash . "','" . $firstName . "','" . $lastName . "','" . $email . "','" . $type . "'";
            $statement = $this->db->prepare("INSERT INTO users (username,password,first_name,last_name,email,type,reputation) VALUES(" . $values . ",'0')");
            $success = $statement->execute();

            if ($success)
                return '<span id="fbSuccess" style="color:##02601a;">User added successfully</span>';
            else
                return '<span id="fbError">User adding failed!</span>';
            
        } else{            
            return '<span id="fbError" style="color:#f00;">Some fields are invalid!</span>';
        }
    }
    
    function addRoom() {
        $roomID = $_POST['roomID'];
        $roomName = $_POST['roomName'];
        $department = $_POST['department'];
        $capacity = $_POST["capacity"];
        $air = $_POST["air"];
        $cLab = $_POST["cLab"];

        if ($this->checkValidity(array($roomID,$roomName,$department,$capacity,$air,$cLab))) {            
            
            $values = "'" . $roomID . "','" . $roomName . "','" . $department . "','" . $capacity . "','" . $air . "','" . $cLab . "'";
            $statement = $this->db->prepare("INSERT INTO rooms (room_id,room_name,dept_name,capacity,aircondition,com_lab) VALUES(" . $values . ")");
            $success = $statement->execute();

            if ($success)
                return '<span id="fbSuccess" style="color:##02601a;">Room added successfully</span>';
            else
                return '<span id="fbError">Room adding failed!</span>';
            
        } else{            
            return '<span id="fbError" style="color:#f00;">Some fields are invalid!</span>';
        }
    }

    function checkValidity($values) {
        for($x=0;$x<count($values);$x++){
            if(empty($values[$x])){
                return FALSE;
            }
        }
        return TRUE;
    }
    
    

}
//
//$addUser = new AddUser();
//$addUser->addUser();
?>
