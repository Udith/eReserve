<?php

/*
 * This class is used to compute the hash value of the password
 * and also to compare the entered password with the one in DB.
 * PHP inbuilt "BlowFish" crypto is used as the hashing algorithm
 */

class Hasher {

    function __construct() {
        
    }

    function hashIt($password) {        //returns the hashed value of the password
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), TRUE)), 0, 22);
            $hash = crypt($password, $salt);
            return $hash;
        }
        return $password;
    }

    function verifyPass($password, $hashedpass) {   //verify entered password with the one in DB
        return crypt($password, $hashedpass) == $hashedpass;
    }

}

?>
