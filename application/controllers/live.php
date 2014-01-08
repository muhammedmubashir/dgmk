<?php
class live extends CI_Controller 
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        redirect(base_url()."live/jalsa/al-mustafa-trust-hyderabad-2013.html");
    }
    function jalsa($param)
    {
        $this->load->view("layout/header");
        $this->load->view("front/jalsa_2013");
        $this->load->view("layout/footer");
    }
}