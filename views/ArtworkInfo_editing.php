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
  <title>Artwork Details - <?=PROJECTNAME?></title>
  <link rel="stylesheet" href=" ./css/popup.css"/>
  <link rel="stylesheet" href=" ./css/ArtworkInfo.css"/>
  <link rel="stylesheet" href=" ./css/Reference.css"/>
  <script type="text/javascript" src="./js/main.js"></script>
  <script type="text/javascript" src=" ./js/popup.js"></script>
  <link rel="icon" href=" ./images/opp.ico" type="image/x-icon">
  <link rel="shortcut icon" href=" ./images/opp.ico" type="image/x-icon">
 </head>

 <body onresize="resizeNote();">
 <?php
 require_once(MODULES_PATH.'ArtworkInfo.php');
 $obj = new ArtworkInfo($_GET['OPPID']);
 $result = $obj->getData();
 $row = mysql_fetch_array($result);
 $mastercount = $obj->countmaster($row['opp']);
 $relationcount = $obj->countrelation($row['opp']);
 $formercount = $obj->formercollec($row['opp']);
 $href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
 if(isset($_GET['page'])) $href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);
 $hrefForPrint = str_replace("ArtworkInfo", "ArtworkInfoPrint", $href_temp);
 ?>
 <table class="HeaderBar" cellspacing="0">
  <tr>
   <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
   <td class="Title">Artwork</td>
   <td class="dropdown">
     <table cellspacing="0" align="right">
     <tr>
      <td> <a id="NtAndComtry" button class="dropbtn">Menu</button></td>
      <div class="dropdown-content">
      <a href="#">Link 1</a>
      </div>
      <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
     </tr>
    </table>
  </td>
   </tr>
  </table>

<!---------------------------- start Artwork Details ---------------------------->
<table id="ArtworkInfo" cellspacing="0" align="center" width="100%" border="0">
  <tr>
   <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?>
    <td id="ImgHolder"><br /><a href="./index.php?view=zoom&random=<?=$row['startyear']*23?>&alpha=<?=$obj->imgName($row['opp'])?>.jpg" target="_blank"  onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?=$row['startyear']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/></a>
   <?php }
   else {
   		?>
		<td id="ImgHolder"><br /><img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/>
		<?php } 
		?>
   <br/><small><font color="#808080">Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</font></small>
    </td>
      <?php  }
	  ?>
    <td  align="left" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=ArtworkDetails&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="left" width="97%" height="450px"  scrolling="auto" frameborder="0"> </iframe>
    </td>
  </tr>
</table>
    
	
<!---------------------------- end of Artwork Details ---------------------------->
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

