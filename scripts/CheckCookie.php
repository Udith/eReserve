<?php

/*
 * This class checks the ereserve cookie
 * If present, gets user details from DB
 * Else redirects to appropriate page
 */

class CheckCookie {

    private $db = NULL;

    function __construct($dbCon) {
        $this->db = $dbCon;
    }

    function checkCook($expectedType) {     //check for ereserve cookie
        if (isset($_COOKIE['ereserve'])) {
            $cookHash = $_COOKIE['ereserve'];

            $statement = $this->db->prepare("SELECT username, first_name, last_name, type FROM users WHERE cookhash='" . $cookHash . "'");
            $statement->execute();

            if ($statement->rowCount() > 0) {   //if present gets userdata from DB and returns

                $result = $statement->fetchAll();
                $usrname = $result[0]['username'];
                $first_name = $result[0]['first_name'];
                $last_name = $result[0]['last_name'];
                $type = $result[0]['type'];

                if (($expectedType == $type) || ($expectedType == "guest")) {
                    return array($usrname, $first_name, $last_name, $type);
                } else {
                    header("Location:" . $this->redirectPage($type));
                }
            } else {
                header("Location:" . $this->redirectPage("guest"));
            }
            return null;
        } else if ($expectedType == "guest") {
            return "guest";
        } else {
            header("Location:" . $this->redirectPage("guest"));
        }
    }

    function redirectPage($userType) {  //gives the default page for each user type
        switch ($userType) {
            case "user":
                return "home.php";
                break;
            case "radmin":
                return "admin.php";
                break;
            case "staff":
                return "staff.php";
                break;
            case "guest":
                return "login.php";
                break;
            default :
                return "login.php";
        }
    }

}

?>
