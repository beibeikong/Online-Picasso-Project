<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Artworks Year Index - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/menu.css"/>
<link rel="stylesheet" href="./css/ArtworkDisplay.css"/>
<script type="text/javascript" src="./js/ArtworkDisplay.js"></script>
<script type="text/javascript" src="./js/menu.js"></script>
</head>

<body onload="Initialize('Biography Year Index'); AutoSizePopup();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Artworks</td>
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
  	<td class="Active"><img src="./images/magnify-art.png"/>Chronology</td>
	<td class="Inactive"><a href="index.php?view=MenuArtworksSearch"><img src="./images/magnify-text.png"/>Search</a></td>
	<td class="Inactive"><a href="index.php?view=MenuArtworksConcordance&category=painting_watercolor_collage_gouache_photograph_pastel_sculpture_engraving_ceramic_lithograph_drawing_other"><img src="./images/magnify-text.png"/>Concordance</a></td>
	<td class="Inactive"><a href="index.php?view=MenuArtworksCalendar"><img src="./images/magnify-text.png"/>Calendar</a></td>
  </tr>

  <tr>
	<td class="Container" colspan="4">
	<table class="YearIndex" align="center">
      <tr>
        <td>&nbsp;</td>
        <td>1881</td>
        <td>1882</td>
        <td>1883</td>
        <td>1884</td>
        <td>1885</td>
        <td>1886</td>
        <td>1887</td>
        <td>1888</td>
        <td><a href="index.php?view=ArtworkDisplay&year=1889&category=<?echo $_GET['category'];?>" target="OPPMain">1889</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1890&category=<?echo $_GET['category'];?>" target="OPPMain">1890</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1891&category=<?echo $_GET['category'];?>" target="OPPMain">1891</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1892&category=<?echo $_GET['category'];?>" target="OPPMain">1892</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1893&category=<?echo $_GET['category'];?>" target="OPPMain">1893</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1894&category=<?echo $_GET['category'];?>" target="OPPMain">1894</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1895&category=<?echo $_GET['category'];?>" target="OPPMain">1895</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1896&category=<?echo $_GET['category'];?>" target="OPPMain">1896</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1897&category=<?echo $_GET['category'];?>" target="OPPMain">1897</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1898&category=<?echo $_GET['category'];?>" target="OPPMain">1898</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1899&category=<?echo $_GET['category'];?>" target="OPPMain">1899</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1900&category=<?echo $_GET['category'];?>" target="OPPMain">1900</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1901&category=<?echo $_GET['category'];?>" target="OPPMain">1901</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1902&category=<?echo $_GET['category'];?>" target="OPPMain">1902</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1903&category=<?echo $_GET['category'];?>" target="OPPMain">1903</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1904&category=<?echo $_GET['category'];?>" target="OPPMain">1904</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1905&category=<?echo $_GET['category'];?>" target="OPPMain">1905</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1906&category=<?echo $_GET['category'];?>" target="OPPMain">1906</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1907&category=<?echo $_GET['category'];?>" target="OPPMain">1907</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1908&category=<?echo $_GET['category'];?>" target="OPPMain">1908</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1909&category=<?echo $_GET['category'];?>" target="OPPMain">1909</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1910&category=<?echo $_GET['category'];?>" target="OPPMain">1910</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1911&category=<?echo $_GET['category'];?>" target="OPPMain">1911</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1912&category=<?echo $_GET['category'];?>" target="OPPMain">1912</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1913&category=<?echo $_GET['category'];?>" target="OPPMain">1913</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1914&category=<?echo $_GET['category'];?>" target="OPPMain">1914</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1915&category=<?echo $_GET['category'];?>" target="OPPMain">1915</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1916&category=<?echo $_GET['category'];?>" target="OPPMain">1916</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1917&category=<?echo $_GET['category'];?>" target="OPPMain">1917</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1918&category=<?echo $_GET['category'];?>" target="OPPMain">1918</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1919&category=<?echo $_GET['category'];?>" target="OPPMain">1919</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1920&category=<?echo $_GET['category'];?>" target="OPPMain">1920</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1921&category=<?echo $_GET['category'];?>" target="OPPMain">1921</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1922&category=<?echo $_GET['category'];?>" target="OPPMain">1922</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1923&category=<?echo $_GET['category'];?>" target="OPPMain">1923</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1924&category=<?echo $_GET['category'];?>" target="OPPMain">1924</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1925&category=<?echo $_GET['category'];?>" target="OPPMain">1925</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1926&category=<?echo $_GET['category'];?>" target="OPPMain">1926</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1927&category=<?echo $_GET['category'];?>" target="OPPMain">1927</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1928&category=<?echo $_GET['category'];?>" target="OPPMain">1928</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1929&category=<?echo $_GET['category'];?>" target="OPPMain">1929</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1930&category=<?echo $_GET['category'];?>" target="OPPMain">1930</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1931&category=<?echo $_GET['category'];?>" target="OPPMain">1931</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1932&category=<?echo $_GET['category'];?>" target="OPPMain">1932</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1933&category=<?echo $_GET['category'];?>" target="OPPMain">1933</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1934&category=<?echo $_GET['category'];?>" target="OPPMain">1934</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1935&category=<?echo $_GET['category'];?>" target="OPPMain">1935</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1936&category=<?echo $_GET['category'];?>" target="OPPMain">1936</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1937&category=<?echo $_GET['category'];?>" target="OPPMain">1937</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1938&category=<?echo $_GET['category'];?>" target="OPPMain">1938</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1939&category=<?echo $_GET['category'];?>" target="OPPMain">1939</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1940&category=<?echo $_GET['category'];?>" target="OPPMain">1940</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1941&category=<?echo $_GET['category'];?>" target="OPPMain">1941</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1942&category=<?echo $_GET['category'];?>" target="OPPMain">1942</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1943&category=<?echo $_GET['category'];?>" target="OPPMain">1943</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1944&category=<?echo $_GET['category'];?>" target="OPPMain">1944</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1945&category=<?echo $_GET['category'];?>" target="OPPMain">1945</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1946&category=<?echo $_GET['category'];?>" target="OPPMain">1946</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1947&category=<?echo $_GET['category'];?>" target="OPPMain">1947</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1948&category=<?echo $_GET['category'];?>" target="OPPMain">1948</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1949&category=<?echo $_GET['category'];?>" target="OPPMain">1949</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1950&category=<?echo $_GET['category'];?>" target="OPPMain">1950</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1951&category=<?echo $_GET['category'];?>" target="OPPMain">1951</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1952&category=<?echo $_GET['category'];?>" target="OPPMain">1952</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1953&category=<?echo $_GET['category'];?>" target="OPPMain">1953</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1954&category=<?echo $_GET['category'];?>" target="OPPMain">1954</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1955&category=<?echo $_GET['category'];?>" target="OPPMain">1955</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1956&category=<?echo $_GET['category'];?>" target="OPPMain">1956</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1957&category=<?echo $_GET['category'];?>" target="OPPMain">1957</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1958&category=<?echo $_GET['category'];?>" target="OPPMain">1958</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1959&category=<?echo $_GET['category'];?>" target="OPPMain">1959</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1960&category=<?echo $_GET['category'];?>" target="OPPMain">1960</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1961&category=<?echo $_GET['category'];?>" target="OPPMain">1961</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1962&category=<?echo $_GET['category'];?>" target="OPPMain">1962</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1963&category=<?echo $_GET['category'];?>" target="OPPMain">1963</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1964&category=<?echo $_GET['category'];?>" target="OPPMain">1964</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1965&category=<?echo $_GET['category'];?>" target="OPPMain">1965</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1966&category=<?echo $_GET['category'];?>" target="OPPMain">1966</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1967&category=<?echo $_GET['category'];?>" target="OPPMain">1967</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1968&category=<?echo $_GET['category'];?>" target="OPPMain">1968</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1969&category=<?echo $_GET['category'];?>" target="OPPMain">1969</a></td>
      </tr>
      <tr>
        <td><a href="index.php?view=ArtworkDisplay&year=1970&category=<?echo $_GET['category'];?>" target="OPPMain">1970</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1971&category=<?echo $_GET['category'];?>" target="OPPMain">1971</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1972&category=<?echo $_GET['category'];?>" target="OPPMain">1972</a></td>
        <td><a href="index.php?view=ArtworkDisplay&year=1973&category=<?echo $_GET['category'];?>" target="OPPMain">1973</a></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<br/>
