<?php

if ((!isset($_SESSION['username'])) && ($req_level > 0)) {
    header("Location:" . ROOT_DIR . "login.php");
} else if (isset($_SESSION['username'])) {
    $user_level = $_SESSION['level'];

    if ($user_level < $req_level) {
        header("Location:" . ROOT_DIR . "home.php");
    }
}
