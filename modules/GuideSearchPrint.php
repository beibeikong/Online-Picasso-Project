<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkSearchPrint extends Database
{
  private $p;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->p = $param;
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title, YEAR(dateStart) as year,duration,collection,inventory,dimension,bookCatalog,medium,location, notes,commentary from `ARTWORK` A where " ;

// === Generate Style constraint =======================================================
$sqlStyleConstraint = "";

for($i=0;$i<$this->p['stylenum'];$i++)
{
  $paraName = "StyleSearch$i";	
  if(isset($this->p[$paraName]))
  {
    $stylename = mysql_real_escape_string($this->p[$paraName]);
	$stylequery = "SELECT dateStart, dateEnd FROM `STYLE` WHERE guidename ='$stylename'";
	$styleresult = mysql_query($stylequery);
	$stylerow = mysql_fetch_array($styleresult);
	$tempstartdate = $stylerow['dateStart'];
	$tempenddate = $stylerow['dateEnd'];
    if ($sqlStyleConstraint !="")
	  $sqlStyleConstraint .= "OR (A.dateStart >= '$tempstartdate' AND A.dateEnd <= '$tempenddate')";  
    else
      $sqlStyleConstraint = "(A.dateStart >= '$tempstartdate' AND A.dateEnd <= '$tempenddate')"; 
  }    
}
if(strlen($sqlStyleConstraint)>0) $sqlStyleConstraint = "($sqlStyleConstraint)";
$tempquery = $sqlStyleConstraint;
// =======================================================================================================
// === Generate Theme constraint =======================================================
$sqlThemeConstraint = "";
$opp = array();
for($i=0;$i<$this->p['themenum'];$i++)
{
  $paraName = "ThemeSearch$i";	
  if(isset($this->p[$paraName]))
  {
    $themename = mysql_real_escape_string($this->p[$paraName]);
	$themequery = "SELECT opp FROM RLTN_THEME_ARTWORK WHERE guidename ='$themename' ORDER BY opp";
	$themeresult = mysql_query($themequery);	  
	while($themerow = mysql_fetch_array($themeresult))
	{
	  $tempopp = $themerow['opp'];
      if ($sqlThemeConstraint !="")
	    $sqlThemeConstraint .= ",'$tempopp'"; 
      else
        $sqlThemeConstraint = "'$tempopp'"; 
	}	  
  }    
}
if(strlen($sqlThemeConstraint)>0) $sqlThemeConstraint = "(A.opp in ($sqlThemeConstraint)) ";
if(strlen($tempquery)>0 && strlen($sqlThemeConstraint)>0) 
  $tempquery .= " and ".$sqlThemeConstraint;
else
  $tempquery .= $sqlThemeConstraint;
// =======================================================================================================
// === Generate technique constraints. ==================================================
$sqltechniqueConstraint = "";

for($i=1;$i<=12;$i++)
{
  $paraName = "CategorySearchIn$i";
  if(isset($this->p[$paraName]))
  {
    $category = mysql_real_escape_string($this->p[$paraName]);
	
    if ($sqltechniqueConstraint !="")
	  $sqltechniqueConstraint .= ",'$category'";  
    else
      $sqltechniqueConstraint = "'$category'"; 
  } 	  
}
if(strlen($sqltechniqueConstraint)>0) $sqltechniqueConstraint = "(A.category in ($sqltechniqueConstraint)) ";
if(strlen($tempquery)>0 && strlen($sqltechniqueConstraint)>0) 
  $tempquery .= " and ".$sqltechniqueConstraint;
else
  $tempquery .= $sqltechniqueConstraint;
// ==================================================================================	
  
    $sqlOrderBy = $this->generateSorting(); 
	$query .= $tempquery.$sqlOrderBy;
    //echo $query;
    $result = mysql_query($query)  or die($query); 
	return $result;	
  }
////////// end of public function getData() //////////////////////////////////////////////  

  private function generateSorting()
  {
    if($this->p['SortBy1'] == "Chronology")
    {
	  $direction = mysql_real_escape_string($this->p['SortDirection1']);
	  $sqlOrderBy = " order by dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
	}
	else if($this->p['SortBy1'] == "OPP")
	{
	  $direction = mysql_real_escape_string($this->p['SortDirection1']);
	  $sqlOrderBy = " order by year(dateStart) $direction, opp $direction ";
	}
	else if($this->p['SortBy1'] == "Category")
	{
	  $direction = mysql_real_escape_string($this->p['SortDirection1']);
	  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
	}
	else
	{
	  $sortby = mysql_real_escape_string($this->p['SortBy1']);
	  $direction = mysql_real_escape_string($this->p['SortDirection1']);
	  $sqlOrderBy = " order by $sortby $direction";
	}
	///////second one///////
	if($this->p['SortBy2']!=$this->p['SortBy1'])
	{
	  if($this->p['SortBy2'] == "Chronology")
	  {
	    $direction = mysql_real_escape_string($this->p['SortDirection2']);
	    $sqlOrderBy .= " ,dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
	  }
	  else if($this->p['SortBy2'] == "OPP")
	  {
	    $direction = mysql_real_escape_string($this->p['SortDirection2']);
	    $sqlOrderBy.= " ,year(dateStart) $direction, opp $direction ";
	  }
	  else if($this->p['SortBy2'] == "Category")
	  {
	    $direction = mysql_real_escape_string($this->p['SortDirection2']);
	    $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
	  }
	  else
	  {
	    $sortby = mysql_real_escape_string($this->p['SortBy2']);
	    $direction = mysql_real_escape_string($this->p['SortDirection2']);
	    $sqlOrderBy = " order by $sortby $direction";
 	  }
	}
    return $sqlOrderBy;
  }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->total = $totalNum[0];
	return $this->total;
  }
  
  public function getTotalPage()
  {
    return ceil($this->total/parent::ITEMS_PER_PAGE);
  }
  
  ///////for artwork search summary///////////////////
  public function sortBooks($books)
  {
    $array = explode("; ",$books);
    sort($array);
	if(count($array)==1)
	  return $array[0];
	else
	{
	  $result = $array[0];
	  for($i=1; $i<count($array); $i++)
	  {
	    if ($i>=30) { $result.="; etc."; break;}
		$result.= "; ".$array[$i];
	  }
	  return $result;
	}
  }  
  
/*  
//old sortBooks
  public function sortBooks($books)
  {
    $array = explode("; ",$books);
    sort($array);
	if(count($array)==1)
	  return $array[0];
	else
	{
	  $result = $array[0];
	  for($i=1; $i<count($array); $i++)
	  {
	    $result.= "; ".$array[$i];
	  }
	  return $result;
	}
  }
*/
  
  public function getCatalog($opp)
  {
    $catalog = array();
	$query = "SELECT Catalog, Volume, Number, Suffix FROM RLTN_WORKS_CATALOG WHERE idArtwork='$opp' ORDER BY Catalog ASC, Volume ASC, Number ASC, Suffix ASC";
	$result = mysql_query($query);
	while($cata = mysql_fetch_array($result))
	{
	  $temp = $cata['Catalog'];
	  $temp.= ($cata['Volume']!='')? ".$cata[Volume]":"";
	  if($cata['Catalog']=="PP")
	  {
	    if($cata['Number'] < 10) $temp.= ":00$cata[Number]";
		elseif($cata['Number'] < 100) $temp.= ":0$cata[Number]";
		else $temp.= ":$cata[Number]";
	  }
	  else
	    $temp.= ":$cata[Number]";
	  $temp.= $cata['Suffix'];
	  $catalog[] = $temp;
	}
	return $catalog;
  }

  
} 
?>