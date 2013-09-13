<?php

/*
 * This class handles the connections to DB
 */
class Database {

    private $db;

    const DB_SERVER = "localhost";      //DB server
    const DB_USER = "root";             //DB user name
    const DB_PASSWORD = "";             //DB password
    const DB_NAME = "reservationdb";    //DB name

    function __construct() {

        $dsn = 'mysql:dbname=' . Database::DB_NAME . ';host=' . Database::DB_SERVER;

        try {
            $this->db = new PDO($dsn, Database::DB_USER, Database::DB_PASSWORD);
        } catch (PDOException $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    function getConnection() {      //returns a connection to the DB
        return $this->db;
    }

}

?>
