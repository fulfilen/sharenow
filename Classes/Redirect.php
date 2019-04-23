<?php

class Redirect 
{
    public static function to($location) 
    { 

        if(is_numeric($location)) {

            switch($location) {

                case 404:
                    header('HTTP/1.0 404 Not Found');
                    include_once ROOT_PATH. '/views/404.php';
                    exit;
                break;
                case 401:
                    header('HTTP/1.0 401 Access Denied');
                    include_once ROOT_PATH. '/views/401.php';
                    exit;
                break;

                case 403:
                    header('HTTP/1.0 403 Fobidden');
                    include_once ROOT_PATH. '/views/403.php';
                    exit;
                break;
            }
        }

        header('Location:' . ROOT_URI . '/' . $location);
        exit;
        
        return self;
        
    }

    public function with($type, $message)
    {
        Flash::set($type, $message);
    }
}