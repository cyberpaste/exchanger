<?php

namespace Controller;

use Model\Reviews as Review;
use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Reviews extends \Core\Framework\Controller {

    use LoginTrait;
    use CurrentPageTrait;
    use TemplateTrait;
    use ConstructTrait;

    public function __construct() {
        parent::__construct();
        $this->checkIfUserLogged();
        $this->init();
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
        $limit = isset($this->get['limit']) ? (int) $this->get['limit'] : 10;
        $page = isset($this->get['page']) ? (int) $this->get['page'] : 1;
        $review = new Review;
        $data['reviews'] = $review->getModeratedReviews(($page - 1) * $limit, $limit);
        $data['total'] = $review->count();
        $this->templateFile = 'reviews.html';
        $this->templateVariables['title'] = 'Отзывы';
        $this->templateVariables['data'] = $data;
        $this->templateVariables['page'] = $page;
        $this->renderHtmlPage();
    }

    public function IndexPost() {
        $this->validator->length($this->post['name'], 4, 100, 'Неправильное имя', '#name');
        $this->validator->length($this->post['message'], 50, 1000, 'Отзыв должен быть в пределах 50-1000 символов', '#message');
        $this->validator->equal($this->post['captcha'], $this->session->get('captcha'), 'Пример решен неверно', '#captcha');
        if (!count($this->validator->getError())) {
            $review = new Review;
            $review->createNewReview($this->post['name'], $this->post['message']);
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

}
