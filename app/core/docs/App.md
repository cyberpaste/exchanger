# App
...
Class app init, create template, db instance.
...
# Installation
...
create config.php
## Example of app/config.php
return [
    'error' => 'E_ALL',
    'database' => [
        'engine' => 'mysql',
        'databaseName' => 'database',
        'databaseUser' => 'root',
        'databasePassword' => '',
    ],
    'template' => [
        'directory' => str_replace('\\', '/', dirname(__FILE__)).'/view/',
    ]
];
...
## Example of index.php
...
define('AppDirectory', str_replace('\\', '/', __DIR__) . '/app');
require_once AppDirectory . '/autoload.php';
$config = require_once AppDirectory . '/config.php';
$app = new Core\Framework\App($config);
...

