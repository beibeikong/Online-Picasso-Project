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
<link rel="stylesheet" href="./APcss/Collaborator.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'FrontUsers.php');
$obj = new FrontUsers($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally
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
			    <td>&nbsp;</td>
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
	            <td class="Active"><img src="./images/magnify-art.png"/>Front Users </td>
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
          <td><button type="button" onclick="addFrontUser(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
        </tr>
      </table></td>
	
	<td>
	   	  <h2><?=$totalNum?> Front Users</h2>
		  <h3>Viewing items <?php echo(($page-1)*ITEMS_PER_PAGE+1)?> through <?php echo(min($page*ITEMS_PER_PAGE, $totalNum))?></h3>
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
<!---------------------------- Start Biography ---------------------------->
<table width="100%" align="center" cellpadding="0"  cellspacing="0">
  <tr>
    <!-- start column 1 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  		<tr class="Header">
    		<td class="EditBtn">Modify</td>
    		<td class="EditBtn">Delete</td>
    		<td class="category">User Name</td>
  		</tr>
  
		<?php $i = 1; while(($i<=15) && ($row = mysql_fetch_array($result))){ ?>  
  		<tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    		<td class="EditBtn"><button type="button" onclick="EditFrontUser('<?=$row['FrontUsername']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button></td>
    		<td class="EditBtn"><button type="button" onclick="DeleteEntry('<?=$row['FrontUsername']?>','deleteFrontUserEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
			<td class="category"><?=$row['FrontUsername']?></td>
  		</tr>
		<?php $i++; } ?>
	   </table>
   	</td>
    <!-- start column 2 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  		<tr class="Header">
    		<td class="EditBtn">Modify</td>
    		<td class="EditBtn">Delete</td>
    		<td class="category">User Name</td>
  		</tr>
  
		<?php $i = 16; while(($i<=30) && ($row = mysql_fetch_array($result))){ ?>  
  		<tr <?=($i%2==0)? "class=\"Even\"" : ""?>>
    		<td class="EditBtn"><button type="button" onclick="EditFrontUser('<?=$row['FrontUsername']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button></td>
    		<td class="EditBtn"><button type="button" onclick="DeleteEntry('<?=$row['FrontUsername']?>','deleteFrontUserEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
			<td class="category"><?=$row['FrontUsername']?></td>
  		</tr>
		<?php $i++; } ?>
	   </table>
   	</td>
  </tr>
</table>
<br/>
<!---------------------------- End Biography ---------------------------->
<!---------------------------- Start Page Navigator ---------------------------->
<?php
require_once(APMODULES_PATH.'PageNavigator.php');
$obj = new PageNavigator($totalPages, $page, $_SERVER['QUERY_STRING']);
$obj->showPgNavigator();
?>
<!---------------------------- End Page Navigator ---------------------------->
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
