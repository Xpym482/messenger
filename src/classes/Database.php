<?php

class Database {

    private $db = "messenger";
    private $user = "root";
    private $host = "127.0.0.1";
    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    public $conn;

    public function dbConnect()
    {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, '', $this->opt);
        return $this->conn;
    }
}
