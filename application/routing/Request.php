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