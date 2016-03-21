<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'deleteColEngine.php');
$obj = new deleteColEngine($_GET['opp']);

$result = $obj->deleteCol();

echo($result);
?>
