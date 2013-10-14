<?php

class Email { //this class is used to handle email sending process

    private $from;

    function __construct() {
        ini_set("SMTP", "smtp.dialognet.lk");   //set smtp server
        ini_set("smtp_port", "25"); //set smtp port
        ini_set("date.timezone", "Asia/Colombo");   //set timezone
        $this->from = "eReserve@eReserve.com";  //set senders address
    }

    function sendEmail($to, $subject, $message) {   //send an email
        $headers = "From:" . $this->from;
        $success = mail($to, $subject, $message, $headers);
        return $success;
    }
}
?>
