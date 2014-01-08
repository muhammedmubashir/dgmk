<?PHP
class Modmessagesfornt {

    var $registry;

    var $_error = array(); 
    var $_info = array();  
    var $_success = array();  
     
    function modMessages()
    {       
    
    }
    
    private static $_instance = null;
    
    function Instance()
    {
        if(self::$_instance == null)
        {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    function _set_string($m,$type_str){
        if(is_array($m)){
            foreach($m as $k=>$v){
               $_SESSION[$type_str][] =  $v;   
            }
        }else{
             $_SESSION[$type_str][] =  $m;
        }
    }
    function error($m){  
        $this->_set_string($m,"error_message"); 
    }
    
    function success($m){
       $this->_set_string($m,"success_message");    
    }
    
    function info($m){
        $this->_set_string($m,"info_message");
    }
    
    function white($m)
    {
        $this->sys($m);
    }
    
    function sys($m){
       $this->_set_string($m,"white_message");    
    }
    
    function render_msg($msg)
    {
        return '<span class="ico"></span><strong class="system_title">'.$msg.'</strong>';
        
    }
    
    function render()
    {
        
         $e_str = "";
         $w_str = "";
         $s_str = "";
         $i_str = "";
         $str = "";
        

        
    if(isset($_SESSION['white_message']) && count($_SESSION['white_message']) > 0)
        {
            $white_message = count($_SESSION['white_message']);
            if($white_message){
            $w_str = '<ul class="system_messages">';
            for($i=0; $i<$white_message; $i++)
            {
                $w_str .= "<li class='white'>".$this->render_msg($_SESSION['white_message'][$i])."</li>" ;
            }
            $w_str .= "</ul>";
            
        }
        }
        
        
        
    if(isset($_SESSION['error_message']) && count($_SESSION['error_message']) > 0)
    {
        $errors = count($_SESSION['error_message']);    
        
        if($errors)
        {
            $e_str = '<ul class="system_messages">';
            for($i=0; $i<$errors; $i++){
                $e_str .= "<li class='red'>".$this->render_msg($_SESSION['error_message'][$i])."</li>" ;
            }
            $e_str .= "</ul>";
        }
    }
        
        
    if(isset($_SESSION['success_message']) && count($_SESSION['success_message']) > 0)
    {
        $succ = count($_SESSION['success_message']);
        
        if($succ)
        {
            $s_str = '<ul class="system_messages">';
            for($i=0; $i<$succ; $i++){
                $s_str .= "<li class='green'>".$this->render_msg($_SESSION['success_message'][$i])."</li>" ;
            }
            $s_str .= "</ul>";
        }
    }
        
     
     
    if(isset($_SESSION['info_message']) && count($_SESSION['info_message']) > 0)
    {
        $info = count($_SESSION['info_message']);   
        if($info){
            $i_str = '<ul class="system_messages">';
            for($i=0; $i<$info; $i++){
                $i_str .= "<li class='yellow'>".$this->render_msg($_SESSION['info_message'][$i])."</li>" ;
            }
            $i_str .= "</ul>";
        }
    }
        
        
        unset($_SESSION['error_message']);
        unset($_SESSION['success_message']);
        unset($_SESSION['info_message']);
        unset($_SESSION['white_message']);
        
        $str  =   $e_str.$s_str.$i_str.$w_str;
        return $str;
    
    }
}//class ends


?>