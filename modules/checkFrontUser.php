<?php 
session_start();

if(!isset($_SESSION["FrontloginName"])) // unauthorized access
  header("Location: http://picasso.shsu.edu/");
else if(!isset($_COOKIE["cookFRONTIT"])) // unauthorized access
  header("Location: http://picasso.shsu.edu/");
else
{
  $value = $_COOKIE["cookFRONTIT"];
  $build = $_SESSION["FrontloginName"].$_SERVER['REMOTE_ADDR']."OPP";
  if($value!=md5($build)) 
    header("Location: http://picasso.shsu.edu/"); // unauthorized access or a fake cookie or changed proxy
}  

setCookie("usertype", $_SESSION['UserType'], 0);
?>