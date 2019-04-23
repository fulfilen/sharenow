<?php
require __DIR__ . '/init.php';
$token = ($_GET['f']) ?? NULL;



$data = $db->get('file', array('fileToken', '=', $token))->result(); 
$fileName = urldecode($data->fileName); //. $data->fileExt;

#upading counts
$db->update('file', $data->id, array('fileDownloadCount' => $data->fileDownloadCount+1));
$db->update('file', $data->id, array('fileLastDownloadedDate' => time()));
 
Redirect::to(FILE_FOLDER.$fileName);