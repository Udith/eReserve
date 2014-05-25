<?php

if ((!isset($_SESSION['user']->username)) && ($req_level > 0)) {
    header("Location:" . ROOT_DIR . "login.php");
} else if (isset($_SESSION['user']->username)) {
    $user_level = $_SESSION['user']->level;

    if ($user_level < $req_level) {
        header("Location:" . ROOT_DIR . "home.php");
    }
}
