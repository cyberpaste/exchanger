<?php

namespace Model;

use Core\Framework\Session as Session;
use \Core\Framework\Helper as Helper;

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

    public function createNew($email, $name, $password, $salt) {
        return $this->create(['email' => $email, 'name' => Helper::Filter($name), 'password' => $password, 'salt' => $salt]);
    }

    public function updateName($name, $id) {
        return $this->update(['name' => Helper::Filter($name)], ['id' => $id]);
    }

    public function updateLastLogin($id) {
        return $this->update(['lastlogin' => Helper::getCurrentTimestamp()], ['id' => $id]);
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

    public function getByEmail($value) {
        return $this->findBy(['email' => $value]);
    }

    public function getByRestoreHash($value) {
        return $this->findBy(['restore_salt' => $value]);
    }

}
