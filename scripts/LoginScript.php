<?php

include 'Hasher.php';

//This class handles the user login process
class Login {

    private $db = NULL;
    private $usrType;

    function __construct($dbCon) {
        $this->db = $dbCon;     //Gets a connection to the DB
    }

    function authenticate() {                   //authenticates the username and password
        $username = $_POST['usrName'];
        $password = $_POST['passwd'];

        if (empty($username)) {                 //if username is empty
            return "Please provide your username";
        } else if (empty($password)) {          //if password is empty
            return "Please provide your password";
        } else {
            $isAuthentic = $this->comparePassword($username, $password);

            if ($isAuthentic) {
                /*
                 * if authentic, sets the cookie and redirects to the home page
                 * according to user type
                 */
                $this->setTheCookie($username);
                if ($this->usrType == "user")
                    header("Location:home.php");
                else if ($this->usrType == "radmin")
                    header("Location:admin.php");
                if ($this->usrType == "staff")
                    header("Location:staff.php");
            } else {
                return "Incorrect Username or Password";
            }
        }
    }

    function comparePassword($username, $password) {    //compares the entered password with the one in database
        $hasher = new Hasher();

        $statement = $this->db->prepare("SELECT password,type FROM users WHERE username='" . $username . "'");
        $statement->execute();

        $isAuthentic = FALSE;

        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll();
            $dbpass = $result[0]['password'];

            if ($hasher->verifyPass($password, $dbpass)) {
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

    function setTheCookie($usrname) {   //sets the cookie for the user
        $str = $usrname . time();
        $cookStr = md5($str);   //encrypt the string to be stored in the cookie
        
        //stores the encrypted string in DB
        $statement = $this->db->prepare("UPDATE users SET cookhash='" . $cookStr . "' WHERE username='" . $usrname . "'");
        $success = $statement->execute();

        //stores the same encrypted string in the cookie
        if ($success)
            setcookie("ereserve", $cookStr, "0", "/");
    }

}

?>
