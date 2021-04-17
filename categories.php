<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';


function addCategory($name)
{
  global $mysqli;
  if (!empty($name)) {
    $query = "INSERT INTO `users` (`name`) VALUES ('${name}')";
    $res = $mysqli->query($query);
    if ($res) {
      echo response([
        'message' => 'دسته بندی ایجاد شد',
        'code' => 200
      ]);
    } else {
      echo response([
        'message' => 'خطایی در ثبت رخ داد',
        'code' => 400
      ]);
    }
  } else {
    echo response(['error' => 'نام دسته‌بندی نمی‌تواند خالی باشد']);
  }
}
// echo response($_REQUEST);
if (isset($_POST)) {
  addCategory($_POST['name']);
}
