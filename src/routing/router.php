<?php

$router = new Router();

$router->get('/', function () {
    return;
});

$router->post('/login', function ($request) {
    // ToDo send data for logging in
});

$router->post('/register', function ($request) {
    // ToDo send data for register
});
