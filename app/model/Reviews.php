<?php

namespace Model;

class Reviews extends \Core\Framework\Model {

    protected $table = 'reviews';

    public function createNewReview($name = null, $message = null) {
        return $this->create(['name' => $name, 'message' => $message]);
    }

    public function getAllReviews($offset = 0, $limit = 10) {
        if ($offset < 0) {
            $offset = 0;
        }
        $queryResult = $this->db->fetchAll('SELECT * FROM ' . $this->table . '  LIMIT ? OFFSET ? ', [$limit, $offset]);
        return $queryResult;
    }

    public function getModeratedReviews($offset = 0, $limit = 10) {
        if ($offset < 0) {
            $offset = 0;
        }
        $queryResult = $this->db->fetchAll('SELECT * FROM ' . $this->table . ' WHERE moderation = "1"  LIMIT ? OFFSET ? ', [$limit, $offset]);
        return $queryResult;
    }

}
