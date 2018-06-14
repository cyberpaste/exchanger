<?php

namespace Controller;

use Model\Users as User;

class Notfound extends \Core\Framework\Controller {

    public $userLogged;

    public function __construct() {
        parent::__construct();
        $user = new User;
        $this->userLogged = $user->logged();
    }

    public function index() {
        $templateFile = '404.html';
        $title = '404 страница не найдена';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->setHeader('404')->withData($this->template->render($templateFile, $templateVariables));
    }

}
