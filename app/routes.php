<?php

return [
    '/'       => 'Controller\Main@index',
    '/exchange/:any/:any'  => 'Controller\Exchange@index',
    '/bitcoin.png' => 'Controller\QrCode@index',
    '/login'  => 'Controller\Cabinet@login',
    '/register'  => 'Controller\Cabinet@register',
    '/rules'  => 'Controller\Rules@index',
    '/reviews'  => 'Controller\Reviews@index',    
    '/logout'  => 'Controller\Cabinet@logout',
    '/restore' => 'Controller\Cabinet@restore',
    '/restore/:any' => 'Controller\Cabinet@restoreHash',
    '/contact'  => 'Controller\Contact@index',
    '/captcha'  => 'Controller\Captcha@index',
    '/r/:num' => 'Controller\Referral@index',
    '/admin' => 'Controller\Admin@index',
    '/admin/:any' => 'Controller\Admin@call',
    ':any' => 'Controller\Notfound@index',
];