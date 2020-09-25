<?php

header("Access-Control-Allow-Methods: POST");

require 'classes/Database.php';
require 'classes/User.php';

$pdo = new Database();
$conn = $pdo->dbConnect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email) || !isset($data->password) || !isset($data->username)){
    echo json_encode(["error" => "Data is not correct!"]);
    return;
}

$email = $data->email;
$password = $data->password;
$username = $data->username;

$user = new User($conn);
$user->setEmail($email);
$user->setPassword($password);
$user->setUsername($username);

if ($user->getEmail() && $user->getPassword() && $user->getUsername()) {
    $user->userRegister();
} else {
    echo json_encode(["error" => "Cannot login"]);
    exit;
}
