<?php

namespace Controller;

use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Notfound extends \Core\Framework\Controller {

    use LoginTrait;
    use CurrentPageTrait;
    use TemplateTrait;
    use ConstructTrait;

    public function __construct() {
        parent::__construct();
        $this->checkIfUserLogged();
        $this->init();
    }

    public function index() {
        $this->templateFile = '404.html';
        $this->templateVariables['title'] = '404 страница не найдена';
        $this->responce->setHeader('404');
        $this->renderHtmlPage();
    }

}
