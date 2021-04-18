<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';


function login($phone, $password)
{
  global $mysqli;
  if (!empty($phone) && !empty($password)) {
    $query = "SELECT * FROM `users` WHERE `phone` = '${phone}' AND `password` = '${password}'";
    $res = $mysqli->query($query);
    if($res->num_rows > 0){
      $_SESSION['user_logged_in'] = true;
      $data =$res->fetch_assoc();
      $_SESSION['user_id'] = $data['id'];
      echo response(['status'=>'ok', 'user'=> $res->fetch_assoc()]);
    }else{
      echo response(['message'=> 'نام کاربری یا رمز عبور اشتباه است']);
    }
  }

}

if(isset($_POST)){
  login($_POST['phone'],$_POST['password']);
}
