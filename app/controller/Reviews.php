<?php

namespace Controller;

use Model\Users as User;

class Reviews extends \Core\Framework\Controller {

    public $userLogged;

    public function __construct() {
        parent::__construct();
        $user = new User;
        $this->userLogged = $user->logged();
    }

    public function Index() {
        if ($this->request->isGet()) {
            $this->IndexGet();
        }
        if ($this->request->isPost()) {
            $this->IndexPost();
        }
    }

    public function IndexGet() {
        $templateFile = 'reviews.html';
        $title = 'Отзывы';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function IndexPost() {
        
    }

}