<!---------------------------- starting Category  ---------------------------->
<table width="505" align="center" cellpadding="0" cellspacing="2" style="border-width:1px; border-color: silver; border-style: solid;">
  <tr height="20" align="left" valign="middle">
    <td width="20" >&nbsp;</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "painting"))? "checked":"" ?> onclick="refresh(window.location.href, 'painting'); return false;"/>painting</td>
    <td width="100" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "drawing"))? "checked":"" ?> onclick="refresh(window.location.href, 'drawing'); return false;"/>drawing</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "gouache"))? "checked":"" ?> onclick="refresh(window.location.href, 'gouache'); return false;"/>gouache</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "pastel"))? "checked":"" ?> onclick="refresh(window.location.href, 'pastel'); return false;"/>pastel</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "watercolor"))? "checked":"" ?> onclick="refresh(window.location.href, 'watercolor'); return false;"/>watercolor</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "sculpture"))? "checked":"" ?> onclick="refresh(window.location.href, 'sculpture'); return false;"/>sculpture</td>
  </tr>
  <tr height="20" align="left" valign="middle">
    <td width="20" >&nbsp;</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "collage"))? "checked":"" ?> onclick="refresh(window.location.href, 'collage'); return false;"/>collage</td>
    <td width="100" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "photograph"))? "checked":"" ?> onclick="refresh(window.location.href, 'photograph'); return false;"/>photograph</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "engraving"))? "checked":"" ?> onclick="refresh(window.location.href, 'engraving'); return false;"/>engraving</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "lithograph"))? "checked":"" ?> onclick="refresh(window.location.href, 'lithograph'); return false;"/>lithograph</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "ceramic"))? "checked":"" ?> onclick="refresh(window.location.href, 'ceramic'); return false;"/>ceramic</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "other"))? "checked":"" ?> onclick="refresh(window.location.href, 'other'); return false;"/>other</td>
  </tr>
</table>
<br/>
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
