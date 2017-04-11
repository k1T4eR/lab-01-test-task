<?php

namespace Application\Routing;

class Route {

    protected $_name;
    protected $_pattern;
    protected $_method;
    protected $_controller;
    protected $_action;

    public function __construct($name, $pattern, $method, $controller, $action) {
        $this->_controller = "Application\\Controllers\\$controller";
        $this->_action = $action;
        $this->_pattern = $pattern;
        $this->_method = strtoupper($method);
    }

    public function match($path) {
        $matches = [];
        $result  = preg_match($this->_pattern, $path, $matches);
        return $result ? $matches : false;
    }

    public function getControllerClassName() {
        return $this->_controller;
    }

    public function getControllerActionName() {
        return $this->_action;
    }

    public function getMethod() {
        return $this->_method;
    }
}