<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Dotenv\Dotenv;

class Verification
{
    public static function createJWT() : string {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $secret = $_ENV['SECRET'];

        $payload = [
            "iss" => "http://" . $_SERVER['SERVER_NAME'],
            "aud" => "http://" . $_SERVER['SERVER_NAME'],
            "iat" => time(),
            "nbf" => time(),
        ];

        return JWT::encode($payload, $secret);
    }
}