<?php

namespace Model;

use \Core\Framework\Helper as Helper;

class Reviews extends \Core\Framework\Model {

    protected $table = 'reviews';

    public function createNewReview($name = null, $message = null) {
        return $this->create(['name' => Helper::Filter($name), 'message' => Helper::Filter($message)]);
    }

    public function getModeratedReviews($offset = 0, $limit = 10) {
        if ($offset < 0) {
            $offset = 0;
        }
        $queryResult = $this->db->fetchAll('SELECT * FROM ' . $this->table . ' WHERE moderation = "1"  LIMIT ? OFFSET ? ', [$limit, $offset]);
        return $queryResult;
    }

    public function updateById($id, $name, $message) {
        return $this->update(['name' => $name, 'message' => $message], ['id' => $id]);
    }

    public function moderateById($id, $moderation) {
        return $this->update(['moderation' => $moderation], ['id' => $id]);
    }

}
