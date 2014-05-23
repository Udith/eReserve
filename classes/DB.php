<?php

/**
 * Database class
 *
 * @author Udith Gunaratna <uditharosha@gmail.com>
 */
class DB {

    private $db_server = "localhost";
    private $db_name = "reservationdb";
    private $db_user = "root";
    private $db_pass = "";
    private $db;

    function __construct() {
        $this->connect();
    }

//    public function closeConnection(){
//        $this->connection->
//    }

    public function connect() {
        $this->db = new PDO("mysql:host=$this->db_server;dbname=$this->db_name", $this->db_user, $this->db_pass);

        return TRUE;
    }

    public function processRowSet($rowSet, $singleRow = FALSE) {
        $retArray = array();

        while ($row = $rowSet->fetch(PDO::FETCH_ASSOC)) {
            array_push($retArray, $row);
        }

        if ($singleRow && (count($retArray) > 0)) {
            return $retArray[0];
        }
        return $retArray;
    }

    public function select($table, $where = TRUE, $singleRow = FALSE) {
        $sql = "SELECT * FROM $table WHERE $where";
        $result = $this->db->query($sql);

        if (!$result) {
            return FALSE;
        }

        if ($singleRow) {
            return $this->processRowSet($result, TRUE);
        } else {
            return $this->processRowSet($result);
        }
    }

}
