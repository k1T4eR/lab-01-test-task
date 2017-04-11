<?php

namespace Application\Controllers;

use Application\Routing\Request;
use Application\Routing\Response;
use Application\Views\View;

class BaseController {
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response) {
        $this->request  = $request;
        $this->response = $response;
    }

    protected function render($name, $params = [], $type = 'text/html; charset=UTF-8') {
        $this->response->setBody( (new View($name, $params))->render() );
        $this->response->setContentType($type);
    }
}