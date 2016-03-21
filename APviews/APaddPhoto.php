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
<title>Add Photo - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Add Photo</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>

<!------------------------------------------- start Add Photo ----------------------------------------------->
<form action="OPPAuthorV2WorksModifyDB" method="post" name="EntryForm" id="EntryForm">
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
			    <td class="Label"><label for="title">Description:</label> </td>
				<td><input value="" size="30" id="desc" name="desc" type="text"></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="title">Year:</label> </td>
				<td><input value="" size="30" id="year" name="year" type="text"></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="title">name:</label> </td>
				<td><input value="" size="30" id="name" name="name" type="text"></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="title">PhotoDesc:</label> </td>
                <td>
				<textarea name="description" id="description" rows="10" cols="30"></textarea>
               </td>
			  </tr>
              </table>
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
		  <td class="Active"   id="TabLbl1"><a href="javascript:ChangeTab(1);"><img src="./images/magnify-art.png" />Thumbnails</a></td>
		  <td class="EmptySpace">&nbsp;</td>
          <td class="EmptySpace">&nbsp;</td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="4">
		    <div id="Tab1">
			<table align="center" cellspacing="5">
			  <tr align="left" valign="top">
				<td>X-Thumbnail:</td>
				<td>Y-Thumbnail:</td>
			  </tr>
			  <tr align="left" valign="top">
				<td><img src="../photos/<?=$daterow['StartYear']?>/xthumbs/x<?=$image?>.jpg" class="imageStyle"/></td>
				<td><a  href="index.php?view=BioPhotoZoom&type=photo&year=<?=$daterow['StartYear']?>&img=<?=$image?>" target="_blank" onclick="OpenWin(this.href, 'BioPhotoZoom', 850, 600); return false;" ><img src="../photos/<?=$daterow['StartYear']?>/ythumbs/y<?=$image?>.jpg" class="imageStyle"/></a></td>
			  </tr>
			</table>
			</div>
		    
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
			<button type="button" onclick="OnSaveForm('addPhotoEngine'); return false;" id="SaveButton">Save</button>
		  </td>
		</tr>
	  </table>
	
	</td>
  </tr>
</table>
</form>
<!--------------------- end bottom buttons----------------->  
 <!------------------------------------------ end of Add Photo ----------------------------------------------->
    </td>
    </tr>
    </table>
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
    