<?php
class Home extends CI_Controller 
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $this->load->model("news_model");
        $data['welcom_box'] = $this->news_model->up_coming();
        $data['news_data'] = $this->news_model->get_all_news();
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("test/slider");
        $this->load->view("test/welcombox",$data);
        $this->load->view("test/aboutus");
        $this->load->view("test/latest_post",$data);
        $this->load->view("test/footer");
    }

    function main()
    {
        $this->load->model("news_model");
        $data['welcom_box'] = $this->news_model->up_coming();
        $data['news_data'] = $this->news_model->get_all_news();
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("test/slider");
        $this->load->view("test/aboutus");
        $this->load->view("test/latest_post",$data);
        $this->load->view("test/footer");
    }

    function book_list()
    {
        
    }


    function intro()
    {
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("front/intro");
        $this->load->view("test/footer");
    }

    function naat()
    {
        $this->load->model("news_model");
        //reading naat folder
        $this->load->helper('directory');
        $data['naat_data'] = directory_map(_DIR_NAAT);
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("front/naat",$data);
        $this->load->view("test/footer");
    }

    function naat_catg($q)
    {
        $q = intval($q);
        $this->load->model("news_model");
        $data['naat'] = $this->news_model->naat_cat($q);
        $this->load->view("layout/naat_cat",$data);
    }

    function contact()
    {
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("front/contact");
        $this->load->view("test/footer");
    }

    function artical()
    {   
        $this->load->model("news_model");
        $data['art_data'] = $this->news_model->artical();
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("front/artical",$data);
        $this->load->view("test/footer");
    }

    function artical_detail($id)
    {   
        $this->load->model("news_model");
        $data['art_data'] = $this->news_model->detail_artical($id);
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("front/artical_detail",$data);
        $this->load->view("test/footer");
    }
    
	function books($bookid)
    {   
        $this->load->model("news_model");
        $data['books_cat'] = $this->news_model->books($bookid);
        $data['categ'] = $this->news_model->categories();
        $this->load->view("test/header");
        $this->load->view("test/body_head");
        $this->load->view("front/books",$data);
        $this->load->view("test/footer");
    }
}
?>