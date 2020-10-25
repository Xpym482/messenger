<?php

class Router {

    private array $routes = array();
    private string $serverPath;
    private string $serverMethod;
    private $request;

    public function __construct(IRequest $request){
        $this->request = $request;
    }

    public function add(string $path, string $method, $closure)
    {
        $this->routes[$path] = ['method'=> strtoupper($method), 'function' => $closure];
    }

    public function validateRequest()
    {
        $path = explode("?", $_SERVER['REQUEST_URI']);

        $this->serverPath = $path[0];
        $this->serverMethod = $_SERVER['REQUEST_METHOD'];

        if(!in_array($this->serverPath, array_keys($this->routes)))
        {
          return;
        } else {
            $pathIndex = array_search($this->serverPath, array_keys($this->routes));
        }

        if($pathIndex === false) return;
        if($this->serverMethod !== $this->routes[$this->serverPath]['method']) return;

        //ToDO rework switch or place it in Requst class
        switch ($this->serverMethod)
        {
            case 'POST':
                $this->postData();
                break;
            case 'GET':
                $this->getData();
        }
    }

    public function postData(){
        call_user_func($this->routes[$this->serverPath]['function'], $this->request);
    }

    public function getData(){
        call_user_func($this->routes[$this->serverPath]['Closure']);
    }

    public function errorHandler(){
        return json_encode(['error' => "No such page or invalid method!"]);
    }
}
