<?php

namespace Core\Framework;

use Core\Framework\Validator as Validator;
use Core\Framework\Request as Request;
use Core\Framework\Responce as Responce;

abstract class Controller {

    protected $validator;
    protected $request;
    protected $template;
    protected $responce;

    public function __construct() {
        $this->template = $GLOBALS['app']->template;
        $this->request = new Request;
        $this->validator = new Validator;
        $this->responce = new Responce;
    }

}
