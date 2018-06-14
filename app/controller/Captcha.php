<?php

namespace Controller;

use Core\Framework\Image as Image;

class Captcha extends \Core\Framework\Controller {

    public function Index() {
        $this->responce->setHeader('png');
        $captchaKey = Image::getCaptchaMath(rand(1,11),rand(1,11));
        $this->session->set('captcha', $captchaKey);
    }

}
