<?php

class Router {

    private array $methodsPaths =
        ['POST' => ['/register', '/login'],
            'GET' => ['/', '/messenger']
        ];
    private string $requestPath;
    private object $request;

    public function __call($name, $args)
    {
        list($path, $callback) = $args;

        if(!in_array($_SERVER['REQUEST_METHOD'], array_keys($this->methodsPaths))) {
            return;
        }

        if(array_search($path, $this->methodsPaths[$_SERVER['REQUEST_METHOD']]) === false){
            return;
        }

        $this->requestPath = $path;
        $this->request = $callback;

        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                $this->sendData();
                break;
            case 'GET':
                $this->getData();
                break;
        }
    }

    public function sendData(){
        switch ($this->requestPath){
            case '/login':
                //ToDo login User
            case '/register':
                //ToDO register User
        }
    }

    public function getData(){
        if ($this->requestPath === '/'){
            return;
        }

        // ToDo other cases
    }

    public function errorHandler(){
        return json_encode(['error' => "No such page or invalid method!"]);
    }
}
