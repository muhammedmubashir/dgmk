<?PHP
class Helperhtmlform extends CI_Controller
{
	
	function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->load->database();
        $this->ci->load->model('SiteCodes_model');
    }
	
	function comboPerPage()
	{
		$options = array(10,20,30,50,100,150,200,250,300,350,400,450,500,1000);
		
		$perpage = isset($_GET['per_page']) ? $_GET['per_page'] : _GRID_LIMIT;
		
		if(isset($_GET['page']) && $_GET['page'] === "all")
		{
			$perpage = "0";
		}
		
		$str = '<select name="per_page" id="per_page" style="width:90px;">';
			$str .= "<option value='0'>View All</option>";
		 	$str .= funArray::arrayToComboOptions($options,$perpage,'',true);
		$str .= '</select>';
		
		return $str;
	}
	
    function hidden_form_field($fieldName,$value){
		$formField = "<input type='hidden' id='".$fieldName."' name='".$fieldName."' value='".$value."' />";
		return $formField;
	}	
	
	function input_field($fieldName,$type,$value='',$jsEvent='',$class='text',$error_enabled=true){ 
		$str = '<input id="'.$fieldName.'" name="'.$fieldName.'" type="'.$type.'" value="'.$value.'" class="'.$class.'" '.$jsEvent.' />';
        
        if($error_enabled){
           $str .= $this->form_err($fieldName);
		   $str .= $this->req($fieldName);
        }
		
        return $str;
	}
	
	function form_err($fieldName,$class="form_err"){
        if(isset($_SESSION['error_'.$fieldName])){
            $str = '<em>'.$_SESSION['error_'.$fieldName].'</em>';
            unset($_SESSION['error_'.$fieldName]);
            return $str;
        }
    }
	
	/*
		Wrapper
	*/
	function req($fieldName){
		return $this->errorInfoDiv('required',$fieldName,'red_error');
	}
	
	function errorInfoDiv($errorString,$fieldName,$class="red_error"){
		return "<span id='".$fieldName."err' class='".$class."' style='display:none;'>".$errorString."</span>";
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
    
    
	function radio($name,$value='',$dbValue='',$id='',$js_event=''){
        if($id == '') $id = $name;
    
        $checked = '';
        if($dbValue != '' && $value == $dbValue){
            $checked = 'checked="checked"';
        }
        
        $checkboxStr = '<input type="radio" id="'.$id.'" name="'.$name.'" value="'.$value.'" class="check_radio" '.$checked.' '.$js_event.' />';
        
        return $checkboxStr; 
    }
    
	function checkbox($name,$value='',$dbValue='',$id=''){
		$checked = '';
		if(!empty($value) && !empty($dbValue) && $value == $dbValue){
			$checked = 'checked="checked"';
		}
		$checkboxStr = '<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$value.'" class="check_radio" '.$checked.' />';
		
		return $checkboxStr;
	}
	
	
	
	function errorInfoSpan($errorString,$fieldName){
		return "<span id='".$fieldName."err' style='display:none;'>".$errorString."</span>";
	}
	
	function toolip($message,$size=200){
		 return "<a href=\"#\" onmouseover=\"Tip('".$message."')\" onmouseover=\"Tip('".$message."', BALLOON, true, ABOVE, true)\" onmouseout=\"UnTip()\"><img src='"._SITE_ADMIN_URL."images/info_icon.gif' width='17' height='19'/></a>";
	}
	
	
	function ToolTIPDHTML($message){
		 return "<a href=\"index.htm\" onmouseover=\"Tip('".$message."')\" onmouseover=\"Tip('".$message."', BALLOON, true, ABOVE, true)\" onmouseout=\"UnTip()\"><img src='"._SITE_ADMIN_URL."images/info_icon.gif' width='17' height='19'/></a>";
	}
	
	function Customtoolip($message,$string,$size=100){
		return '<a style="" onMouseover="tip(\''.$message.'\', '.$size.');" onMouseout="hideddrivetip()">'.$string.'</a>';
	}
	
	function errorRow($errorIndex){
		if(isset($_SESSION[$errorIndex])){
			$output =  "<tr class='formerrorrow'>
			<td colspan='2'>".$_SESSION[$errorIndex]."</td>
			</tr>";
			unset($_SESSION[$errorIndex]);
			return $output;
		}
	}
	
	function infomessage($str,$divname='',$display='',$class='OKMsg'){
        echo'<div class="'.$class.'" id="'.$divname.'" style="display:'.$display.'">
        <p>
         '.$str.'
        </p>
      </div>';
    }
    
    function showErrorMessage($title,$errors,$class='errorMsg'){
        ?>
         <div class="<?PHP echo $class; ?>">
            <h3><?PHP echo $title; ?></h3>
              <?PHP if(is_array($errors)){ ?>
              <ul>
                <?PHP
                for($i=0;$i<count($errors);$i++){ ?>
                    <li><?PHP echo $errors[$i]; ?></li>
                <?PHP } ?>
              </ul>
              <?PHP } ?>
          </div>
        <?PHP
    }
	
	   function showErrorMessage_simple($title,$errors,$class='errorMsg'){
        ?>
         <div class="<?PHP echo $class; ?>">
              <?PHP if(is_array($errors)){ ?>
              <ul>
                <?PHP
                for($i=0;$i<count($errors);$i++){ ?>
                    <li><?PHP echo $errors[$i]; ?></li>
                <?PHP } ?>
              </ul>
              <?PHP } ?>
          </div>
        <?PHP
    }
    
	function infoDiv($contentIndex,$defaultxt='',$id='',$class='alert'){
		if(isset($_SESSION[$contentIndex])){
			$output = '<div id="'.$id.'" class="'.$class.'">'.$_SESSION[$contentIndex]."</div>";
			unset($_SESSION[$contentIndex]);
			echo $output;
		}elseif($defaultxt != ''){
			$output =  '<div id="'.$id.'" class="'.$class.'">'.$defaultxt."</div>";
			echo $output;
		}
	}
	
	function infoDiv1($contentIndex,$defaultxt='',$id=''){
		if(isset($_SESSION[$contentIndex])){
			$output = '<div id="'.$id.'" class="err_info">'.$_SESSION[$contentIndex]."</div>";
			unset($_SESSION[$contentIndex]);
			echo $output;
		}elseif($defaultxt != ''){
			$output =  '<div id="'.$id.'" class="err_info">'.$defaultxt."</div>";
			echo $output;
		}
	}
	
	function infoRow($contentIndex,$defaultxt=''){
		if(isset($_SESSION[$contentIndex])){
			$output =  "<tr class='tblcontentrow'>
			<td colspan='4'>".$_SESSION[$contentIndex]."</td>
			</tr>";
			unset($_SESSION[$contentIndex]);
			echo $output;
		}elseif($defaultxt != ''){
			$output =  "<tr class='tblcontentrow'>
			<td colspan='4'>".$defaultxt."</td>
			</tr>";
			echo $output;
		}
	}
	    
	function fillcomboSQL($table,$pkey_field,$display,$curent_id='',$show_select=true){
		$q = $this->registry->db->sQuery("SELECT * FROM ".$table."");
		if($show_select) echo"<option value='0'>Please select</option>";
		while($row = $this->registry->db->myArray($q)){
			if($row[$pkey_field] == $curent_id){
				echo "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
			}else{
				echo "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
			}
		}
	}
	
	/*
	@Supports Multiple Ids Selection When $curent_id = ARRAY
	*/
	function fillcomboSQLQuery($sql,$pkey_field,$display,$curent_id='',$show_select=true){
	
		if($pkey_field == 'metaIndexID' && !isset($curent_id) ){
			$curent_id = 1;
		}
		
		$q = $this->registry->db->squery($sql);
		if($show_select) echo"<option value='0' selected='selected'>Please select</option>";
		while($row = $this->registry->db->myArray($q)){
			if(!is_array($curent_id)){
				if($row[$pkey_field] == $curent_id && $curent_id > 0){
					echo "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
				}else{
					echo "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
				}
			}elseif(is_array($curent_id)){
				if(in_array($row[$pkey_field],$curent_id)){
					echo "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
				}else{
					echo "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
				}
			}
		}
	}
    
	
	function fillcombo($sql,$pkey_field,$display,$curent_id='',$show_select=false,$show_selecttxt="Please select")
    {
		$queryResult = $this->db->query($sql);
        $result_array = $queryResult->result_array();
        $str = '';
    
        if($show_select) $str .= "<option value=''>$show_selecttxt</option>";
        
        foreach($result_array as $row)
        {
            if(!is_array($curent_id)){
                if($row[$pkey_field] == $curent_id){
                    $str .= "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
                }else{
                    $str .= "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
                }
            }elseif(is_array($curent_id)){
                if(in_array($row[$pkey_field],$curent_id)){
                    $str .= "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
                }else{
                    $str .= "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
                }
            }
        }
        return $str ;
	}
	
	function fillcomboSQLQueryAjax($sql,$pkey_field,$display,$curent_id='',$show_slct=true){
		
        $db = registry()->db;
        
        $q = $db->sQuery($sql);
		$str = '';
		if($show_slct)
            $str .= "<option value='0'>View All</option>";
		
		while($row = $db->myArray($q)){
			if(!is_array($curent_id)){
				if($row[$pkey_field] == $curent_id){
					$str .= "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
				}else{
					$str .= "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
				}
			}elseif(is_array($curent_id)){
				if(in_array($row[$pkey_field],$curent_id)){
					$str .= "<option value='".$row[$pkey_field]."' selected='selected'>".$row[$display]."</option>";
				}else{
					$str .= "<option value='".$row[$pkey_field]."'>".$row[$display]."</option>";
				}
			}
		}
		return $str ;
	}
	
    function fillstatusCombo($status='',$avoid_pre_init=false){
        if($status == '' && $avoid_pre_init == false) $status = 1; // by default show active
        
        if($avoid_pre_init == true && ($status == '' || $status == NULL))
            $status = "-1";


        if($status == 0 ){
            echo"<option value='0' selected='selected'>Inactive</option>";
        }else{
            echo"<option value='0'>Inactive</option>";
        }
        
        if($status == 1 ){
            echo"<option value='1' selected='selected'>Active</option>";
        }else{
            echo"<option value='1'>Active</option>";
        }
    }
    
	function comboStatus($status=''){
        if($status == null || $status == '')
            $status = "-1";
            
		$options['1'] = "Active";
        $options['0'] = "InActive";

        return funArray::arrayToComboOptions($options,$status);
	}
    
	
	function fillstatusCombo2($status=''){
		if($status == 0 ){
			echo"<option value='0' selected='selected'>Inactive</option>";
		}else{
			echo"<option value='0'>Inactive</option>";
		}
		
		if($status == 1 ){
			echo"<option value='1' selected='selected'>Active</option>";
		}else{
			echo"<option value='1'>Active</option>";
		}
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
    
	
	
	function comboDays($curent_day=''){
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
	
	function comboYear($year=''){
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
	

	function AjaxLoadingDiv($name='ajxLoader',$image='images/loader.gif'){
		return "<span id='$name' style='display:none;'><img src='"._SITE_URL."$image' alt='Processing...' /></span>";
	}
	
	function AjaxLoadingDiv_Form($name='ajxLoader',$image='images/loader.gif'){
		return "<div id='$name' style='display:none;'><label>&nbsp;</label><img src='"._SITE_URL."$image' alt='Processing...' /></div>";
	}
}