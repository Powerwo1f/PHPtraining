<?php
namespace System;
class Model {

    public $db;

    public function __construct () {
        $this->db = new DB(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    }
}
