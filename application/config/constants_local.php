<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Facebook App Id and App secret
|------------------------------------------------------------------------
| These constants are used when communicating with facebook API's

define('APP_ID',"293209490714573");
define('APP_SECRET',"a6ed035a6e6fa86370008f932fbb7e3f");
*/
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('ACHIVED_PERCENTAGE',"70");

$settings = array();
$settings['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$settings['base_url'] .= "://".$_SERVER['HTTP_HOST'];
$settings['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('_DATA_DIR_PATH', $settings['base_url']);


//define('_DIR_DOCTORS',DOC_ROOT.'medical/img/doctors/'); // LIVE Settings On Ephunics
define('_DIR_DOCTORS',DOC_ROOT.'clinic_project/img/doctors/'); // Local Settings
define('_URL_DOCTORS',_DATA_DIR_PATH.'img/doctors/');
    define ('DOCTORS_IMAGE_W', 500);
    define ('DOCTORS_IMAGE_H', 300);
    define ('DOCTORS_THUMB_W', 200);
    define ('DOCTORS_THUMB_H', 200);

//define('_DIR_DOCTORS',DOC_ROOT.'medical/img/patients/'); // LIVE Settings On Ephunics
define('_DIR_PATIENTS',DOC_ROOT.'clinic_project/img/patients/'); // Local Settings
define('_URL_PATIENTS',_DATA_DIR_PATH.'img/patients/');
    define ('PATIENTS_IMAGE_W', 500);
    define ('PATIENTS_IMAGE_H', 300);
    define ('PATIENTS_THUMB_W', 200);
    define ('PATIENTS_THUMB_H', 200);
    
   
//define('_DIR_DOCTORS',DOC_ROOT.'medical/img/patient_medical_histories/'); // LIVE Settings On Ephunics
define('_DIR_PATIENTS_MEDICAL_HISTORIES',DOC_ROOT.'clinic_project/img/patient_medical_histories/');  // Local Settings
define('_URL_PATIENTS_MEDICAL_HISTORIES',_DATA_DIR_PATH.'img/patient_medical_histories/');


define('_DIR_PATIENTS_FAMILIES',DOC_ROOT.'clinic_project/img/patient_families/'); // Local Settings
define('_URL_PATIENTS_FAMILIES',_DATA_DIR_PATH.'img/patient_families/');
    define ('FAMILIES_IMAGE_W', 500);
    define ('FAMILIES_IMAGE_H', 300);
    define ('FAMILIES_THUMB_W', 200);
    define ('FAMILIES_THUMB_H', 200);
function PRE($data)
{
    echo "<PRE>";
    print_r($data);
    echo "</PRE>";
}

function short_date_format($date)
{
    $formattedDate = "";
    if(isset($date) && $date != "" && strlen($date) >= 10)
    {
        if (isset($withTime) && $withTime == true)
            $formattedDate = date("m/d/Y, g:i a", mktime(substr($date,11,2), substr($date,14,2), 0, substr($date,5,2), substr($date,8,2), substr($date,0,4)));
        else
            $formattedDate = date("m/d/Y", mktime(0, 0, 0, substr($date,5,2), substr($date,8,2), substr($date,0,4)));
    }    
    echo $formattedDate;
}

function long_date_format($date)
{
    $formatedDate = "";
    if(isset($date) && $date != "" && strlen($date) >= 10)
    {
        if (isset($withTime) && $withTime == true)
            $formatedDate = date("F j, Y, g:i A",mktime(substr($date,11,2), substr($date,14,2), 0, substr($date,5,2), substr($date,8,2), substr($date,0,4)));
        else
            $formatedDate = date("F j, Y",mktime(0, 0, 0, substr($date,5,2), substr($date,8,2), substr($date,0,4)));
    }    
    echo $formatedDate;
}

function getdbTimeFormat($timestamp)
{
    return date("Y-m-d g:i:s", $timestamp);
}
function getDateFormat($dbstr)
{
    return date("d M, Y", $dbstr);
}
function safe($string)
{
    return escape(stripslashes($string));
}
function escape($v)
{
    if(!is_array($v))
    {
        return @mysql_real_escape_string($v);
    }else
    {
        return @array_map("mysql_real_escape_string",$v); 
    }
}
if ( ! function_exists('replace_quotes')) { 
       function replace_qoutes($text) {
         $text = trim($text);
         $text = str_replace(chr(130), ',', $text);    // baseline single quote
         $text = str_replace(chr(132), '"', $text);    // baseline double quote
         $text = str_replace(chr(133), '...',$text);  // ellipsis
         $text = str_replace(chr(145), "'", $text);    // left single quote
         $text = str_replace(chr(146), "'", $text);    // right single quote
         $text = str_replace(chr(147), '"', $text);    // left double quote
         $text = str_replace(chr(148), '"', $text);    // right double quote
 
         $text = mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8');
         return $text;
        }
}

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

function get_months()
    {
        $month = array ("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"
                        May", "06"=>"June","07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October"
                        , "11"=>"November", "12"=>"December");
        return $month;
    }
    
    
    
if ( ! function_exists('strip_quotes'))
{
    function strip_quotes($str)
    {
        return str_replace(array('"', "'"), '', $str);
    }
}

function generate_slug($string)
    {                           
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
          array('', '-', ''),remove_accent($string))); 
    }
    
 function generate_desc_slug($string)
{                           
    return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
      array('', ' ', ''),remove_accent($string))); 
}
   
function remove_accent($str)
{
      $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
      $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
} 

function truncate($string, $length, $ellipsis = true) {
  // Count all the uppercase and other wider-than-normal characters
  $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));
  
  // Reduce the length accordingly
  $length = round($length - $wide * 0.2);
  
  // Condense all entities to one character
  $clean_string = preg_replace('/&[^;]+;/', '-', $string);
  if (strlen($clean_string) <= $length) return $string;
  
  // Use the difference to determine where to clip the string
  $difference = $length - strlen($clean_string);
  $result = substr($string, 0, $difference);
  
  if ($result != $string and $ellipsis) {
    $result = add_ellipsis($result);
  }
  
  return $result;
}

// Replaces the last 3 characters of a string with "...". If there is a space
// followed by three letters or less at the end of the string, those will
// also be removed, along with any extra white space.

function add_ellipsis($string) {
  $string = substr($string, 0, strlen($string) - 3);
  return trim(preg_replace('/ .{1,3}$/', '', $string)) . '...';
}

function getAllCombinations($array)
{
    if (count($array)==1)
        return ($array);
    $res = array();
    foreach ($array as $i=>$val)
    {
        $tArray = $array;
        unset($tArray[$i]);
        $subRes = getAllCombinations($tArray);
        foreach ($subRes as $t)
        {
            $res[]= $val.' '.$t;
        }
    }
    return $res;
}
/* End of file constants.php */
/* Location: ./application/config/constants.php */