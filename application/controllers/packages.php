<?php
class packages extends CI_Controller 
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('packages_model');
        $this->load->model('pages_model');
    }
    
    function index()
    {
        
        $data = array();
        
        $digitizing_packages = $this->packages_model->get_packages_list_by_digitizing();
        $page_data = $this->pages_model->get_site_content_data_by_page_code("PRICING_TABLES");
        
        $data['digitizing_packages'] = $digitizing_packages;
        $data['page_data'] = $page_data;
        
        $this->load->view("layout/header");
        $this->load->view("packages/packages",$data);
    	$this->load->view("layout/main_footer");
    }
}
?>