<?php
ob_start();
session_start();

ini_set('display_errors', 'on');

require_once dirname(__DIR__). '/vendor/autoload.php';
require_once dirname(__DIR__). '/core/functions.php';
require_once dirname(__DIR__). '/config/config.php';

spl_autoload_register(function($className) {

    $filePath =  dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    //echo  $filePath;
    if (file_exists($filePath)) {

        require_once($filePath);
    }
});


Classes\Core\Config::load(dirname(__DIR__) . '/config/settings.php');

$cookieName = get('cookie/name');
$sessionName = get('user/id');

if (Classes\Core\Cookie::has($cookieName) && !Session::has($sessionName)) {

	$hash = Classes\Core\Cookie::get($cookieName);
	$hashCheck = Classes\Core\Database::instance()->get('session', ['hash','=', $hash]);
	if ($hashCheck->rowCount()) {

		$user = new Classes\Core\User($hashCheck->row()->user_id);
		$user->login();
	}
}
