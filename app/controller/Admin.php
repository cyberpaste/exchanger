<?php

namespace Controller;

use Model\Users as User;

class Admin extends \Core\Framework\Controller {

    public $userLogged;

    public function __construct() {
        parent::__construct();
        $user = new User;
        $this->userLogged = $user->logged();
        if ($this->userLogged) {
            if ($user->isAdmin($this->userLogged['id'])) {
                //continue
            } else {
                $this->redirectToMain();
            }
        } else {
            $this->redirectToMain();
        }
    }

    private function redirectToMain() {
        $this->responce->setHeader('301')->redirectTo('/');
    }

    public function index() {
        $templateFile = 'admin.html';
        $title = 'Админ панель';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function call($method = null) {
        if (method_exists($this, $method) && !in_array($method, [__FUNCTION__, 'call', 'index'])) {
            call_user_func(array($this, $method), $method);
            return false;
        }
    }

    public function ajax() {
        $get = $this->request->getQuery();
        $method = $get['method'];
        $this->call($method);
    }

    public function users() {
        $get = $this->request->getQuery();
        $limit = isset($get['limit']) ? (int) $get['limit'] : 10;
        $page = isset($get['page']) ? (int) $get['page'] : 1;
        $user = new User;

        $data['users'] = $user->getAllUsers(($page - 1) * $limit, $limit);
        $data['total'] = $user->count();

        $templateFile = 'admin-users.html';
        $title = 'Все пользователи';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title,
            'description' => $description,
            'domain' => $domain,
            'email' => $email,
            'currentUrl' => $currentUrl,
            'user' => $this->userLogged,
            'data' => $data,
            'page' => $page,
        ];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function GetAllUsers() {
        /* $user = new User;
          $get = $this->request->getQuery();
          $limit = isset($get['limit']) ? (int) $get['limit'] : 10;
          $offset = isset($get['offset']) ? (int) $get['offset'] : 0;
          $data['users'] = $user->getAllUsers($offset, $limit);
          $data['total'] = $user->count();
          $this->responce->setHeader('json')->withJson($data); */
    }

}
