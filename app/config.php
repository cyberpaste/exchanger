<?php

return [
    'error' => 'E_ALL',
    'site' => [
        'email' => 'info@exhanger.loc',
        'name' => 'Обменник криптовалют',
    ],
    'database' => [
        'engine' => 'mysql',
        'databaseName' => 'exc',
        'databaseUser' => 'root',
        'databasePassword' => '',
    ],
    'cache' => [
        'path' => str_replace('\\', '/', dirname(__FILE__)) . '/cache/', 
    ],
    'template' => [
        'directory' => str_replace('\\', '/', dirname(__FILE__)) . '/view/',
    ]
];
