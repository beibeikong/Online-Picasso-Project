<?php if ( ! defined('PROJECTNAME')) exit(''); 

class PageNavigator
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
	    $href = str_replace("page=".$this->page, "page=".$previousPage, $href);
        echo("<a href=\"$href\" title=\"Previous Page\"><img src=\"./images/arrow-left.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
	  }
	  else
	    echo("&nbsp;");
	  echo("    </td>\n");
	  //// end left arrow
	  
	  
	  
	  //// start page links
	  echo("    <td align=\"center\">\n");
	  echo("<h3>Page</h3>\n");
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
		
		if(strstr($href, "page")==false) // can't find page parameter
		  $href .= "&page=2";
		else
		  $href = str_replace("page=".$this->page, "page=".$nextPage, $href);
		  
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
	$href = str_replace("&page=".$this->page, "", $href);
	
	$i = ceil($this->page / 10);
	$start = ($i-1)*10 + 1;
	$end = $i*10;
	if($end>$this->totalPages) $end = $this->totalPages;
	
	if($start > 10)
	{
	  $temp_i = $start-1;
	  $temp_href = $href."&page=$temp_i";
	  echo("<td class=\"Prev10\"><a href=\"$temp_href\">Prev 10</a></td>");
	}
	
	for($i=$start; $i<=$end; $i++)
	{
		$temp_href = $href."&page=$i";
	    if($this->page==$i)
		  echo("<td><a href=\"$temp_href\" class=\"Current\">$i</a></td>");
		else
		  echo("<td><a href=\"$temp_href\">$i</a></td>");
	}
	
	if($end < $this->totalPages)
	{
	  $temp_i = $end+1;
	  $temp_href = $href."&page=$temp_i";
	  echo("<td class=\"Prev10\"><a href=\"$temp_href\">Next 10</a></td>");
	}
	
  }

  
} 
?>