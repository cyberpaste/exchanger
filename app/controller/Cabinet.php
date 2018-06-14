<?php

namespace Controller;

use Model\Users as User;

class Cabinet extends \Core\Framework\Controller {

    public $userLogged;

    public function __construct() {
        parent::__construct();
        $user = new User;
        $this->userLogged = $user->logged();
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
            $subject = 'Пароль восстановлен';
            $message = "<p>Ваш новый пароль для входа в личный кабинет: <b>" . $password . "</b></p>";
            $templateVariables = ['message' => $message, 'subject' => $subject, 'domain' => $this->request->getDomainName()];
            $templateFile = 'email.html';
            $htmlMessage = $this->template->render($templateFile, $templateVariables);
            $this->mail->notify($this->site['email'], $this->site['name'], $member['email'], $member['name'], $subject, $htmlMessage);
            $this->responce->setHeader('301')->redirectTo('/');
        } else {
            $this->responce->setHeader('404')->withData('Broken link');
        }
    }

    public function restoreGet() {
        $templateFile = 'restore.html';
        $title = 'Восстановление пароля';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function restorePost() {
        $post = $this->request->getBody();
        $this->validator->email($post['email'], 'Неправильный email', '#email');
        $user = new User;
        $member = $user->getByEmail($post['email']);
        if ($post['email'] && $member) {
            $password = $this->helper->getRandomString(10);
            $salt = $this->helper->getRandomString(10);
            $hash = $this->helper->getHash($password, $salt);
            $user->update(['restore_salt' => $hash, 'restore_time' => $this->helper->getCurrentTimestamp()], ['id' => $member['id']]);
            $restoreLink = $this->request->getDomainProtocol() . $this->request->getDomainName() . '/restore/' . $hash;
            $subject = 'Ссылка на восстановление пароля';
            $message = "<p>Для восстановления пароля перейдите по ссылке: <a href='" . $restoreLink . "'>" . $restoreLink . "</a>";
            $templateVariables = ['message' => $message, 'subject' => $subject, 'domain' => $this->request->getDomainName()];
            $templateFile = 'email.html';
            $htmlMessage = $this->template->render($templateFile, $templateVariables);
            $this->mail->notify($this->site['email'], $this->site['name'], $member['email'], $member['name'], $subject, $htmlMessage);
        } else {
            $this->validator->customError('Email не найден', '#email');
        }
        $this->responce->setHeader('json')->withJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function registerGet() {
        $templateFile = 'register.html';
        $title = 'Регистрация';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function registerPost() {
        $post = $this->request->getBody();
        $this->validator->email($post['email'], 'Неправильный email', '#email');
        $user = new User;
        if ($post['email'] && $user->getByEmail($post['email'])) {
            $this->validator->customError('Email уже занят', '#email');
        }
        $this->validator->length($post['name'], 4, 100, 'Неправильное имя', '#name');
        $this->validator->equal($post['captcha'], $this->session->get('captcha'), 'Пример решен неверно', '#captcha');
        $this->validator->notBlank($post['rules'], 'Нужно согласиться с правилами', '#rules');
        if (!count($this->validator->getError())) {
            $password = $this->helper->getRandomString(10);
            $salt = $this->helper->getRandomString(10);
            $hash = $this->helper->getHash($password, $salt);
            $user->create(['email' => $post['email'], 'name' => $post['name'], 'password' => $hash, 'salt' => $salt]);
            $subject = 'Успешная регистрация';
            $message = "<p>Ваш пароль для входа в личный кабинет: <b>" . $password . "</b></p>";
            $templateVariables = ['message' => $message, 'subject' => $subject, 'domain' => $this->request->getDomainName()];
            $templateFile = 'email.html';
            $htmlMessage = $this->template->render($templateFile, $templateVariables);
            $this->mail->notify($this->site['email'], $this->site['name'], $post['email'], $post['name'], $subject, $htmlMessage);
        }
        $this->responce->setHeader('json')->withJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

    public function loginGet() {
        $templateFile = 'login.html';
        $title = 'Вход';
        $description = '';
        $domain = $this->request->getDomainName();
        $currentUrl = $this->request->getRequestUrl();
        $email = $this->site['email'];
        $templateVariables = ['title' => $title, 'description' => $description, 'domain' => $domain, 'email' => $email, 'currentUrl' => $currentUrl, 'user' => $this->userLogged];
        $this->responce->setHeader('html')->withData($this->template->render($templateFile, $templateVariables));
    }

    public function loginPost() {
        $post = $this->request->getBody();
        $this->validator->email($post['email'], 'Неправильный email', '#email');
        $this->validator->notBlank($post['password'], 'Пароль пуст', '#password');
        $user = new User;
        if ($post['email'] && !$member = $user->getByEmail($post['email'])) {
            $this->validator->customError('Email не существует', '#email');
        } else {
            if ($this->helper->getHash($post['password'], $member['salt']) == $member['password']) {
                $user->update(['lastlogin' => $this->helper->getCurrentTimestamp()], ['id' => $member['id']]);
                $this->session->set('user', $member['id']);
            } else {
                $this->validator->customError('Пароль неверный', '#password');
            }
        }
        $this->responce->setHeader('json')->withJson(['success' => $this->validator->getSuccess(), 'error' => $this->validator->getError()]);
    }

}
