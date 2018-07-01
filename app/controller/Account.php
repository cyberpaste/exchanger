<?php

namespace Controller;

use Model\Users as User;
use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Account extends \Core\Framework\Controller {

    use LoginTrait;
    use CurrentPageTrait;
    use TemplateTrait;
    use ConstructTrait;

    public function __construct() {
        parent::__construct();
        $this->checkIfUserLogged();
        $this->ifIsNotLoggedRedirectToLogin();
        $this->init();
    }

    public function index() {
        $this->templateFile = 'account.html';
        $this->templateVariables['title'] = 'Аккаунт';
        $this->renderHtmlPage();
    }

    public function edit() {
        if ($this->request->isGet()) {
            $this->templateFile = 'account-edit.html';
            $this->templateVariables['title'] = 'Редактировать аккаунт';
            $this->renderHtmlPage();
        }
        if ($this->request->isPost()) {
            $this->validator->length($this->post['name'], 4, 100, 'Неправильное имя', '#name');
            $this->validator->equal($this->post['captcha'], $this->session->get('captcha'), 'Пример решен неверно', '#captcha');
            if (!count($this->validator->getError())) {
                $user = new User;
                $user->update(['name' => $this->post['name']], ['id' => $this->userLogged['id']]);
            }
            $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
        }
    }

    public function call($method = null) {
        if (method_exists($this, $method) && !in_array($method, [__FUNCTION__, 'call', 'index'])) {
            call_user_func(array($this, $method), $method);
            return false;
        }
    }

}
