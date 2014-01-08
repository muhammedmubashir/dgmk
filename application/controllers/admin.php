<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        ini_set('upload_max_filesize', '10M');  
        ini_set('post_max_size', '10M');  
        ini_set('max_input_time', 300);  
        ini_set('max_execution_time', 300);

        $this->load->library('Pagination');
        $this->load->model('admin_model');
        $this->load->model('SiteCodes_model');
        $this->load->library('session');    
        $this->load->library('Modmessages');
        $this->messages = new Modmessages();
        $this->admin_user_id = $this->session->userdata('admin_user_id'); 
    }
    
    function check_is_admin_login()
    {
      $admin_user_id = $this->session->userdata('admin_user_id'); 
      $is_admin = $this->session->userdata('is_admin');
      $isAdmin = $this->admin_model->isAdmin($admin_user_id);
      if($admin_user_id == "" && $is_admin != 1)  
      {
         $_SESSION['Error_Message'] = "YES";
         $this->messages->error("You are not authorized to access that location.");     
         redirect('admin/admin_login','refresh'); 
      } 
      else if($isAdmin == false)
      {
          //redirect('admin/dashboard','refresh'); 
      }
      return true;
    }
    
    function index()
    {
        if($this->check_is_admin_login())
        {
            redirect('admin/dashboard','refresh'); 
        }
    }
    
    function dashboard()
    {
        
        //-----------------------------------------------------------------------------------------------------------
        //$data['recent_total_users_count'] = $this->admin_model->get_recent_total_users_count();
        //$data['dashborad_total_users_count'] = $this->admin_model->get_dashborad_total_users_count();
        //-----------------------------------------------------------------------------------------------------------
        
         //-----------------------------------------------------------------------------------------------------------
        //$data['recent_total_payments_count'] = $this->admin_model->get_recent_total_payments_count();
        //$data['dashborad_total_payments_count'] = $this->admin_model->get_dashborad_total_payments_count();
        //-----------------------------------------------------------------------------------------------------------
        
        $this->check_is_admin_login();
        $this->load->view("admin/header");
        $this->load->view('admin/dashboard'); 
        $this->load->view("admin/footer");
    }
    
    
    public function admin_login()
    {
        $admin_user_id = $this->session->userdata('admin_uid'); 
        $is_admin = $this->session->userdata('is_admin');
        $isAdmin = $this->admin_model->isAdmin($admin_user_id);
        if($admin_user_id != "" && $is_admin == 1)
        {
            redirect('admin/dashboard','refresh'); 
        }
        else
        {
            $this->load->view("admin/header_login"); 
            $this->load->view('admin/admin_login'); 
            $this->load->view("admin/footer");
        }
    }
    
    function login()
    {
        
        if($this->input->post('submit'))
        {
           $admin_username = safe($this->input->post('admin_username'));
           $admin_passwd  = safe($this->input->post('admin_passwd'));
           
            if($admin_username == '' || $admin_passwd == '')
            {
                $_SESSION['admin_username'] = $admin_username;
                $_SESSION['Error_Message'] = "YES";
                $this->messages->error("Please provide valid login information.");
                redirect('admin/admin_login','refresh'); 
            }
            else
            {
                if($this->admin_model->admin_login(array('admin_username' => $admin_username, 'admin_passwd' => $admin_passwd)))
                {                
                    $this->messages->info("Logged in successfully.");
                    redirect('admin/dashboard','refresh'); 
                }
                else
                {
                    $_SESSION['admin_username'] = $admin_username;
                    $_SESSION['Error_Message'] = "YES";
                    $this->messages->error("Invalid username or password.");
                    redirect('admin/admin_login','refresh'); 
                }
            }
        }
        else
        {
            $_SESSION['Error_Message'] = "YES";
            $this->messages->error("Invalid username or password.");
            redirect('admin/admin_login','refresh'); 
        }
    }
   
    function logout()
    {
        $this->session->destroy();
        $this->messages->info("You have been successfully logged out.");
        redirect('admin/admin_login','refresh'); 
    }

    function admin_users()
    {
      $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      $data = $_REQUEST;
                                            
      $admin_users = $this->admin_model->get_admin_users_list($data);
                                     
      $data['admin_users'] = $admin_users;
      
      $this->load->view("admin/admin_users/admin_users",$data); 
      
      $this->load->view("admin/footer");
        
    }
    
    function update_admin_user_status()
    {
        $this->check_is_admin_login();
        
        $status_id = $this->uri->segment(3);    
        $users_id = $this->uri->segment(4);   
         
        $status_id = $this->admin_model->update_admin_user_status($status_id, $users_id);
        
        if($status_id == 0)
        {
            $this->messages->success("Admin user has been activated successfully.");    
        }
        else
        {
            $this->messages->success("Admin user has been deactivated successfully.");    
        }
        
        redirect('admin/admin_users','refresh');
    }
    
    function delete_admin_user()
    {
       $this->check_is_admin_login();
        
        $users_id = $this->uri->segment(3);    
        $this->admin_model->delete_admin_user($users_id);
        $this->messages->success("Admin user has been deleted successfully.");
        redirect('admin/admin_users/','refresh');
    }
    
    function library_list()
    {
        $this->check_is_admin_login();

        /*
        $data = array();
        $data = $_POST;
        //offset
        $data['offset'] = intval($this->uri->segment(3));
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url().'index.php/admin/gallery/';
        $config['total_rows'] = $this->admin_model->get_gallery_list_rows();
        $config['enable_query_strings'] = FALSE;
        $limit = $config['per_page'] = 30;    
        $this->pagination->initialize($config);
        
        $gallery_pictures = $this->admin_model->get_gallery_pictures_data($limit,$data['offset']);
        $data['gallery_pictures'] = $gallery_pictures;
        $data['pagination'] =  $this->pagination->create_links();
        */

        $data['book_list'] = $this->admin_model->library_list();
        $this->load->view("admin/header"); 
        $this->load->view("admin/library/list",$data); 
        $this->load->view("admin/footer");     
    }

    function add_book_in_library()
    {
        $this->check_is_admin_login();
        $data = array();
        $form_action  = "add_book_in_library";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Add new book in Library";
        $data['categories'] = $this->admin_model->get_all_categories();
        //pre($data);die;
        //echo $data['categories'][0]['category_name'];die;
        if(isset($_SESSION['add_new_book_data']))
        {
            $data['book_data'] = $_SESSION['add_new_book_data'];
            unset($_SESSION['add_new_book_data']);
        }
        
        if(isset($_REQUEST['book_name']))
        {
            $this->load->library('classes/LibBookvalidator');
            $oV = new LibBookvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                $this->messages->error($oV->getMessage());
                $_SESSION['add_new_book_data'] = $_REQUEST;  
                redirect('admin/add_book_in_library'); 
            }
            else
            {
                //var_dump($_POST);die;
                $book_data['category_id'] = intval($_POST['category']);
                $book_data['book_name'] = $_POST['book_name'];
                $book_data['book_sub_title'] = $_POST['book_sub_title'];
                $book_data['book_author'] = $_POST['book_author'];
                $book_data['author_type'] = $_POST['author_type'];
                $book_data['book_publisher'] = $_POST['book_publisher'];
                $book_data['publisher_city'] = $_POST['publisher_city'];
                $book_data['publishing_date'] = $_POST['publishing_date'];
                $book_data['publishing_number'] = $_POST['publishing_number'];
                $book_data['publish_quantity'] = $_POST['publish_quantity'];
                $book_data['no_of_copies'] = $_POST['no_of_copies'];
                $book_data['book_pages'] = $_POST['book_pages'];
                $book_data['book_language'] = $_POST['book_language'];
                $book_data['book_price'] = $_POST['book_price'];
                $book_data['glossary'] = $_POST['glossary'];
                $book_data['detail'] = $_POST['detail'];
                $book_data['status'] = intval($_POST['status']);
                
                if($this->admin_model->add_book_in_library($book_data))
                {
                    $this->messages->success("Book has been added in library successfully.");
                    redirect('admin/library_list','refresh'); 
                }
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/library/form",$data);
        $this->load->view("admin/footer"); 
    }
    
    function edit_book_in_library()
    {
        $this->check_is_admin_login();
        $book_id = intval($this->uri->segment(3));
        $data = array();
        $form_action  = "edit_book_in_library";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit book in Library";
        $data['categories'] = $this->admin_model->get_all_categories();
        $data['lib_book_id'] = $book_id;

        $data['book_data'] = $this->admin_model->get_lib_book_detail($book_id);
        //pre($data);die;
        if(isset($_SESSION['edit_book_data']))
        {
            $data['book_data'] = $_SESSION['edit_book_data'];
            unset($_SESSION['edit_book_data']);
        }
        
        if(isset($_REQUEST['book_name']))
        {
            $this->load->library('classes/LibBookvalidator');
            $oV = new LibBookvalidator();
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                $this->messages->error($oV->getMessage());
                $_SESSION['edit_book_data'] = $_REQUEST;  
                redirect('admin/edit_book_in_library/'.$book_id); 
            }
            else
            {
                //var_dump($_POST);die;
                $book_data['category_id'] = intval($_POST['category']);
                $book_data['book_name'] = $_POST['book_name'];
                $book_data['book_author'] = $_POST['book_author'];
                $book_data['book_publisher'] = $_POST['book_publisher'];
                $book_data['publisher_city'] = $_POST['publisher_city'];
                $book_data['publishing_date'] = $_POST['publishing_date'];
                $book_data['publishing_number'] = $_POST['publishing_number'];
                $book_data['publish_quantity'] = $_POST['publish_quantity'];
                $book_data['book_pages'] = $_POST['book_pages'];
                $book_data['book_language'] = $_POST['book_language'];
                $book_data['book_price'] = $_POST['book_price'];
                $book_data['glossary'] = $_POST['glossary'];
                $book_data['detail'] = $_POST['detail'];
                $book_data['status'] = intval($_POST['status']);
                $book_data['lib_book_id'] = intval($_POST['lib_book_id']);
                
                if($this->admin_model->edit_book_in_library($book_data))
                {
                    $this->messages->success("Book has been updated successfully.");
                    redirect(base_url().'admin/library_list','refresh'); 
                }
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/library/form",$data);
        $this->load->view("admin/footer"); 
    }

    function delete_book_in_library()
    {
        $this->check_is_admin_login();
        
        $book_id = $this->uri->segment(3);
        $this->admin_model->delete_book_in_library($book_id);
        $this->messages->success("Book has been deleted successfully.");
        redirect(base_url().'admin/library_list/','refresh');
    }

    function categories()
    {
        $this->check_is_admin_login();
        $data['categories'] = $this->admin_model->get_all_categories("all");
        $this->load->view("admin/header"); 
        $this->load->view("admin/category/list",$data); 
        $this->load->view("admin/footer");  
    }

    function add_category()
    {
        $this->check_is_admin_login();
        $data = array();
        $data['form_heading'] = "Add new book Topic";
        
        if(isset($_REQUEST['category_name']))
        {
            $topic_data['category_name'] = $_POST['category_name'];
            $topic_data['category_status'] = intval($_POST['category_status']);
            $topic_data['parent_id'] = 0;
            if($this->admin_model->add_category_in_library($topic_data))
            {
                $this->messages->success("Topic has been added for books successfully.");
                redirect('admin/categories','refresh'); 
            }
        }
     
        $this->load->view("admin/header");
        $this->load->view("admin/category/form",$data);
        $this->load->view("admin/footer");
    }

    function edit_book_category()
    {
        $this->check_is_admin_login();
        $category_id = intval($this->uri->segment(3));
        $data['category_id'] = $category_id;
        $data['category_data'] = $this->admin_model->get_category_detail($category_id);
        $data['form_heading'] = "Edit book Topic";
        
        if(isset($_REQUEST['category_name']))
        {
            $topic_data['category_name'] = $_POST['category_name'];
            $topic_data['category_status'] = intval($_POST['category_status']);
            $topic_data['category_id'] = intval($_POST['category_id']);
            $topic_data['parent_id'] = 0;
            if($this->admin_model->update_category_in_library($topic_data))
            {
                $this->messages->success("Topic has been updated successfully.");
                redirect('admin/categories','refresh'); 
            }
        }
        $this->load->view("admin/header");
        $this->load->view("admin/category/form",$data);
        $this->load->view("admin/footer");
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

    function add_new_book()
    {
       $this->check_is_admin_login();
        
        $data = array();
        $form_action  = "add_new_book";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Add New Book";
        
        if(isset($_SESSION['add_new_book_str']))
        {
            $data['book_data'] = $_SESSION['add_new_book_str'];
            unset($_SESSION['add_new_book_str']);
        }
        
        if(isset($_REQUEST['book_title']))
        {
            $this->load->library('classes/Bookvalidator');
            $oV = new Bookvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['add_new_book_str'] = $_REQUEST;  
                  redirect('admin/add_new_book','refresh'); 
            }
            else
            {
               
                //$total_books_count = $this->admin_model->get_total_books_count();
                $book_data = array();
                
                $book_data['book_title'] = safe($this->input->post('book_title'));
                $book_data['book_author'] = safe($this->input->post('book_author'));
                $book_data['book_description'] = safe($_POST['book_description']);
                $book_data['book_pdf_filename'] = safe($_POST['book_pdf_filename']);
                $book_data['book_folder'] = safe($_POST['book_folder']);
                $book_data['book_status'] = safe($this->input->post('book_status'));
                $book_data['date_added'] = getdbTimeFormat(time());

                
                $book_id = $this->admin_model->add_new_book($book_data); 
                    
                if(isset($_FILES["book_title_file"]['name']) && $_FILES["book_title_file"]['name'] != "")
                {
                    $response_upload = $this->admin_model->upload_book_title($book_id,$book_title='');

                    if($response_upload == false)
                    {
                        $this->messages->error("Book Front Page File couldn't be uploaded");
                    }
                }

                $this->messages->success("Book has been created successfully.");
                
                redirect('admin/books','refresh'); 
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/books/form",$data);
        $this->load->view("admin/footer"); 
    }
    
    
    function add_new_article()
    {
        
        $this->check_is_admin_login();
        $data = array();
        $form_action  = "add_new_article";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Add New Article";
        
        if(isset($_SESSION['add_new_article_str']))
        {
            $data['article_data'] = $_SESSION['add_new_article_str'];
            unset($_SESSION['add_new_article_str']);
        }
        
        if(isset($_REQUEST['article_title']))
        {
            $this->load->library('classes/Articlevalidator');
            $oV = new Articlevalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['add_new_article_str'] = $_REQUEST;  
                  redirect('admin/add_new_article','refresh'); 
            }
            else
            {
               
                $total_articles_count = $this->admin_model->get_total_articles_count();
                $article_data = array();
                
                $article_data['article_title'] = safe($this->input->post('article_title'));
                $article_data['article_description'] = safe($this->input->post('article_description'));
                $article_data['article_status'] = safe($this->input->post('article_status'));
                $article_data['date_added'] = getdbTimeFormat(time());
                $article_data['display_order'] = (int)$total_articles_count+1;
                
                $article_id = $this->admin_model->add_new_article($article_data); 
               
                if(isset($_FILES["article_image"]['name']) && $_FILES["article_image"]['name'] != "")
                {
                    $response_upload = $this->admin_model->upload_article_image($article_id,$article_image='');

                    if($response_upload == false)
                    {
                        $this->messages->error("Article Image File couldn't be uploaded");
                    }
                }
                
                /*if($_REQUEST['book_type'] == "pdf_format")
                {
                    if(isset($_FILES["book_filename"]['name']) && $_FILES["book_filename"]['name'] != "")
                    {
                        $response_upload = $this->admin_model->upload_book_filename($book_id,$book_filename='');

                        if($response_upload == false)
                        {
                            $this->messages->error("Book File couldn't be uploaded");  
                        }
                    }
                }                                         */
                
                $this->messages->success("Article has been created successfully.");
                
                redirect('admin/articles','refresh'); 
            }
        }
     
        $this->load->view("admin/header");
        $this->load->view("admin/articles/form",$data);
        $this->load->view("admin/footer"); 
    }
    
    function edit_book()
    {
        /*
        $this->load->helper('directory');
        $map = directory_map('C:/wampstack/apache2/htdocs/election2013/user_guide');
        pre($map);
        */
        $this->check_is_admin_login();
        $data = array();
        $form_action  = "edit_book";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit Book"; 
        
        $book_id = "";
        
        $book_id = $this->uri->segment(3);  
        
        if(isset($_POST['book_id']))
        {
            $book_id = $_POST['book_id'];
        }
       
        $book_details_row = $this->admin_model->get_book_details_by_book_id($book_id);  
         
        if(count($book_details_row) == 0)
        {
            redirect('admin/books','refresh');   
        }
        
        $data['book_data'] = $book_details_row;
        
        if(isset($_SESSION['edit_book_str']))
        {
            $data['book_data'] = $_SESSION['edit_book_str'];
            unset($_SESSION['edit_book_str']);
        }
        
        if(isset($_REQUEST['book_title']))
        {
            $this->load->library('classes/Bookvalidator');
            $oV = new Bookvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_book_str'] = $_REQUEST;  
                  $book_id = $this->input->post('book_id');
                  redirect('admin/edit_book/'.$book_id,'refresh'); 
            }
            else
            {
                $book_data = array();
                
                $book_data['book_id'] = safe($this->input->post('book_id'));
                $book_data['book_title'] = safe($this->input->post('book_title'));
                $book_data['book_author'] = safe($this->input->post('book_author'));
                $book_data['book_description'] = safe($_POST['book_description']);
                $book_data['book_pdf_filename'] = safe($_POST['book_pdf_filename']);
                $book_data['book_folder'] = safe($_POST['book_folder']);
                $book_data['book_status'] = safe($this->input->post('book_status'));
                //$book_data['date_added'] = getdbTimeFormat(time());
                $this->admin_model->edit_book($book_data); 
               
                $book_details_row = $this->admin_model->get_book_details_by_book_id($this->input->post('book_id'));  
                
                if(isset($_FILES["book_title_file"]['name']) && $_FILES["book_title_file"]['name'] != "")
                {
                    $response_upload = $this->admin_model->upload_book_title($book_id,$book_details_row['book_title_file']);

                    if($response_upload == false)
                    {
                        $this->messages->error("Book Front Page File couldn't be uploaded");
                    }
                }
                $this->messages->success("Book has been updated successfully.");
                redirect('admin/books','refresh'); 
            }
        }
        $this->load->view("admin/header");
        $this->load->view("admin/books/form",$data);
        $this->load->view("admin/footer");
    }
    
    function edit_article()
    {
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "edit_article";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit Article"; 
        
        $article_id = "";
        
        $article_id = $this->uri->segment(3);  
        
        if(isset($_POST['article_id']))
        {
            $article_id = $_POST['article_id'];
        }
       
        $article_details_row = $this->admin_model->get_article_details_by_article_id($article_id);  
         
        if(count($article_details_row) == 0)
        {
            redirect('admin/articles','refresh');   
        }
        
        $data['article_id'] = $article_id;
        $data['article_data'] = $article_details_row;
        
        if(isset($_SESSION['edit_book_str']))
        {
            $data['book_data'] = $_SESSION['edit_article_str'];
            unset($_SESSION['edit_article_str']);
        }
        
        if(isset($_REQUEST['article_title']))
        {
            $this->load->library('classes/Articlevalidator');
            $oV = new Articlevalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_article_str'] = $_REQUEST;  
                  $article_id = $this->input->post('article_id');
                  redirect('admin/edit_article/'.$article_id,'refresh'); 
            }
            else
            {                                  
                
                $article_data = array();
                $article_data['article_id'] = safe($this->input->post('article_id'));
                $article_data['article_title'] = safe($this->input->post('article_title'));
                $article_data['article_description'] = safe($this->input->post('article_description'));
                $article_data['article_status'] = safe($this->input->post('article_status'));
                $article_data['date_modified'] = getdbTimeFormat(time());
                
                $this->admin_model->edit_article($article_data);  
               
                $article_details_row = $this->admin_model->get_article_details_by_article_id($this->input->post('article_id'));  
                
                if(isset($_FILES["article_image"]['name']) && $_FILES["article_image"]['name'] != "")
                {
                    $response_upload = $this->admin_model->upload_article_image($this->input->post('article_id'),$article_details_row['article_image']);

                    if($response_upload == false)
                    {
                        $this->messages->error("Article Image File couldn't be uploaded");
                    }
                }
                
                $this->messages->success("Article has been updated successfully.");
                
                redirect('admin/articles','refresh'); 
            }
         }
         
        
        $this->load->view("admin/header");
        $this->load->view("admin/articles/form",$data);
        $this->load->view("admin/footer");
    }
    
    function add_new_admin_user()
    {
       $this->check_is_admin_login();
        
        $data = array();
        $form_action  = "add_new_admin_user";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Add new admin user";
        
        if(isset($_SESSION['add_new_admin_user_str']))
        {
            $data['admin_data'] = $_SESSION['add_new_admin_user_str'];
            unset($_SESSION['add_new_admin_user_str']);
        }
        
        if(isset($_REQUEST['users_email']))
        {
            $this->load->library('classes/Adminusersvalidator');
            $oV = new Adminusersvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['add_new_admin_user_str'] = $_REQUEST;  
                  redirect('admin/add_new_admin_user/','refresh'); 
            }
            else
            {
                
                $users_password = safe($this->input->post('users_password'));
                $md5password = md5($users_password);
                
                if($this->admin_model->email_exists($_REQUEST['users_email']) == false)
                {
                    $this->messages->error("Email <b>(".$_REQUEST['users_email'].")</b> already exists"); 
                    $_SESSION['add_new_admin_user_str'] = $_REQUEST;  
                    redirect('admin/add_new_admin_user/','refresh'); 
                }
                
                $admin_data = array('users_fname' => safe($this->input->post('users_fname')),
                                    'users_lname' => safe($this->input->post('users_lname')),
                                    'users_email' => safe($this->input->post('users_email')),
                                    'users_status' => '1',
                                    'users_password' => $md5password,
                                    'users_isAdmin' => '1',
                                    'roles_id' => '6');
                
                $users_id = $this->admin_model->add_new_admin_user($admin_data);
   
                $this->messages->success("Admin user has been created successfully.");
                
                redirect('admin/admin_users/','refresh'); 
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/admin_users/form",$data);
        $this->load->view("admin/footer"); 
    }
    
    
   function edit_admin_user()
    {
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "edit_admin_user";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit admin user";
        $users_id = '';
        
        $users_id = $this->uri->segment(3);    
        
        $user_row = $this->admin_model->get_admin_user_data_by_users_id($users_id);
        
        $data['admin_data'] = $user_row;
        
        if($users_id)
        {
            $data['users_id'] = $users_id;
        }
        else
        {
            $data['users_id'] = "";
        }
        
        if(isset($_SESSION['edit_admin_user_str']))
        {
            $data['admin_data'] = $_SESSION['edit_admin_user_str'];
            unset($_SESSION['edit_admin_user_str']);
        }
        
        if(isset($_REQUEST['users_fname']))
        {
            $this->load->library('classes/Adminusersvalidator');
            $oV = new Adminusersvalidator(); 
            $oV->setEditMode(true);
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_admin_user_str'] = $_REQUEST;
                  $users_id = $this->input->post('users_id');  
                  redirect('admin/edit_admin_user/'.$users_id,'refresh'); 
            }
            else
            {
                $user_row = $this->admin_model->get_admin_user_data_by_users_id($this->input->post('users_id'));
                
                if($user_row['users_email'] != $_REQUEST['users_email'])
                {
                    if($this->admin_model->email_exists($_REQUEST['users_email']) == false)
                    {
                        $this->messages->error("Email <b>(".$_REQUEST['users_email'].")</b> already exists"); 
                        $_SESSION['edit_edit_user_str'] = $_REQUEST;  
                        redirect('admin/edit_admin_user/'.$this->input->post('users_id'),'refresh'); 
                    }
                }
                
             $admin_data = array();
             
             $admin_data['users_fname'] = safe($this->input->post('users_fname'));
             $admin_data['users_lname'] = safe($this->input->post('users_lname'));
             $admin_data['users_email'] = safe($this->input->post('users_email'));
             $admin_data['users_isAdmin'] = '1';
             $admin_data['users_id'] = $this->input->post('users_id');
             
             if(isset($_REQUEST['users_password']) && $_REQUEST['users_password'] != "")
             {
                $users_password = $this->input->post('users_password');
                $md5password = md5($users_password); 
                $admin_data['users_password'] = $md5password;   
             }
                
                $this->admin_model->edit_admin_user($admin_data);
                
                $this->messages->success("Admin user has been updated successfully.");
                redirect('admin/admin_users/','refresh'); 
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/admin_users/form",$data);
        $this->load->view("admin/footer");
    }

    function site_contents()
    {
      $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      $data = $_REQUEST;
                                            
      $site_contents = $this->admin_model->get_site_contents($data);
      
      $data['site_contents'] = $site_contents;
      
      $this->load->view("admin/site_contents/site_contents",$data); 
      
      $this->load->view("admin/footer");   
    }
    
    function edit_content()
    {
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "edit_content";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit Content";
        $page_id = '';
        
        $page_id = $this->uri->segment(3);    
        
        $content_data = $this->admin_model->get_content_by_page_id($page_id);
        $data['content_data'] = $content_data;
        
        if($page_id)
        {
            $data['page_id'] = $page_id;
        }
        else
        {
            $data['page_id'] = "";
        }
        
        if(isset($_SESSION['edit_content_str']))
        {
            $data['content_data'] = $_SESSION['edit_content_str'];
            unset($_SESSION['edit_content_str']);
        }
        
        if(isset($_REQUEST['page_title']))
        {
            $this->load->library('classes/Contentvalidator');
            $oV = new Contentvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_content_str'] = $_REQUEST;
                  $page_id = $this->input->post('page_id');  
                  redirect('admin/edit_content/'.$page_id,'refresh'); 
            }
            else                                                                         
            {
                $page_content = $_REQUEST['page_content'];
                $page_data = array( 'page_id' => $this->input->post('page_id'),
                                    'page_title' => safe($this->input->post('page_title')),
                                    'page_content' => $page_content);
                
                $this->admin_model->edit_content($page_data);
                
                $this->messages->success("Content has been updated successfully.");
                redirect('admin/site_contents/','refresh');
            }
         }  
     
        $this->load->view("admin/header");
        $this->load->view("admin/site_contents/form",$data);
        $this->load->view("admin/footer");
    }
    
    function change_password()
    {
      $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "change_password";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Change Password";
        
        if(isset($_REQUEST['current_password']))
        {
            $this->load->library('classes/Passwordvalidator');
            $oV = new Passwordvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  redirect('admin/change_password/','refresh'); 
            }
            else
            {
                $users_id = $this->session->userdata('admin_uid');
                $admin_password_data = $this->admin_model->get_admin_password_data_by_user_id($users_id);
                
                $user_current_password = $admin_password_data['users_password'];
                $current_password = $this->input->post('current_password');
                $confirm_password = $this->input->post('confirm_password');
                
                if($user_current_password == md5($current_password))
                {
                    $password_data = array('users_id' => $users_id,
                                           'users_password' => md5($confirm_password));
                                           
                    $this->admin_model->change_password($password_data);
                    $this->messages->success("Your password has been changed successfully.");
                    redirect('admin/change_password/','refresh');
                }
                
                else
                {
                    $this->messages->error("Your current password didn't verify.");
                    redirect('admin/change_password/','refresh');
                }
            }
         }  
     
        $this->load->view("admin/header");
        $this->load->view("admin/change_password",$data);
        $this->load->view("admin/footer");  
    }


    function email_templates()
    {
      $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      $data = $_POST;
                                            
      $email_templates = $this->admin_model->get_email_templates($data);
      
      $data['email_templates'] = $email_templates;
      $this->load->view("admin/email_templates/email_templates",$data); 
      
      $this->load->view("admin/footer");   
    }
    
    function edit_email_template()
    {
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "edit_email_template";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit Email template";
        $template_id = '';
        
        $template_id = $this->uri->segment(3);    
        
        if(isset($_POST['template_id']))
        {
            $template_id = $_POST['template_id'];
        }
        
        $template_data = $this->admin_model->get_email_template_by_template_id($template_id);
        
        $data['template_data'] = $template_data;
        $data['identifiers'] = unserialize($template_data['identifiers']);
      
        if($template_id)
        {
            $data['template_id'] = $template_id;
        }
        else
        {
            $data['template_id'] = "";
        }
        
        if(isset($_SESSION['edit_email_template_str']))
        {
            $data['template_data'] = $_SESSION['edit_email_template_str'];
            unset($_SESSION['edit_email_template_str']);
        }
        
        if(isset($_POST['template_subject']))
        {
            $this->load->library('classes/Templatevalidator');
            $oV = new Templatevalidator(); 
            
            if($oV->Validate($_POST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_email_template_str'] = $_POST;
                  $page_id = $this->input->post('template_id');  
                  redirect('admin/edit_email_template/'.$template_id,'refresh'); 
            }
            else
            {
                $template_data = array();
                
                $identifiersArray = array();
                $identifiersArray["User Name"] = "[USER_NAME]";
                $identifiersArray["Feedback Message"] = "[FEEDBACK_MESSAGE]";
                $identifiersArray["UnApprove Reason"] = "[UN_APPROVE_REASON]";
                //$identifiersArray["Activation Link"] = "[ACTIVATION_LINK]";
                
                $template_data['template_id'] = $this->input->post('template_id');
                $template_data['template_subject'] = $this->input->post('template_subject');
                $template_data['template_content'] = $this->input->post('template_content');
                //$template_data['identifiers'] = serialize($identifiersArray);
                
                
                $this->admin_model->edit_email_template($template_data);
                
                $this->messages->success("Email template has been updated successfully.");
                redirect('admin/email_templates/','refresh');
            }
         }  
     
        $this->load->view("admin/header");
        $this->load->view("admin/email_templates/form",$data);
        $this->load->view("admin/footer");
    }
    
    function sitecodes()
    {
      $this->check_is_admin_login();
      $this->load->view("admin/header"); 
      
      $data = array();
      $data = $_POST;
      $sitecodes = $this->SiteCodes_model->get_sitecodes_list($data);
      $data['sitecodes'] = $sitecodes;
      $this->load->view("admin/sitecodes/sitecodes",$data); 
      
      $this->load->view("admin/footer");
    }
    
    function add_new_codes()
    {
       $this->check_is_admin_login();
        
        $data = array();
        $form_action  = "add_new_codes";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Add New System Data Codes";
        
        if(isset($_SESSION['add_new_codes_str']))
        {
            $data['codes_data'] = $_SESSION['add_new_codes_str'];
            unset($_SESSION['add_new_codes_str']);
        }
        
        if(isset($_REQUEST['codeType']))
        {
            $this->load->library('classes/Codesvalidator');
            $oV = new Codesvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['add_new_codes_str'] = $_REQUEST;  
                  redirect('admin/add_new_codes/','refresh'); 
            }
            else
            {
                
                $comma_data = explode(",",$this->input->post('comma_data'));
                $added = 0;
                for($i=0;$i<count($comma_data);$i++)
                {
                        $qq = $this->SiteCodes_model->create($this->input->post('codeType'),stripslashes($comma_data[$i]));
                    if($qq)
                    {
                        $added++;    
                    }
                }
                if($added > 0)
                {
                    $this->messages->success("Site codes has been created successfully.");
                    redirect('admin/sitecodes/','refresh'); 
                }
                else
                {
                    $this->messages->success("Site codes has been created successfully.");
                    redirect('admin/sitecodes/','refresh'); 
                }  
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/sitecodes/add",$data);
        $this->load->view("admin/footer"); 
    }
    
    
    function edit_code()
    {
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "edit_code";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit Specification Code";
        $codeID = '';
        
        $codeID = $this->uri->segment(3);    
        
        $codes_data = $this->admin_model->get_code_by_codeID($codeID);
        $data['codes_data'] = $codes_data;
        
        if($codeID)
        {
            $data['codeID'] = $codeID;
        }
        else
        {
            $data['codeID'] = "";
        }
        
        if(isset($_SESSION['edit_code_str']))
        {
            $data['codes_data'] = $_SESSION['edit_code_str'];
            unset($_SESSION['edit_code_str']);
        }
        
        if(isset($_REQUEST['codeType']))
        {
            $this->load->library('classes/Editcodesvalidator');
            $oV = new Editcodesvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_code_str'] = $_REQUEST;
                  $codeID = $this->input->post('codeID');  
                  redirect('admin/edit_code/'.$codeID,'refresh'); 
            }
            else                                                                         
            {
                $codes_data = array('codeID' => $this->input->post('code_id'),
                                    'codeType' => safe($this->input->post('codeType')),
                                    'codeValue' => safe($this->input->post('codeValue')));
                
                $this->SiteCodes_model->update_site_data_codes_save($codes_data);
                
                $this->messages->success("Code Value has been updated successfully.");
                redirect('admin/sitecodes/','refresh'); 
            }
         }  
     
        $this->load->view("admin/header");
        $this->load->view("admin/sitecodes/edit",$data);
        $this->load->view("admin/footer"); 
    }
    
    function update_code_status()
    {
        $this->check_is_admin_login();
        
        $status_id = $this->uri->segment(3);    
        $code_id = $this->uri->segment(4);    
        $status_id = $this->admin_model->update_code_status($status_id, $code_id);
        if($status_id == 1)
        {
            $this->messages->success("Code has been activated successfully.");    
        }
        else
        {
            $this->messages->success("Code has been deactivated successfully.");    
        }
        
        redirect('admin/sitecodes/','refresh');
    }
    
    
    function edit_newsletter()
    {
        $this->check_is_admin_login();
      
        $data = array();      
        $form_action  = "edit_newsletter";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit newsletter";
        
        $newsletter_id = '';
        
        $newsletter_id = $this->uri->segment(3);    
        
        $newsletter_row = $this->admin_model->get_newsletter_details_by_newsletter_id($newsletter_id);
        
        
        $data['newsletter_data'] = $newsletter_row;
        
        if($newsletter_id)
        {
            $data['newsletter_id'] = $newsletter_id;
        }
        else
        {
            $data['newsletter_id'] = "";
        }
        
        if(isset($_SESSION['edit_newsletter_str']))
        {
            $data['newsletter_data'] = $_SESSION['edit_newsletter_str'];
            unset($_SESSION['edit_newsletter_str']);
        }
        
        if(isset($_REQUEST['newsletter_title']))
        {
            $this->load->library('classes/Newslettervalidator');
            $oV = new Newslettervalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_newsletter_str'] = $_REQUEST;  
                  $newsletter_id = $this->input->post('newsletter_id');
                  redirect('admin/edit_newsletter/'.$newsletter_id,'refresh'); 
            }
            else
            {
                $newsletter_data = array('newsletter_id' => safe($this->input->post('newsletter_id')), 
                                         'newsletter_title' => safe($this->input->post('newsletter_title')), 
                                         'newsletter_text' => $_POST['newsletter_text'],
                                         'date_updated' => getdbTimeFormat(time()));
                
                $this->admin_model->edit_newsletter($newsletter_data);
                
                $this->messages->success("Newsletter has been updated successfully.");
                redirect('admin/newsletters_created','refresh'); 
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/newsletters_created/form",$data);
        $this->load->view("admin/footer");
    }
    
    function newsletter_details($newsletter_id)
    {
        $newsletter_row = $this->admin_model->get_newsletter_details_by_newsletter_id($newsletter_id);
        $data['newsletter_data'] = $newsletter_row;
        $this->load->view("admin/newsletters_created/details",$data); 
    }
    
    function send_newsletter()
    {
        $newsletter_id = (int)$this->uri->segment(3); 
        $this->admin_model->send_newsletter($newsletter_id);   
        $this->messages->success("Newsletter has been sent successfully.");
        redirect('admin/newsletters_sent','refresh');  
    }
    
   function update_subscription_status()
    {
        $this->check_is_admin_login();
        
        $status_id = $this->uri->segment(3);    
        $news_id = $this->uri->segment(4);    
        $status_id = $this->admin_model->update_subscription_status($status_id, $news_id);
        if($status_id == 1)
        {
            $this->messages->success("Subscription has been activated successfully.");    
        }
        else
        {
            $this->messages->success("Subscription has been deactivated successfully.");    
        }
        
        redirect('admin/newsletter_subscriptions','refresh');
    }
    
    function delete_subscription()
    {
       $this->check_is_admin_login();
        
        $newsletter_subscription_id = $this->uri->segment(3);    
        $this->admin_model->delete_subscription($newsletter_subscription_id);
        $this->messages->success("Subscription has been deleted successfully.");
        redirect('admin/newsletter_subscriptions/','refresh');
    }
    
    
    function gallery()
    {
        $this->check_is_admin_login();

        $this->load->view("admin/header"); 
        $data = array();
        $data = $_POST;
        //offset
        $data['offset'] = intval($this->uri->segment(3));
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url().'index.php/admin/gallery/';
        $config['total_rows'] = $this->admin_model->get_gallery_list_rows();
        $config['enable_query_strings'] = FALSE;
        $limit = $config['per_page'] = 30;    
        $this->pagination->initialize($config);
        
        $gallery_pictures = $this->admin_model->get_gallery_pictures_data($limit,$data['offset']);
        $data['gallery_pictures'] = $gallery_pictures;
        $data['pagination'] =  $this->pagination->create_links();

        $this->load->view("admin/gallery/view_images",$data); 

        $this->load->view("admin/footer");     
    }

    function delete_newsletter()
    {
       $this->check_is_admin_login();
        
        $newsletter_id = $this->uri->segment(3);    
        $this->admin_model->delete_newsletter($newsletter_id);
        $this->messages->success("Newsletter has been deleted successfully.");
        redirect('admin/newsletters_created/','refresh');
    }
    
   function add_new_newsletter()
    {  
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "add_new_newsletter";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Create new newsletter";
        
        
        if(isset($_SESSION['add_new_newsletter_str']))
        {
            $data['newsletter_data'] = $_SESSION['add_new_newsletter_str'];
            unset($_SESSION['add_new_newsletter_str']);
        }
        
        if(isset($_REQUEST['newsletter_title']))
        {
            $this->load->library('classes/Newslettervalidator');
            $oV = new Newslettervalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['add_new_newsletter_str'] = $_REQUEST;  
                  redirect('admin/add_new_newsletter'); 
            }
            else
            {
                $newsletter_data = array('newsletter_title' => safe($this->input->post('newsletter_title')), 
                'newsletter_text' => $_POST['newsletter_text'],
                'date_added' => getdbTimeFormat(time()));
                $newsletter_id = $this->admin_model->add_new_newsletter($newsletter_data);
                
                $this->messages->success("Newsletter has been created successfully.");
                redirect('admin/newsletters_created','refresh'); 
            }
         }
     
        $this->load->view("admin/header");
        $this->load->view("admin/newsletters_created/form",$data);
        $this->load->view("admin/footer");
    }
    
    function newsletters_sent($offset=NULL)
    {
       $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      
      $data = $_REQUEST;    
      
      if($offset==NULL)
      {
        $offset=0;
      }

      $data['offset'] = $offset;
      $config['uri_segment'] = 3;
      $config['base_url'] = base_url().'index.php/admin/products/';          
      $config['total_rows'] = $this->admin_model->get_newsletters_sent_list_rows();
      $config['enable_query_strings'] = FALSE;
      $limit = $config['per_page'] = 80;    
      $this->pagination->initialize($config);
               
      $newsletters_sent = $this->admin_model->get_newsletters_sent_list($data,$offset,$limit);
      
      $data['newsletters_sent'] =  $newsletters_sent;
      $data['pagination'] =  $this->pagination->create_links();
      
      $this->load->view("admin/newsletters_sent/newsletters_sent",$data); 
      
      $this->load->view("admin/footer");
    }
    
    
    function newsletter_subscriptions($offset=NULL)
    {
       $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      
      $data = $_REQUEST;    
      
      if($offset==NULL)
      {
        $offset=0;
      }

      $data['offset'] = $offset;
      $config['uri_segment'] = 3;
      $config['base_url'] = base_url().'index.php/admin/newsletter_subscriptions/';
      $config['total_rows'] = $this->admin_model->get_newsletter_subscriptions_list_rows();
      $config['enable_query_strings'] = FALSE;
      $limit = $config['per_page'] = 80;    
      $this->pagination->initialize($config);
               
      $newsletter_subscriptions = $this->admin_model->get_newsletter_subscriptions_list($data,$offset,$limit);
      
      $data['newsletter_subscriptions'] =  $newsletter_subscriptions;
      $data['pagination'] =  $this->pagination->create_links();
      
      $this->load->view("admin/newsletter_subscriptions/newsletter_subscriptions",$data); 
      
      $this->load->view("admin/footer");
    }
    
    function newsletters_created($offset=NULL)
    {
       $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      
      $data = $_REQUEST;    
      
      if($offset==NULL)
      {
        $offset=0;
      }

      $data['offset'] = $offset;
      $config['uri_segment'] = 3;
      $config['base_url'] = base_url().'index.php/admin/products/';
      $config['total_rows'] = $this->admin_model->get_newsletters_created_list_rows();
      $config['enable_query_strings'] = FALSE;
      $limit = $config['per_page'] = 80;    
      $this->pagination->initialize($config);
               
      $newsletters_created = $this->admin_model->get_newsletters_created_list($data,$offset,$limit);
      
      $data['newsletters_created'] =  $newsletters_created;
      $data['pagination'] =  $this->pagination->create_links();
      
      $this->load->view("admin/newsletters_created/newsletters_created",$data); 
      
      $this->load->view("admin/footer");
    }
    
    
    function update_picture_title()
    {
         $image_text = safe($_POST['image_text']);
         $gallery_id = $_GET['gallery_id'];
         $this->admin_model->update_picture_title($image_text,$gallery_id);
    }
    
    /*function update_display_order_()
    {
         $display_order = $_POST['display_order'];
         $gallery_id = $_GET['gallery_id'];
         $this->admin_model->update_display_order($display_order,$gallery_id);
    }                               */
    
    function update_is_show_status()
    {
         $gallery_image_status = $_POST['gallery_image_status'];
         $gallery_id = $_GET['gallery_id'];
         $this->admin_model->update_is_show_status($gallery_image_status,$gallery_id);
    }
    
    function delete_gallery_image()
    {
        $gallery_id = $this->uri->segment(3);    
        
        $this->admin_model->delete_gallery_image($gallery_id);
        $this->messages->success("Picture has been deleted successfully.");        
        
        redirect('admin/gallery/','refresh'); 
    }
    
    function edit_news()
    {
        $this->check_is_admin_login();
      
        $data = array();
        $form_action  = "edit_news";
        $data['form_action'] = $form_action;
        $data['form_heading'] = "Edit news";
        
        $news_id = '';
        
        $news_id = $this->uri->segment(3);    
        
        $news_row = $this->admin_model->get_news_row_by_news_id($news_id);
        
        $data['news_data'] = $news_row;
        
        if($news_id)
        {
            $data['news_id'] = $news_id;
        }
        else
        {
            $data['news_id'] = "";
        }
        
        if(isset($_SESSION['edit_news_str']))
        {
            $data['news_data'] = $_SESSION['edit_news_str'];
            unset($_SESSION['edit_news_str']);
        }
        
        if(isset($_REQUEST['news_title']))
        {
            $this->load->library('classes/Newsvalidator');
            $oV = new Newsvalidator(); 
            
            if($oV->Validate($_REQUEST)->isValidated() == false)
            {
                  $this->messages->error($oV->getMessage());
                  $_SESSION['edit_news_str'] = $_REQUEST;  
                  $news_id = $this->input->post('news_id');
                  redirect('admin/edit_news/'.$news_id); 
            }
            else
            {
                $news_data = array(
                            'news_id' => safe($this->input->post('news_id')), 
                            'news_title' => addslashes($_POST['news_title']), 
                            'news_details' => addslashes($_POST['news_details']),
                            'news_date' => safe($_POST['news_date']),
                            'display_order' => $_POST['display_order'],
                            'news_status' => safe($this->input->post('news_status')), 
                            'date_updated' => getdbTimeFormat(time()));
                
                $this->admin_model->edit_news($news_data);
                
                $this->messages->success("News has been updated successfully.");
                redirect('admin/news','refresh'); 
            }
         }
        $this->load->view("admin/header");
        $this->load->view("admin/news/form",$data);
        $this->load->view("admin/footer");
    }
    
    function news($offset=NULL)
    {
      $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      
      $data = $_REQUEST;    
      
      if($offset==NULL)
      {
        $offset=0;
      }

      $data['offset'] = $offset;
      $config['uri_segment'] = 3;
      $config['base_url'] = base_url().'index.php/admin/news/';
      $config['total_rows'] = $this->admin_model->get_news_list_rows();
      $config['enable_query_strings'] = FALSE;
      $limit = $config['per_page'] = 80;    
      $this->pagination->initialize($config);
               
      $news = $this->admin_model->get_news_list($data,$offset,$limit);
      
      $data['pagination'] =  $this->pagination->create_links();
      $data['news'] = $news;
      $this->load->view("admin/news/news",$data); 
      
      $this->load->view("admin/footer");  
    }
    
    function articles($offset=NULL)
    {
      $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      
      $data = $_REQUEST;    
      
      if($offset==NULL)
      {
        $offset=0;
      }

      $data['offset'] = $offset;
      $config['uri_segment'] = 3;
      $config['base_url'] = base_url().'index.php/admin/articles/';
      $config['total_rows'] = $this->admin_model->get_news_list_rows();
      $config['enable_query_strings'] = FALSE;
      $limit = $config['per_page'] = 80;    
      $this->pagination->initialize($config);
               
      $articles = $this->admin_model->get_articles_list($data,$offset,$limit);
      
      $data['pagination'] =  $this->pagination->create_links();
      $data['articles'] = $articles;
      $this->load->view("admin/articles/articles",$data); 
      
      $this->load->view("admin/footer");  
    }
    
    function books($offset=NULL)
    {
      $this->check_is_admin_login();
      
      $this->load->view("admin/header"); 
      $data = array();
      
      $data = $_REQUEST;    
      
      if($offset==NULL)
      {
        $offset=0;
      }

      $data['offset'] = $offset;
      $config['uri_segment'] = 3;
      $config['base_url'] = base_url().'index.php/admin/news/';
      $config['total_rows'] = $this->admin_model->get_books_list_rows();
      $config['enable_query_strings'] = FALSE;
      $limit = $config['per_page'] = 80;    
      $this->pagination->initialize($config);
               
      $books = $this->admin_model->get_books_list($data,$offset,$limit);
      
      $data['pagination'] =  $this->pagination->create_links();
      $data['books'] = $books;
      $this->load->view("admin/books/books",$data); 
      
      $this->load->view("admin/footer");  
    }
    
     function update_news_status()
    {
        $this->check_is_admin_login();
        
        $status_id = $this->uri->segment(3);    
        $news_id = $this->uri->segment(4);    
        $status_id = $this->admin_model->update_news_status($status_id, $news_id);
        if($status_id == 1)
        {
            $this->messages->success("News has been activated successfully.");    
        }
        else
        {
            $this->messages->success("News has been deactivated successfully.");    
        }
        
        redirect('admin/news','refresh');
    }  
    
    function news_details($news_id)
    {
        $news_row = $this->admin_model->get_news_details_by_news_id($news_id);
        $data['news_data'] = $news_row;
        $this->load->view("admin/news/details",$data); 
    }
    
    
    function delete_news()
    {
       $this->check_is_admin_login();
        
        $news_id = $this->uri->segment(3);    
        $this->admin_model->delete_news($news_id);
        $this->messages->success("News has been deleted successfully.");
        redirect('admin/news','refresh');
    }
    
    
    function delete_book()
    {
       $this->check_is_admin_login();
        
        $book_id = $this->uri->segment(3);    
        $this->admin_model->delete_book($book_id);
        $this->messages->success("Book has been deleted successfully.");
        redirect('admin/books','refresh');
    }
    
    function delete_article()
    {
       $this->check_is_admin_login();
        
        $book_id = $this->uri->segment(3);    
        $this->admin_model->delete_article($book_id);
        $this->messages->success("Article has been deleted successfully.");
        redirect('admin/articles','refresh');
    }
    
    function update_display_order()
    {
         $table_name = $_GET['table_name'];
         $primaray_key_field = $_GET['primaray_key_field'];
         $display_order = $_POST['display_order'];
         $id = $_GET['id'];
         $this->admin_model->update_display_order($table_name,$primaray_key_field,$display_order,$id);
    }                                                                                   
    
    function update_status()
    {
         $table_name = $_GET['table_name'];
         $primaray_key_field = $_GET['primaray_key_field'];
         $set_field = $_GET['set_field'];
         $status = $_POST['status'];
         $id = $_GET['id'];
         $this->admin_model->update_status($table_name,$primaray_key_field,$set_field,$status,$id);
    }                              
    
    function view_book_images($book_id,$offset=NULL)
    {
        $this->check_is_admin_login();

        $this->load->view("admin/header"); 
        $data = array();
        $data = $_POST;
        
        $book_id = $this->uri->segment(3);
        //offset
        $data['offset'] = intval($this->uri->segment(4));
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url().'index.php/admin/view_book_images/'.$book_id."/";
        $config['total_rows'] = $this->admin_model->get_book_images_list_rows($book_id);
        $config['enable_query_strings'] = FALSE;
        $limit = $config['per_page'] = 30;    
        $this->pagination->initialize($config);
      
        
        
        $book_pages_data = $this->admin_model->get_book_details_by_book_id($book_id);
        
        if(count($book_pages_data)== 0)
        {
            redirect('admin/books','refresh');   
        }
        
        $data['book_pages_data'] = $book_pages_data;
        
        $book_pages = $this->admin_model->get_book_pages_data_by_book_id($book_id,$limit,$data['offset']);

      
        
      $data['book_pages'] = $book_pages;
      $data['book_page_id'] = $book_id;
      $data['pagination'] =  $this->pagination->create_links();
      
      
      

      $this->load->view("admin/books/view_book_images",$data); 
      $this->load->view("admin/footer");     
    }
    
    function uploadify()
    {   
       //set_time_limit(0);
       
       $tempFile = $_FILES['Filedata']['tmp_name'];
       $fileInfo = pathinfo($_FILES['Filedata']['name']);
       $fileName = $fileInfo["filename"];
       $basename = $fileInfo["basename"];
       $extension = $fileInfo["extension"];
        
       $uploaddir = _DIR_BOOKS;;
       $onlyext = $fileName;
       
       $book_id = $this->uri->segment(3);
       $book_filename = "yearbook_".date("YmdHis")."_".(int)$book_id."_".rand(10000,99999).".".$extension;
       
       
       $file = $uploaddir.$book_filename; 
       move_uploaded_file($tempFile, $file);
       
       $olddir = _DIR_BOOKS.$book_filename;
       $newdir = _DIR_BOOKS.'thumb_'.$book_filename;
       $newdir1 = _DIR_BOOKS.$book_filename;
        
       list($width,$height) = getimagesize(_DIR_BOOKS.$book_filename);
       $size_small = $this->getniceproportion($width,$height,210,150,"height");
       $sizearray = $this->getniceproportion($width,$height,800,600,"height");
       
       $this->make_thumb($olddir,$newdir1,$sizearray[0],$sizearray[1],$extension);
       $this->make_thumb($olddir,$newdir,$size_small[0],$size_small[1],$extension);
                                         
       $this->admin_model->insert_book_pictures($book_filename,$book_id);
    }
     
    function getniceproportion($width,$height,$expectedwidth,$expectedheight,$mode)
    {
    $returnwidth = $expectedwidth;
    $returnheight = $expectedheight;
    
    if($width > $height){
        
        $ratio = $width / $expectedwidth;
        $hieghteffect = $height / $ratio; 
        
        if($hieghteffect > $expectedheight)
        {
            $returnwidth =  ceil($width /($height / $expectedheight));
            $returnheight = $expectedheight;
        }
        
        else if($hieghteffect <= $expectedheight)
        {
            $returnwidth =  $expectedwidth;
            $returnheight = $hieghteffect;
        }
        
    }     


    if($height > $width)
    {
            
        $ratio = $height / $expectedheight;
        $widtheffect = $width / $ratio; 
        
        if($widtheffect > $expectedwidth)
        {
            $returnheight =  ceil($height /($width / $expectedwidth));
            $returnwidth = $expectedwidth;
        }
        
        else if($widtheffect <= $expectedwidth)
        {
            $returnheight =  $expectedheight;
            $returnwidth = $widtheffect;
        }    
        
    }


    else if($height == $width){
        
        if($mode == "height") {
            
            $returnheight =  $expectedheight;
            $returnwidth = $expectedheight;    
        }
        else{
            $returnheight =  $expectedwidth;
            $returnwidth = $expectedwidth;    
        }
    }

        $proportionarr = array($returnwidth,$returnheight);
        return $proportionarr;                       
    }
     
    function make_thumb($img_name,$filename,$new_w,$new_h,$ext)
    {
        //$ext=getExtension($img_name);
        if( !ini_get('safe_mode') ){ 
            set_time_limit(25); 
        } 
        if(!strcasecmp("jpg",$ext) || !strcmp("jpeg",$ext))
        $src_img=imagecreatefromjpeg($img_name);
        
        if(!strcasecmp("png",$ext))
        $src_img=imagecreatefrompng($img_name);
        
        if(!strcasecmp("gif",$ext))
        $src_img=imagecreatefromgif($img_name);
        
        $old_x=imageSX($src_img);
        $old_y=imageSY($src_img);
        
        $ratio1=$old_x/$new_w;
        $ratio2=$old_y/$new_h;
        
        if($ratio1>$ratio2) {
        $thumb_w=$new_w;
        $thumb_h=$old_y/$ratio1;
        }
        else {
        $thumb_h=$new_h;
        $thumb_w=$old_x/$ratio2;
        }
        
        $dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
        
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
        
        if(!strcmp("png",$ext))
        imagepng($dst_img,$filename);
        else if(!strcmp("gif",$ext))
        imagegif($dst_img,$filename);
        else
        imagejpeg($dst_img,$filename);
        
        //destroys source and destination images.
        imagedestroy($dst_img);
        imagedestroy($src_img);
    }
    function upload_yearbook_fornt_back_images()
    {
        $book_id = $_POST['book_id'];
        
        $book_row = $this->admin_model->get_book_details_by_book_id($book_id);
                
        $book_title = $book_row['book_title'];
        
        if(isset($_POST['book_id']))
        {
            if(isset($_FILES["book_title"]) && $_FILES["book_title"]['name'] !="")
            {
                
                $this->admin_model->upload_book_title($book_id,$book_title);
                /*$file_size = $_FILES["Book_Fornt_Image"]['size'];            
                if($file_size > IMAGE_SIZE_LIMIT)
                {
                    $this->messages->error("Picture size must be less or equal to 10 MB.");
                    redirect('admin/view_book_images/'.$YearBook_Id,'refresh'); 
                }
                else
                {
                    $this->admin_model->upload_book_fornt_image($YearBook_Id,$Book_Fornt_Image);        
                }*/
            }
          
          
          $book_back_page = $book_row['book_back_page'];    
          if(isset($_FILES["book_back_page"]) && $_FILES["book_back_page"]['name'] !="")
          {
              
              $this->admin_model->upload_book_back_page($book_id,$book_back_page);
              
              /*$file_size = $_FILES["Book_Back_Image"]['size'];            
            
                if($file_size > IMAGE_SIZE_LIMIT)
                {
                    $this->messages->error("Picture size must be less or equal to 10 MB.");
                    redirect('admin/view_book_images/'.$YearBook_Id,'refresh'); 
                }
                else
                {
                    $this->admin_model->upload_book_back_image($YearBook_Id,$Back_Picture_Text,$Back_Picture_Text);
                } */
          }
         
            
            $this->messages->success("Pictures has been uploaded successfully.");
            $book_id = $_POST['book_id']; 
            redirect('admin/view_book_images/'.$book_id,'refresh');
    }} 
    
    
}?>
