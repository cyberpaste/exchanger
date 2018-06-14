<?php

namespace Core\Framework;

use Core\Framework\Database as Database;
use Core\Framework\Template as Template;
use Core\Framework\Cache as Cache;

final class App {

    protected static $config;
    protected static $databaseConnection;
    protected static $template;
    protected static $cache;
    protected static $site;

    public function __construct($config) {
        session_start();
        $this->config = $config;
        $this->getDatabaseConnection($this->config['database']);
        $this->initTemplate();
        $this->cache = new Cache($config['cache']['path'], 60, '.cache');
        $this->site = $this->site = $config['site'];   
    }

    public function initTemplate() {
        $config = $this->config['template'];
        $this->template = new Template($config['directory']);
    }

    public function getDatabaseConnection() {
        if (isset($this->databaseConnection)) {
            return $this->databaseConnection;
        }
        $config = $this->config;
        $this->databaseConnection = new Database($config['database']['engine'], $config['database']['databaseName'], $config['database']['databaseUser'], $config['database']['databasePassword']);
    }

    public function __set($name, $value) {
        $this->$name = $value;
        return true;
    }

    public function __get($name) {
        return $this->$name;
    }

}
