<?php

/*
 * This script is used to logout the user
 */

class Logout {

    function removeCookie() {
        //It forces the browser to remove the cookie by expiring it  
        setcookie("ereserve", "", time() - 3600, "/");
        //Then redirects to login page
        header("Location:../login.php");
    }

}

$logout = new Logout();
$logout->removeCookie();
?>
