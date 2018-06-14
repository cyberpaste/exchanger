<?php

namespace Controller;

use Model\Users as User;

class Main extends \Core\Framework\Controller {

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
        $templateFile = 'main.html';
        $title = 'Быстрый обмен криптовалют';
        $description = 'Exchanger - быстрый обмен валют: USD, RUB, BTC, ETH, LTC, DASH .. Работаем с: 10.02.2017';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function PairExists() {
        if (isset($this->request->post['give']) && isset($this->request->post['recieve'])) {
            /* Add pair check in database here */
            if (true) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function IndexPost() {
        if ($this->PairExists()) {
            print_r($this->post);
        } else {
            
        }
    }

}
