<?php

namespace Core\Framework;

use Core\Framework\Validator as Validator;
use Core\Framework\Request as Request;
use Core\Framework\Responce as Responce;
use Core\Framework\Session as Session;
use Core\Framework\Mail as Mail;

abstract class Controller {

    protected $validator;
    protected $request;
    protected $template;
    protected $responce;
    protected $site;
    protected $session;
    protected $mail;
    protected $cache;
    protected $cookie;

    public function __construct() {
        $this->template = $GLOBALS['app']->template;
        $this->request = new Request;
        $this->validator = new Validator;
        $this->responce = new Responce;
        $this->session = new Session;
        $this->mail = new Mail;
        $this->cookie = new Cookie;
        $this->cache = $GLOBALS['app']->cache;
        $this->site = $GLOBALS['app']->site;     
    }

}
