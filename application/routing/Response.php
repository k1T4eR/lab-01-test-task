<?php

namespace Application\Routing;

class Response {
    protected $_body;

    public function __construct() {

    }

    public function setHeader($string, $replaceExisting = true, $statusCode = null) {
        header($string, $replaceExisting, $statusCode);
    }

    public function setContentType($contentType) {
        $this->setHeader("Content-Type: $contentType");
    }

    public function setStatus($statusWithCodeAndName) {
        $this->setHeader("HTTP/1.1 $statusWithCodeAndName");
    }

    public function getBody() {
        return $this->_body;
    }

    public function setBody($body) {
        $this->_body = $body;
    }

}