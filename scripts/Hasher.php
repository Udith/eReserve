<?php

class Hasher {

    function __construct() {
        
    }

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

?>
