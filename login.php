<?php
require __DIR__ . '/init.php';

$username = $_POST['username'];
$password = $_POST['password'];
$user = $db->query('SELECT * FROM users WHERE user_username = ? AND user_password = ?', [$username, $password])->rowCount();

if ($user): 
	Session::put('username', $username);
	echo "loggedin";
else:
	echo "error";

endif;
