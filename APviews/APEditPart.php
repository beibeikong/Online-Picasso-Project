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
<title>Edit Writings Part - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>


<body>
<?php
require_once(APMODULES_PATH.'ModifyPoemPart.php');
$obj = new ModifyPoemPart($_GET);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Edit Part</td>
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
<form action="OPPAuthorV2WorksModifyDB" method="post" name="EntryForm" id="EntryForm" target="_blank">
<input value="<?=$_GET['mid']?>" id="mid" name="mid" type="hidden">
<input value="<?=$_GET['part']?>" id="part" name="part" type="hidden">
<table align="center" cellspacing="3">
  <tr>
    <td align="center" valign="top">
<!-------------- start left panel --------------------------->		
      <table class="TabContainer" id="SideBar" cellspacing="0" align="center">
		<tr class="Tabs">
		  <td class="Active"   id="TabLbl1Side"><a href="javascript:ChangeTabSide(1);"><img src="./images/magnify-text.png"/>Details</a></td>
		  <td class="Inactive" id="TabLbl2Side"><a href="javascript:ChangeTabSide(2);"><img src="./images/magnify-text.png"/>LinkID</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="3">
		  <div id="Tab1Side">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><?php $row=$obj->getTitle(); echo $row['title']; ?></td>
			  </tr>
			  <tr>
                <td valign="top" class="Label"><label for="startmonth">Part:</label>
                </td>
                <td><?=$_GET['part']?></td>
			    </tr>
			  <tr>
                <td valign="top" class="Label"><label for="endmonth">OPPs:</label>
                </td>
                <td><input value="<?php $image=$obj->getImage(); if($image!="") echo $image?>" size="30" id="opps" name="opps" type="text" />
				<input value="<?php $row=$obj->getTitle(); echo $row['title']; ?>" size="30" id="title" name="title" type="hidden"/>
				</td>
			    </tr>
			</table>
			<button type="button" onclick="DeletePoemPart('<?=$_GET['mid']?>', '<?=$row['title']?>', '<?=$_GET['part']?>', 'deletePoemPart');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button>	  

		  </div>
		  <div id="Tab2Side">
			  <iframe id="noteiframe" class="iframeNote" src="AuthorIndex.php?view=linkIdTree"  width="270px" height="420px"  scrolling="auto" frameborder="0"></iframe>
		</div>
		  </td>
		</tr>
	  </table>
<!-------------- end left panel --------------------------->		
	</td>

	<td align="center" valign="top">
<!-------------- start right panel --------------------------->	
 <table class="TabContainer" cellspacing="0" align="center">
	    <tr class="Tabs">
		  <td class="Active"   id="TabLbl1"><a href="javascript:ChangeTab(1);"><img src="./images/magnify-art.png" />Text</a></td>
		  <td class="Inactive" id="TabLbl2"><a href="javascript:ChangeTab(2);"><img src="./images/magnify-text.png"/>Commentary</a></td>
		  <td class="Inactive" id="TabLbl3"><a href="javascript:ChangeTab(3);"><img src="./images/magnify-text.png"/>Translation</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="4">
		    <div id="Tab1"><textarea name="text" id="text" rows="24" cols="63"><?php 
			  $result=$obj->getPoem();
			  while($row = mysql_fetch_array($result))
			    echo "<line>".$row['linetext']."</line>\n";
			?>
			</textarea></div>
		    <div id="Tab2"><textarea name="Commentary" id="Commentary" rows="24" cols="63"><?php 
			  $result=$obj->getCommentary();
			  echo $result;
			?></textarea></div>
			<div id="Tab3"><textarea name="Translation" id="Translation" rows="24" cols="63"><?php 
			  $result=$obj->getTranslation();
                           while($row = mysql_fetch_array($result))
			    echo "<line>".$row['translation']."</line>\n";
			//  echo $result;                       
			  ?></textarea></div>
		  </td>
		</tr>
	  </table>
<!-------------- end right panel --------------------------->	
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
			<button type="button" onclick="OnSaveModifiedForm('ModifyPartEngine'); return false;" id="SaveButton">Save</button>
			<button type="button" onclick="PreviewEntryFullPage(this.form, 'TxPreview')" id="TxPreview">Text Preview</button>
			<button type="button" onclick="PreviewEntryFullPage(this.form, 'ComPreview')" id="ComPreview">Commentary Preview</button>
			<button type="button" onclick="PreviewEntryFullPage(this.form, 'TranPreview')" id="TranPreview">Translation Preview</button>
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
