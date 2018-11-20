<?php
class Token {
    public static function generate() {
        return Session::put("logIngToken", md5(uniqid()));
    }

    public static function check($token) {
   
        if(Session::exists('logIngToken') && $token === Session::get('logIngToken')) {
            Session::delete('logIngToken');
            return true;
        }

        return false;
    }
}