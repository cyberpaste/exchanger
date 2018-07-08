<?php

namespace Core\Framework;

class Model {

    protected $db;
    protected $table;

    public function __construct() {
        $this->db = $GLOBALS['app']->databaseConnection;
    }

    public function findBy($parameters) {
        $query = "SELECT * FROM " . $this->table;
        $whereBind = [];
        $first = true;
        foreach ($parameters as $num => $item) {
            if ($first) {
                $query .= ' WHERE  ' . $num . ' = ? ';
                $first = false;
            } else {
                $query .= ' AND  ' . $num . ' = ? ';
            }
            $whereBind[] = $item;
        }
        $queryResult = $this->db->fetch($query, $whereBind);
        return $queryResult;
    }

    public function create($parameters) {
        $query = "INSERT " . $this->table;
        $rowNames = [];
        $rowValues = [];
        $bindValues = [];
        foreach ($parameters as $row => $value) {
            $rowNames[] = $row;
            $rowValues[] = $value;
            $bindValues[] = "?";
        }
        $query .= " (" . implode(',', $rowNames) . ") VALUES (" . implode(',', $bindValues) . ") ";
        $queryResult = $this->db->fetch($query, $rowValues);
        return $queryResult;
    }

    public function update($parameters, $where) {
        $query = "UPDATE " . $this->table;
        $rowNames = [];
        $bindVars = [];
        foreach ($parameters as $row => $value) {
            $rowNames[] = $row . ' = ? ';
            $bindVars[] = $value;
        }
        $rowWhere = [];
        foreach ($where as $row => $value) {
            $rowWhere[] = $row . ' = ? ';
            $bindVars[] = $value;
        }
        $query .= " SET " . implode(',', $rowNames) . " WHERE " . implode(',', $rowWhere) . " ";
        $queryResult = $this->db->execute($query, $bindVars);
        return $queryResult;
    }

    public function delete($where) {
        $query = "DELETE FROM " . $this->table;
        $rowWhere = [];
        $bindVars = [];
        foreach ($where as $row => $value) {
            $rowWhere[] = $row . ' = ? ';
            $bindVars[] = $value;
        }
        $query .= " WHERE " . implode(',', $rowWhere) . " ";
        $queryResult = $this->db->execute($query, $bindVars);
        return $queryResult;
    }

    public function count() {
        $queryResult = $this->db->fetch('SELECT COUNT(*) AS total FROM ' . $this->table, '');
        return $queryResult['total'];
    }

}
