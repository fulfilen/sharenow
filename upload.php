<?php 
require __DIR__ . '/init.php';

// $allowExtensions = array('jpg', 'jpeg', 'png', 'pdf', 'apk', 'mp3', 'mp4', '3gp', 'zip', 'tar');
$token = bin2hex(random_bytes(5)); #random token

// $maxFileSize = 50*MB; #in megabites
// FILE_DIR = ROOT_PATH. '/uploads/'; #file directory


if (!is_dir(FILE_DIR)):
	@mkdir(FILE_DIR, 0755, true);
endif;
if (empty($_FILES['file']['tmp_name'])):
	print 'ERROR: Choose a file';
	exit();
endif;

$fileName = $_FILES['file']['name'];
$fileTempLoc = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$newName = pathinfo($fileName, PATHINFO_FILENAME);
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (!in_array($fileExt, ALLOWED_FILE_EXTS)):
	print 'ERROR: Invalid File Extension';
	unlink($fileTempLoc);
	exit();
endif;

if ($fileSize > MAX_FILE_SIZE):
	print 'ERROR: Invalid File Size; Maximum size is ' . MAX_FILE_SIZE/MB .'MB';
	unlink($fileTempLoc);
	exit();
endif;

$destination = FILE_DIR. $fileName;
if (is_file($destination)) {
	echo "ERROR: File Already Exist";
	unlink($fileTempLoc);
	exit();
}

if (!move_uploaded_file($fileTempLoc, $destination)):
	print 'ERROR: Could not upload file, Contact Admin';
	unlink($fileTempLoc);
	exit();
endif;

$fields = array();
$fields['fileToken'] = $token;
$fields['fileName'] = $fileName;
$fields['fileSize'] = $fileSize;
$fields['fileLink'] = FILE_FOLDER.$fileName;
$fields['fileExt'] = $fileExt;
$fields['fileCreatedDate'] = time();

$db->insert('file', $fields);


echo "<a href='" .ROOT_URI. "/view/$token'><strong><div class='alert alert-success'>VIEW FILE HERE</div></strong></a>";
echo '<strong>' .$newName. '.'.$fileExt . '</strong><br/>';
echo "File Size: <span class='text-muted'>" .getSize($fileSize). '<span>';





?>


