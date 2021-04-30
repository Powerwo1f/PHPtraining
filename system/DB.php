<?php
namespace System;
use mysqli as mysqli;
class DB {
    private $mysqli;

    function __construct($host, $user, $password, $db) {
        $this->mysqli = new mysqli($host, $user, $password, $db);
        if ($this->mysqli->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }
    }

    public function query($sql){
        $query = $this->mysqli->query($sql);

        if (!$this->mysqli->errno) {
            if ($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return true;
            }
        } else {
            throw new \Exception('Error: ' . $this->connection->error  . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
        }
    }

    public function escape($value) {
        return $this->mysqli->real_escape_string($value);
    }

    public function getLastId() {
        return $this->mysqli->insert_id;
    }
}
