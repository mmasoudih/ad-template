<?php
header('Content-Type: Application/json');
header('Accept: Application/json');
require_once 'includes/functions.php';


session_destroy();
unset($_SESSION['user_logged_in']);
unset($_SESSION['admin_logged_in']);


if (isset($_COOKIE['user_logged_in'])) {
  unset($_COOKIE['user_logged_in']); 
  setcookie("user_logged_in", "", time()-3600); 
}
if (isset($_COOKIE['admin_logged_in'])) {
  unset($_COOKIE['admin_logged_in']); 
  setcookie("admin_logged_in", "", time()-3600); 
}