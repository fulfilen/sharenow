<?php

class Token {
    public static function generateRandCode() 
    {
        return  base64_encode(uniqid());
    }

    public static function generateRandToken($length)
    {
        // return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        return bin2hex(random_bytes($length));
    }


    public static function check($token) 
    {
        $tokenName = Config::get('token/name');

        if(Session::has($tokenName) && $token === Session::get($tokenName))
        {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}