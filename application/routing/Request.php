<?php

namespace Application\Routing;

class Request {
    private $_params;
    private $_path;
    private $_server;

    public function __construct(array $server, array $get, array $post) {
        $this->_params = [];
        $this->mergeParams($get);
        $this->mergeParams($post);

        // http://stackoverflow.com/questions/9597052/how-to-retrieve-request-payload
        // http://stackoverflow.com/questions/541430/how-do-i-read-any-request-header-in-php
        if (isset($server['HTTP_CONTENT_TYPE']) && $server['HTTP_CONTENT_TYPE'] === 'application/json') {
            $this->mergeParams((array)json_decode(file_get_contents('php://input')));
        }

        $this->_server = $server;

        $this->_path = explode('?', $server['REQUEST_URI'])[0];

        // Special case
        if ($this->_path !== '/') {
            $this->_path = rtrim($this->_path, '/');
        }
    }

    public function getParam($key) {
        return isset($this->_params[$key]) ? $this->_params[$key] : null;
    }

    public function getParams() {
        return $this->_params;
    }

    public function mergeParams($params) {
        $this->_params = array_merge($this->_params, $params);
    }

    /**
     * Returns only path, not URL!
     * @return string
     */
    public function getPath() {
        return $this->_path;
    }

    public function getMethod() {
        return strtoupper($this->_server['REQUEST_METHOD']);
    }
}