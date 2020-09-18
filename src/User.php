<?php

class User{

    private $db;
    private $name;
    private $pass;

    public function __construct($database, $username, $password)
    {
        $this->db = $database;
        $this->name = $username;
        $this->pass = $password;
    }

    public function userLogin(){
        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE Name = :email;');
        $stmt->execute(array(':email' => $this->name));
        print_r($stmt->fetch());
    }
}