<?php

namespace Core\Framework;

class Cookie {

    private $prefix = 'cc_';

    public function set($key, $value, $cookieTime = 86400) {
        $prefix = $this->prefix . $key;
        return setcookie($prefix, $value, time() + $cookieTime, '/');
    }

    public function get($key = '') {
        if (isset($_COOKIE[$this->prefix . $key])) {
            return $_COOKIE[$this->prefix . $key];
        }
        return (isset($_COOKIE) && count($_COOKIE)) ? $_COOKIE : false;
    }

    public function pull($key) {
        if (isset($_COOKIE[$this->prefix . $key])) {
            setcookie($this->prefix . $key, '', time() - 3600, '/');
            return $_COOKIE[$this->prefix . $key];
        }
        return false;
    }

    public function destroy($key = '') {
        if (isset($_COOKIE[$this->prefix . $key])) {
            setcookie($this->prefix . $key, '', time() - 3600, '/');
            return true;
        }
        if (count($_COOKIE) > 0) {
            foreach ($_COOKIE as $key => $value) {
                $value = '';
                setcookie($key, $value, time() - 3600, '/');
            }
            return true;
        }
        return false;
    }

    public function setPrefix($prefix) {
        if (!empty($prefix) && is_string($prefix)) {
            $this->prefix = $prefix;
            return true;
        }
        return false;
    }

    public function getPrefix() {
        return $this->prefix;
    }

}
