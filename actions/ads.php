<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';

function addAds() {
  global $mysqli;
  $res = $mysqli->query("INSERT INTO `ads` ()");
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
