<?php

class Email {

    private $from;

    function __construct() {
        ini_set("SMTP", "smtp.dialognet.lk");
        ini_set("smtp_port", "25");
        ini_set("date.timezone", "Asia/Colombo");
        $this->from = "eReserve@eReserve.com";
    }

    function sendEmail($to, $subject, $message) {
        $headers = "From:" . $this->from;
        $success = mail($to, $subject, $message, $headers);
        return $success;
    }
}
?>
