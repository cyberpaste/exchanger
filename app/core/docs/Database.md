<?php

namespace Core\Framework;

use Core\Framework\Error as Error;

final class Database {

    public $pdo;
    private $error;
    private $dsn;
    private $options;
    private $databaseName;
    private $databaseUser;
    private $databasePassword;
    private $databaseHost = "localhost";
    private $databaseCharset = "utf8";

    function __construct($engine, $databaseName, $databaseUser, $databasePassword) {
        if (method_exists($this, $engine)) {
            $this->$engine($databaseName, $databaseUser, $databasePassword);
        } else {
            Error::UnsupportedType('db driver');
        }
        $this->connect($this->dsn, $this->databaseUser, $this->databasePassword, $this->options);
    }

    function prep_query($query) {
        return $this->pdo->prepare($query);
    }

    private function mysql($databaseName, $databaseUser, $databasePassword) {
        $this->databaseUser = $databaseUser;
        $this->databasePassword = $databasePassword;
        $this->databaseName = $databaseName;
        $this->dsn = 'mysql:dbname=' . $this->databaseName . ';host=' . $this->databaseHost . ';charset=' . $this->databaseCharset;
        $this->options = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        );
    }

    private function connect($dsn, $user, $password, $options) {
        if (!$this->pdo) {
            try {
                $this->pdo = new \PDO($dsn, $user, $password, $options);
                return true;
            } catch (\PDOException $e) {
                $this->error = $e->getMessage();
                die($this->error);
                return false;
            }
        } else {
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            return true;
        }
    }

    function table_exists($table_name) {
        $stmt = $this->prep_query('SHOW TABLES LIKE ?');
        $stmt->execute(array($table_name));
        return $stmt->rowCount() > 0;
    }

    function execute($query, $values = null) {
        if ($values == null) {
            $values = array();
        } else if (!is_array($values)) {
            $values = array($values);
        }
        $stmt = $this->prep_query($query);
        $stmt->execute($values);
        return $stmt;
    }

    function fetch($query, $values = null) {
        if ($values == null) {
            $values = array();
        } else if (!is_array($values)) {
            $values = array($values);
        }
        $stmt = $this->execute($query, $values);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    function fetchAll($query, $values = null, $key = null) {
        if ($values == null) {
            $values = array();
        } else if (!is_array($values)) {
            $values = array($values);
        }
        $stmt = $this->execute($query, $values);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($key != null && $results[0][$key]) {
            $keyed_results = array();
            foreach ($results as $result) {
                $keyed_results[$result[$key]] = $result;
            }
            $results = $keyed_results;
        }
        return $results;
    }

    function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function __destruct() {
        $this->pdo = null;
    }

}
