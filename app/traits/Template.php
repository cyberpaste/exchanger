<?php

namespace Traits;

trait Template {

    public function renderHtmlPage() {
        $this->responce->setHeader('html')->withData($this->template->render($this->templateFile, $this->templateVariables));
    }
    
    public function renderJson($data){
        $this->responce->setHeader('json')->withJson($data);
    }

    public function renderEmail(){
        return $this->template->render($this->templateFile, $this->templateVariables);
    }
}
