<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class DatedArtworks extends Database
{
  private $startYear;
  private $startMonth;
  private $startDay;
  private $endYear;
  private $endMonth;
  private $endDay;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->startYear = mysql_real_escape_string($param['startYear']);
	$this->startMonth = mysql_real_escape_string($param['startMonth']);
	$this->startDay  = mysql_real_escape_string($param['startDay']);
	$this->endYear = mysql_real_escape_string($param['endYear']);
	$this->endMonth = mysql_real_escape_string($param['endMonth']);
	$this->endDay  = mysql_real_escape_string($param['endDay']);
	
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT opp,notVerified,category,title FROM `ARTWORK` WHERE YEAR(dateStart)=$this->startYear AND MONTH(dateStart)=$this->startMonth AND DAY(dateStart)=$this->startDay AND YEAR(dateEnd)=$this->endYear AND MONTH(dateEnd)=$this->endMonth AND DAY(dateEnd)=$this->endDay ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end" ;
	$result = mysql_query($query);
	return $result;
  }

} 
?>