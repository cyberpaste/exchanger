<?php

namespace Controller;

use Traits\Login as LoginTrait;
use Traits\CurrentPage as CurrentPageTrait;
use Traits\Template as TemplateTrait;
use Traits\Construct as ConstructTrait;

class Main extends \Core\Framework\Controller {

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
        $this->templateFile = 'main.html';
        $this->templateVariables['title'] = 'Быстрый обмен криптовалют';
        $this->templateVariables['description'] = 'Exchanger - быстрый обмен валют: USD, RUB, BTC, ETH, LTC, DASH .. Работаем с: 10.02.2017';
        $this->renderHtmlPage();
    }

    public function PairExists() {
        if (isset($this->request->post['give']) && isset($this->request->post['recieve'])) {
            /* Add pair check in database here */
            if (true) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function IndexPost() {
        if ($this->PairExists()) {
            print_r($this->post);
        } else {
            
        }
    }

}
