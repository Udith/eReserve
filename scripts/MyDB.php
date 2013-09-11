<?php

class Database {

    private $db;
    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "reservationdb";
    
    function __construct() {

        $dsn = 'mysql:dbname=' . Database::DB_NAME . ';host=' . Database::DB_SERVER;

        try {
            $this->db = new PDO($dsn, Database::DB_USER, Database::DB_PASSWORD);
        } catch (PDOException $ex) {
            throw new Exception($ex->getMessage());
        }
    }
    
    function getConnection(){
        return $this->db;
    }
}



?>
