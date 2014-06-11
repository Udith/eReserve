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

    private function connect() {
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
            if ($singleRow) {
                return NULL;
            } else {
                return array();
            }
        }

        if ($singleRow) {
            return $this->processRowSet($result, TRUE);
        } else {
            return $this->processRowSet($result);
        }
    }

    public function selectOrder($table, $orderBy, $where = TRUE, $singleRow = FALSE) {
        $sql = "SELECT * FROM $table WHERE $where ORDER BY $orderBy";
        $result = $this->db->query($sql);

        if (!$result) {
            if ($singleRow) {
                return NULL;
            } else {
                return array();
            }
        }

        if ($singleRow) {
            return $this->processRowSet($result, TRUE);
        } else {
            return $this->processRowSet($result);
        }
    }

    public function join($table1, $table2, $onfield1, $onField2, $where = TRUE, $singleRow = FALSE) {
        $sql = "SELECT * FROM $table1 JOIN $table2 ON $table1.$onfield1 = $table2.$onField2 WHERE $where";

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

    public function remove($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
        $result = $this->db->exec($sql);
        
        return $result;
    }

}
