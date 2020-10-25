<?php

$router = new Router(new Request);

$router->add('/', 'GET', function () {
    return;
});

$router->add('/login', 'POST', function ($request) {
    $request->getBody();
    // ToDo send data for logging in
});

$router->add('/register', 'POST', function ($request) {
    // ToDo send data for register
});

$router->validateRequest();
