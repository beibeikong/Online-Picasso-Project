<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="picasso, pablo picasso, picasso art, picasso paintings, picasso prints, picasso biography, picasso exhibitions"></meta>
<meta name="description" content="Digital Catalogue Raisonné, most comprehensive, authoritative resource, high quality Picasso artwork images"></meta>

<title>On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/homepage.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'homepage.php');
$obj = new Homepage();
$result = $obj->getData();
$row = mysql_fetch_array($result); 
?>
<center>
<?php include('header.htm'); ?>

<table width="760" border="0" cellspacing="0" cellpadding="3" class="main_body">
  <tr>
    <td  align="center" style="padding-top: 15px"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="324" align="left"><img src="./images/Picasso.jpg" width="324" height="450" /></td>
    <td valign="top">
    
     <br>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" align="center" valign="bottom"  style="padding-bottom:20px"><span class="style1">Digital Catalogue Raisonné</span><br><br><span class="Citation">
         <div align="center" style="margin:5px 5px 3px 5px "><span class="Quote"></span><span class="Citation">The most comprehensive, authoritative and interactive<br/> resource on the life and works of Pablo Ruiz Picasso</span><span class="Quote">
</div><br/>
         <b><font size="3">Prof. Dr. Enrique Mallen, ed. <br/>Online Picasso Project. <br/>Sam Houston State University. 1997-2016</b></font></span>

</td>
      </tr>
      <tr>
        <td>
		<table width="90%"  border="0" cellspacing="0" cellpadding="0" align="center">
          <tr align="center" valign="top">
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArtworkCount"]));?></div><div class="title">Catalogued <br/>Artworks</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArtworkNoteCount"]));?></div><div class="title">Artwork <br/>Notes</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArtworkCommentaryCount"]));?></div><div class="title">Artwork <br/>Commentaries</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["CollectionsCount"]));?></div><div class="title">Listed <br/>Collections</div></td>
          </tr>
          <tr align="center" valign="bottom">
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["NarrativeCount"]));?></div><div class="title">Biographical <br/>Entries</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["NarrativeCommentaryCount"]));?></div><div class="title">Biographical <br/>Commentaries</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["RefsCount"]));?></div><div class="title">Selected <br/>References</div></td>
            <td width="25%" height="60"><div class="summary"><?php echo(number_format($row["ArchivesCount"]));?></div><div class="title">Archived <br/>Articles</div></td>
          </tr>
        </table>
		</td>
	</tr>

<?php 
session_start();
$show="invalid";
if(!isset($_SESSION["FrontloginName"])) // unauthorized access
  $show="valid";
else if(!isset($_COOKIE["cookFRONTIT"])) // unauthorized access
  $show="valid";
else
{
  $value = $_COOKIE["cookFRONTIT"];
  $build = $_SESSION["FrontloginName"].$_SERVER['REMOTE_ADDR']."OPP";
  if($value!=md5($build)) 
    $show="valid"; // unauthorized access or a fake cookie or changed proxy
}  

?>

<tr>
<td width="204" height="10" align="left">&nbsp;&nbsp;
<?php
if($show=="valid")
{?>
<div>
<form action="frontlogin.php" method="post">
<table width="300"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100" height="30" align="right"><strong>Username:</strong></td>
  	<td width="204" height="10" align="left">&nbsp;&nbsp;
    <input name="frontusername" type="text" maxlength="20"></td>
  </tr>
  <tr>
    <td height="30" align="right"><strong>Password:</strong></td>
  	<td height="10" align="left">&nbsp;&nbsp;
    <input name="frontpassword" type="password" maxlength="20"></td>
  </tr>
  <tr align="center">
    <td height="30" colspan="2"><input type="submit" name="submit" value="Log In" style=" font-size:14px; color:maroon; font-weight:bold ">&nbsp;
      <input type="reset" value="Clear"></td>
  </tr>
</table>
</form>
</div>
<?php
}
?>

</td>
</tr>



      <tr>
        <td height="60">

		  	<div align="left" style="margin:10px 20px 3px 20px "><span class="Quote">“</span><span class="Citation">It is not enough to know an artist's works. One must also know when he did them, why, how, in what circumstances<br/> &nbsp;&nbsp; ... &nbsp;&nbsp; I attempt to leave as complete a documentation as possible for posterity. </span><span class="Quote">” &nbsp;&nbsp; – Pablo Ruiz Picasso</span>

</div>
			<center><div class="Citator"><br/><a href="http://www.shsu.edu" target="_blank" class="collaboration"><img border="0" alt="" src="./SHSU.jpg"></a></div></center>
                         
                        
      </td>
      </tr>

    </table>   
	</td>
  </tr>
</table>
</td>
  </tr>
</table><?php include('footer.php'); ?></center>

</body>
</html>
