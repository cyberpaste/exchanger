<?php

namespace Traits;

use Model\Users as User;

trait Login {

    public $userLogged;

    public function checkIfUserLogged() {
        $user = new User;
        $this->userLogged = $user->logged();
    }

    public function ifIsNotLoggedRedirectToLogin() {
        if ($this->userLogged) {
            //continue
        } else {
            $this->responce->setHeader('301')->redirectTo('/login');
        }
    }

}
