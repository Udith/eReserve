<?php

include '../classes/DB.php';
include '../classes/Hasher.php';

$userName = $_POST["user"];
$password = $_POST["pass"];

if (isset($_POST["remember"]) && ($_POST["remember"] == "on")) {
    $remember = TRUE;
} else {
    $remember = FALSE;
}

//check for empty username and password
if (empty($userName) || empty($password)) {
    header("location: ../login.php?err=empty");
    exit();
}

//authenticate password
$hasher = new Hasher();
$db = new DB();

$userDetails = $db->select("users", "username='$userName'", TRUE);

if ($userDetails == NULL) {
    header("location: ../login.php?err=err_cred&namestr=$userName");
    exit();
}

$isAuthentic = $hasher->verifyPass($password, $userDetails["password"]);

if ($isAuthentic) {
    /*
     * if authentic, starts the session and redirects to the home page
     */
    session_start();
    $_SESSION['username'] = $userDetails["username"];
    $_SESSION['first'] = $userDetails["first_name"];
    $_SESSION['last'] = $userDetails["last_name"];
    $_SESSION['level'] = $userDetails["level"];

    header("Location:../home.php");
}
else{
    header("location: ../login.php?err=err_cred&namestr=$userName");
    exit();
}

//
//    function setTheCookie($usrname, $remember) {   //sets the cookie for the user
//        $str = $usrname . time();
//        $cookStr = md5($str);   //encrypt the string to be stored in the cookie
//        //stores the encrypted string in DB
//        $values = "'" . $usrname . "','" . $cookStr . "'";
//        $statement = $this->db->prepare("INSERT INTO cookies (username,cookhash) VALUES(" . $values . ")");
//        $success = $statement->execute();
//
//        //stores the same encrypted string in the cookie
//        if ($success) {
//            if ($remember == "on") {
//                setcookie("ereserve", $cookStr, time() + 3600 * 24 * 30, "/");
//            } else {
//                setcookie("ereserve", $cookStr, "0", "/");
//            }
//        }
//    }
//
//}

