<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function getCategoryNameById($id){
  global $mysqli;
  $res = $mysqli->query("SELECT (title) FROM categories WHERE id = $id");
  $res = $res->fetch_assoc();
  return $res['title'];
}
function getUserNameById($id){
  global $mysqli;
  $res = $mysqli->query("SELECT (name) FROM users WHERE id = $id");
  $res = $res->fetch_assoc();
  return $res['name'];
}
function getAds()
{
  global $mysqli;
  $res = $mysqli->query("SELECT * FROM ads");
  if ($res->num_rows > 0) {
    $ads = [];
    while ($row = $res->fetch_assoc()) {
      $ads[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'category' => getCategoryNameById($row['cat_id']),
        'user' => getUserNameById($row['user_id']),
        'description' => truncate($row['description'], 150),
        'phone' => $row['phone'],
        'price' => $row['price'],
        'status' => $row['status'],
        'images' => unserialize($row['images']),
      ];
    }
    echo response([
      'ads' => $ads,
      'status' => 200,
    ]);
  } else {
    echo response([
      'status' => 404,
    ]);
  }
}

function getAd($id = null)
{
  if (!$id) {
    echo response(['error' => 'آیدی آگهی رو وارد کنید']);
    die;
  }
  global $mysqli;
  $res = $mysqli->query("SELECT * FROM ads WHERE id=" . $id . ";");
  if ($res->num_rows > 0) {
    $ad = [];
    while ($row = $res->fetch_assoc()) {
      $ad = [
        'id' => $row['id'],
        'title' => $row['title'],
        'cat_id' => $row['cat_id'],
        'user_id' => $row['user_id'],
        'description' => $row['description'],
        'phone' => $row['phone'],
        'price' => $row['price'],
        'status' => $row['status'],
        'images' => unserialize($row['images']),
      ];
    }
    echo response([
      'ad' => $ad,
      'status' => 200,
    ]);
  } else {
    echo response([
      'status' => 404,
    ]);
  }
}

function addAds($title, $description, $category_id, $price, $images, $phone)
{
  if(!empty($title) && !empty($description) && !empty($category_id) && !empty($price) && !empty($images) && !empty($phone) ){
    global $mysqli;
    $array_images = explode(',', $images);
    $arr_serialize = serialize(array_filter($array_images));
    $user_id = $_SESSION['user_id'];
    $status = 'enable';
    $query = "INSERT INTO `ads` (`id`, `cat_id`, `user_id`, `title`, `description`, `phone`, `price`, `status`, `images`) VALUES (NULL, '${category_id}', '${user_id}', '${title}', '${description}', '${phone}', '${price}', '${status}', '${arr_serialize}')";
  
    $result = $mysqli->query($query); 
  
    if($result){
      echo response([
        'message' => 'تبلیغ با موفقیت ثبت شد',
        'status' => 200
      ]);
    }else{
      echo response([
        'message' => 'خطایی در ثبت رخ داد',
        'status' => 400
      ]);
    }
  }else{
    echo response([
      'message' => 'همه فیلد ها را پر کنید',
      'status' => 400
    ]);
  }

}

function toggleAdsStatus($ads_id){
  global $mysqli;
  $status = $mysqli->query("SELECT (`status`) FROM `ads` WHERE `id` = ${ads_id}")->fetch_assoc();
  if($status['status'] == 'enable'){
    $status = $mysqli->query("UPDATE `ads` SET `status` = 'disable' WHERE `id` = ${ads_id}");
    echo response([
      'message' => 'وضعیت با موفقیت تغییر کرد',
      'status' => 200
    ]);
  }
  else if($status['status'] == 'disable'){
    $status = $mysqli->query("UPDATE `ads` SET `status` = 'enable' WHERE `id` = ${ads_id}");
    echo response([
      'message' => 'وضعیت با موفقیت تغییر کرد',
      'status' => 200
    ]);
  }
}

function deleteAd($id){
  global $mysqli;
  
  $res = $mysqli->query("DELETE FROM `ads` WHERE `id` = ${id}");
  if($res){
    echo response([
      'message' => 'آگهی با موفقیت پاک شد',
      'status' => 200,
    ]);
  }else {
    
    echo response([
      'message' => 'خطای غیر منتظره‌ای رخ داد مجدد تلاش کنید',
      'status' => 404,
      ]);
  }

}
function getUserAds(){
  global $mysqli;
  $user_id = $_SESSION['user_id'];
  $res = $mysqli->query("SELECT * FROM `ads` WHERE `user_id` = $user_id ");
  if ($res->num_rows > 0) {
    $ads = [];
    while ($row = $res->fetch_assoc()) {
      $ads[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'category' => getCategoryNameById($row['cat_id']),
        'user' => getUserNameById($row['user_id']),
        'description' => truncate($row['description'], 150),
        'phone' => $row['phone'],
        'price' => $row['price'],
        'status' => $row['status'],
        'images' => unserialize($row['images']),
      ];
    }
    echo response([
      'ads' => $ads,
      'status' => 200,
    ]);
  } else {
    echo response([
      'status' => 404,
    ]);
  }
}