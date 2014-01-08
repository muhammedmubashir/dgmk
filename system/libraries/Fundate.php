<?PHP

class Fundate{
    
    private $ice;
    
    public function __construct($ice=''){
        $this->ice = $ice;
    }
    
    function nextyear(){
        return strtotime("+1 year");
    }
	
	function currentYear(){
        return date("Y",time());
    }
    
    function check_date($date) {
        if(strlen($date) == 10) {
            $pattern = '/\.|\/|-/i';    // . or / or -
            preg_match($pattern, $date, $char);
           
            $array = preg_split($pattern, $date, -1, PREG_SPLIT_NO_EMPTY);
           
            if(strlen($array[2]) == 4) {
                // dd.mm.yyyy || dd-mm-yyyy
                if($char[0] == "."|| $char[0] == "-") {
                    $month = $array[1];
                    $day = $array[0];
                    $year = $array[2];
                }
                // mm/dd/yyyy    # Common U.S. writing
                if($char[0] == "/") {
                    $month = $array[0];
                    $day = $array[1];
                    $year = $array[2];
                }
            }
            // yyyy-mm-dd    # iso 8601
            if(strlen($array[0]) == 4 && $char[0] == "-") {
                $month = $array[1];
                $day = $array[2];
                $year = $array[0];
            }
            if(checkdate($month, $day, $year)) {    //Validate Gregorian date
                return TRUE;
           
            } else {
                return FALSE;
            }
        }else {
            return FALSE;    // more or less 10 chars
        }
    }
    
    public function is_date($date)
    {
        $date = str_replace(array('\'', '-', '.', ','), '/', $date);
        $date = explode('/', $date);

        if(    count($date) == 1 // No tokens
            and    is_numeric($date[0])
            and    $date[0] < 20991231 and
            (    checkdate(substr($date[0], 4, 2)
                        , substr($date[0], 6, 2)
                        , substr($date[0], 0, 4)))
        )
        {
            return true;
        }
       
        if(    count($date) == 3
            and    is_numeric($date[0])
            and    is_numeric($date[1])
            and is_numeric($date[2]) and
            (    checkdate($date[0], $date[1], $date[2]) //mmddyyyy
            or    checkdate($date[1], $date[0], $date[2]) //ddmmyyyy
            or    checkdate($date[1], $date[2], $date[0])) //yyyymmdd
        )
        {
            return true;
        }
       
        return false;
    } 
	
	
	function isLeapYear($year)
    { 
		return ((($year%4==0) && ($year%100)) || $year%400==0) ? (true):(false); 
	} 
    
    function time_since($original) {
        // array of time period chunks
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
        );
        
        $today = time(); /* Current unix time  */
        $since = $today - $original;
        
        if($since > 604800) {
            $print = date("M jS", $original);
        
            if($since > 31536000) {
                    $print .= ", " . date("Y", $original);
                }

            return $print;

        }
        
        // $j saves performing the count function each time around the loop
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            
            // finding the biggest chunk (if the chunk fits, break)
            if (($count = floor($since / $seconds)) != 0) {
                // DEBUG print "<!-- It's $name -->\n";
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

        return $print . " ago";

    }
    
    function printDate($dbtime_str){
        return date("d M, Y", strtotime($dbtime_str));
    }
    
    /**
     * Finds the difference in days between two calendar dates.
     *
     * @param Date $startDate
     * @param Date $endDate
     * @return Int
     */ 
    function dateDiff($startDate, $endDate)
    {
        // Parse dates for conversion
        $startArry = date_parse($startDate);
        $endArry = date_parse($endDate);

        // Convert dates to Julian Days
        $start_date = gregoriantojd($startArry["month"], $startArry["day"], $startArry["year"]);
        $end_date = gregoriantojd($endArry["month"], $endArry["day"], $endArry["year"]);

        // Return difference
        return round(($end_date - $start_date), 0);
    } 
    
    function getCurrentDate($format='',$data_str=''){
        if($format == '')
            $format = "d M, Y";
		
		if($data_str == '')
			 $data_str = time();
		else
			 $data_str = strtotime( $data_str );
        return date($format, $data_str);
    }
    
    function getFormatedDateTime($dbstr=''){
        if($dbstr == '')
            $dbstr1 = time();
        else{
            $dbstr1 = strtotime($dbstr);
        }
        return date("d M, Y - g:i:s", $dbstr1);
    }
    
    function unix_to_db_format($timestamp,$t4_hours=false){
		$format = 'Y-m-d g:i:s';
		if($t4_hours)
			$format = 'Y-m-d G:i:s';
        return date($format, $timestamp);
    }
    
