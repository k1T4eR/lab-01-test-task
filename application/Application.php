<?php

class Application {
    private $_routes;
    private $_request;

    public function getRequest() {
        return $this->_request;
    }

    public function setRequest(\Application\Routing\Request $request) {
        $this->_request = $request;
    }

    public function getRoutes() {
        return $this->_routes;
    }

    public function setRoutes(array $routes) {
        $this->_routes = $routes;
    }

    private static $instance;

    public static function get() {
        return self::$instance ? self::$instance : self::$instance = new self();
    }
}
