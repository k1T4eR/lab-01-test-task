<?php

class Application {
    private function __construct() {

    }

    public function setRoutes(array $routes) {

    }

    public function getRoutes() {

    }

    public function getRequest() {

    }

    public function setRequest($request) {

    }

    public function getResponse() {

    }

    public function setResponse($response) {

    }

    private static $instance;

    public static function get() {
        return self::$instance ? self::$instance : self::$instance = new self();
    }
}
