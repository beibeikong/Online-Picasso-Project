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
<title>Artworks - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/menu.css"/>
<script type="text/javascript" src="./APjs/menu.js"></script>
</head>

<body onload="Initialize('Biography Year Index'); AutoSizePopup();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Menu</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnExtrn" href="#" onclick="OpenWin(this.href,'OPPMenu',550,320); return false;">External Pop-Up</a></td>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<center>
<table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
  <tr class="Tabs">
  	<td class="Active"><img src="./images/magnify-art.png"/>Menu</td>
<td class="EmptySpace">&nbsp;</td><td class="EmptySpace">&nbsp;</td><td class="EmptySpace">&nbsp;</td>  </tr>
  
  <tr>
	<td class="Container" colspan="4">
	<table class="YearIndex" align="center">
      <tr>
        <td>
		  &bull;&nbsp;<a href="AuthorIndex.php?view=ArtworkDisplay&year=1881&SortBy=OPP&SortDirection=Asc" target="OPPMain">Artwork</a><br />
		  &bull;&nbsp;<a href="AuthorIndex.php?view=Biography&year=1881" target="OPPMain">Biography</a><br />
		  &bull;&nbsp;<a href= "AuthorIndex.php?view=GuideStyle&SortBy=Time&SortDirection=Asc" target="OPPMain">Overview</a><br />
		  &bull;&nbsp;Writings<br />
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AuthorIndex.php?view=WritingPoem" target="OPPMain">Poems</a><br />
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="AuthorIndex.php?view=WritingTerm&letter=A&lan=spa" target="OPPMain">Terms</a><br />
		  &bull;&nbsp;<a href="AuthorIndex.php?view=BioResource" target="OPPMain">Bio Resources</a><br />
		  &bull;&nbsp;<a href="AuthorIndex.php?view=LinkId&id=3" target="OPPMain">Link Ids</a><br />
		  &bull;&nbsp;<a href="AuthorIndex.php?view=References&letter=A" target="OPPMain">Literature</a><br />
		  &bull;&nbsp;<a href="AuthorIndex.php?view=Archive&year=1930" target="OPPMain">Archives</a><br />
		  &bull;&nbsp;<a href="AuthorIndex.php?view=FrontUser" target="OPPMain">Front Users</a></td>
      </tr>
    </table></td>
  </tr>
</table>
</center>

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
