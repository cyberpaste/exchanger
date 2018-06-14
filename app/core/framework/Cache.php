<?php

namespace Core\Framework;

class Cache {

    private $cachePath;
    private $cacheTime;
    private $cacheExtencion;

    public function __construct($cachePath, $cacheTime, $cacheExtencion) {
        $this->cachePath = $cachePath;
        $this->cacheTime = $cacheTime;
        $this->cacheExtencion = $cacheExtencion;
    }

    public function setCache($label, $data) {
        file_put_contents($this->cachePath . $this->getFilename($label) . $this->cacheExtencion, json_encode($data));
    }

    public function getCache($label) {
        if ($this->isCached($label)) {
            $filename = $this->cachePath . $this->getFilename($label) . $this->cacheExtencion;
            return json_decode(file_get_contents($filename));
        }
        return false;
    }

    public function isCached($label) {
        $filename = $this->cachePath . $this->getFilename($label) . $this->cacheExtencion;
        if (file_exists($filename) && (filemtime($filename) + $this->cacheTime >= time())) {
            return true;
        }
        return false;
    }

    private function getFilename($label) {
        return preg_replace('/[^0-9a-z\.\_\-]/i', '', strtolower($label));
    }

}
