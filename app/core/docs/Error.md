<?php

namespace Core\Framework;

class Error {

    public function NotFound() {
        http_response_code(404);
        echo '404 Not found';
    }

    public function MethodNotAllowed() {
        http_response_code(405);
        echo '405 Not Allowed';
    }

    public function UnsupportedType($type = null) {
        throw new \Exception('Unsupported Type: ' . $type);
    }

    public function FatalError($error) {
        echo 'Fatal Error ' . $error->getMessage() . '! <br><br> Error file ' . $error->getFile() . ' line ' . $error->getLine() . '<br><br>';
    }

}
