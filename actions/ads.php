<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function addAds($title,$description,$category_id,$price,$images) {
  global $mysqli;
  $array_images = explode(',',$images);
  $user_id = $_SESSION['user_id'];

  
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
