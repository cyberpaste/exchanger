<?php

namespace Core\Framework;

class Helper {

    public function getRandomString($length) {
        $characters = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getHash($string, $salt = null) {
        return(md5($string . $salt));
    }

    public function getCurrentUnixTime() {
        $dateTime = new \DateTime();
        return $dateTime->getTimestamp();
    }

    public function getCurrentTimestamp() {
        return date("Y-m-d H:i:s", $this->getCurrentUnixTime());
    }

}
