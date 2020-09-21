<?php

header("Access-Control-Allow-Methods: POST");

require 'Database.php';
require 'User.php';

$pdo = new Database();
$conn = $pdo->dbConnect();

$data = json_decode(file_get_contents("php://input"));

$username = $data->name;
$password = $data->password;

$user = new User($conn, $username, $password);
$user->hashPassword();
$user->userLogin();