<?php

namespace Model;

class Messages extends \Core\Framework\Model {

    protected $table = 'messages';
    
    public function createNewMessage($name = null, $message = null, $type = null){
        return $this->create(['name' => $name, 'message' => $message, 'type' => $type]);
    }
}
