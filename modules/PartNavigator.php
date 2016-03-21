<?php if ( ! defined('PROJECTNAME')) exit(''); 
// this class is only for WritingInfo page
class PartNavigator
{
  private $page; // the # of current page
  private $totalPages;
  private $href;
  
  function __construct($totalPages, $currntPage, $href) 
  {
     $this->totalPages = $totalPages;
	 $this->page = $currntPage;
	 $this->href = $href;
  }
    
  public function showPgNavigator()
  {
    if($this->totalPages > 1)  // show page navigator
	{
	  echo("<table class=\"PageNavigator\" cellspacing=\"0\" align=\"center\">\n");
	  echo("  <tr>\n");
	  
	  //// start left arrow
	  echo("    <td class=\"Arrow\">\n");
	  if($this->page > 1) // display left arrow
	  {
	    $href = "index.php?".$this->href;
		$previousPage = $this->page - 1; 
	    $href = str_replace("part=".$this->page, "part=".$previousPage, $href);
        echo("<a href=\"$href\" title=\"Previous Page\"><img src=\"./images/arrow-left.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
	  }
	  else
	    echo("&nbsp;");
	  echo("    </td>\n");
	  //// end left arrow
	  
	  
	  
	  //// start page links
	  echo("    <td align=\"center\">\n");
	  echo("<h3>Part</h3>\n");
	  echo("<table class=\"PageLinks\" cellspacing=\"1\" align=\"center\">\n");
	  echo("<tr>\n");
	  
	  $this->showPageLinks();
	  
	  echo("  </tr>\n");
	  echo("</table>\n"); 
	  echo("    </td>\n");
	  //// end page links
	  
	  
	  
	  //// start right arrow
	  echo("    <td class=\"Arrow\">\n");
	  if($this->page < $this->totalPages) // display right arrow
	  {
	    $href = "index.php?".$this->href;
		$nextPage = $this->page + 1; 
		
		if(strstr($href, "part")==false) // can't find page parameter
		  $href .= "&part=2";
		else
		  $href = str_replace("part=".$this->page, "part=".$nextPage, $href);
		  
        echo("<a href=\"$href\" title=\"Next Page\"><img src=\"./images/arrow-right.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
	  }
	  else
	    echo("&nbsp;");
	  echo("    </td>\n");	  
	  //// end right arrow
	  
	  echo("  </tr>\n");
	  echo("</table>\n"); 
	}
  }
  
  public function showPageLinks()
  {
    $href = "index.php?".$this->href;
	$href = str_replace("&part=".$this->page, "", $href);
	
	if($this->totalPages <= 10)
	{
	  for($i=1; $i<=$this->totalPages; $i++)
	  {
		$temp_href = $href."&part=$i";
	    if($this->page==$i)
		  echo("<td><a href=\"$temp_href\" class=\"Current\">$i</a></td>");
		else
		  echo("<td><a href=\"$temp_href\">$i</a></td>");
	  }
	}
	elseif($this->page <=10) // totalPges more than 10 and current page less than 10
	{
	  for($i=1; $i<=10; $i++)
	  {
		$temp_href = $href."&part=$i";
	    if($this->page==$i)
		  echo("<td><a href=\"$temp_href\" class=\"Current\">$i</a></td>");
		else
		  echo("<td><a href=\"$temp_href\">$i</a></td>");
	  }
	  $temp_href = $href."&part=11";
	  echo("<td class=\"Next10\"><a href=\"$temp_href\">Next 10</a></td>");
	}
	else // totalPges more than 10 and current page greater than 10
	{
	  $temp_href = $href."&part=10";
	  echo("<td class=\"Prev10\"><a href=\"$temp_href\">Prev 10</a></td>");
	  
	  for($i=11; $i<=$this->totalPages; $i++)
	  {
		$temp_href = $href."&part=$i";
	    if($this->page==$i)
		  echo("<td><a href=\"$temp_href\" class=\"Current\">$i</a></td>");
		else
		  echo("<td><a href=\"$temp_href\">$i</a></td>");
	  }
	}
  }
  
  
} 
?>