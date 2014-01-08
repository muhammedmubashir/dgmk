<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pages_model extends CI_Model
{
    function __construct()
    {
        parent:: __construct(); 
        $this->load->library('email');   
    }
    
    function get_site_content_data_by_page_code($page_code)
    {
        $SQL = "SELECT * FROM site_contents WHERE page_code = '".$page_code."'";
        
        $query_result = $this->db->query($SQL);
        $site_content_data_row = $query_result->row_array();
        
        return $site_content_data_row;
    }
}?>