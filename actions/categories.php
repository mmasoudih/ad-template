<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function getCategories() {
  global $mysqli;
  /* if (!$id) {
    echo response(['error' => 'آیدی دسته رو وارد کنید']);
    die;
  } */
  $res = $mysqli->query("SELECT * FROM categories;");
  if ($res->num_rows > 0) {
    $categories = [];
    while ($row = $res->fetch_assoc()) {
      $categories[] = [
        'id' => $row['id'],
        'title' => $row['title'],
      ];
    }
    echo response([
      'categories' => $categories,
      'status' => 200,
    ]);
  } else {
    echo response([
      'status' => 404,
    ]);
  }
}
function deleteCategory($id){
  global $mysqli;
  
  
  $res = $mysqli->query("DELETE FROM categories WHERE id = ${id}");
  if($res){
    echo response([
      'message' => 'دسته‌بندی با موفقیت پاک شد',
      'status' => 200,
    ]);
  }else {
    
    echo response([
      'message' => 'خطای غیر منتظره‌ای رخ داد مجدد تلاش کنید',
      'status' => 404,
      ]);
  }

}
function updateCategory($id, $title){
  global $mysqli;
  
  
  $res = $mysqli->query("UPDATE categories SET title = '${title}' WHERE id = ${id}");
  if($res){
    echo response([
      'message' => 'دسته‌بندی با موفقیت ویرایش شد',
      'status' => 200,
    ]);
  }else {
    
    echo response([
      'message' => 'خطای غیر منتظره‌ای رخ داد مجدد تلاش کنید',
      'status' => 404,
    ]);
  }
}
function addCategory($title) {
  global $mysqli;
  if (!empty($title)) {
    $query = "INSERT INTO `categories` (`title`) VALUES ('${title}')";
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
