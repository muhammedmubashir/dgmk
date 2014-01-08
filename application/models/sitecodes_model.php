<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class SiteCodes_model extends CI_Model
  {
    private $code_types_array;
    private $yes_no_array;
    
    static $_ACTIVE = 1;
    static $_INACTIVE = 0;
            
    static $_DIGITIZING = 1; 
    static $_STITCHES = 2; 
    static $_BACK_LOGOS = 3; 
    
    
    
    
    function __construct()      
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('Funarray','helperhtmlform'));  
    
        $this->code_types_array[self::$_DIGITIZING] = "DIGITIZING";
        $this->code_types_array[self::$_STITCHES] = "STITCHES";
        $this->code_types_array[self::$_BACK_LOGOS] = "BACK LOGOS";
    }
    
    function get_sitecodes_list($searchArray = array())
    {
        $sql = "SELECT * FROM codes WHERE codeID > 0";
        
        if(isset($searchArray['codeType']) && $searchArray['codeType'] !="")
        {
            $sql.=" AND codeType = '".$searchArray['codeType']."'";    
        }
        
        if(isset($searchArray['status']) && $searchArray['status'] >= 0)
        {
            $sql.=" AND status = '".$searchArray['status']."'";    
        }
        
        if(isset($searchArray['codeValue']) && $searchArray['codeValue'] != "")
        {
            $sql.=" AND codeValue like '%".$searchArray['codeValue']."%'";
        }
        
        $queryResult = $this->db->query($sql);
        $sitecodes = $queryResult->result_array();
        return $sitecodes;
    }
    
    function update_site_data_codes_save($site_code)    
    {
      $this->db->where("codeID",$site_code['codeID']);
      $this->db->update("codes", $site_code);   
    }
    
    function get_code_type($key='')
    {
       return $this->code_types_array[$key];
    }    
    
    function code_type_combo($value='')
    {
        $Funarray = new Funarray();
        return $Funarray->arrayToComboOptions($this->code_types_array,$value);
    }
    
    function Value($codeID)
    {
        $Query = "SELECT codeValue FROM codes WHERE codeID='".$codeID."'";
        $queryResult = $this->db->query($Query);
        $code_row = $queryResult->row_array();
        return ucfirst(stripslashes($code_row['codeValue']));
    }
    
    function YesNoData($include_prefer=0){
        $yes_no_array['y'] = "Yes";
        $yes_no_array['n'] = "No";
        if($include_prefer)
            $yes_no_array['p'] = "Prefer not to say";  
        return $yes_no_array;
    }
    
    public static function getYesNoData($include_prefer){
        if(!self::$yesNOData){
            self::$yesNOData = self::YesNoData($include_prefer);
        }
        return self::$yesNOData; 
    }
    
    function YN($k){
        $a = self::getYesNoData(1);
        return $a[strtolower($k)];
    }
    
    //warpper of function comboCodeValues
    function comboCodes($codeType,$current_value,$show_default_txt=false){ 
        return self::comboCodeValues($codeType,$current_value,$show_default_txt,"Any"); 
    }
    
    function parent_code_values_by_codetype($codeType,$currentID=0,$show_select=true,$first_optionTXT = "Parent")
    {
        $sql = "SELECT  * from  codes WHERE codeType ='".$codeType."' AND  parent_id ='0'";
        
        $str = "<select name='parent_id' style='width:auto;'>";
            $str .= $this->fillcombo($sql,'codeID','codeValue',$currentID,$show_select,$first_optionTXT);
        $str .= "</select>";
        
        return $str;
        
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
    
    function exists($parentID,$codeType,$codeValue)
    {
       $this->db->where("parent_id",$parentID);
       $this->db->where("codeType",$codeType);
       $this->db->where("codeValue",$codeValue);
       return $this->db->count_all_results('codes'); 
      
      /* return $this->ice->db->QuickCount("SELECT * FROM codes 
        WHERE 
            parent_id = '".$parentID."' AND
            codeType = '".$codeType."' AND codeValue = '".$codeValue."'");  */
    }
    
    function add($data)
    {
        
        $chk = $this->exists($data['parent_id'],$data['codeType'],$data['codeValue']);
        
        if($chk > 0)
            return true; //already added
            
        $sql = "INSERT INTO codes ";
        $sql .= " SET ";
        $sql .= " parent_id = '".$data['parentID']."', ";
        $sql .= " codeType = '".$data['codeType']."', ";
        $sql .= " codeValue = '".$data['codeValue']."', ";
        $sql .= " status = '".$data['status']."' ";

            
        $q = $this->ice->db->squery($sql);
        if($q){
            return true;    
        }else{
            return false;
        }
    }
      
      
    function update($data,$dbRow)
    {
        
        $chk = $this->exists($data['parent_id'],$data['codeType'],$data['codeValue']);
        
        if($chk > 0)
            return true; //already added
            
        $sql = "UPDATE codes ";
        $sql .= " SET ";
        //$sql .= " parent_id = '".$data['parent_id']."', ";
        $sql .= " codeType = '".$trim(safe($data['codeType']))."', ";
        $sql .= " codeValue = '".trim(safe($data['codeValue']))."', ";
        $sql .= " status = '".$data['status']."' ";
        
        $sql .= " WHERE codeID = '".$dbRow['codeID']."' ";
  
        $q = $this->ice->db->squery($sql);
        if($q){
            return true;    
        }else{
            return false;
        }
    }
    
    function create($codetype,$codeValue)
    {   
        
        $codes_data = array('codeType' => trim(safe($codetype)),
                            'codeValue' => trim(safe($codeValue)),
                            'status' => "1");
         
                          
            $q = $this->db->insert("codes",$codes_data);
            if($q){
                return true;    
            }else{
                return false;
            }
    }
    
    function get_site_code_by_code_id($codeID)
    {
        $editQuery = "SELECT * FROM codes WHERE codeID='".$codeID."'";
        $queryResult = $this->db->query($editQuery);
        $code_row = $queryResult->row_array();
        return $code_row;
    }
    
     function getRow($codeType,$codeID)
    {
        $editQuery = "SELECT * FROM codes WHERE codeType = '".$codeType."' AND codeID='".$codeID."'";
        $queryResult = $this->db->query($editQuery);
        $code_row = $queryResult->row_array();
        return $code_row;
    }
    
    
    function get_data_set($codeType,$field,$value)
    {
        $editQuery = "SELECT * FROM codes WHERE codeType = '".$codeType."' AND ".$field." = '".$value."'";
        $queryResult = $this->db->query($editQuery);
        $result_array = $queryResult->result_array();
        return $result_array;
    }
    
    function comboCodeValues($codeType,$current_value=0,$show_plz_select=true,$plzslct_txt='Please select'){
        
        $current_value = (array) $current_value;
        
        $Query = "SELECT * FROM codes WHERE codeType='".$codeType."' AND parent_id ='0' AND status = '1' ORDER BY codeID,codeValue  ASC";
        
        $queryResult = $this->db->query($Query);
        $result_array = $queryResult->result_array();
        
        
        
        $str = '';
        
        if($show_plz_select)
        $str = '<option value="0">'.$plzslct_txt.'</option>';
        
        foreach($result_array as $row)
        {   
            $slctd = '';
            if(in_array($row['codeID'],$current_value)){
                 $slctd = ' selected="selected"';  
                 
            }
            
            $str .= '<option value="'.$row['codeID'].'" '.$slctd.'>'.ucfirst(stripslashes($row['codeValue'])).'</option>';  
            
            $qq = "SELECT * FROM codes WHERE codeType='".$codeType."' AND parent_id = '".$row['codeID']."' ORDER BY codeID ASC";          
            $queryResult = $this->db->query($qq);
            $qq_result_array = $queryResult->result_array();            
            foreach($qq_result_array as $rowSub){
                if(in_array($rowSub['codeID'],$current_value)){
                     $slctd = ' selected="selected"';  
                }else{$slctd='';}
                   
                $str .= '<option class="ident" value="'.$rowSub['codeID'].'" '.$slctd.'>&nbsp;&nbsp;&nbsp;'.ucfirst(stripslashes($rowSub['codeValue'])).'</option>';      
            }
               
        }
        return $str;
    }
    
    function comboYesNo($value='',$prefer_no_to_say=0,$show_plz_select=1,$slctTxt='Select'){
        $str = '';
        if($show_plz_select)
            $str = '<option value="0">'.$slctTxt.'</option>';
            
        $str .= $this->Funarray->arrayToComboOptions(self::YesNoData($prefer_no_to_say)  ,strtolower($value));
        return $str;
    }
    
    function validate($post_data,$edit=true){
        $err_msg = array();
        
        if($edit){
            if(trim($post_data['codeValue']) == ''){
                $err_msg[] = "Please provide data";
            }
        }
        
        return $err_msg;
    }
    
    function MarkStatus($id,$status){

        
        $condition_string = "";      
        if(is_array($id)){
            $condition_string = " IN (".implode(',',$id).") ";
        }
        else
        {
            $condition_string = " = '".(int)$id."'"; 
        }


        $sql = "UPDATE codes SET status = '".$status."' WHERE codeID ".$condition_string."";
        $response = $this->_db->mnbQuery($sql);
        if($this->_db->getAffectedRows() > 0) {
            return true;    
        }
        return false;
    }
    
    
    function ActivateCodes($code_id_arrays)
    {
       return $this->MarkStatus($code_id_arrays,modCodes::$_ACTIVE);
    } 
       
    function DeActivateCodes($code_id_arrays)
    {
       return $this->MarkStatus($code_id_arrays,modCodes::$_INACTIVE);
    }
    
    function mark_code_status($status_id, $field_id)
    {
       $SQL = "UPDATE codes SET status = '".$status_id."' WHERE codeID = '".$field_id."'";
       $this->db->query($SQL);
    }
  }
?>