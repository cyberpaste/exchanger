<?php

namespace Controller;

class Referral extends \Core\Framework\Controller {

    public function index($refId) {
        $this->cookie->set('ref', $refId, 60);
        $this->responce->setHeader('301')->redirectTo('/');
    }

}
