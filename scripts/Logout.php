<?php

/*
 * This script is used to logout the user
 */
include './MyDB.php';
class Logout {

    function removeCookie() {
        //Destroys the current session
        session_start();
        session_destroy();

        //remove the cookie entry from database
        $db = new Database();
        $dbCon = $db->getConnection();
        $cookHash = $_COOKIE['ereserve'];
        $statement = $dbCon->prepare("DELETE FROM cookies WHERE cookhash='" . $cookHash . "'");
        $statement->execute();

        //It forces the browser to remove the cookie by expiring it         
        setcookie("ereserve", "", time() - 3600, "/");
        //Then redirects to login page
        header("Location:../login.php");
    }
}

$logout = new Logout();
$logout->removeCookie();
?>
