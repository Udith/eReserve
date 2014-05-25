<?php

class UserHelper {    

    public static function getUser($username) {
        $db = new DB();
        $userArr = $db->select("users", "username='$username'", TRUE);

        if (count($userArr) == 0) {
            return NULL;
        }
        
        $user = new User(
                $userArr['username'], $userArr['first_name'], $userArr['last_name'], $userArr['level'], $userArr['reputation']
        );

        return $user;
    }

    public static function getHashedPass($username) {
        $db = new DB();
        $userArr = $db->select("users", "username='$username'", TRUE);
        
        if (count($userArr) == 0) {
            return NULL;
        }
        return $userArr['password'];
    }

}
