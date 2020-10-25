<?php

class Request implements IRequest{

    public function getBody()
    {
        print_r($_SERVER);
        // TODO: Implement getBody() method.
    }
}
