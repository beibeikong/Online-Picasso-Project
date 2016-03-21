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
<title>Overview - On-line Picasso Project</title>

<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/GuideList.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'GuideList.php');
$obj = new GuideList();
$ThemeList = $obj->getTheme();
$themenum = count($ThemeList);
$StyleList = $obj->getStyle();
$stylenum = count($StyleList);
?>
<center>
<?php include('header.htm'); ?>
<table width="760" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">	
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td width="40" align="center">&nbsp;</td>
		      </tr>
	        </table>
	      </td>
        </tr>

		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Active"><img src="./images/magnify-text.png"/>Overview</td> 
  	            <td class="Inactive"><a href="index.php?view=GuideMaster"/><img src="./images/magnify-text.png"/>Artists</a></td> 
				<td class="Inactive"><a href="index.php?view=MenuListsSearch&category=painting_collage_photograph_sculpture_ceramic_drawing_watercolor_gouache_pastel_engraving_lithograph_other" target="menuPopup" onclick="OpenSearchBox(this.href, this.target, 550, 120); return false;"><img src="./images/magnify-text.png"/>Lists</a></td>
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">
<!---------------------------- starting heading2 ---------------------------->
<br/>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!----------------------- start search form----------------------->
<form method="get" action="index.php" target="OPPMain" name="GuideSearchForm" id="GuideSearchForm">
	<input type="text" name="view" id="view" size="1" value="GuideSearchS" style=" display:none"/>
	<table class="SearchForm" id="GuideSearch" cellspacing="0" align="center" width="100%">
	<!-- Starts Style search -->
	<tr>
	  <td class="fieldLabel">Periods: </td>
		<td class="fieldCtrls">
			<div class="ScrollArea" id="StyleTable">
			<table cellspacing="0" width="100%">
			<tr>
				<td width="33%">
				  <table>
				  <?php $i=0; while($i <= ceil($stylenum/3)-1) { ?>
				  	<tr>
						<td><input name="StyleSearch<?=$i?>" type="checkbox" value="<?=$StyleList[$i]?>" />
							<?=$StyleList[$i]?>
						</td>
				  	</tr>				  
				  <?php $i++; } ?>
				  </table>
				</td>
				
				<td width="33%">
				  <table>
				  <?php while($i <= 2*ceil($stylenum/3)-1) { ?>
				  	<tr>
						<td><input name="StyleSearch<?=$i?>" type="checkbox" value="<?=$StyleList[$i]?>" />
							<?=$StyleList[$i]?>
						</td>
				  	</tr>			  
				  <?php $i++; } ?>
				  </table>
				</td>
				
				<td width="34%">
				  <table>
				  <?php while($i < 3*ceil($stylenum/3)) { ?>
				  	<tr>
						<td><?php if($i < $stylenum) { ?><input name="StyleSearch<?=$i?>" type="checkbox" value="<?=$StyleList[$i]?>" />
							<?=$StyleList[$i]?>
							<?php } else echo("&nbsp;");?>
						</td>
				  	</tr>			  
				  <?php $i++; } ?>
				  </table>
				</td>
			</tr>
			</table>
			</div>
		</td>
	</tr>
	<!-- Ends Style search -->	
	<!-- Starts Theme search -->
	<tr>
	  <td class="fieldLabel">Themes: </td>
		<td class="fieldCtrls">
			<div class="ScrollArea" id="ThemeTable">
			<table cellspacing="0" width="100%">
			<tr>
				<td width="33%">
				  <table>
				  <?php $j=0; while($j <= ceil($themenum/3)-1) { ?>
				  	<tr>
						<td><input name="ThemeSearch<?=$j?>" type="checkbox" value="<?=$ThemeList[$j]?>" />
							<?=$ThemeList[$j]?>
						</td>
				  	</tr>				  
				  <?php $j++; } ?>
				  </table>
				</td>
				
				<td width="33%">
				  <table>
				  <?php while($j <= 2*ceil($themenum/3)-1) { ?>
				  	<tr>
						<td><input name="ThemeSearch<?=$i?>" type="checkbox" value="<?=$ThemeList[$j]?>" />
							<?=$ThemeList[$j]?>
						</td>
				  	</tr>			  
				  <?php $j++; } ?>
				  </table>
				</td>
				
				<td width="34%">
				  <table>
				  <?php while($j < 3*ceil($themenum/3)) { ?>
				  	<tr>
						<td><?php if($j < $themenum) { ?><input name="ThemeSearch<?=$j?>" type="checkbox" value="<?=$ThemeList[$j]?>" />
							<?=$ThemeList[$j]?>
							<?php } else echo("&nbsp;");?>
						</td>
				  	</tr>			  
				  <?php $j++; } ?>
				  </table>
				</td>
			</tr>
			</table>
			</div>
		</td>
	</tr>			
	<!-- Ends Theme search -->	
    <!-- Starts Technique search -->
	<tr>
	  <td class="fieldLabel">Categories: </td>
		<td class="fieldCtrls">
			<!-- <form action="" method="get" name="TechniqueList" id="TechniqueList"> -->
			<table cellspacing="0" width="100%">
				<tr>
                     <td style= "width:32%">&nbsp;<input name="CategorySearchIn1" id="CategorySearchIn1"  type="checkbox" value="painting" checked="checked"  />
                     painting</td>
                     <td width="32%">&nbsp;<input name="CategorySearchIn6" id="CategorySearchIn6" type="checkbox" value="drawing" checked="checked"  />
                     drawing</td>
                     <td width="34%">&nbsp;<input name="CategorySearchIn8" id="CategorySearchIn8" type="checkbox" value="gouache" checked="checked"  />
                     gouache</td><td><input type="checkbox" onchange="checkAll(this)" checked="checked" align="right"/></td>
				</tr>
				<tr>					 
		     <td width="95">&nbsp;<input name="CategorySearchIn9" id="CategorySearchIn9" type="checkbox" value="pastel" checked="checked"  />
		     pastel</td>
    		     <td width="95">&nbsp;<input name="CategorySearchIn7" id="CategorySearchIn7" type="checkbox" value="watercolor" checked="checked"  />
                     watercolor</td>
                     <td width="95">&nbsp;<input name="CategorySearchIn4" id="CategorySearchIn4" type="checkbox" value="sculpture" checked="checked"  />
                     sculpture</td>
				</tr>
				<tr>
                     <td>&nbsp;<input name="CategorySearchIn2" id="CategorySearchIn2" type="checkbox" value="collage" checked="checked"  />
                     collage</td>
                     <td>&nbsp;<input name="CategorySearchIn3" id="CategorySearchIn3" type="checkbox" value="photograph" checked="checked"  />
                     photograph</td>
                     <td>&nbsp;<input name="CategorySearchIn10" id="CategorySearchIn10" type="checkbox" value="engraving" checked="checked"  />
                     engraving</td>
				</tr>
				<tr>
                     <td>&nbsp;<input name="CategorySearchIn11" id="CategorySearchIn11" type="checkbox" value="lithograph" checked="checked"  />
                     lithograph</td>
                     <td>&nbsp;<input name="CategorySearchIn5" id="CategorySearchIn5" type="checkbox" value="ceramic" checked="checked"  />
                     ceramic</td>
                     <td>&nbsp;<input name="CategorySearchIn12"id="CategorySearchIn12"  type="checkbox" value="other" checked="checked"  />
                     other</td>
         		</tr>
			</table>
			<!-- </form> -->
		</td>
	</tr>
	<!-- Ends Technique search -->

	<!-- Starts sorting -->
	<tr><td class="fieldLabel">Sorting: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
				<tr><td>1. </td>
					<td>	<select size="1" name="SortBy1"><option>OPP</option><option>Chronology</option><option>Title</option><option>Location</option><option>Medium</option><option>Dimension</option><option>Collection</option><option>Category</option></select>
						<select size="1" name="CatalogSort1" id="CatalogSort1" style="display:none">
							<?php
							while($row = mysql_fetch_array($result))
							{
							  if($row['Catalog']!=$catalog)  // new catalog
							  {
							    $catalog = $row['Catalog'];
								echo("<option value=\"$catalog\" title=\"$row[CatalogName]\">$catalog</option>");
							  }
							}
							mysql_data_seek ( $result, 0);
							?>
						</select>
					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection1" id="Order1a" checked="true"/> <label for="Order1a"> Ascending</label>&nbsp;</td>
					<td>	<input type="radio" value="Desc" name="SortDirection1" id="Order1d"               /> <label for="Order1d"> Descending</label>	</td>
				</tr>
				<tr><td>2. </td>
					<td>	<select size="1" name="SortBy2"><option>OPP</option><option>Chronology</option><option>Title</option><option>Location</option><option>Medium</option><option>Dimension</option><option>Collection</option><option>Category</option></select>
					    <select size="1" name="CatalogSort2" id="CatalogSort2" style=" display:none">
							<?php
							while($row = mysql_fetch_array($result))
							{
							  if($row['Catalog']!=$catalog)  // new catalog
							  {
							    $catalog = $row['Catalog'];
								echo("<option value=\"$catalog\" title=\"$row[CatalogName]\">$catalog</option>");
							  }
							}
							mysql_data_seek ( $result, 0);
							?>
						</select>


					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection2" id="Order2a" checked="true"/> <label for="Order2a"> Ascending</label>&nbsp;	</td>
					<td>	<input type="radio" value="Desc" name="SortDirection2" id="Order2d"               /> <label for="Order2d"> Descending</label>	</td>
				</tr>
			</table>
			<input type="text" name="stylenum" id="stylenum" size="1" value="<?=$stylenum?>" style=" display:none"/>	
			<input type="text" name="themenum" id="themenum" size="1" value="<?=$themenum?>" style=" display:none"/>			
		</td>
	</tr>
	<!-- Ends sorting -->

	<tr><td class="submitArea" colspan="2">
			<input type="submit" value="Search" id="FormSubmit"/>
			<input type="reset"  value="Reset"  id="FormReset"/>
		</td>
	</tr>
	<!-- Ends submit -->
	</table>
</form>

<!----------------------- end of search form----------------------->
				</td>
              </tr>				
            </table>
		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include('footer.php'); ?>
</center>
</body>
</html>
