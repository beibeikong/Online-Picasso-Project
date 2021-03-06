<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 

require_once(APMODULES_PATH.'BioResourcePreview.php');
$obj = new BioResourcePreview();


$temp=(string)$_POST['XMLCode'];
$temp= str_replace("&", "&amp;", $temp);

$xmlstring = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<XMLCode>
$temp
</XMLCode>
XML;

$xml = simplexml_load_string($xmlstring);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Biography Resource - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/BioPreview.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onresize="resizeBioTree();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Biography <?=$_POST['Type']?></td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start  Details ---------------------------->
<table class="SideBarNavigator">
  <tr>
    <td width="220"></td>
	<td><h2><?=$_POST['Name']?></h2></td>
  </tr>
  
  <tr>
    <td  class="LinkList">
	  <span class="features">Features</span><br />
	  <?php $i=1;
	    foreach($xml->panels as $panels)
        {
		  foreach($panels->panel as $panel)
          {
		    echo ("&nbsp;&nbsp;&nbsp;&nbsp;<span id=\"Bull$i\" class=\"Bull\">&bull;&nbsp;</span><a href=\"javascript:ChangePanel($i);\">$panel[name]</a><br>");
			$i++;
		  }
		}
		
		if(strpos($temp, "<links>")!==FALSE)  
		{ 
	      echo ("<br /><span class=\"features\">Related Links</span><br />");
		  foreach($xml->links as $links)
          {
		    foreach($links->link as $link)
            {
		      echo ($link[0]);
			  if(strpos($link['url'], "http://")!==FALSE)
			    echo ("&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$link[url]\"  target=\"_blank\">".$link->asXML()."</a><br>");
			  else
			  {
			    $temp_links = "\"index?view=BioResource&".substr($link['url'],1)."\"";
				echo ("&nbsp;&nbsp;&nbsp;&nbsp;<a href=$temp_links>".$link->asXML()."</a><br>");
			  }
		    }
		  }
		}
      ?>
	 
	  <br /><span class="features">Biography Overview</span><br />
	  <iframe id="noteiframe" class="iframeNote" src="index.php?view=bioTree"  width="200px" height="380px"  scrolling="auto" frameborder="0"></iframe>
	</td>
	<!---------------right part----------------------->
	<td class="Contents">
	  <div id="MasterPanel">
	     <?php $i=1;
	       foreach($xml->panels as $panels)
           {
		     foreach($panels->panel as $panel)
             {
		 ?>
		 <div id="Panel<?=$i?>" class="Panel">
		 <?php 
		   if($panel['contentType']=="ExplicitHTML") echo str_replace("?id=","index.php?view=BioResource&id=",$panel->asXML());
		   else if($panel['contentType']=="PhotoGallery")
		   {
		 ?>
		 <!-- start display photo -->
		 <table cellspacing="7" align="center" style="margin-bottom:20px ">
		 <?php  $j=0;
		   foreach($panel->photo as $photo)
		   {
		     $j++;
		     if(($j%4) == 1)
			 {
		 ?>
<tr>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a <?=$obj->generateImgViewer($photo['photoFileName'],$photo['thumbnailFileName'])?> ><img src="<?=$photo['thumbnailFileName']?>" class="imageStyle"/></a></td></tr>
      <tr><td class="Biocontent"><?=$obj->getTitle($photo->asXML())?></td>
      </tr>
    </table>
  </td>
		 <?php	 
			 }
			 else if(($j%4) == 2)
			 {
		?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a <?=$obj->generateImgViewer($photo['photoFileName'],$photo['thumbnailFileName'])?> ><img src="<?=$photo['thumbnailFileName']?>" class="imageStyle"/></a></td></tr>
      <tr><td class="Biocontent"><?=$obj->getTitle($photo->asXML())?></td>
      </tr>
    </table>
  </td>
		<?php	 
			 }
			 else if(($j%4) == 3)
			 {
	    ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a <?=$obj->generateImgViewer($photo['photoFileName'],$photo['thumbnailFileName'])?> ><img src="<?=$photo['thumbnailFileName']?>" class="imageStyle"/></a></td></tr>
      <tr><td class="Biocontent"><?=$obj->getTitle($photo->asXML())?></td>
      </tr>
    </table>
  </td>
		<?php	 
			 }
			 else if(($j%4) == 0)
			 {
	    ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a <?=$obj->generateImgViewer($photo['photoFileName'],$photo['thumbnailFileName'])?> ><img src="<?=$photo['thumbnailFileName']?>" class="imageStyle"/></a></td></tr>
      <tr><td class="Biocontent"><?=$obj->getTitle($photo->asXML())?></td>
      </tr>
    </table>
  </td>
</tr>  
		<?php
			 }
		   }	 
			 if(($j%4) == 1 ||($j%4) == 2||($j%4) == 3) echo "</tr>";
		?>
		 </table>
		 <!-- end display photo -->
		 <?php } ?>
		 </div>
		 <?php      
			   $i++;
		     }
		   }
		 ?>  
	  </div>
	</td>
  </tr>
  
  
</table>
<!---------------------------- end  Details ---------------------------->
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


  </tr>
  
  
</table>
<!---------------------------- end  Details ---------------------------->
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