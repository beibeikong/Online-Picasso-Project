<?php 
session_start();

if(!isset($_SESSION["loginName"])) // unauthorized access
  header("Location: http://picasso.tamu.edu/");
else if(!isset($_COOKIE["cookIT"])) // unauthorized access
  header("Location: http://picasso.tamu.edu/");
else
{
  $value = $_COOKIE["cookIT"];
  $build = $_SESSION["loginName"].$_SERVER['REMOTE_ADDR']."OPP";
  if($value!=md5($build)) 
    header("Location: http://picasso.tamu.edu/"); // unauthorized access or a fake cookie or changed proxy
}  

?>