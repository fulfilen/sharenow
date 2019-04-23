<?php 

#size in bytes
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);


define("ROOT_URI", "http://" .$_SERVER['HTTP_HOST']. '/share');
define("ROOT_PATH", dirname(__DIR__));
define("ADMIN_URI", "http://" .$_SERVER['HTTP_HOST']. '/share/admin');
define("ADMIN_PATH", __DIR__. '/../admin');
define("APP_TITLE", "9jaFiles");
define('APP_DESC', 'Site Desription goes here');

define("FILE_FOLDER","uploads/". date('Y/m/'));
define("FILE_DIR", ROOT_PATH. "/" .FILE_FOLDER);
define("MAX_FILE_SIZE", 50*MB);
define("ALLOWED_FILE_EXTS", array('jpg', 'jpeg', 'png', 'pdf', 'apk', 'mp3', 'mp4', '3gp', 'zip', 'tar'));

#site developer socail media details
define("FACEBOOK_USER", "fulfilen");
define("TWITTER_USER", "fulfilen");
define("INSTAGRAM_USER", "fulfilen");

