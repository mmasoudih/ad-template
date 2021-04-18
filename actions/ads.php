<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function getAds() {
  global $mysqli;
  $res = $mysqli->query("SELECT * FROM ads");
  if ($res->num_rows > 0) {
    $ads = [];
    while ($row = $res->fetch_assoc()) {
      $ads[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'cat_id' => $row['cat_id'],
        'user_id' => $row['user_id'],
        'description' => $row['description'],
        'phone' => $row['phone'],
        'price' => $row['price'],
        'status' => $row['status'],
        'images' => $row['images'],
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

function getAd($id = null) {
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
        'images' => $row['images'],
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

function addAds($title, $description, $category_id, $price, $images, $phone) {
  global $mysqli;
  $array_images = explode(',', $images);
  $user_id = $_SESSION['user_id'];
  $status = 'enable';
  $query = "INSERT INTO ads (id, title, cat_id, user_id, description, phone, price, status, images) VALUES (NULL, '$title', '$category_id', '$user_id', '$description', '$phone', '$price', '$status', '$images');";

  // TODO
  
  // echo response(serialize($array));
  echo response([
    'title' => $title,
    'description' => $description,
    'category_id' => $category_id,
    'price' => $price,
    'array_images' => $array_images
  ]);
  // $res = $mysqli->query("INSERT INTO `ads` ()");

}
