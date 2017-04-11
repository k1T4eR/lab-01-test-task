<?php

namespace Application\Routing;

class Route {

    protected $_name;
    protected $_pattern;
    protected $_method;
    protected $_controllerClassName;
    protected $_controllerActionName;

    public function __construct($name, $pattern, $method, $controllerClassName, $controllerActionName) {
        $this->_controllerClassName  = "Application\\Controllers\\$controllerClassName";
        $this->_controllerActionName = $controllerActionName;
        $this->_pattern              = $pattern;
        $this->_method               = strtoupper($method);
    }

    public function match($path) {
        $matches = [];
        $result  = preg_match($this->_pattern, $path, $matches);
        return $result ? $matches : false;
    }

    public function getControllerClassName() {
        return $this->_controllerClassName;
    }

    public function getControllerActionName() {
        return $this->_controllerActionName;
    }

    public function getMethod() {
        return $this->_method;
    }
}