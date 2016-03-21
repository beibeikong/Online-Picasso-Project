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
<link rel="stylesheet" href=" ./css/ArtworkDetails.css"/>


<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
</head>
 
<body <?php if(isset($_GET['highlight'])) echo("onload=\"highlightSearchTerms('$_GET[highlight]','commentaryTable');\"");?>>
<?php
require_once(MODULES_PATH.'ArtworkInfo.php');
$obj = new ArtworkInfo($_GET['OPPID']);
$result = $obj->getData();
$row = mysql_fetch_array($result);

$temp=(string)$row['commentary'];
$temp= str_replace("&", "&amp;", $temp);

$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
 if(isset($_GET['page'])) $href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);
 $hrefForPrint = str_replace("ArtworkInfo", "ArtworkInfoPrint", $href_temp);
 $AcceptedTitle = $obj->getAcceptedTitle($row['title']);
?>


<div id="commentaryTable">
<table width="100%"  align="center" border="0">
<tr>
  <td  id="InfoHolder">
    <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
      <tr class="Tabs">
       <td class="Active"><img src="./images/magnify-text.png"/>Details</td>
       <td class="EmptySpace">&nbsp;</td>
      </tr>
			<tr>
       <td class="Container" colspan="2">
	       <table width="100%" cellpadding="0" cellspacing="0">
      	  <tr>
          <td class="InfoLabel">Title:</td>
	        <td class="Info"><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?></font></strong></td>
      	  </tr>
		  <?php if ( substr($row['title'],strlen($AcceptedTitle))!==FALSE) { ?>
		  <tr>
          <td class="InfoLabel">Alternate:</td>
		  
	        <td class="Info"><strong><font color="#800000"><?=$obj->parseTextTM(substr($row['title'],strlen($AcceptedTitle)))?></font></strong></td>
      	  </tr> 
		  <?php }
		  ?>
      	  <tr>
          <td class="InfoLabel">Location:</td> <td class="Info"><?=$row['location']?></td>
      	  </tr>
      	  <tr>
          <td class="InfoLabel">Date:</td> <td class="Info"><?=$row['duration']?></td>
      	  </tr>
      	  <tr>
          <td class="InfoLabel">Medium:</td> <td class="Info"><?=$obj->parseTextTM($row['medium'])?></td>
      	  </tr>
      	  <tr>
          <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$row['dimension']?></td>
      	  </tr>
          <?php if($row['collection']!='') { ?>
      	  <tr>
          <td class="InfoLabel">Collection:</td> <td class="Info"><a href="index.php?view=ArtworkSearchS&page=1&Keyword1=<?=$row['collection']?>&SearchIn1=Collection&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc" <?php echo("target=\"OPPMain\">".$row['collection']);?></a>. 
           <?php
	    if($row['inventory']!='')
	    { echo $row['inventory'];}
	    ?>
	        </td>
      	  </tr>
          <?php }?>
      	  <tr>
          <td class="InfoLabel">Catalogs:</td> 
          <td class="Info"><strong><font color="#800000"><?=$row['opp']?></font></strong><?php 
		$result1 = $obj->getCatalog($row['opp']);
	       foreach($result1 as $cata){
	  	if(substr($cata,0,3) === "testing")
              {
	   	echo("<a href=index.php?view=RefSearch&page=1&Keyword1=MPP&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPP")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPP&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPM")
              {
	       echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPM&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPB")
              {
	       echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPB&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPA")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPA&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,4) === "PP.L")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(PP.L)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "PP")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(PP)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "GC")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=GC&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "DB")
              {
	       echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=DB&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "DR")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=DR&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "CC")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=CC&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}		
		elseif(substr($cata,0,2) === "Ba")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=Ba&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "AR")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=AR&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "FM")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=FM&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "LD")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=LD&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "WS")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=WS&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "Z")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(Z)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "B")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(B)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "M")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(M)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "C")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(C)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,2) === "PS")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=PS&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,4) === "P.IV")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.IV&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}		
	       elseif(substr($cata,0,5) === "P.III")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.III&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,4) === "P.II")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.II&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,3) === "P.I")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.I&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		else 
              {
		echo("; ".$cata);
		}
	    }?>
      	</td>
        </tr>
	<?php if($row['bookCatalog']!=''){ ?>
         <tr>
          <td class="InfoLabel">Books:</td> 
             <td class="Info"><?$a=$obj->sortBooks($row['bookCatalog']);
		$words= explode(" ", $a );
		$j=0;
		for($q=0;$q<count($words);$q++){
		  //if ($j>=10){	echo(" etc."); break;}
		  $starPosition = strpos($words[$q],'*');
		  $colonPosition = strpos($words[$q],':');
		  if ($starPosition == false){
			if ($colonPosition == false)
			  $finalPosition = 5;
			  //$v = substr($words[$q], 0, 5);
			else
			  $finalPosition = $colonPosition;
			  //$v = substr($words[$q], 0, $pos);
		  }
		  else
		  	$finalPosition2 = $starPosition + 1;
                  
                   if ($starPosition == false){
		  $v = substr($words[$q], 0, $finalPosition);
		  echo(" "."<a href=index.php?view=RefSearch&page=1&Keyword1=".$v."&SearchIn1=Books&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$v."</a>");
		  
		  echo(substr($words[$q], $finalPosition, strlen($words[$q])));
                  }
                  else{
                  $v = substr($words[$q], 0, $finalPosition2);
		  echo(" "."<a href=index.php?view=RefSearch&page=1&Keyword1=".$v."&SearchIn1=Exhibitions&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$v."</a>");
		  
		  echo(substr($words[$q], $finalPosition2, strlen($words[$q])));
                  }
                  
		  $j++;
		}
	  }?>  
	</td>
      </tr>
                   
        <?php if(($row['bookCatalog']!='')&& (strpos($row['bookCatalog'],'*') !== false)) { ?>
        <tr>
          <td class="InfoLabel">Exhibited:</td> 
          <td class="Info"> <? $b = $obj->sortBooks($row['bookCatalog']);
             $word= explode(" ", $b );
             $k=0;
		for($p=0;$p<count($word);$p++){
		  $starPosition2 = strpos($word[$p],'*');
		  $colonPosition2 = strpos($word[$p],':');		  
                  if (strpos($word[$p], '*') == true){		  
                 
                    $finalPosition3 = $starPosition2 + 1;                           
		    $e = substr($word[$p], 0, $finalPosition3);		 
                    echo(($k==0 ? " " :"; ")."<a href=index.php?view=RefSearch&page=1&Keyword1=".$e."&SearchIn1=Exhibitions&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$e."</a>"); 
                    $exhib = rtrim($word[$p], ";");
                    echo (substr($exhib, $finalPosition3,strlen($word[$p]))); 
                   
                    $k++;
                    }
		}                 
             }?>
          </td>
      	  </tr>   
                   

				
		 </table>
		</td>
      </tr>
    </table>
  </td>
</tr>
</table>
</div>
</body>
</html>