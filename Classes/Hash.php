<?php


class Hash
{
    public static function make($string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    public static function verify(...$string)
    {
    	return password_verify($string[0], $string[1]);
    }
    
    public static function unique()
    {
        return self::make(uniqid());
    }
}
