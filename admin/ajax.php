<?php
require __DIR__ . '/../init.php';

if (isset($_POST['deleteRecent'])) {
	$fileID = $_POST['fileID'];
	$file = $db->query('SELECT * FROM file WHERE id = ? ', array($fileID))->result();
	$fileDir = FILE_DIR . $file->fileName;
	$deleteRecent = $db->query('DELETE FROM file WHERE id = ? ', array($fileID))->rowCount();
	if ($deleteRecent) {
		unlink($fileDir);
		echo 'deleted';
		exit();
	}
}

if (isset($_POST['register'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	$field = array(
		'user_username' => $username,
		'user_password' => $password,
		'user_email' => $email
	);

  if (Share::registerUser($fields)) {
  	echo "success";
  	exit();
  }
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user = $db->query('SELECT * FROM users WHERE user_username = ? AND user_password = ?', [$username, $password])->rowCount();
	if ($user): 
		Session::put('username', $username);
		echo "loggedin";
		exit();
	else:
		echo "error";
		exit();
	endif;
}



?>