<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function upload($file) {
  // get details of the uploaded file
  $fileTmpPath = $file['tmp_name'];
  $fileName = $file['name'];
  $fileSize = $file['size'];
  $fileType = $file['type'];

  $fileNameCmps = explode(".", $fileName);
  $fileExtension = strtolower(end($fileNameCmps));

  // sanitize file-name
  $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

  $uploadFileDir = './uploaded_pictures/';
  $dest_path = $uploadFileDir . $newFileName;

  if(move_uploaded_file($fileTmpPath, $dest_path)) 
  {
    echo response([
      "message" => "عکس با موفقیت بارگذاری شد",
      "file" => $newFileName,
      "status" => 200
    ]);
  }else {
    echo response([
      "message" => "مشکلی در بارگذاری رخ داد",
      "status" => 500
    ]);
  }  
}

