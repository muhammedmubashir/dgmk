<?PHP
/**
 * Basic Cubes - Funcations.
 */
 	
	function isAjax() 
    {
	  return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
	}
	
	function isPost() 
    {
	 	if($_SERVER['REQUEST_METHOD'] == "POST")
        {
			return true;
		}
	}
    
     function unset_globals() {
        
         if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS']))
        {
            // Prevent malicious GLOBALS overload attack
            echo "Global variable overload attack detected! Request aborted.\n";

            // Exit with an error status
            exit("1");
        }
        
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            if(is_array($GLOBALS[$value])){
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
	
	 /**
	 * Convenience method for htmlspecialchars.
	 *
	 * @param string $text Text to wrap through htmlspecialchars
	 * @param string $charset Character set to use when escaping.  Defaults to config value in 'App.encoding' or 'UTF-8'
	 * @return string Wrapped text
	 * @link http://book.cakephp.org/view/703/h
	 */
	function h($text, $charset = '') {
		if (is_array($text)) {
			return array_map('h', $text);
		}
		if (empty($charset)) {
			$charset = 'UTF-8';
		}
		return htmlspecialchars($text, ENT_QUOTES, $charset);
	}
	
	/**
	 * Returns an array of all the given parameters.
	 *
	 * Example:
	 * <code>
	 * a('a', 'b')
	 * </code>
	 *
	 * Would return:
	 * <code>
	 * array('a', 'b')
	 * </code>
	 *
	 * @return array Array of given parameters
	 * @link http://book.cakephp.org/view/694/a
	 */
	function a() {
		$args = func_get_args();
		return $args;
	}
	
	/**
	 * Convenience method for strtolower().
	 *
	 * @param string $str String to lowercase
	 * @return string Lowercased string
	 * @link http://book.cakephp.org/view/705/low
	 */
	function low($str) {
		return strtolower($str);
	}

	/**
	 * Convenience method for strtoupper().
	 *
	 * @param string $str String to uppercase
	 * @return string Uppercased string
	 * @link http://book.cakephp.org/view/710/up
	 */
	function up($str) {
		return strtoupper($str);
	}

	/**
	 * Convenience method for str_replace().
	 *
	 * @param string $search String to be replaced
	 * @param string $replace String to insert
	 * @param string $subject String to search
	 * @return string Replaced string
	 * @link http://book.cakephp.org/view/708/r
	 */
	function r($search, $replace, $subject) {
		return str_replace($search, $replace, $subject);
	}
	
/*	function pre($var) {
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}   */
	
	/**
	 * Merge a group of arrays
	 *
	 * @param array First array
	 * @param array Second array
	 * @param array Third array
	 * @param array Etc...
	 * @return array All array parameters merged into one
	 * @link http://book.cakephp.org/view/696/am
	 */
	function am() {
		$r = array();
		$args = func_get_args();
		foreach ($args as $a) {
			if (!is_array($a)) {
				$a = array($a);
			}
			$r = array_merge($r, $a);
		}
		return $r;
	}
	
	/**
	 * Recursively strips slashes from all values in an array
	 *
	 * @param array $values Array of values to strip slashes
	 * @return mixed What is returned from calling stripslashes
	 * @link http://book.cakephp.org/view/709/stripslashes_deep
	 */
	function stripslashes_deep($values) {
		if (is_array($values)) {
			foreach ($values as $key => $value) {
				$values[$key] = stripslashes_deep($value);
			}
		} else {
			$values = stripslashes($values);
		}
		return $values;
	}
        
/*    function escape($v){
        if(!is_array($v)){
            return @mysql_real_escape_string($v);
        }else{
            return @array_map("mysql_real_escape_string",$v); 
        }
    }
         */
    function P($price,$currency=_DEFAULT_CURRENCY){
        return $currency . " " . N($price,2);
    }
    
    function ent($v){
        return htmlentities($v);
    }
        
    function N($number,$preciscion=2){
        return number_format($number,$preciscion);
    }    
        
    function ent_decode($c){
        echo html_entity_decode($c);
    }
    
   /* function safe($string){
        return escape(stripslashes($string));
    }
     */
    function admin_link($values='')
    {
        $ice = registry();
        
        $url = _ADMIN_URL;

        if(is_array($values)){  
            //can't change it - Manage functionality gets controller name in form action - By Default 
            if($values['section'] == '' || !isset($values['section']))
            {
                $values['section'] = $ice->controller;
            }
            
            if($values['action'] == '' || !isset($values['action']))
            {
                $values['action'] = $ice->action;
            }
        }

        if(is_array($values)){
            $querystring = http_build_query( $values );
            $url .= "?".$querystring;
        }else{
            $url .= "?".$values;
        }
        
        return $url;
    }

?>