<?php

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $i = 0;
    $c = count($class);
    $realclass = "";
    foreach ($class as $ns) {
        if ($c - 1 == $i) {
            $realclass .= $ns;
        } else {
            $realclass .= strtolower($ns) . '\\';
        }
        $i++;
    }
    $path = __DIR__ . '/' . $realclass . '.php';
    $path = str_replace('\\', '/', $path);
    if (file_exists($path)) {
        require_once $path;
    }
});
