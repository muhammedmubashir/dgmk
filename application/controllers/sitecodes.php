<?php
  class SiteCodes extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('SiteCodes_model');
          $this->load->helper('url');
          $this->load->library(array("form_validation"));
      }
      
        
      function mark_code_status()
      {
        $this->SiteCodes_model->mark_code_status($_POST['status'],$this->input->post('field_id')) ;      
      }
      
      function index()
      {
        $searchArray = $_POST;  
        $sitecodes = $this->SiteCodes_model->get_sitecodes_list($searchArray);
        $data['sitecodes'] = $sitecodes;
        $data['base_url'] = site_url("sitecodes");
        $this->load->view("header");
        $this->load->view("sitecodes/manage",$data);
      }
      
      function add()
      {
        $this->load->library('form_validation');
        
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('codeType', 'Code Type', 'trim|required');
            $this->form_validation->set_rules('comma_data', 'Data Codes', 'required');
            
            if ($this->form_validation->run() == FALSE)
            {
                        
            }
            else
            {
                $this->add_site_data_codes_save();
            } 
        
        }
        
          $this->load->view("header");
          $data['base_url'] = site_url("sitecodes/");
          $this->load->view("sitecodes/add",$data);
      }
      
      function add_site_data_codes_save()
      {
            
        $comma_data = explode("|",$this->input->post('comma_data'));
        $added = 0;
        for($i=0;$i<count($comma_data);$i++)
        {
            $qq = $this->SiteCodes_model->create($this->input->post('codeType'),$comma_data[$i],
                                                 $this->input->post('parent_id'),$this->input->post('status'));
            if($qq)
            {
                $added++;    
            }
        }
        if($added > 0)
        {
            redirect('sitecodes/index/','refresh');
        }else
        {
            redirect('sitecodes/add/','refresh');
        }  
      }
      
      function edit()
      {
        $this->load->view("header");
        $this->load->library('form_validation');
        
        $code_id = $this->uri->segment(3);  
        $code_row = $this->SiteCodes_model->get_site_code_by_code_id($code_id);
        $data['code_row'] = $code_row;
        $data['base_url'] = site_url("sitecodes/");
        
        if(isset($_POST['submit']))
        {
            $code_id = $this->input->post('code_id');
            $parent_id = $this->input->post('parent_id');
            $data['code_id'] = $code_id;
            $data['parent_id'] = $parent_id;
            
            $this->form_validation->set_rules('codeType', 'Code Type', 'trim|required');
            $this->form_validation->set_rules('code_value', 'Code Value', 'required');
            
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view("sitecodes/edit",$data);               
            }
            else
            {
                $this->edit_site_data_codes_save();
                
            } 
        
        }
        else
        {
            $this->load->view("sitecodes/edit",$data);      
        }
        
        
      }
      
     function edit_site_data_codes_save()
      {
        $code_data = array('parent_id' => $this->input->post('parent_id'),
                           'codeType' => $this->input->post('codeType'),  
                           'codeValue' => $this->input->post('code_value'),  
                           'codeID' => $this->input->post('code_id'));
        
        $this->SiteCodes_model->update_site_data_codes_save($code_data);
        redirect('sitecodes/index/','refresh');
      }
      
      
    function parent_code_values()
    {
        $codeType = $_POST['codeType'];
         $this->SiteCodes_model->parent_code_values_by_codetype($codeType);
    }
  }
?>
