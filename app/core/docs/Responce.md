<?php

namespace Core\Framework;

use Core\Framework\Error as Error;

class Responce {

    private $headers = [
        'png' => 'Content-type: image/png',
        'json' => 'Content-type: application/json',
        'html' => 'Content-Type: text/html',
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

}
