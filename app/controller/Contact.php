<?php

namespace Controller;
use Model\Messages as Message;
use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Contact extends \Core\Framework\Controller {

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
        $this->templateFile = 'contact.html';
        $this->templateVariables['title'] = 'Контакты';
        $this->renderHtmlPage();
    }

    public function IndexPost() {
        $this->validator->length($this->post['name'], 4, 100, 'Неправильное имя', '#name');
        $this->validator->length($this->post['message'], 50, 2500, 'Сообщение должно быть в пределах 50-2500 символов', '#message');
        $this->validator->equal($this->post['captcha'], $this->session->get('captcha'), 'Пример решен неверно', '#captcha');
        if (!count($this->validator->getError())) {
            $message = new Message;
            $message->createNewMessage($this->post['name'], $this->post['message'], $type = 'Сообщение с контактной формы');
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

}
