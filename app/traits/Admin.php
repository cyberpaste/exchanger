<?php

namespace Traits;

use Model\Users as User;

trait Admin {

    public $userLogged;

    public function checkIfAdminIsLogged() {
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

}
