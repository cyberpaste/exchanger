<?php

namespace Controller;

use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Partners extends \Core\Framework\Controller {

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
        $this->templateFile = 'partners.html';
        $this->templateVariables['title'] = 'Партнеры';
        $this->renderHtmlPage();
    }

    public function IndexPost() {
        
    }

}

