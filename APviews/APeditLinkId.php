<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit LinkId - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>


<body>
<?php
require_once(APMODULES_PATH.'ModifylinkId.php');
$obj = new ModifylinkId($_GET['id']);
$row = $obj->getData();
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Edit LinkId</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!------------------------------------------- start Add Artwork ----------------------------------------------->
<form action="OPPAuthorV2WorksModifyDB" method="post" name="EntryForm" id="EntryForm">
<input value="<?=$_GET['id']?>" id="id" name="id" type="hidden">
<table align="center" cellspacing="3">
  <tr>
    <td align="center" valign="top">
<!-------------- start left panel --------------------------->		
      <table class="TabContainer" id="SideBar" cellspacing="0" align="center">
		<tr class="Tabs">
		  <td class="Active"   id="TabLbl1Side"><a href="javascript:ChangeTabSide(1);"><img src="./images/magnify-text.png"/>Details</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="2">
		  <div id="Tab1Side">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input value="<?=$obj->escapeStringToHtmlText($row['title'])?>" size="30" id="title" name="title" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">URL:</label> </td>
				<td><input value="<?=$obj->escapeStringToHtmlText($row['URL'])?>" size="30" id="URL" name="URL" type="text"></td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="title">Category:</label> </td>
				<td>
				  <input id="category" name="category" value="3" type="radio" <?php if($row['category']==3) echo "checked";?>>People [3]<br />
				  <input id="category" name="category" value="8" type="radio" <?php if($row['category']==8) echo "checked";?>>Location (City) [8]<br />
				  <input id="category" name="category" value="2" type="radio" <?php if($row['category']==2) echo "checked";?>>Location (Street, Plaza, etc.) [2]<br />
				  <input id="category" name="category" value="9" type="radio" <?php if($row['category']==9) echo "checked";?>>Museum [9]<br />
				  <input id="category" name="category" value="1" type="radio" <?php if($row['category']==1) echo "checked";?>>Bibliography [1]<br />
				  <input id="category" name="category" value="4" type="radio" <?php if($row['category']==4) echo "checked";?>>Text [4]<br />
				  <input id="category" name="category" value="5" type="radio" <?php if($row['category']==5) echo "checked";?>>Artworks (non-OPP) [5]<br />
				  <input id="category" name="category" value="10" type="radio" <?php if($row['category']==10) echo "checked";?>>Objects [10]<br />
				  <input id="category" name="category" value="0" type="radio" <?php if($row['category']==0) echo "checked";?>>Other [0]<br />
				</td>
			  </tr>

			  





			</table>
		  </div>
		  </td>
		</tr>
	  </table>
<!-------------- end left panel --------------------------->			  
	</td>
  </tr>
</table>
<!--------------------- start bottom buttons----------------->
<table class="ActionButtons" cellspacing="0" align="center">
  <tr>
    <td>
    <div>
	  <table class="StatusHolder" cellspacing="0">
		<tr>
		  <div class="Hidden"><img src="./images/statusicon-idle.gif" alt=""/><img src="./images/statusicon-busy.gif" alt=""/><img src="./images/statusicon-error.gif" alt=""/><img src="./images/statusicon-success.gif" alt=""/></div>
		  <td class="ImageHolder"><img src="./images/statusicon-idle.gif" alt="" id="StatusImage"/></td>
		  <td id="StatusMessage">Idle</td>
		  <td>
			<button type="button" onclick="OnSaveModifiedForm('ModifyLinkIdEngine'); return false;" id="SaveButton">Save</button>
		  </td>
		</tr>
	  </table>
	</div>
	</td>
  </tr>
</table>
<!--------------------- end bottom buttons----------------->
</form>
<!------------------------------------------ end of Add Artwork ----------------------------------------------->
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
