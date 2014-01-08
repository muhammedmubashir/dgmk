<?php
class page extends CI_Controller 
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('page_model');
    }
    
    function index()
    {
        
        $data = array();
        $this->load->view("layout/main_header");
        $this->load->view("testimonials/testimonials",$data);
    	$this->load->view("layout/main_footer");
    }
}
?>