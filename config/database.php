<?php
define('SERVER', 'localhost');
define('USER_NAME','app_user');
define('PASSWORD', '1234');
define('DB_NAME', 'ad-manager');
define('CHARSET', 'utf8');


$mysqli = new mysqli(SERVER,USER_NAME,PASSWORD,DB_NAME);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$mysqli->set_charset(CHARSET);
// $mysqli->query('SET foreign_key_checks = 0');