<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'deleteBioResourceEngine.php');
$obj = new deleteBioResourceEngine($_GET['opp']);

$result = $obj->copyToTrash();
if($result == "OK")
  $result = $obj->deleteArc();

echo($result);
?>
