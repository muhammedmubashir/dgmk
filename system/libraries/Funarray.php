<?PHP
class Funarray{
    
	function BuildQuery($array){
        /*
        $data = array('foo'=>'bar',
                  'baz'=>'boom',
                  'cow'=>'milk',
                  'php'=>'hypertext processor');
        */

        return http_build_query($array); // foo=bar&baz=boom&cow=milk&php=hypertext+processor
       // echo http_build_query($data, '', '&amp;'); // foo=bar&amp;baz=boom&amp;cow=milk&amp;php=hypertext+processor
    }
	
    function arrayToComboOptions($array,$current_value='',$ignore_values='',$use_value_as_key=false){
        

        if($ignore_values == '')
            $ignore_values = array(); //init :P
            
        $str = '';
        foreach ($array as $key => $value){
            if($use_value_as_key)
                $key  = $value;
                        
            if($key == $current_value){
                $selected = " selected";
            }else{
                 $selected = "";
            }
            
            if(!in_array($key,$ignore_values)){
                 $str .= '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            }
            
           
        } 
        return $str;
        
    }
    
     function arrayToRadioOptions($array,$name,$current_value='',$class='check_radio'){
         $str = '';

        foreach ($array as $key => $value){
            if($key == $current_value){
                $selected = "checked";
            }else{
                 $selected = "";
            }
            $str .= '<input type="radio" id="'.$name.'" name="'.$name.'" value="'.$key.'" '.$selected.' class="'.$class.'">'.$value.' ';
        } 
        return $str;
    }
    
    function arrayTocheckboxes($array,$name,$data_array=array(),$class='check_radio'){
        $str = '';
        foreach ($array as $key => $value){
            if(in_array($key,$data_array)){
                $selected = "checked";
            }else{
                 $selected = "";
            }
            $str .= '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="'.$key.'"'.$selected.' class="'.$class.'">'.$value;
        } 
        return $str;
    }
       

    
    function comboGender($c = '')
    {
        if($c == 'm' ){
            echo"<option value='m' selected='selected'>Male</option>";
        }else{
            echo"<option value='m'>Male</option>";
        }
        
        if($c == 'f' ){
            echo"<option value='f' selected='selected'>Female</option>";
        }else{
            echo"<option value='f'>Female</option>";
        }
    }
    
    function fillstatusCombo($status='1',$avoid_pre_init=false)
    {
        
        if($status == 0 || $status == 1)  
        {
            if($status == 0 )
            {
                echo"<option value='0' selected='selected'>Inactive</option>";
            }
            else
            {
                echo"<option value='0'>Inactive</option>";
            }
        
            if($status == 1 )
            {
                echo"<option value='1' selected='selected'>Active</option>";
            }
            else
            {
                echo"<option value='1'>Active</option>";
            }                
        }
    }
    
    function comboStatus($status='')
    {
        if($status == null || $status == '')
            $status = "-1";
            
        $options['1'] = "Active";
        $options['0'] = "InActive";

        return funArray::arrayToComboOptions($options,$status);
    }
    
     function comboPendingApproved($status=''){

        $str = '';

        if($status == 1 ){
            $str .= "<option value='1' selected='selected'>Approved</option>";
        }else{
            $str .= "<option value='1'>Approved</option>";
        }
        
        if($status == 0 && $status != ''){
            $str .= "<option value='0' selected='selected'>Pending</option>";
        }else{
            $str .= "<option value='0'>Pending</option>";
        }
        
        if(!$show_select) 
            echo $str;
        else 
            return $str;
    }
    
    function fillyesNOCombo($status='')
    {

        $str = '';

        if($status == 1 ){
            $str .= "<option value='1' selected='selected'>Yes</option>";
        }else{
            $str .= "<option value='1'>Yes</option>";
        }
        
        if($status == 0 && $status != ''){
            $str .= "<option value='0' selected='selected'>No</option>";
        }else{
            $str .= "<option value='0'>No</option>";
        }
        
        if(!$show_select) 
            echo $str;
        else 
            return $str;
    }
    
    function fillOpenCloseCombo($status=''){

        $str = '';

        if($status == 1 ){
            $str .= "<option value='1' selected='selected'>Open</option>";
        }else{
            $str .= "<option value='1'>Open</option>";
        }
        
        if($status == 0 && $status != ''){
            $str .= "<option value='0' selected='selected'>Close</option>";
        }else{
            $str .= "<option value='0'>Close</option>";
        }
        
        if(!$show_select) 
            echo $str;
        else 
            return $str;
    }
    
    
    
    function comboDays($curent_day='')
    {
        $i=1;
        while($i<32){
            if($i == $curent_day){
                echo "<option value='".$i."' selected='selected'>".$i."</option>";
            }else{
                echo "<option value='".$i."'>".$i."</option>";
            }
            $i++;
        }
    }
    
    function comboYear($year='')
    {
        $i = date('Y',time()) ; //year 
        $i2 = $i+2; //year 
        
        while($i < $i2 ){
            if($i == $year){
                echo "<option value='".$i."' selected='selected'>".$i."</option>";
            }else{
                echo "<option value='".$i."'>".$i."</option>";
            }
            $i++;
        }
    }
    
    function ddlYears($startingYear,$endYear,$currentyear=''){
        for($i=$startingYear;$i<=$endYear;$i++){
            if($i == $currentyear){
                echo "<option value='".$i."' selected='selected'>".$i."</option>";
            }else{
                echo "<option value='".$i."'>".$i."</option>";
            }
        }
    }
    
}
?>