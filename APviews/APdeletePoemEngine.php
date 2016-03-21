<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'deletePoemEngine.php');
$obj = new deletePoemEngine($_GET['mid']);
$result = $obj->deletePoem();

echo($result);
?>
