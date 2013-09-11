<?php

class Logout {

    function removeCookie() {
        setcookie("ereserve", "", time()-3600, "/");
        header("Location:../login.php");
    }

}

$logout = new Logout();
$logout->removeCookie();
?>
