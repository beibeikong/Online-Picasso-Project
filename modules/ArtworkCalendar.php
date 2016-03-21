<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
class Calendar extends Database
{

     private $year;
     private $monthNames = array("January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December");                     
     private $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	 private $query;
	 private $yr;
	 
     function Calendar($y)
     {
	   parent::__construct(); 
	   $this->year = $y;
	   $this->query = "select count(*) from `ARTWORK` A where " ;
	   $this->yr = $y . "-";
	   
     }
    
     function getDaysInMonth($month, $year)
     {
         if ($month < 1 || $month > 12)
         {
             return 0;
         }
   
         $d = $this->daysInMonth[$month - 1];
   
         if ($month == 2)
         {
             if ($year%4 == 0)
             {
                 if ($year%100 == 0)
                 {
                     if ($year%400 == 0)
                     {
                         $d = 29;
                     }
                 }
                 else
                 {
                     $d = 29;
                 }
             }
         }
    
         return $d;
     }
	 
	 function checkMonth($m)
	 {
	   $monthName = $this->monthNames[$m - 1];
	   $mm = ($m>9) ? $m : "0$m";
	   $year_month_start = $this->yr  . $mm;
	   $year_month_end = $this->yr  . $mm;
	   $excepYM =  $this->yr . "00";
	   $sqlTimeConstraint = " date_format(dateStart,'%Y-%m') >= '" . $year_month_start . "' and date_format(dateEnd,'%Y-%m') <= '" . $year_month_end  . "' and date_format(dateEnd,'%Y-%m') != '" . $excepYM . "'";
	   
	   $query = $this->query.$sqlTimeConstraint;
	   $result = mysql_query($query);
	   $row = mysql_fetch_array($result);
	   if($row[0] >0)
	   {
$l = "index.php?view=ArtworkCaleSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=month&StartMonth=$m&StartYear=$this->year&EndMonth=$m&EndYear=$this->year&SortBy1=Chronology&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc";
		 return "<a href=\"$l\"  class=\"link1\" >$monthName</a>";
	   }
	   else
		 return $monthName;
	 }
	 
     function getMonthHTML($month)
     {
      $s = "";      
      $daysInMonth = $this->getDaysInMonth($month, $this->year);
	  $jd = cal_to_jd(CAL_GREGORIAN,$month,1,$this->year);     //calculates the Julian day count for the date
      $first = jddayofweek($jd,0); //this is to know which weekday the first day of this month is.


      $s .= "<table class=\"calendar\">\n";
      $s .= "<tr>\n";
      $s .= "<td colspan=\"7\" class=\"calendarHeader\">".$this->checkMonth($month)."</td>\n";
      $s .= "</tr><tr><td colspan=\"7\">&nbsp;</td></tr>";
      $s .= "<tr>\n";
      $s .= "<td align=\"center\" valign=\"top\" >Su</td>\n";
      $s .= "<td align=\"center\" valign=\"top\" >Mo</td>\n";
      $s .= "<td align=\"center\" valign=\"top\" >Tu</td>\n";
      $s .= "<td align=\"center\" valign=\"top\" >We</td>\n";
      $s .= "<td align=\"center\" valign=\"top\" >Th</td>\n";
      $s .= "<td align=\"center\" valign=\"top\" >Fr</td>\n";
      $s .= "<td align=\"center\" valign=\"top\" >Sa</td>\n";
      $s .= "</tr>\n";
     
      // We need to work out what date to start at so that the first appears in the correct column
      $d = 1 - $first;

         // Make sure we know when today is, so that we can use a different CSS style
     
      while ($d <= $daysInMonth)
      {
          $s .= "<tr>\n";       
         
          for ($i = 0; $i < 7; $i++)
          {
              $s .= "<td align=\"right\" valign=\"top\">";       
              if ($d > 0 && $d <= $daysInMonth)
              {
                  $flag = $this->verifyThisDay($month, $d); // verify if there are artworks on $month/$d/$year
				  if($flag==true) // exist
				  {
				    $l = "index.php?view=ArtworkCaleSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=$month&StartDay=$d&StartYear=$this->year&EndMonth=$month&EndDay=$d&EndYear=$this->year&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc";
					$s .= "<a href=\"$l\"  class=\"link1\" >$d</a>";
				  }
				  else
				  {
				    $s .= $d;
				  }
              }
              else
              {
                  $s .= "&nbsp;";
              }
                $s .= "</td>\n";       
              $d++;
          }
          $s .= "</tr>\n";    
      }
     
      $s .= "</table>\n";
     
      return $s; 
 
     }
	 
