<?php
session_start();

function response($data){
  return json_encode($data);
}
