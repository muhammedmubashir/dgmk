<?PHP
class iceText
{
    
    function is_alphabet($asciCode){
        if($asciCode == 0 || trim($asciCode) == '') 
            return false;
        
        if($asciCode>=65 && $asciCode<=90)
                return true;        
        
        return false;
    }
    
    function getAlphabet($asciCode,$default='All'){
        if($this->is_alphabet($asciCode)){
            return chr($asciCode);
        }
        return $default;
    }
    
    static function getFirstCharacter($string){    
        if(trim($string) != ''){
            return $string[0];
        }
    }

}

class Icevalidation extends iceText
{
    
    function only_alpha_numeric($string)
    {
        return eregi('[^a-z0-9_]', $string) ? FALSE : TRUE;
    }
    
    function is_alpha_only_string($string)
    {
        if(preg_match("/^[A-Z][a-zA-Z -]+$/", $string) == false)
        {
            return false;
        }
        else
        {
            return true;
        }
        //return eregi('[/^[A-Z][a-zA-Z -]+$/]', $string) ? FALSE : TRUE;
    }
    
    function only_alpha_string($string)
    {
        
        return eregi('[^a-z0-9_ ]', $string) ? FALSE : TRUE;
    }
    
    function only_numeric($string)
    {
        return eregi('[^0-9_]', $string) ? FALSE : TRUE;
    }
    
    function checkFieldlength($string,$needed_length=6){
        if(strlen($string) >= $needed_length){
            return true;
        }
        return false;
    }
    
    function is_alpha($testcase){
        if (ctype_alpha($testcase)) {
          return false;
        }
        return true;
    }
    
     function is_number($testcase){
        if (is_numeric($testcase)) {
          return false;
        }
        return true;
    }
    
    function is_alpha_only_string1($string){   
        return $this->is_alpha($string);
        
    }
    
    function isempty($string){
        if(trim($string) == ''){
            return true;
        }
        return false;
    }
    
    function isequal($value1,$value2){
        if($value1 == $value2){
            return true;
        }
        return false;
    }
    
    public function isemail($email) {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
            }
        } 
        
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
                }
            }
        }
        return true;
    }
    
    public function validate_url($url,$protocols='http|https')
    {
        if (preg_match('/^('.$protocols.'):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
            return true;
        } else {
            return false;
        }
    }
     
     public function isValidDomain($url,$valid_url=_ICE_URL)
     {
         $parse = parse_url($valid_url);
         $valid_domain = strtolower($parse['host']); 

         $parse = parse_url($url);
         $redirected_domain = strtolower($parse['host']); 
        

        return ($valid_domain === $redirected_domain);
     }
     
     /**
     * --Validate username--
     * Validate username, consist of alpha-numeric (a-z, A-Z, 0-9), underscores, and has minimum 5 character and maximum 20 character. You could change the minimum character
     * and maximum character to any number you like.
     * 
     * @param mixed $username
     */
     public function validate_username($username)
     {
        if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
            return true;
        } else {
            return false;
        }
     }
     
     
     

}
abstract class Abstractvalidator
{   
    protected $message = ""; 
    
    protected $isEdit = false;   
    
              
    abstract function Validate($data);
    
    function setMessage($message_string)
    {
        $this->message .= $message_string."<br />";
    }  
    
    function getEditMode()
    {
        return $this->isEdit;
    }  
     
    function setEditMode($isEdit=false)
    {
        $this->isEdit = $isEdit;
    }  
    
    function getMessage()
    {
        return $this->message;
    }   
    
    function isValidated()
    {
          if($this->message != "")
            return false;
          return true;
    }
}
?>
