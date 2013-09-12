<?php

require 'Hasher.php';
require 'DB.php';

class AddUser {

    private $db = NULL;

//    const DB_SERVER = "localhost";
//    const DB_USER = "root";
//    const DB_PASSWORD = "";
//    const DB_NAME = "reservationdb";

    function __construct() {

        $dsn = 'mysql:dbname=' . Database::DB_NAME . ';host=' . Database::DB_SERVER;

        try {
            $this->db = new PDO($dsn, Database::DB_USER, Database::DB_PASSWORD);
        } catch (PDOException $ex) {
            throw new Exception($ex->getMessage());
        }

        return $this->db;
    }

    function addUser() {
        $username = $_POST['userName'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $password = $_POST["passw"];
        $repassword = $_POST["repassw"];
        $email = $_POST["email"];
        $type = $_POST["usrtype"];

        if ($this->checkValidity($username, $firstName, $lastName, $password, $repassword, $email)) {

            $hasher = new Hasher();
            $hash = $hasher->hashIt($password);

            $values = "'" . $username . "','" . $hash . "','" . $firstName . "','" . $lastName . "','" . $email . "','" . $type . "'";
            $statement = $this->db->prepare("INSERT INTO users (username,password,first_name,last_name,email,type) VALUES(" . $values . ")");
            $success = $statement->execute();

            if ($success)
                echo 'User added successfully';
            else
                echo 'User not added';
            echo $hash;
        }
    }

    function checkValidity($usr, $first, $last, $pass, $repass, $email) {
        //should validate inputs
        return TRUE;
    }

}

$addUser = new AddUser();
$addUser->addUser();
?>
