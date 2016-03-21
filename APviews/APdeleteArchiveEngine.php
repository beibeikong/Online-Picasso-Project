<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'deleteArchiveEngine.php');
$obj = new deleteArchiveEngine($_GET['opp']);

$result = $obj->copyToTrash();
if($result == "OK")
  $result = $obj->deleteArc();

echo($result);
?>
