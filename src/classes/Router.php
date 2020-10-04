<?php

class Router {

    private array $methods = ['POST', 'GET'];
    private array $paths = ['/', 'register', 'login', 'messenger'];
    private string $requestPath;
    private object $request;

    public function __call($name, $args)
    {
        list($path, $callback) = $args;

        if($_SERVER['REQUEST_METHOD'] !== strtoupper($name) || !in_array($_SERVER['REQUEST_METHOD'], $this->methods)){
            http_response_code(405);
            exit;
        }

        if($_SERVER['REQUEST_URI'] !== $path || !in_array($_SERVER['REQUEST_URI'], $this->paths)){
            http_response_code(404);
            exit;
        }

        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                $this->Post();
                break;
            case 'GET':
                $this->Get();
                break;
        }
    }

    public function Post(){
        //toDo Implement post
    }

    public function Get(){
        //toDo Implement get

    }

    public function errorHandler(){
        return json_encode(['error' => "No such page or invalid method!"]);
    }
}
