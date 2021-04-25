<?php
@session_start();
function response($data){
  return json_encode($data);
}
function truncate($text, $chars = 25) {
  if (strlen($text) <= $chars) {
      return $text;
  }
  $text = $text." ";
  $text = substr($text,0,$chars);
  $text = substr($text,0,strrpos($text,' '));
  $text = $text."...";
  return $text;
}
function checkAdminLogin(){
  if(!isset($_SESSION['admin_logged_in'])){
    header('location: /');
  }
}