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
<title>Authoring Portal -- On-line Picasso Project</title>
<link rel="stylesheet" href="./APcss/main.css"/>
<link rel="stylesheet" href="./APcss/homepage.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'homepage.php');
$obj = new Homepage();
$result = $obj->getData();
$row = mysql_fetch_array($result); 
?>
<center>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td id="FakeBodyHeader">
<table class="MainHeader" cellspacing="0" align="center">
	<tr>
		<td class="Emblem">
<img src="images/opp-emblem-innershadow.png" width="77" height="65" border="0" />
		</td>
		<td class="Title" colspan="5">
<img src="images/opp-title-innershadow.png" width="438" height="35" border="0"/>
		</td>
	</tr>
</table>
	<table class="MainHeader" cellspacing="0" align="center">
	<tr class="Links">
		<td width="100">&nbsp;</td>
		<td>
<a href="AuthorIndex.php?view=Menu" target="menuPopup" onclick="OpenSearchBox(this.href, this.target, 550, 280); return false;">menu</a>
		</td>
		<td class="Spacer">&nbsp;</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
<div id="OPPFloatingMenuContainer" class="OPPFloatingMenuContainer">
<iframe src="" border="0" name="OPPFloatingMenu" id="OPPFloatingMenu" frameborder="0" class="OPPFloatingMenu"></iframe>
</div>
<table width="760" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td  align="center" style="padding-top: 15px"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="324" align="left"><img src="./images/Picasso.jpg" width="324" height="450" /></td>
    <td valign="top">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="100" align="center" valign="bottom"  style="padding-bottom:20px"><span class="style1">Digital Catalogue Raisonné</span><br><br><span class="Citation"><b>Prof. Dr. Enrique Mallen, General Editor</b></span></td>
      </tr>
      <tr>
        <td><table width="90%"  border="0" cellspacing="0" cellpadding="0" align="center">
          <tr align="center" valign="top">
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArtworkCount"]));?></div><div class="title">Catalogued Artworks</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArtworkNoteCount"]));?></div><div class="title">Artwork Notes</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArtworkCommentaryCount"]));?></div><div class="title">Artwork Commentaries</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["CollectionsCount"]));?></div><div class="title">Listed Collections</div></td>
          </tr>
          <tr align="center" valign="bottom">
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["NarrativeCount"]));?></div><div class="title">Biographical Entries</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["NarrativeCommentaryCount"]));?></div><div class="title">Biographical Commentaries</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["RefsCount"]));?></div><div class="title">Selected References</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArchivesCount"]));?></div><div class="title">Archived Articles</div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="210">
		  	<div align="left" style="margin:10px 20px 3px 20px "><span class="Quote">“</span><span class="Citation">It is not enough to know an artist's works. One must also know when he did them, why, how, in what circumstances ... I attempt to leave as complete a documentation as possible for posterity.</span><span class="Quote">”</span></div>
			<div class="Citator">– Pablo Ruiz Picasso</div>
		</td>
      </tr>
    </table>   
	</td>
  </tr>
</table>
</td>
  </tr>
</table>
<table width="760" height="40" border="0" cellpadding="0" cellspacing="0" class="footer_table" align="center">
    <tr>
      <td>
		<table width="740" height="30" align="center" cellspacing="0">
          <tr>
            <td align="left">&nbsp;
		    </td>
			<td align="right">
			    &copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen
			</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</center>
</body>
</html>
