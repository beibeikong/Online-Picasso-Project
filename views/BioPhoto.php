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
<title>Photo - <?=PROJECTNAME?></title><link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/popup.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon"></head>

<body onload="AutoSizePopup();">
<?php
require_once(MODULES_PATH.'BioPhoto.php');
$obj = new BioPhoto($_GET);
$result = $obj->getData();
?>
<center>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Photo Viewer</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
	</tr>
	  </table>
	</td>
  </tr>
</table><br/>

<!---------------------------- Start ---------------------------->
<table class="ThumbGallery" border="0" align="center">
  <tr>
    <td class="pic"> <br />
	  <a  href="index.php?view=BioPhotoZoom&type=<?=$_GET['type']?>&year=<?=$_GET['year']?>&img=<?=$_GET['img']?>" target="_blank" onclick="OpenWin(this.href, 'BioPhotoZoom', 850, 650); return false;" ><img src="..<?=$obj->getImagePath()?>" height="430"/></a>
    </td>
  </tr>
  <tr>
    <td width="70">
<center>
	 <?php
	 /* 
	 while($row = mysql_fetch_array($result))
	 { 
	 	if(trim($row['photo'])!="")
	    {
			$photoXML = $row['photo'];
			while(strpos($photoXML, "<photo>")!==FALSE)
			{
                $photoTagPosition = strpos($photoXML, "</photo>");
				$photoName = substr($photoXML, 7, $photoTagPosition-7);
				$photoXML = substr($photoXML, $photoTagPosition+9);
				$photoDescTagPosition = strpos($photoXML, "</photodescription>");
				$photoDescrption = substr($photoXML, 18, $photoDescTagPosition-18);
				echo $photoDescrption;
				$photoXML = substr($photoXML, $photoDescTagPosition+20);
			}
		}
	}
	*/
	?>
	<?php 
	 while($row = mysql_fetch_array($result))
	 { 
	 	if(trim($row['photo'])!="")
	    {
		  $photoXML = $row['photo'];
		  while(strpos($photoXML, "<photo>")!==FALSE)
		  {
		  	$photoXML = trim($photoXML);
			$photostart = strpos($photoXML, "<photo>");
			$photoName = substr($photoXML, $photostart+7, 10);
			$photoDescTagPosition = strpos($photoXML, "</photodescription>");
		    if ($photoName == $obj->getImageShort())
			{
			  $descstart = strpos($photoXML, "<photodescription>");
			  $photoDescrption = substr($photoXML, $descstart+18, $photoDescTagPosition-$descstart-7);
			  echo($photoDescrption);
			}
			$photoXML = substr($photoXML, $photoDescTagPosition+19);
		  }
		}
	  }
	  ?>

</center>

    </td>
 </tr>
</table>
</center>
<!---------------------------- End Page Navigator ---------------------------->
<center>
	<div class="Copyright" id="Copyright">
		<table width="100%" height="37" cellspacing="0">
			<tr>
				<td align="left" style="PADDING-LEFT: 10px">
					<font style="font-variant:small-caps; font-weight:bold"><?=PROJECTNAME?></font>
				</td>
				<td align="right" style="PADDING-RIGHT: 10px">
					© <?=START_YEAR?>-<?=date("Y")?>&nbsp;<?=COPYRIGHT?>
				</td>
			</tr>
	      </table>
	</div>
</center>
</body>
</html>