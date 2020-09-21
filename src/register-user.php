<?php

header("Access-Control-Allow-Methods: POST");

require 'Database.php';
require 'User.php';

$pdo = new Database();
$conn = $pdo->dbConnect();

$data = json_decode(file_get_contents("php://input"));

$username = $data->name;
$password = $data->password;
$userrealname = $data->realname;

$user = new User($conn, $username, $password, $userrealname);
$user->hashPassword();
//$user->userRegister();
$user->compareUsers();