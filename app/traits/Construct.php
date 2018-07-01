<?php

namespace Traits;

trait Construct {
    
    public function init() {
        $this->title = '';
        $this->description = '';
        $this->templateFile = '';
        $this->domain = $this->request->getDomainName();
        $this->currentUrl = $this->request->getRequestUrl();
        $this->email = $this->site['email'];
        $this->get = $this->request->getQuery();
        $this->post = $this->request->getBody();
        $this->templateVariables = [
            'title' => $this->title,
            'description' => $this->description,
            'domain' => $this->domain,
            'email' => $this->email,
            'currentUrl' => $this->currentUrl,
            'user' => $this->userLogged
        ];
    }

}
