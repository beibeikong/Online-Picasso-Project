<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'deleteArtworkEngine.php');
$obj = new deleteArtworkEngine($_GET['opp']);
$result = $obj->IsArtworkReferenced();
if($result == "OK") // we can delete it, because it is not referenced by Biography.
{
  $result = $obj->copyToTrash();
  if($result == "OK")
    $result = $obj->deleteArtwork();
}

echo($result);
?>
