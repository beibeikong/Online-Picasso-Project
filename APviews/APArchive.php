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
<title>Authoring Portal - On-line Picasso Project</title>
<link rel="stylesheet" href="./APcss/main.css"/>
<link rel="stylesheet" href="./APcss/Reference.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'Archive.php');
$obj = new Archive($_GET['year']);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
?>
<center>
<?php include('APheader.htm'); ?>
<table width="990" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">	
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td width="40" align="center">&nbsp;</td>
			    <td><span class="big_year"><?=$_GET['year']?></span></td>
                <td width="40" align="center">&nbsp;
			    </td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
	            <td class="Active"><img src="./images/magnify-art.png"/>Archives</td>
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
    <td width="150px" align="left">
	  <table cellspacing="0" class="NavBar" align="left">
        <tr>
          <td><button type="button" onclick="addArchive(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
          <td style="padding-left:10px "><select size="1" name="year"  id="year" class="Letterselect" onchange="changeyear(window.location.href,'year');">
			<?php for($i=1930;$i<=date("Y");$i++) 
			if($i == $_GET['year'])
				  echo("<option value=\"$i\" selected>$i</option>");
				else
				  echo("<option value=\"$i\">$i</option>"); ?>
				</select>
		  </td>
		</tr>
      </table></td>
	
	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
	</td>
	
	<td width="150px" align="right" >
	  <table cellspacing="0" class="NavBar" align="right">
        <tr>
          <td><button type="button" onclick="RefreshPage();"><img src="./images/icon-reload.png" width="16" height="16" alt="" title="Reload List"/> Reload</button></td>
        </tr>
      </table></td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Archive ---------------------------->
<table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  <tr class="Header">
    <td><small>Modify</small></td>
    <td><small>Delete</small></td>
	<td>&nbsp;</td>
    <td>Title</td>
    <td>Publisher</td>
    <td colspan="2">Date</td>
    <td>Text</td>
  </tr>

<?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="EditArchive('<?=$row['id']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button></td>
    <td class="EditBtn"><button type="button" onclick="DeleteEntry('<?=$row['id']?>','deleteArchiveEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
    <td class="Language"><img src="./images/languagepin-<?=$row['Language']?>.png" width="16" height="16" alt="" title="<?=$obj->getLanguageName($row['Language'])?>"/></td>
	<td class="Title_Archive"><?=$row['Title']?></td>
	<td class="Author"><?=$row['Publisher']?></td>
	<td class="Date1"><?php if($row['Month']<10) echo "0".$row['Month']."/"; else echo $row['Month']."/"; if($row['Day']<10) echo "0".$row['Day']; else echo $row['Day']; if($row['DateFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
	<td class="Date2"><?=$row['DateDescription']?></td>
	<td class="Text"><div class="TextView"><?php $temp=trim($row['PartialText']); $temp=str_replace("&","&amp;",$temp);$temp=str_replace("\n"," ",$temp);$temp=str_replace("\r"," ",$temp);$temp=str_replace("<","&lt;",$temp);$temp=str_replace(">","&gt;",$temp); echo $temp;?></div></td>
  </tr>
<?php $i++; } ?>
</table>

<!---------------------------- End Archive ---------------------------->
				</td>
              </tr>
            </table>
		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include('APfooter.php'); ?>
</center>
</body>
</html>