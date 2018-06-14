<?php

namespace Core\Framework;

use Core\Framework\Error as Error;

class Image {

    protected $headers = [
        'png' => 'Content-type: image/png',
    ];

    public function setHeader($extension) {
        if (array_key_exists($extension, $this->headers)) {
            header($this->headers[$extension]);
        } else {
            Error::UnsupportedType($extension);
        }
    }

    public function getQrCode($data = null, $height = 200, $width = 200) {
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $width . 'x' . $height . '&chl=' . urlencode($data));
        return imagepng($QR);
    }

}
