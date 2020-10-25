<?php

header("Access-Control-Allow-Methods: POST");

require 'classes/Database.php';
require 'classes/User.php';

$pdo = new Database();
$conn = $pdo->dbConnect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->password) || !isset($data->username)){
    echo json_encode(["error" => "Data is not correct!"]);
    exit;
}

$username = $data->username;
$password = $data->password;

$user = new User($conn);
$user->setUsername($username);
$user->setPassword($password);

if ($user->getUsername() && $user->getPassword()) {
    $user->userLogin();
} else {
    echo json_encode(["error" => "Cannot login"]);
    exit;
}
