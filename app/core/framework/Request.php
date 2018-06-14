<?php

namespace Core\Framework;

class Request {

    protected $requestUrl;
    protected $requestMethod;
    protected $get;
    protected $post;

    public function __construct() {
        $this->requestMethod = $this->getRequestMethod();
        $this->requestUrl = $this->getRequestUrl();
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function getBody() {
        return $this->post;
    }

    public function getQuery() {
        return $this->get;
    }

    public function isGet() {
        if ($this->requestMethod === 'GET') {
            return true;
        }
        return false;
    }

    public function isPost() {
        if ($this->requestMethod === 'POST') {
            return true;
        }
        return false;
    }

    public function dump() {
        return ['requestUrl' => $this->requestUrl, 'requestMethod' => $this->requestMethod, 'get' => $this->get, 'post' => $this->post];
    }

    protected function getRequestMethod() {
        if (isset($this->requestMethod)) {
            return $this->requestMethod;
        }
        return filter_var(getenv('REQUEST_METHOD'));
    }

    public function getRequestUrl() {
        if (isset($this->requestUrl)) {
            return $this->requestUrl;
        }
        $requestUrl = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        if (strpos($requestUrl, '?')) {
            $requestUrl = substr($requestUrl, 0, strpos($requestUrl, '?'));
        }
        return $requestUrl;
    }

    public function getDomainName() {
        return $_SERVER['HTTP_HOST'];
    }

    public function getDomainProtocol() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol;
    }

}
