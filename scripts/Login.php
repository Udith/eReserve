<?php

include 'Hasher.php';
//include 'MyDB.php';

class Login {

    private $db = NULL;

//    const DB_SERVER = Database(;
//    const DB_USER = "root";
//    const DB_PASSWORD = "";
//    const DB_NAME = "reservationdb";
    
    private $usrType;

    function __construct($dbCon) {

//        $dsn = 'mysql:dbname=' . Database::DB_NAME . ';host=' . Database::DB_SERVER;
//
//        try {
//            $this->db = new PDO($dsn, Database::DB_USER, Database::DB_PASSWORD);
//        } catch (PDOException $ex) {
//            throw new Exception($ex->getMessage());
//        }
//
//        return $this->db;
        
        $this->db = $dbCon;
    }

    function authenticate() {       //authenticate the username and password

        $username = $_POST['usrName'];
        $password = $_POST['passwd'];

        if (empty($username)) {
            return "Please provide your username";
        } else if(empty($password)){
            return "Please provide your password";
        } else {
            $isAuthentic = $this->comparePassword($username, $password);

            if ($isAuthentic) {                
                $this->setTheCookie($username);
                if($this->usrType == "user")
                    header("Location:home.php");
                else if($this->usrType == "radmin")
                    header("Location:admin.php");
                if($this->usrType == "staff")
                    header("Location:staff.php");
            } else {
                return "Incorrect Username or Password";
            }
        }
    }

    function comparePassword($username, $password) {    //compare the entered password with the one in database
        
        $hasher = new Hasher();       
        
        $statement = $this->db->prepare("SELECT password,type FROM users WHERE username='" . $username . "'");
        $statement->execute();

        $isAuthentic = FALSE;

        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll();
            $dbpass = $result[0]['password'];

            if ($hasher->verifyPass($password,$dbpass)) {
                $isAuthentic = TRUE;
                $this->usrType = $result[0]['type'];
            } else {
                $isAuthentic = FALSE;
            }
        } else {
            $isAuthentic = FALSE;
        }

        return $isAuthentic;
    }
    
    function setTheCookie($usrname){
        
        $str = $usrname.time();
        $cookStr = md5($str);
        
        $statement = $this->db->prepare("UPDATE users SET cookhash='".$cookStr."' WHERE username='".$usrname."'");
        $success = $statement->execute();
        
        if($success)
            setcookie("ereserve", $cookStr,"0","/");
    }

}

//$login = new Login();
//$login->authenticate();
?>
