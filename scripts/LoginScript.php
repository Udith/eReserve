<?php

include 'Hasher.php';

//This class handles the user login process
class Login {

    private $db = NULL;
    private $firstName;
    private $lastName;
    private $usrType;

    function __construct($dbCon) {
        $this->db = $dbCon;     //Gets a connection to the DB
    }

    function authenticate() {                   //authenticates the username and password
        $username = $_POST['usrName'];
        $password = $_POST['passwd'];

        $remember = 'off';
        if (isset($_POST['remember'])) {
            $remember = $_POST['remember'];
        }

        if (empty($username)) {                 //if username is empty
            return "Please provide your username";
        } else if (empty($password)) {          //if password is empty
            return "Please provide your password";
        } else {
            $isAuthentic = $this->comparePassword($username, $password);

            if ($isAuthentic) {
                /*
                 * if authentic, starts the session, sets the cookie and redirects to the home page
                 * according to user type
                 */
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['first'] = $this->firstName;
                $_SESSION['last'] = $this->lastName;
                $_SESSION['type'] = $this->usrType;

                $this->setTheCookie($username, $remember);

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

        $statement = $this->db->prepare("SELECT password,type,first_name,last_name FROM users WHERE username='" . $username . "'");
        $statement->execute();

        $isAuthentic = FALSE;

        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll();
            $dbpass = $result[0]['password'];

            if ($hasher->verifyPass($password, $dbpass)) {
                $isAuthentic = TRUE;
                $this->usrType = $result[0]['type'];
                $this->firstName = $result[0]['first_name'];
                $this->lastName = $result[0]['last_name'];
            } else {
                $isAuthentic = FALSE;
            }
        } else {
            $isAuthentic = FALSE;
        }

        return $isAuthentic;
    }

    function setTheCookie($usrname, $remember) {   //sets the cookie for the user
        $str = $usrname . time();
        $cookStr = md5($str);   //encrypt the string to be stored in the cookie
        //stores the encrypted string in DB
        $values = "'" . $usrname . "','" . $cookStr . "'";
        $statement = $this->db->prepare("INSERT INTO cookies (username,cookhash) VALUES(" . $values . ")");
        $success = $statement->execute();

        //stores the same encrypted string in the cookie
        if ($success) {
            if ($remember == "on") {
                setcookie("ereserve", $cookStr, time() + 3600 * 24 * 30, "/");
            } else {
                setcookie("ereserve", $cookStr, "0", "/");
            }
        }
    }

}

?>
