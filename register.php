<?php
header('Content-Type: Application/json');
header('Accept: Application/json');

require_once 'config/database.php';
require_once 'includes/functions.php';


function register($name, $phone, $password, $password_confirm)
{
  global $mysqli;
  if (!empty($name) && !empty($phone) && !empty($password) && !empty($password_confirm)) {
    if($password !== $password_confirm){
      $query = "INSERT INTO `users` (`name`,`phone`,`password`) VALUES ('${name}','${phone}','${password}')";
      $res = $mysqli->query($query);
      if($res){
        echo response([
          'message' => 'ثبت نام با موفقیت انجام شد',
          'code' => 200
        ]);
      }else{
        echo response([
          'message' => 'خطایی در ثبت نام رخ داد',
          'code' => 400
        ]);
      }
    }else{
      echo response(['error' => 'تکرار رمز عبور یکسان نیست']);
    }
  }

}
// echo response($_REQUEST);
if(isset($_POST)){
  register($_POST['name'],$_POST['phone'],$_POST['password'],$_POST['passwrod_confirm']);
}
