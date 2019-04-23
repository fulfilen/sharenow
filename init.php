<?php
ob_start();
session_start();

ini_set('display_errors', 'on');

require_once __DIR__. '/core/functions.php';
require_once __DIR__. '/core/config.php';

spl_autoload_register(function($className) {

    $filePath =  ROOT_PATH . DIRECTORY_SEPARATOR . 'Classes' . DIRECTORY_SEPARATOR . $className . '.php';
    //echo  $filePath;
    if (file_exists($filePath)):
        require_once($filePath);
    endif;
});



Config::load( ROOT_PATH. '/core/database.php');
$db = Database::instance();
