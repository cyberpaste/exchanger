<?php

namespace Core\Framework;

use Core\Framework\Error as Error;

class Responce {

    private $headers = [
        'png' => 'Content-type: image/png',
        'json' => 'Content-type: application/json',
        'html' => 'Content-Type: text/html',
        '404' => 'HTTP/1.0 404 Not Found',
        '301' => 'HTTP/1.1 301 Moved Permanently',
    ];
    protected $header;

    public function setHeader($extension) {
        if (array_key_exists($extension, $this->headers)) {
            header($this->headers[$extension]);
        } else {
            Error::UnsupportedType($extension);
        }
        return $this;
    }

    public function withData($data) {
        echo $data;
        return true;
    }

    public function withJson($data) {
        echo json_encode($data);
        return true;
    }

    public function redirectTo($location) {
        header("Location: " . $location);
    }

}
