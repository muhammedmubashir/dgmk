<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class packages_model extends CI_Model
{
    function __construct()
    {
        parent:: __construct(); 
        $this->load->library('email');   
    }
    
    function get_packages_list_by_digitizing()        
    {
        $SQL = "SELECT * FROM codes c, packages p WHERE c.codeID = p.digitizing_id AND p.package_type = 'digitizing' AND p.package_status = '1' ORDER BY display_order LIMIT 3";
        $query_result = $this->db->query($SQL);
        
        $digitizing_packages = $query_result->result_array();
        
        return $digitizing_packages;
    }
    
    function get_packages_digitizing_data_by_package_id($package_id)
    {
        $SQL = "SELECT * FROM codes c, packages p WHERE c.codeID = p.digitizing_id AND p.package_type = 'digitizing' AND p.package_status = '1' AND p.package_id = '".(int)$package_id."'";
        
        $query_result = $this->db->query($SQL);
        $packages_digitizing_data_row = $query_result->row_array();
        
        return $packages_digitizing_data_row;
    }
}?>