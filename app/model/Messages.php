<?php

namespace Model;

use \Core\Framework\Helper as Helper;

class Messages extends \Core\Framework\Model {

    protected $table = 'messages';

    public function createNewMessage($name = null, $message = null, $type = null) {
        return $this->create(['name' => Helper::Filter($name), 'message' => Helper::Filter($message), 'type' => $type]);
    }

}
