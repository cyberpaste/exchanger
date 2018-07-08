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
        if (method_exists($this, $method) && !in_array($method, [__FUNCTION__, 'call', 'index'])) {
            $this->call($method);
        }
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

    public function getReview() {
        $id = isset($this->get['id']) ? (int) $this->get['id'] : 0;
        $review = new Review;
        $item = $review->getById($id);
        $this->renderJson(['item' => $item]);
    }

    public function addReview() {
        $this->validator->length($this->post['name'], 4, 100, 'Неправильное имя', '#name');
        $this->validator->length($this->post['message'], 50, 2500, 'Отзыв должен быть в пределах 50-2500 символов', '#message');
        if (!count($this->validator->getError())) {
            $review = new Review;
            $review->createNewReview($this->post['name'], $this->post['message']);
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function deleteReview() {
        $id = isset($this->get['id']) ? (int) $this->get['id'] : 0;
        $review = new Review;
        if ($id && $review->getById($id)) {
            $review->deleteById($id);
        } else {
            $this->validator->customError('Отзыв не найден', '#null');
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function moderateReview() {
        $id = isset($this->get['id']) ? (int) $this->get['id'] : 0;
        $review = new Review;
        if ($id && $item = $review->getById($id)) {
            $moderation = '0';
            if ($item['moderation'] == '0') {
                $moderation = '1';
            }
            $review->moderateById($id, $moderation);
        } else {
            $this->validator->customError('Отзыв не найден', '#null');
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function editReview() {
        $id = isset($this->post['id']) ? (int) $this->post['id'] : 0;
        $review = new Review;
        if ($id && $review->getById($id)) {
            $this->validator->length($this->post['name'], 4, 100, 'Неправильное имя', '#name');
            $this->validator->length($this->post['message'], 50, 2500, 'Отзыв должен быть в пределах 50-2500 символов', '#message');
            if (!count($this->validator->getError())) {
                $review->updateById($id, $this->post['name'], $this->post['message']);
            }
        } else {
            $this->validator->customError('Отзыв не найден', '#null');
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

}
