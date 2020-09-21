<?php

class User
{

    private $db;
    private $name;
    private $pass;
    private $realname;

    public function __construct($database, $username, $password, $userrealname = null)
    {
        $this->db = $database;
        $this->name = htmlspecialchars(strip_tags($username));
        $this->pass = htmlspecialchars(strip_tags($password));
        $this->realname = htmlspecialchars(strip_tags($userrealname));
    }

    public function userLogin()
    {
        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE Name = :name;');
        $stmt->execute(array(':name' => $this->name));
        $user = json_encode($stmt->fetch());
        echo $user;
    }

    public function userRegister()
    {
        $stmt = $this->db->prepare('INSERT INTO USERS (Name, Password, RealName) VALUES (:username, :password, :realname)');
        $stmt->execute(array(':username' => $this->name, ':password' => $this->pass, ':realname' => $this->realname));
    }

    public function compareUsers()
    {
        $stmt = $this->db->prepare('SELECT * FROM USERS');
        $stmt->execute();
        $users = $stmt->fetchAll();
        array_map(function ($user) {
            if ($user['Name'] === $this->name) {
                return false;
            }
            return true;
        }, $users);
    }

    public function hashPassword()
    {
        return $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);
    }
}
