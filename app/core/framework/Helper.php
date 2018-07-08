<?php

namespace Core\Framework;

class Helper {

    public static function getRandomString($length) {
        $characters = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getHash($string, $salt = null) {
        return(md5($string . $salt));
    }

    public static function getCurrentUnixTime() {
        $dateTime = new \DateTime();
        return $dateTime->getTimestamp();
    }

    public static function getCurrentTimestamp() {
        return date("Y-m-d H:i:s", self::getCurrentUnixTime());
    }

    public static function Truncate($text, $textEnd = '...', $start = 0, $end = 100) {
        return mb_substr($text, $start, $end) . $textEnd;
    }

    public static function Filter($text){
        return htmlspecialchars($text);
    }
}
