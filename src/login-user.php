<?php

header("Access-Control-Allow-Methods: POST");

require 'database.php';
require 'User.php';

$pdo = new Database();
$conn = $pdo->Connect();

$data = json_decode(file_get_contents("php://input"));

$username = $data->name;
$password = $data->password;

$user = new User($conn, $username, $password);
$user->userLogin();