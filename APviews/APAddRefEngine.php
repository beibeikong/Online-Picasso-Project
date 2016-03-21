<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'AddRefEngine.php');
$obj = new AddRefEngine($_POST);
$result = $obj->checkData();
if($result == "OK")
  $result = $obj->saveData();
  
echo($result);
?>
