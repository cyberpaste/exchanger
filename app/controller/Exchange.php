<?php

namespace Controller;

class Exchange extends \Core\Framework\Controller {

    public function Index($from, $to) {
        print_r([$from,$to]);
    }

}

