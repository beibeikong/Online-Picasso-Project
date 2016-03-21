<!---------------------------- this is the notes page ---------------------------->
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
<title></title>
 <link rel="stylesheet" href=" ./css/ArtworkCommentaryNew.css"/>
<link rel="stylesheet" href="./css/commentary.css"/>
<link rel="stylesheet" href="./css/Guide.css"/>
<link rel="stylesheet" href="./css/Collections.css"/>
  <script type="text/javascript" src=" ./js/popup.js"></script>
  <link rel="icon" href=" ./images/opp.ico" type="image/x-icon">
  <link rel="shortcut icon" href=" ./images/opp.ico" type="image/x-icon">
<link rel="stylesheet" href="./css/note.css"/>
</head>
<body>
<?php
require_once(MODULES_PATH.'ArtworkFormer.php');
$obj = new ArtworkFormer($_GET['OPPID']);
$result = $obj->getData();
?>
<table width="100%"  align="center" border="0">
<tr>
  <td  id="InfoHolder">
    <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
      <tr class="Tabs">
       <td class="Active"><img src="./images/magnify-text.png"/>Provenance</td>
        <td class="EmptySpace">&nbsp;</td>
		 <td class="EmptySpace">&nbsp;</td>
      </tr>
      <tr>
	    <td class="Container" colspan="3">
	      <table width="100%" cellpadding="0" cellspacing="0" border="0">
     		<?php $i=1;
			while ($row = mysql_fetch_array($result)) {?>
                            <?php if($i<=12) { ?>
				<tr>	
                                  <td class="Label"><label for="title"><? echo $i.':';?></label> </td>
				  <td align="left" style="border:1px dotted silver;" style="font-size:11px"><b><a href="index.php?view=FormerCollecArtworkSearchP&page=1&Keyword=<?=urlencode($row['collector'])?>&Location=&Date=&Amount=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973" class="collection" target="OPPMain"><?=$row['collector']?></a></b></td>
				  
				  <td style="border:1px dotted silver;" style="font-size:11px"><?=$row['location']?></td>
				  <td style="border:1px dotted silver;" style="font-size:11px"><?=$row['date']?></td>
				  <td style="border:1px dotted silver;" style="font-size:11px"><?=$row['amount']?></td>
				  <td style="border:1px dotted silver;" style="font-size:11px"><?=$row['num']?></td>
			        </tr> 
                            <?php  $i++; } else { ?>
                                 <tr>	
                                  <td class="Label"><label for="title"><? echo $i.':';?></label> </td>
                                  <td align="left" style="border:1px dotted silver;" style="font-size:11px"colspan="5">etc.</td>		
			        </tr>  
                            <?php break; } } ?>	
  		  </table>
		</td>
	  </tr> 	
      <tr><td>&nbsp;</td> <td>&nbsp;</td></tr>
	</table>
  </td>
</tr>
</table>
</body>
</html>