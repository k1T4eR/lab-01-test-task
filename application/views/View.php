<?php

namespace Application\Views;

class View {

    protected $_name;
    protected $_params;

    public function __construct($name, $params = array()) {
        $this->_name   = $name;
        $this->_params = $params;
    }

    public function __get($key) {
        return isset($this->_params[$key]) ? $this->_params[$key] : null;
    }

    public function render() {
        ob_start();
        include __DIR__.'/'.$this->_name.'.phtml';
        return ob_get_clean();
    }
}