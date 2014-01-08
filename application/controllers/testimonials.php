<?php
class testimonials extends CI_Controller 
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('testimonials_model');
        $this->load->model('pages_model');
    }
    
    function index()
    {
        
        $data = array();
        
        $testimonials = $this->testimonials_model->get_testimonials_list();
        $page_data = $this->pages_model->get_site_content_data_by_page_code('CLIENT_TESTIMONIALS');
        
        $data['testimonials'] = $testimonials;
        $data['page_data'] = $page_data;
        
        $this->load->view("layout/main_header");
        $this->load->view("testimonials/testimonials",$data);
    	$this->load->view("layout/main_footer");
    }
}
?>