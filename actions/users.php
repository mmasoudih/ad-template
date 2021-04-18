<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function getUsers() {
  global $mysqli;
  $res = $mysqli->query("SELECT * FROM users;");
  if ($res->num_rows > 0) {
    $users = [];
    while ($row = $res->fetch_assoc()) {
      $users[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'phone' => $row['phone'],
        'status' => $row['status']
      ];
    }
    echo response([
      'users' => $users,
      'status' => 200,
    ]);
  } else {
    echo response([
      'status' => 404,
    ]);
  }
}
function toggleEnableUser($user_id){
  global $mysqli;
  $status = $mysqli->query("SELECT (`status`) FROM `users` WHERE `id` = ${user_id}")->fetch_assoc();
  if($status['status'] == 'enable'){
    $status = $mysqli->query("UPDATE `users` SET `status` = 'disable' WHERE `id` = ${user_id}");
    echo response([
      'message' => 'وضعیت با موفقیت تغییر کرد',
      'status' => 200
    ]);
  }
  else if($status['status'] == 'disable'){
    $status = $mysqli->query("UPDATE `users` SET `status` = 'enable' WHERE `id` = ${user_id}");
    echo response([
      'message' => 'وضعیت با موفقیت تغییر کرد',
      'status' => 200
    ]);
  }
  

  
  
  // $res = $mysqli->query("UPDATE users SET `status` =  ");
  
}