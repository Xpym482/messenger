<?php

class Request implements IRequest{

    private array $request = array();

    public function __construct(){
        foreach ($_SERVER as $key => $item) {
            $this->request[$key] = $item;
        }
    }

    public function getBody()
    {
        $test = file_get_contents("php://input");
        return json_decode($test);
    }
}
