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


    public static function generate2($tokenName) {

        return Session::put($tokenName, md5(uniqid()));
    }



    public static function check2($tokenName, $ToeknValue) {

    if(Session::exists($tokenName) && $ToeknValue === Session::get($tokenName)) {
        Session::delete($tokenName);
        return true;
    }

    return false;
    }
    
}