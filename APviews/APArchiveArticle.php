<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Archives Article Preview- On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/archives.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'ArchiveArticle.php');
$obj = new ArchiveArticle($_POST);
?>
<center>
<?php include('header.htm'); ?>

<table width="760" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">	
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td width="40" align="center">&nbsp;</td>
			    <td>&nbsp;</td>
                <td width="40" align="center">&nbsp;</td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Active"><img src="./images/magnify-text.png"/>Preview Article</td>
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="InactiveEmpty">&nbsp;</td>								
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    <td width="150" align="right">&nbsp;</td>
	<td><i><font size="5"><?=$_POST['Publisher']?></font></i></td>
	<td width="150" align="right" >&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3" align="center">

        <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><h2><?=$_POST['Title']?></h2></td></tr>
          <tr>
</table>
        <table width="100%" border="0" cellpadding="20" cellspacing="0">
    	  <tr>
	    <td align="left"><i><?=$_POST['Description']?></i></td>
          </tr>
        </table>
</td>
	</tr>
</table>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="titleDura">&nbsp;</td>
  </tr>
</table>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Archive Article ---------------------------->
<table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>

<!-------- div start -------->
<div id="ArticleBody">
	<?php $imgs = $obj->getImgs(); if($imgs!= "") { ?>
		<table class="ImageStrip" cellspacing="7">
		<?php $imageArray = explode(";", $imgs);
		      foreach($imageArray as $image) {
		?>  
			<tr>
				<td><a href="index.php?view=BioPhotoZoom&img=/archives/<?=$_POST['Year']?>/<?=$image?>" target="_blank" onclick="OpenWin(this.href, 'BioZoom', 850, 650); return false;" ><img src="../archives/<?=$_POST['Year']?>/thumbnails/x<?=$image?>"/></a></td>
			</tr>
	    <?php  }  ?>		
			
	<?php
	  $photoDesc = $obj->getPhotoDesc();
	  if($photoDesc != "") {
	?>
 			<tr  class="PhotoDescription">
               <td ><?=$photoDesc?></td>
            </tr>
     <?php } ?>
	    </table>
	<?php } ?>
	<?=$obj->getText()?>
</div>
<!-------- div end -------->	

	</td>
  </tr>
</table>
<!---------------------------- End Archive Article ---------------------------->
				</td>
              </tr>
            </table>
		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include('footer.php'); ?>
</center>
</body>
</html>
