<?php

class Database {

    public $database = "";
    public $user = "";
    public $password = "";
    public $host = "";

    public function __construct($db, $user, $password, $host)
    {
        $this->database = $db;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
    }

    public function databaseConnection(){

    }
}