<?php

namespace Core\Framework\Interfaces;

interface Migration {

    public function up();

    public function down();
}
