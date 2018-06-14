<?php

namespace Core\Framework;

class Model {

    protected $db;

    public function __construct() {
        $this->db = $GLOBALS['app']->databaseConnection;
    }

    protected function ClassName(string $tableName): string {
        return ucfirst(strtolower($tableName));
    }

    protected function VariableName(string $variable): string {
        return strtolower($variable);
    }

    protected function MethodName(string $variable): string {
        return ucfirst(strtolower($variable));
    }

    protected function findBy(array $parameters) {
        if ($this->object) {
            $query = "SELECT * FROM " . $this->getClassName($this->object);
            $whereParameters = [];
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
            $objects = [];
            foreach ($this->db->fetchAll($query, $whereBind) as $item) {
                $objectName = get_class($this->object);
                $object = new $objectName;
                foreach ($item as $num => $value) {
                    $object = call_user_func(array($object, 'set' . $this->MethodName($num)), $value);
                }
                $objects[] = $object;
            }
            return $objects;
        }
    }

}
