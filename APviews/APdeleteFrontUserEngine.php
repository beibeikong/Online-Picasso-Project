<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'deleteFrontUserEngine.php');
$obj = new deleteFrontUserEngine($_GET['opp']);
$result = $obj->checkdata();
if($result == "OK") // check whether this studyname exists.
{
    $result = $obj->deleteFrontUser();
}
	
echo($result);

?>