	 function verifyThisDay($m, $d)
	 {
	   	$mm = ($m>9) ? $m : "0$m";
		$dd = ($d>9) ? $d : "0$d";
		
		$start = $this->yr . $mm . "-$dd";
		$end = $this->yr . $mm . "-$dd";
		$excep1 =  $this->yr ."00-00";
		$excep2 =  $this->yr . $mm . "-00";
		$sqlTimeConstraint = "dateStart >= '$start' and dateEnd <= '$end' and dateEnd != '$excep1' and dateEnd != '$excep2 '";
		
		$query = $this->query.$sqlTimeConstraint;
		
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if($row[0] >0) return true; else return false;
	 }
	 
	 function getSeason($i)
	 {
	   if($i==5) {$startYr=$this->year; $endYr=$this->year+1;} else {$startYr=$this->year; $endYr=$this->year;}
	   switch($i)
	   {
	     case 1:
		   $start = $startYr . "-01-01";
		   $end =  $startYr . "-03-19";
		   $excep1 = $startYr ."-00-00";
		   $excep2 =  $startYr . "-03-00";
		   $startMonth = "01"; $startDay="01"; $endMonth="03"; $endDay="19";
		   $season = "Early";
		   break;
		 case 2:
		   $start = $startYr . "-03-20";
		   $end =  $startYr . "-06-20";
		   $excep1 = $startYr ."-00-00";
		   $excep2 =  $startYr . "-06-00";
		   $startMonth = "03"; $startDay="20"; $endMonth="06"; $endDay="20";
		   $season = "Spring";
		   break;
		 case 3:
		   $start = $startYr . "-06-21";
		   $end =  $startYr . "-09-21";
		   $excep1 = $startYr ."-00-00";
		   $excep2 =  $startYr . "-09-00";
		   $startMonth = "06"; $startDay="21"; $endMonth="09"; $endDay="21";
		   $season = "Summer";
		   break;
		 case 4:
		   $start = $startYr . "-09-22";
		   $end =  $startYr . "-12-20";
		   $excep1 = $startYr ."-00-00";
		   $excep2 =  $startYr . "-12-00";
		   $startMonth = "09"; $startDay="22"; $endMonth="12"; $endDay="20";
		   $season = "Fall";
		   break;
		 case 5:
		   $start = $startYr . "-12-21";
		   $end =  $endYr . "-03-19";
		   $excep1 = $endYr ."-00-00";
		   $excep2 =  $endYr . "-03-00";
		   $startMonth = "12"; $startDay="21"; $endMonth="03"; $endDay="19";
		   $season = "Winter";
		   break;  
	   }
	   
	   $sqlTimeConstraint = "dateStart >= '$start' and dateEnd <= '$end' and dateEnd != '$excep1' and dateEnd != '$excep2 '";
	   $query = $this->query.$sqlTimeConstraint;
	   $result = mysql_query($query);
	   $row = mysql_fetch_array($result);
	   if($row[0] >0)
	   {
	     $l = "index.php?view=ArtworkCaleSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=$startMonth&StartDay=$startDay&StartYear=$startYr&EndMonth=$endMonth&EndDay=$endDay&EndYear=$endYr&SortBy1=Chronology&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc";
		 echo "<a href=\"$l\"  class=\"link1\" >$season</a>";
	   }
	   else
		 echo $season;
	 }
}
?>