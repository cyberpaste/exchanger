<?php

namespace Model;

use Core\Framework\Session as Session;

class Users extends \Core\Framework\Model {

    protected $table = 'users';

    public function logged() {
        $session = new Session;
        $userId = $session->get('user');
        if ($userId) {
            return $this->getById($userId);
        }
        return false;
    }

    public function isAdmin($value) {
        $queryResult = $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE id = ? ', $value);
        if ($queryResult) {
            if ($queryResult['role'] == 'admin') {
                return true;
            }
        }
        return false;
    }

    public function getById($value) {
        $queryResult = $this->db->fetch('SELECT * FROM ' . $this->table . ' WHERE id = ? ', $value);
        return $queryResult;
    }

    public function getByEmail($value) {
        return $this->findBy(['email' => $value]);
    }

    public function getByRestoreHash($value) {
        return $this->findBy(['restore_salt' => $value]);
    }

    public function getAllUsers($offset = 0, $limit = 10) {
        if ($offset < 0) {
            $offset = 0;
        }
        $queryResult = $this->db->fetchAll('SELECT * FROM ' . $this->table . '  LIMIT ? OFFSET ? ', [$limit, $offset]);
        return $queryResult;
    }

    public function count() {
        $queryResult = $this->db->fetch('SELECT COUNT(*) AS total FROM ' . $this->table, '');
        return $queryResult['total'];
    }

}
