<?php

namespace Controller;

use Model\Users as User;
use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Cabinet extends \Core\Framework\Controller {

    use LoginTrait;
    use CurrentPageTrait;
    use TemplateTrait;
    use ConstructTrait;

    public function __construct() {
        parent::__construct();
        $this->checkIfUserLogged();
        $this->init();
    }

    public function logout() {
        $this->session->destroy();
        $this->responce->setHeader('301')->redirectTo('/');
    }

    public function register() {
        if ($this->request->isGet()) {
            $this->registerGet();
        }
        if ($this->request->isPost()) {
            $this->registerPost();
        }
    }

    public function login() {
        if ($this->request->isGet()) {
            $this->loginGet();
        }
        if ($this->request->isPost()) {
            $this->loginPost();
        }
    }

    public function restore() {
        if ($this->request->isGet()) {
            $this->restoreGet();
        }
        if ($this->request->isPost()) {
            $this->restorePost();
        }
    }

    public function restoreHash($hash) {
        $user = new User;
        $member = $user->getByRestoreHash($hash);
        if ($member) {
            $password = $this->helper->getRandomString(10);
            $salt = $this->helper->getRandomString(10);
            $hash = $this->helper->getHash($password, $salt);
            $user->update(['password' => $hash, 'salt' => $salt, 'restore_salt' => null], ['id' => $member['id']]);
            $this->templateVariables['subject'] = 'Пароль восстановлен';
            $this->templateVariables['message'] = "<p>Ваш новый пароль для входа в личный кабинет: <b>" . $password . "</b></p>";
            $this->templateFile = 'email.html';
            $htmlMessage = $this->renderEmail();
            $this->mail->notify($this->site['email'], $this->site['name'], $member['email'], $member['name'], $this->templateVariables['subject'], $htmlMessage);
            $this->responce->setHeader('301')->redirectTo('/');
        } else {
            $this->responce->setHeader('404')->withData('Broken link');
        }
    }

    public function restoreGet() {
        $this->templateFile = 'restore.html';
        $this->templateVariables['title'] = 'Восстановление пароля';
        $this->renderHtmlPage();
    }

    public function restorePost() {
        $this->validator->email($this->post['email'], 'Неправильный email', '#email');
        $user = new User;
        $member = $user->getByEmail($this->post['email']);
        if ($this->post['email'] && $member) {
            $password = $this->helper->getRandomString(10);
            $salt = $this->helper->getRandomString(10);
            $hash = $this->helper->getHash($password, $salt);
            $user->update(['restore_salt' => $hash, 'restore_time' => $this->helper->getCurrentTimestamp()], ['id' => $member['id']]);
            $restoreLink = $this->request->getDomainProtocol() . $this->request->getDomainName() . '/restore/' . $hash;
            $this->templateVariables['subject'] = 'Ссылка на восстановление пароля';
            $this->templateVariables['message'] = "<p>Для восстановления пароля перейдите по ссылке: <a href='" . $restoreLink . "'>" . $restoreLink . "</a>";
            $this->templateFile = 'email.html';
            $htmlMessage = $this->renderEmail();
            $this->mail->notify($this->site['email'], $this->site['name'], $member['email'], $member['name'], $this->templateVariables['subject'], $htmlMessage);
        } else {
            $this->validator->customError('Email не найден', '#email');
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function registerGet() {
        $this->templateFile = 'register.html';
        $this->templateVariables['title'] = 'Регистрация';
        $this->renderHtmlPage();
    }

    public function registerPost() {
        $this->validator->email($this->post['email'], 'Неправильный email', '#email');
        $user = new User;
        if ($this->post['email'] && $user->getByEmail($this->post['email'])) {
            $this->validator->customError('Email уже занят', '#email');
        }
        $this->validator->length($this->post['name'], 4, 100, 'Неправильное имя', '#name');
        $this->validator->equal($this->post['captcha'], $this->session->get('captcha'), 'Пример решен неверно', '#captcha');
        $this->validator->notBlank($this->post['rules'], 'Нужно согласиться с правилами', '#rules');
        if (!count($this->validator->getError())) {
            $password = $this->helper->getRandomString(10);
            $salt = $this->helper->getRandomString(10);
            $hash = $this->helper->getHash($password, $salt);
            $user->create(['email' => $this->post['email'], 'name' => $this->post['name'], 'password' => $hash, 'salt' => $salt]);
            $this->templateVariables['subject'] = 'Успешная регистрация';
            $this->templateVariables['message'] = "<p>Ваш пароль для входа в личный кабинет: <b>" . $password . "</b></p>";
            $this->templateFile = 'email.html';
            $htmlMessage = $this->renderEmail();
            $this->mail->notify($this->site['email'], $this->site['name'], $this->post['email'], $this->post['name'], $this->templateVariables['subject'], $htmlMessage);
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function loginGet() {
        $this->templateFile = 'login.html';
        $this->templateVariables['title'] = 'Вход';
        $this->renderHtmlPage();
    }

    public function loginPost() {
        $this->validator->email($this->post['email'], 'Неправильный email', '#email');
        $this->validator->notBlank($this->post['password'], 'Пароль пуст', '#password');
        $user = new User;
        if ($this->post['email'] && !$member = $user->getByEmail($this->post['email'])) {
            $this->validator->customError('Email не существует', '#email');
        } else {
            if ($this->helper->getHash($this->post['password'], $member['salt']) == $member['password']) {
                $user->update(['lastlogin' => $this->helper->getCurrentTimestamp()], ['id' => $member['id']]);
                $this->session->set('user', $member['id']);
            } else {
                $this->validator->customError('Пароль неверный', '#password');
            }
        }
        $this->renderJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

}
