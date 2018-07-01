<?php

namespace Core\Framework;

use Core\Framework\Interfaces\Migration as MigrationIterface;

class Migration {

    protected $db;

    public function __construct() {
        $this->db = $GLOBALS['app']->databaseConnection;
    }

    protected function runQuery($query) {
        $queryResult = $this->db->fetch($query, "");
        return $queryResult;
    }

    protected function dropTable($table) {
        $query = " DROP TABLE IF EXISTS ? ; ";
        $queryResult = $this->db->fetch($query, $table);
        return $queryResult;
    }

}
