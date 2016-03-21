<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./modules/checkFrontUser.php'))
    require_once('./modules/checkFrontUser.php');  // check if it is authenrized user
else
    die('0'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href=" ./css/ArtworkDetails.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
</head>

<body 
<?php
require_once(MODULES_PATH.'ArtworkInfo.php');
$obj = new ArtworkInfo($_GET['OPPID']);
$result = $obj->getData();
$row = mysql_fetch_array($result);

$temp=(string)$row['commentary'];
$temp= str_replace("&", "&amp;", $temp);

$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
 if(isset($_GET['page'])) $href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);
 $hrefForPrint = str_replace("ArtworkInfo", "ArtworkInfoPrint", $href_temp);
 $AcceptedTitle = $obj->getAcceptedTitle($row['title']);
?>


<div id="commentaryTable">
    <table class="ContainerS"width="100%"  align="center" border="0">
    <tr>
        <td class="infoLarge">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?></font></strong></span>. 
	   <?=$row['location']?>.  
	   <?=$row['duration']?>. 
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>. 
	   <?=$row['dimension']?>.</span> 
	   <?=$row['collection']?>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>.<?php } ?>
 	</td>
    </tr>
</table>
</div>
</body>
</html>