<?php

namespace Controller;

use Model\Users as User;
use Model\Reviews as Review;
use Traits\Admin as AdminTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Admin extends \Core\Framework\Controller {

    use AdminTrait;
    use CurrentPageTrait;
    use TemplateTrait;
    use ConstructTrait;

    public function __construct() {
        parent::__construct();
        $this->checkIfAdminIsLogged();
        $this->init();
    }

    public function index() {
        $this->templateFile = 'admin.html';
        $this->templateVariables['title'] = 'Админ панель';
        $this->renderHtmlPage();
    }

    public function call($method = null) {
        if (method_exists($this, $method) && !in_array($method, [__FUNCTION__, 'call', 'index'])) {
            call_user_func(array($this, $method), $method);
            return false;
        }
    }

    public function ajax() {
        $method = $this->get['method'];
        $this->call($method);
    }

    public function users() {
        $limit = isset($this->get['limit']) ? (int) $this->get['limit'] : 10;
        $page = isset($this->get['page']) ? (int) $this->get['page'] : 1;
        $user = new User;
        $data['users'] = $user->getAllUsers(($page - 1) * $limit, $limit);
        $data['total'] = $user->count();
        $this->templateFile = 'admin-users.html';
        $this->templateVariables['title'] = 'Все пользователи';
        $this->templateVariables['data'] = $data;
        $this->templateVariables['page'] = $page;
        $this->renderHtmlPage();
    }

    public function reviews() {
        $limit = isset($this->get['limit']) ? (int) $this->get['limit'] : 10;
        $page = isset($this->get['page']) ? (int) $this->get['page'] : 1;
        $review = new Review;
        $data['reviews'] = $review->getAllReviews(($page - 1) * $limit, $limit);
        $data['total'] = $review->count();
        $this->templateFile = 'admin-reviews.html';
        $this->templateVariables['title'] = 'Все отзывы';
        $this->templateVariables['data'] = $data;
        $this->templateVariables['page'] = $page;
        $this->renderHtmlPage();
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
