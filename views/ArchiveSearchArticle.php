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
<title>Archives Article - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/archives.css"/>
<link rel="stylesheet" href="./css/popup.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onresize="resizeNote();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Article</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>

<?php
$s = str_replace("ArchiveSearchArticle","ArchiveSearch",$_SERVER['QUERY_STRING']);
$s = str_replace("&id=$_GET[id]","",$s);

require_once(MODULES_PATH.'ArchivesArticle.php');
$obj = new ArchivesArticle($_GET['id']);
$result = $obj->getData();

$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
$hrefForPrint = str_replace("ArchiveSearchArticle", "ArchivePrint", $href_temp);
?>
<div style="height:88vh;overflow-x:hidden;overflow-y:auto;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
               <table  cellspacing="0" align="center">
           <!-- <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Inactive"><a href="index.php?<?=$s?>"><img src="./images/magnify-text.png"/>Archives Search</a></td>
  	            <td class="Active"><img src="./images/magnify-text.png"/>Article</td>
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="EmptySpace">&nbsp;</td>
              </tr> -->
              <tr>
	            <td class="Container" colspan="5">
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" align="center" cellspacing="0">
  <tr>
    <td width="640" align="center"><i><font size="5"><?=$result['Publisher']?></font></i></td>
  </tr>
  
  <tr>
    <td colspan="3" align="center">

        <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
           <td align="center"><h2><?=$result['Title']?></h2></td></tr>
          <tr>
</table>
        <table width="100%" border="0" cellpadding="20" cellspacing="0">
    	  <tr>
	    <td align="left"><i><?=$result['DateDescription']?></i></td>
	<td width="150" align="right" ><a class="PageButton" href="<?=$hrefForPrint?>" target="_blank"  onclick="if(!PrintWarning()) return false;" title="Print this article."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Print</a></td>
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
	<?php if($result['Images']!= "") { ?>
		<table class="ImageStrip" cellspacing="7">
		<?php $imageArray = explode(";", $result['Images']);
		      foreach($imageArray as $image) {
		?>
			<tr>
				<td><a href="index.php?view=BioPhotoZoom&type=archive&year=<?= $_GET['year']?>&img=<?=$obj->parsePhotoName($image)?>" target="_blank" onclick="OpenWin(this.href, 'BioZoom', 850, 650); return false;" ><img src="../archives/<?= $_GET['year']?>/thumbnails/x<?=$image?>"/></a></td>
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
</center>
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
</body>
</html>
