<?php

namespace Controller;

use Core\Framework\Image as Image;

class QrCode extends \Core\Framework\Controller {

    public function Index() {
        $this->responce->setHeader('png');
        Image::getQrCode('test');
    }

}