    function isvalidDateTime($datetime_dbstr){
        if($datetime_dbstr == '0000-00-00 00:00:00'){
            return false;
        }
        return true;
    }
    
	/*
		$years = range(1900,2005)
	*/
	function comboYears($years,$current=0){
	
		if(!is_array($years)){
			die("Invalid years range");
		}
		
		if($current)
			$current = date("Y",strtotime($current));
		
		$s = "";
		$cnt = count($years);
		for($i = count($years) -1; $i >= 0 ; $i--){
			$slct = "";
			if($current == $years[$i]){
				$slct = "selected='selected'";
			}
			
			$s .= '<option value="'.$years[$i].'" '.$slct.'>'.$years[$i].'</option>';
		}
		return $s;
	}
	
	function comboDays($current=0,$is_time_stamp=false){
		$days = range (1, 31);
		
		if($current && $is_time_stamp == false)
			$current = date("j",strtotime($current));
		elseif($current  && $is_time_stamp)
			$current = date("j",$current);

		
		$s = "";
		foreach ($days as $value) {
			$slct = "";
			if($current == $value && $current != 0){
				$slct = "selected='selected'";
			}
			
			$s .= '<option value="'.$value.'" '.$slct.'>'.$value.'</option>';
		}
		return $s;
	}

	function comboMonths($current=0,$is_time_stamp=false){
		$months = array ('January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December');
		
		if($current && $is_time_stamp == false)
			$current = date("n",strtotime($current));
		elseif($current  && $is_time_stamp)
			$current = date("n",$current);
		
		$s = "";
		$month_num = 1;
		foreach ($months as $value) {
			$slct = "";
			if($current == $month_num){
				$slct = "selected='selected'";
			}
			
			$s .= '<option value="'.$month_num.'" '.$slct.'>'.$value.'</option>';
			$month_num++;
		}
		return $s;
	}
	
	
	function age($date_formatted){
		$iTimestamp =  strtotime($date_formatted);
		
		// See http://php.net/date for what the first arguments mean.
		$iDiffYear  = date('Y') - date('Y', $iTimestamp);
		$iDiffMonth = date('n') - date('n', $iTimestamp);
		$iDiffDay   = date('j') - date('j', $iTimestamp);
		
		// If birthday has not happen yet for this year, subtract 1.
		if ($iDiffMonth < 0 || ($iDiffMonth == 0 && $iDiffDay < 0))
		{
			$iDiffYear--;
		}
			
		return $iDiffYear;
	}  
	
	function ago($date_current_string) {
		 $c = getdate();
		 $p = array('year', 'mon', 'mday', 'hours', 'minutes', 'seconds');
		 $display = array('year', 'month', 'day', 'hour', 'minute', 'second');
		 $factor = array(0, 12, 30, 24, 60, 60);
		 $d = self::datetoarr($date_current_string);
		
		 $diff = 0;
		 for ($w = 0; $w < 6; $w++) {
			  if ($w > 0) {
				   $c[$p[$w]] += $c[$p[$w-1]] * $factor[$w];
				   $d[$p[$w]] += $d[$p[$w-1]] * $factor[$w];
			  }
			  
			  $current = $c[$p[$w]];
			  $calculated = $d[$p[$w]];
			  $diff = $current  - $calculated ;
			  if ($diff > 1) { 
					if($diff >= 24 && $display[$w] == "hour"){
						return "1 day ago";
					}elseif($diff >= 60 && $display[$w] == "minute"){
						return "1 hour ago";
					}elseif($diff >= 60 && $display[$w] == "second"){
						return "1 minute ago";
					}elseif($diff >= 12 && $display[$w] == "month"){
						return "1 year ago";
					}
				   return $diff .' '.$display[$w].'s ago';
			  }
		 }
		 if($diff==0){
			  return  "2 seconds ago";
		 }else{
		 	//return $date_current_string;
			return "a while ago";
		 }
	}
	
	
	function datetoarr($d) {
		preg_match("/([0-9]{4})(\\-)([0-9]{2})(\\-)([0-9]{2}) ([0-9]{2})(\\:)([0-9]{2})(\\:)([0-9]{2})/", $d, $matches);
		return array( 
			  'seconds' => $matches[10], 
			  'minutes' => $matches[8], 
			  'hours' => $matches[6],  
			  'mday' => $matches[5], 
			  'mon' => $matches[3],  
			  'year' => $matches[1], 
		 );
	}
	
	function dbDate($timestamp=''){
		if($timestamp == '' )
			$timestamp = time();
		return date("Y-m-d", $timestamp);
	}
    
    

}
?>