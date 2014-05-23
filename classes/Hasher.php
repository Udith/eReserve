<?php

/*
 * This class is used to compute the hash value of the password
 * and also to compare the entered password with the one in DB.
 * PHP inbuilt "BlowFish" crypto is used as the hashing algorithm
 */

class Hasher {

    function hashIt($password) { 
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), TRUE)), 0, 22);
            $hash = crypt($password, $salt);
            return $hash;
        }
        return $password;
    }

    function verifyPass($password, $hashedpass) { 
        return crypt($password, $hashedpass) == $hashedpass;
    }

}
