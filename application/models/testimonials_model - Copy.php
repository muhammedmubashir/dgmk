<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class testimonials_model extends CI_Model
{
    function __construct()
    {
        parent:: __construct(); 
        $this->load->library('email');   
    }
    
    function get_testimonials_list()        
    {
        $SQL = "SELECT * FROM testimonials WHERE testimonial_status = '1' ORDER BY display_order";
        
        $query_result = $this->db->query($SQL);
        $testimonials = $query_result->result_array();
        
        return $testimonials;
    }
    
    function get_testimonial_data_by_testimonial_id($testimonial_id)
    {
        $SQL = "SELECT * FROM testimonials WHERE testimonial_id = '".(int)$testimonial_id."'";
        $query_result = $this->db->query($SQL);
        $testimonial_data_row = $query_result->row_array();
        return $testimonial_data_row;
    }
}?>