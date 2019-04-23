<?php

namespace Classes\Core;

use Classes\Core\Flash;

class FileUploader
{
  private $maxSize;
  private $fileErrors = [];
  private $allowedMimeTypes = [];
  private $allowedExtensions = [];
  private $fileInfo;
  private $customName;

  public function getFileInfo(string $file)
  {
  
    $finfo = new \stdClass;
    $finfo->name = $_FILES[$file]['name'];
    $finfo->tmp_name = $_FILES[$file]['tmp_name'];
    $finfo->mime_type = $this->getType($finfo->tmp_name);
    $finfo->extension = $this->getExtension($finfo->name);
    $finfo->size = $_FILES[$file]['size'];
    $finfo->error = $_FILES[$file]['error'];

    $this->fileInfo = $finfo;
    return $finfo;
    
  }

  public function logFileErrors(string $error)
  {
    return $this->fileErrors[] = $error;
  }

   public function getFileErrors()
  {
    if (count($this->fileErrors)) {
      return $this->fileErrors;
    }

    return null;
  }

  public function getType(string $tmpName)
  {
    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    return $finfo->file($tmpName);
  }

  public function getExtension(string $file)
  {
    return strtolower(pathinfo($file, PATHINFO_EXTENSION));
  }

  public function setAllowedMimeTypes(array $types)
  {
    $this->allowedMimeTypes = $types;
  }

  function getAllowedMimeTypes()
  {
    return $this->allowedMimeTypes;
  }

  public function setAllowedExtensions(array $extensions)
  {
    $this->allowedExtensions = $extensions;
  }

  public function getAllowedExtensions()
  {
    return $this->allowedExtensions;
  }

   public function setMaxSize($size)
  {
    return $this->maxSize = $size;
  }

  public function getMaxSize()
  {
    return $this->maxSize * MB;
  }



  function upload(string $dir)
  {

    if(count($this->allowedMimeTypes) && !in_array($this->fileInfo->mime_type, $this->allowedMimeTypes)) {

    $this->logFileErrors('file format not allowed');
    }


    if (count($this->allowedExtensions) && !in_array($this->fileInfo->extension, $this->allowedExtensions)) {

    $this->logFileErrors('Invalid file extension'); 
    }

    if ($this->fileInfo->size > $this->getMaxSize()) {

      $this->logFileErrors(sprintf('maximum file size (%d MB) limit exceeded', $this->maxSize));
    }


    if ($this->fileInfo->error === UPLOAD_ERR_NO_FILE) {

      $this->logFileErrors('No file sent');
    }

    if ($this->fileInfo->error === UPLOAD_ERR_INI_SIZE) {

      $this->logFileErrors('Php.ini maximum file size limit exceeded.');
    }

    if ($this->fileInfo->error === UPLOAD_ERR_NO_TMP_DIR || $this->fileInfo->error === UPLOAD_ERR_CANT_WRITE) {

      $this->logFileErrors('No tmp directory or directory is not writable');
    } 

    if (!count($this->getFileErrors())) {

      return move_uploaded_file($this->fileInfo->tmp_name, $dir);
    }

    return false;
  }

  public function setCustomName($addedText = null, $separator = '-') {

    if (null === $addedText) {
      $addedText = bin2hex(openssl_random_pseudo_bytes(10));
    }

     // +1 for the dot '.' symbol
    $extensionLength = strlen($this->fileInfo->extension)+1;

    // Name with extension stripped off
    $fileName =  substr($this->fileInfo->name, 0, -$extensionLength); 

    //Append our text to the raw name
    $newFileName = createSlug($fileName) . $separator . $addedText . '.' .$this->fileInfo->extension; 

    return $this->customName =  $newFileName;
  }

  public function getCustomName()
  {
      return $this->customName;
  }
}
