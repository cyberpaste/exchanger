<?php

namespace Model;

use \Core\Framework\Helper as Helper;

class Currency extends \Core\Framework\Model {

    protected $table = 'currency';

    public function createNewCurrency($name = null, $code = null) {
        return $this->create(['name' => Helper::Filter($name), 'code' => Helper::Filter($code), 'active' => '1']);
    }

    public function updateById($id, $name, $code) {
        return $this->update(['name' => $name, 'code' => $code], ['id' => $id]);
    }

    public function activateById($id, $active) {
        return $this->update(['active' => $active], ['id' => $id]);
    }

}
