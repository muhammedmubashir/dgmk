<?php
include('admin.php');
class admin_news extends admin
{
	
	function __construct()
	{
		parent::__construct();
	}

	function add_new_news()
    {  
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "add_new_news";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Add new news";
        
        
        if(isset($_SESSION['add_new_news_str']))
        {
            $data['news_data'] = $_SESSION['add_new_news_str'];
            unset($_SESSION['add_new_news_str']);
        }
        
        if(isset($_REQUEST['news_title']))
        {
            $this->load->library('classes/Newsvalidator');
            $oV = new Newsvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['add_new_news_str'] = $_REQUEST;  
                  redirect('admin/add_new_news'); 
            }
            else
            {
                $total_news_count = $this->admin_model->get_total_news_count();
                
                $news_data = array('news_title' => addslashes($_POST['news_title']), 
                'news_details' => $_POST['news_details'],
                'display_order' => $total_news_count+1,
                'news_date' => safe($this->input->post('news_date')),
                'news_status' => safe($this->input->post('news_status')),
                'date_added' => getdbTimeFormat(time()));
                $news_id = $this->admin_model->add_new_news($news_data);
                
                $this->messages->success("News has been created successfully.");
                redirect('admin/news','refresh'); 
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/news/form",$data);
        $this->load->view("admin/footer");
    }
}


?>