<?php

class Session 
{
    public static function has($name)
    {
        return (isset($_SESSION[$name]));
    }

    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function get($name) 
    {
        return $_SESSION[$name];
    }

    public static function delete($name)
    {
        if(self::has($name)){

            unset($_SESSION[$name]);
            return true;
        }

        return false;
    }

    public static function destroy() 
    {
        return session_destroy();
    }
}