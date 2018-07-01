<?php

namespace Core\Framework;

use Core\Framework\Error as Error;

class Image {

    public function getQrCode($data = null, $height = 200, $width = 200) {
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $width . 'x' . $height . '&chl=' . urlencode($data));
        return imagepng($QR);
    }

    public static function getCaptchaMath($a, $b) {
        $c = "";
        $result = "";
        $type = rand(0,1);
        switch ($type) {
            case 0: $c = '+';
                $result = $a + $b;
                break;
            case 1 : $c = '*';
                $result = $a * $b;
                break;
            default: Error::UnsupportedType($type);
                break;
        }
        $letters = $a . $c . $b;
        $caplen = strlen($letters);
        $width = 120;
        $height = 40;
        $font = __DIR__ . '/fonts/captcha.ttf';
        $fontsize = 20;
        $im = imagecreatetruecolor($width, $height); //создаёт новое изображение
        imagesavealpha($im, true); //устанавливает прозрачность изображения
        $bg = imagecolorallocatealpha($im, 255, 255, 255, 127); //идентификатор цвета для изображения
        imagefill($im, 0, 0, $bg); //выполняет заливку цветом
        $captcha = ''; //обнуляем текст
        for ($i = 0; $i < $caplen; $i++) {
            $captcha .= $letters[$i]; // дописываем случайный символ из алфавила
            $x = ($width - 20) / $caplen * $i + 10; //растояние между символами
            $x = rand($x, $x + 4); //случайное смещение
            $y = $height - ( ($height - $fontsize) / 2 ); // координата Y
            $curcolor = imagecolorallocate($im, 34, 34, 34); //цвет для текущей буквы
            $angle = rand(-25, 25); //случайный угол наклона
            imagettftext($im, $fontsize, $angle, $x, $y, $curcolor, $font, $captcha[$i]); //вывод текста
        }
        imagepng($im); //выводим изображение
        imagedestroy($im); //очищаем память
        return $result;
    }

}
