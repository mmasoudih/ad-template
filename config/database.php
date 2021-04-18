<?php
define('SERVER', 'localhost');
define('USER_NAME','root');
define('PASSWORD', 'mahbod');
define('DB_NAME', 'mmasoudi_ad-manager');
define('CHARSET', 'utf8');

$mysqli = new mysqli(SERVER,USER_NAME,PASSWORD,DB_NAME);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$mysqli->set_charset(CHARSET);
