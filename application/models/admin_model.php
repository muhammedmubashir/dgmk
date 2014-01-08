<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_model extends CI_Model
{
    function __construct()
    {
        parent:: __construct(); 
        $this->load->library('email');   
    }
    
    function admin_login($params)
    {
        $sql = "SELECT * FROM users WHERE users_email = '".$params['admin_username']."' 
                AND users_password = md5('".$params['admin_passwd']."') AND users_isAdmin = '1' AND users_status = '1'";
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            $this->load->library('session');
            $admin_data = array('admin_uid'  => $row->users_id,'admin_email'  => $row->users_email, 
                                'first_name'  => $row->users_fname, 'last_name'  => $row->users_lname, "is_admin" => 1);
                                
            $this->session->set_userdata($admin_data);
            $_SESSION['admin_user_id'] = $row->users_id;
            return true;
        }
        else
        {
           return false;
        }
    }
    
    function isAdmin($user_id)
    {
        $query = $this->db->query("SELECT * FROM users WHERE users_id ='$user_id' AND users_isAdmin = 1");
        
        if($query->num_rows() == 0)
        {
            return false;        
        }
        else
        {
            return true;
        }
        
    }
    
   
    function update_subscription_status($status_id, $newsletter_subscription_id)
    {
        if($status_id == 0)    
        {
           $SQL = "UPDATE newsletter_subscriptions SET subscription_status = '0' WHERE newsletter_subscription_id = '".(int)$newsletter_subscription_id."'";
        }
        else
        {
          $SQL = "UPDATE newsletter_subscriptions SET subscription_status = '1' WHERE newsletter_subscription_id = '".(int)$newsletter_subscription_id."'";
        }
        
        $this->db->query($SQL);
        return $status_id;
    }
    
    function delete_subscription($newsletter_subscription_id)
    {
        $SQL = "DELETE FROM newsletter_subscriptions WHERE newsletter_subscription_id = '".(int)$newsletter_subscription_id."'";
        $this->db->query($SQL);
    }
    
    function delete_newsletter($newsletter_id)
    {
        $SQL = "DELETE FROM newsletters WHERE newsletter_id = '".(int)$newsletter_id."'";
        $this->db->query($SQL);
    }
    function update_code_status($status_id, $code_id)
    {
        if($status_id == 0)    
        {
           $SQL = "UPDATE codes SET status = '0' WHERE codeID = '".(int)$code_id."'";
        }
        else
        {
          $SQL = "UPDATE codes SET status  = '1' WHERE codeID = '".(int)$code_id."'";
        }
        
        $this->db->query($SQL);
        return $status_id;
    }
   
    
    function delete_code($codeID)
    {
        $this->delete("codes","codeID",$codeID);
    }
    
    function delete($table,$field,$field_criteria)
    {
        $this->db->where($field, $field_criteria);
        $this->db->delete($table);
    }
    
    function add_new_newsletter($newsletter)
    {
        $this->db->insert("newsletters", $newsletter);
        $newsletter_id  = $this->db->insert_id();
        return $newsletter_id;
    }
    
    function add_new_book($book)
    {
        $this->db->insert("books", $book);
        $book_id  = $this->db->insert_id();
        return $book_id;
    }
    
    function add_new_article($article)
    {
        $this->db->insert("articles", $article);
        $article_id  = $this->db->insert_id();
        return $article_id;
    }   
    
    
    function add_new_package($packages)
    {
        $this->db->insert("packages", $packages);
        $package_id  = $this->db->insert_id();
        return $package_id;
    }
    
    //////////////////////// Library Related Functions start ///////////////////////
    function library_list()
    {
        $SQL = "SELECT
                  l.*,
                  c.category_name
                FROM library l
                  INNER JOIN categories c
                    ON l.category_id = c.category_id
                WHERE l.status = 1
                ORDER BY l.added_on desc";
        $queryResult = $this->db->query($SQL);
        return $queryResult->result_array();
    }

    function get_all_categories($flag="")
    {
        $sql = "SELECT * FROM categories WHERE parent_id = 0";
        if($flag=="")
        {
            $sql .= " AND category_status = 1";
        }
        $queryResult = $this->db->query($sql);
        return $queryResult->result_array();
    }

    function get_category_detail($category_id)
    {
        $sql = "SELECT * FROM categories WHERE category_id = $category_id";
        $queryResult = $this->db->query($sql);
        return $queryResult->row_array();
    }

    function update_category_in_library($data)
    {
        $this->db->where("category_id",$data['category_id']);
        $this->db->update("categories",$data);
        return true;
    }


    function add_book_in_library($data)
    {
        $this->db->insert("library", $data);
        $book_id  = $this->db->insert_id();
        return $book_id;
    }

    function get_lib_book_detail($book_id)
    {
        $sql = "SELECT * FROM library WHERE lib_book_id = $book_id AND status = 1";
        $queryResult = $this->db->query($sql);
        return $queryResult->row_array();
    }

    function edit_book_in_library($data)
    {
        $this->db->where("lib_book_id",$data['lib_book_id']);
        $this->db->update("library",$data);
        return true;
    }

    function delete_book_in_library($book_id)
    {
        $SQL = "UPDATE library SET status = '0' WHERE lib_book_id = '".(int)$book_id."'";
        $this->db->query($SQL);
        return true;
    }
    
    function add_category_in_library($data)
    {
        $this->db->insert("categories", $data);
        $topic_id  = $this->db->insert_id();
        return $topic_id;
    }
    //////////////////////// Library Related Functions end ///////////////////////


    function combo_roles($currentID=0)
    {
        $SQL = "SELECT * FROM  roles WHERE roles_id != 6";
        $queryResult = $this->db->query($SQL);
        $roles = $queryResult->result_array();
        
        $str = '';
        foreach($roles as $role)
        {
          $strSelected = '';
            if(is_array($currentID))
            {
                if(in_array($role['roles_id'],$currentID))
                {
                   $strSelected = " selected='selected'";
                }
            }
            else if($currentID == $role['roles_id'])
            {
                 $strSelected = " selected='selected'";
            }
             $str .= "<option value='".$role['roles_id']."'".$strSelected.">".$role['roles_rname']."</option>";     
        }
        return $str ;
    }
    
    function update_user_status($status_id, $user_id)
    {
        if($status_id == 0)    
        {
           $SQL = "UPDATE site_users SET user_status = '1' WHERE user_id = '".(int)$user_id."'";
        }
        else
        {
          $SQL = "UPDATE site_users SET user_status = '0' WHERE user_id = '".(int)$user_id."'";
        }
        
        $this->db->query($SQL);
        return $status_id;
    }
    
    function add_new_user($user)
    {
        $this->db->insert("site_users", $user);
        $user_id  = $this->db->insert_id();
        return $user_id;
    }
    
   function get_user_data_by_user_id($user_id)
    {
        $SQL = "SELECT * FROM site_users";
        $SQL .= " WHERE user_id = '".(int)$user_id."'";

        $queryResult = $this->db->query($SQL);
        $user_row = $queryResult->row_array();
        return $user_row;
    }
    
    function edit_user($user)
    {
        $this->db->where("user_id",$user['user_id']);
        $this->db->update("site_users",$user); 
    }
    
    function email_exists($email)
    {
        $SQL = "SELECT * FROM users";
        $SQL .= " WHERE users_email = '".$email."'";
        
        $query = $this->db->query($SQL);
        
        if($query->num_rows() > 0)
        {
            return false;
        }    
        else
        {
            return true;
        }
    }

    function get_admin_users_list($searchArray)
    {
        $SQL = "SELECT * FROM users WHERE users_isAdmin = 1";
        
        if(isset($searchArray['users_status']) && $searchArray['users_status'] >= 0)
        {
            $SQL.=" AND users_status = '".$searchArray['users_status']."'";    
        }
        
        if(isset($searchArray['user_name']) && $searchArray['user_name'] != "")
        {
            $SQL.=" AND  concat(users_fname,users_lname) like '%".$searchArray['user_name']."%'";
        }
        
        if(isset($searchArray['users_email']) && $searchArray['users_email'] != "")
        {
            $SQL.=" AND users_email like '%".$searchArray['users_email']."%'";
        }
        
        $SQL.=" ORDER BY users_id DESC";
        
        $queryResult = $this->db->query($SQL);
        $admin_users = $queryResult->result_array();
        
        return $admin_users;   
    }
    
    function update_admin_user_status($status_id, $users_id)
    {
        if($status_id == 0)    
        {
           $SQL = "UPDATE users SET users_status = '1' WHERE users_id = '".(int)$users_id."'";
        }
        else
        {
          $SQL = "UPDATE users SET users_status = '0' WHERE users_id = '".(int)$users_id."'";
        }
        
        $this->db->query($SQL);
        return $status_id;
    }
    
    function delete_admin_user($users_id)
    {
        $sql = "DELETE FROM users WHERE users_id = '".(int)$users_id."'"; 
        $this->db->query($sql);
    }

    function add_new_admin_user($user)
    {
        $this->db->insert("users", $user);
        $users_id  = $this->db->insert_id();
        return $users_id;
    }
    
   function get_admin_user_data_by_users_id($users_id)
    {
        $SQL = "SELECT * FROM users";
        $SQL .= " WHERE users_id = '".(int)$users_id."'";

        $queryResult = $this->db->query($SQL);
        $user_row = $queryResult->row_array();
        return $user_row;
    }
 
    function edit_admin_user($user)
    {
        $this->db->where("users_id",$user['users_id']);
        $this->db->update("users",$user);
    }
    
    function get_site_contents($searchArray)
    {
       $SQL ="SELECT * FROM site_contents";
        $queryResult = $this->db->query($SQL);
        $site_contents = $queryResult->result_array();
        return $site_contents; 
    }
    
    function get_content_by_page_id($page_id)
    {
        $SQL = "SELECT * FROM site_contents";
        $SQL .= " WHERE page_id = '".(int)$page_id."'";

        $queryResult = $this->db->query($SQL);
        $content_row = $queryResult->row_array();
        return $content_row;
    }
    
    function edit_content($page)
    {
      $this->db->where("page_id",$page['page_id']);
      $this->db->update("site_contents",$page);   
    }
    
    function edit_book($book)
    {
      $this->db->where("book_id",$book['book_id']);
      $this->db->update("books",$book);   
    }
    
    function edit_article($article)
    {
      $this->db->where("article_id",$article['article_id']);
      $this->db->update("articles",$article);   
    }
    
    function get_admin_password_data_by_user_id($users_id)
    {
        $SQL = "SELECT * FROM users";
        $SQL .= " WHERE users_id = '".(int)$users_id."'";

        $queryResult = $this->db->query($SQL);
        $admin_password_data_row = $queryResult->row_array();
        return $admin_password_data_row;
    }
    
    function change_password($password_data)
    {
      $SQL = "UPDATE users SET
              users_password = '".$password_data['users_password']."'
              WHERE users_id = '".$password_data['users_id']."'"; 
       
       $this->db->query($SQL);       
    }
   
   function get_user_info_by_users_id($users_id)
    {
        $SQL = "SELECT u.*, r.*,c.* FROM users u, roles r, countries c, world_states ws";
        $SQL.= " WHERE u.roles_id = r.roles_id";
        $SQL.= " AND c.countries_name = u.countries_name";
        $SQL.= " AND ws.state_name = u.users_state";
        $SQL.= " AND u.users_id = '".(int)$users_id."'";
        
        $queryResult = $this->db->query($SQL);
        if($queryResult->num_rows() > 0)
        {
            $user = $queryResult->row_array();
            return $user;
        }
        else
        {
            return false;
        }
        
    }
    
    function check_is_admin_user_by_users_id($users_id)
    {
        $SQL = "SELECT u.*, r.* FROM users u, roles r";
        $SQL.= " WHERE u.roles_id = r.roles_id";
        $SQL.= " AND users_isAdmin = 1";
        $SQL.= " AND u.users_id = '".(int)$users_id."'";
        $queryResult = $this->db->query($SQL);
        if($queryResult->num_rows() > 0)
        {
            $user = $queryResult->row_array();
            return $user;
        }
        else
        {
            return false;
        }
        
    }
    
    function get_user_admin_info_by_users_id($users_id)
    {
        $SQL = "SELECT u.*, r.* FROM users u, roles r";
        $SQL.= " WHERE u.roles_id = r.roles_id";
        $SQL.= " AND u.users_id = '".(int)$users_id."'";
        $queryResult = $this->db->query($SQL);
        if($queryResult->num_rows() > 0)
        {
            $user = $queryResult->row_array();
            return $user;
        }
        else
        {
            return false;
        }
        
    }
    
    function get_email_templates($searchArray)
    {
       $SQL ="SELECT * FROM email_templates";
       $queryResult = $this->db->query($SQL);
       $email_templates = $queryResult->result_array();
       return $email_templates; 
    }
    
    function get_email_template_by_template_id($template_id)
    {
        $SQL = "SELECT * FROM email_templates";
        $SQL .= " WHERE template_id = '".(int)$template_id."'";

        $queryResult = $this->db->query($SQL);
        $template_row = $queryResult->row_array();
        return $template_row;
    }
    
    function edit_email_template($email_template)
    {
      $this->db->where("template_id",$email_template['template_id']);
      $this->db->update("email_templates",$email_template);   
    }
    
    function get_code_by_codeID($codeID)
    {
        $SQL = "SELECT * FROM codes";
        $SQL .= " WHERE codeID = '".(int)$codeID."'";

        $queryResult = $this->db->query($SQL);
        $code_row = $queryResult->row_array();
        return $code_row;
    }
   function get_admin_user_name_by_admin_user_id($admin_user_id) 
    {
        
        $SQL = "SELECT * FROM users";
        $SQL.="  WHERE users_id= '".(int)$admin_user_id."'";    
        
        $queryResult = $this->db->query($SQL);
        $admin_user_name_row = $queryResult->row_array();
        
        return ucfirst($admin_user_name_row['users_fname'])." ".ucfirst($admin_user_name_row['users_lname']);   
        
    }
    
    function get_order_details_by_order_id($order_id)
    {
        $SQL = "SELECT * FROM orders o, site_users su, packages p WHERE p.package_id = o.package_id AND o.user_id = su.user_id";
        $SQL.="  AND o.order_id = '".(int)$order_id."'";    
        
        $queryResult = $this->db->query($SQL);
        $order = $queryResult->row_array();
        
        return $order;   
    }

    function get_newsletter_subscriptions_list_rows()
    {
        $SQL = "SELECT COUNT(*) as total_rows FROM newsletter_subscriptions";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function get_newsletter_subscriptions_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT * FROM newsletter_subscriptions WHERE newsletter_subscription_id > 0";
        
        if(isset($searchArray['email_address']) && $searchArray['email_address'] != "")
        {
            $SQL.=" AND email_address like '%".addslashes($searchArray['email_address'])."%'";
        }
        
        if(isset($searchArray['date_added_from']) && $searchArray['date_added_from'] != "")
        {
            $SQL.= " AND DATE(date_added) >= '".$searchArray['date_added_from']."'";
        }

        if(isset($searchArray['date_added_to']) && $searchArray['date_added_to'] != "")
        {
            $SQL.= " AND DATE(date_added) <= '".$searchArray['date_added_to']."'";
        }
        
        if(isset($searchArray['recent_jobs']))
        {
          $SQL.=" AND date_added >= DATE_ADD(NOW(), INTERVAL -1 MONTH) 
                  AND date_added <= NOW()"; 
        }
        
        $SQL.=" ORDER BY newsletter_subscription_id DESC LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $job_applications = $queryResult->result_array();
        
        return $job_applications;   
    }
    
   
    function get_newsletters_created_list_rows()
    {
        $SQL = "SELECT COUNT(*) as total_rows FROM newsletters WHERE is_sent = '0'";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    } 
   function get_newsletters_sent_list_rows()
    {
        $SQL = "SELECT COUNT(*) as total_rows FROM newsletters WHERE is_sent = '1'";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
       
    
    
    function get_newsletters_created_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT * FROM newsletters WHERE newsletter_id > 0 AND is_sent = '0'";
        
        if(isset($searchArray['newsletter_title']) && $searchArray['newsletter_title'] != "")
        {
            $SQL.=" AND newsletter_title like '%".addslashes($searchArray['newsletter_title'])."%'";
        }
        
        if(isset($searchArray['date_added_from']) && $searchArray['date_added_from'] != "")
        {
            $SQL.= " AND DATE(date_added) >= '".$searchArray['date_added_from']."'";
        }

        if(isset($searchArray['date_added_to']) && $searchArray['date_added_to'] != "")
        {
            $SQL.= " AND DATE(date_added) <= '".$searchArray['date_added_to']."'";
        }
        
        $SQL.=" ORDER BY newsletter_id DESC LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $newsletters = $queryResult->result_array();
        
        return $newsletters;   
    }
    
   function get_newsletters_sent_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT * FROM newsletters WHERE newsletter_id > 0 AND is_sent = '1'";
        
        if(isset($searchArray['newsletter_title']) && $searchArray['newsletter_title'] != "")
        {
            $SQL.=" AND newsletter_title like '%".addslashes($searchArray['newsletter_title'])."%'";
        }
        
        if(isset($searchArray['date_added_from']) && $searchArray['date_added_from'] != "")
        {
            $SQL.= " AND DATE(date_sent) >= '".$searchArray['date_added_from']."'";
        }

        if(isset($searchArray['date_added_to']) && $searchArray['date_added_to'] != "")
        {
            $SQL.= " AND DATE(date_sent) <= '".$searchArray['date_added_to']."'";
        }
        
        $SQL.=" ORDER BY newsletter_id DESC LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $newsletters = $queryResult->result_array();
        
        return $newsletters;   
    }
    
   function get_users_list_rows()
    {
        $SQL = "SELECT count(*) as total_rows FROM site_users su WHERE su.user_id > 0 AND is_delete = '1'";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
   
    function get_users_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT su.*,c.* FROM site_users su, countries c WHERE su.user_id > 0 AND su.country_id = c.countries_id";
        
        if(isset($searchArray['user_status']) && $searchArray['user_status'] >= 0)
        {
            $SQL.=" AND su.user_status = '".$searchArray['user_status']."'";    
        }
        
        if(isset($searchArray['country_id']) && $searchArray['country_id'] >= 0)
        {
            $SQL.=" AND su.country_id = '".$searchArray['country_id']."'";    
        }
        
        if(isset($searchArray['user_name']) && $searchArray['user_name'] != "")
        {
            $SQL.=" AND  concat(su.first_name,su.last_name) like '%".$searchArray['user_name']."%'";
        }
        
        if(isset($searchArray['email_address']) && $searchArray['email_address'] != "")
        {
            $SQL.=" AND su.email_address like '%".$searchArray['email_address']."%'";
        }
        
        if(isset($searchArray['register_date_from']) && $searchArray['register_date_from'] != "")
        {
            $SQL.= " AND DATE(su.register_date) >= '".$searchArray['register_date_from']."'";
        }

        if(isset($searchArray['register_date_to']) && $searchArray['register_date_to'] != "")
        {
            $SQL.= " AND DATE(su.register_date) <= '".$searchArray['register_date_to']."'";
        }
        
        if(isset($searchArray['recent_users']))
        {
          $SQL.=" AND su.register_date >= DATE_ADD(NOW(), INTERVAL -1 MONTH) 
                  AND su.register_date <= NOW()"; 
        }
        
        $SQL.="  ORDER BY su.first_name, su.last_name LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $users = $queryResult->result_array();
        
        return $users;   
    }
    
    function get_user_info_by_user_id($user_id)
    {
        $SQL = "SELECT su.*,c.* FROM site_users su, countries c WHERE su.user_id > 0 AND su.country_id = c.countries_id";
        $SQL.="  AND user_id = '".$user_id."'";    
        
        $queryResult = $this->db->query($SQL);
        $user = $queryResult->row_array();
        
        return $user;   
    }
   
    
    function send_newsletter($newsletter_id)
    {
        $SQL = "SELECT * FROM newsletter_subscriptions WHERE subscription_status = '1'";
        $queryResult = $this->db->query($SQL);
        $newsletter_subscriptions = $queryResult->result_array();
        $newsletter_row = $this->get_newsletter_details_by_newsletter_id($newsletter_id);
        
        if(count($newsletter_subscriptions) > 0)
        {
            foreach($newsletter_subscriptions as $subscription)
            {
                $this->email->set_mailtype("html");
                $this->email->from('no-reply@drink.com', 'BUFFALO ENERGY DRINK Team');
                $this->email->to($subscription['email_address']);
                $this->email->subject($newsletter_row['newsletter_title']);
                $this->email->message(html_entity_decode(stripslashes(($newsletter_row['newsletter_text']))));
                $this->email->send(); 
            }
            
            $SQL = "UPDATE newsletters SET is_sent = '1', date_sent = '".getdbTimeFormat(time())."' WHERE newsletter_id = '".(int)$newsletter_id."'";
            
            $this->db->query($SQL);
        }
    }
    function get_gallery_list_rows()
    {
        $SQL = "SELECT count(*) as total_rows FROM gallery";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function get_gallery_pictures_data($limit,$offset="0")
     {
       $SQL = "SELECT * FROM gallery";
       $SQL .= " ORDER BY gallery_id";
       $SQL .= " LIMIT $offset,$limit";
       $queryResult = $this->db->query($SQL);
       
       $gallery_pictures = $queryResult->result_array();
       return $gallery_pictures;     
     }
     
    function insert_pictures($image)
    {
          
          $display_order = $this->get_gallery_image_rows();
          
          $sql = "INSERT INTO gallery";
          $sql .= " SET ";
          $sql .= " date_added = '".getdbTimeFormat(time())."',";
          $sql .= " display_order = '".($display_order+1)."',";
          $sql .= " gallery_image = '".$image."'";
          
          $this->db->query($sql);  
    }
    
    function insert_book_pictures($book_page_file,$book_id)
    {
      $display_order = $this->get_book_image_rows($book_id);
      
      $sql = "INSERT INTO book_pages";
      $sql .= " SET ";
      $sql .= " date_added = '".getdbTimeFormat(time())."',";
      $sql .= " book_id = '".(int)$book_id."',";
      $sql .= " display_order = '".($display_order+1)."',";
      $sql .= " book_page_file = '".$book_page_file."'";
      
      $this->db->query($sql);  
    }
    
    function get_book_image_rows($book_id)
    {
        $SQL = "SELECT count(*) as total_rows FROM book_pages WHERE book_id = '".(int)$book_id."'";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function get_gallery_image_rows()
    {
        $SQL = "SELECT count(*) as total_rows FROM gallery";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function update_picture_title($image_text,$gallery_id)
    {
        $sql = "UPDATE gallery SET
                image_text = '".$image_text."' 
                WHERE gallery_id = '".(int)$gallery_id."'";
                
        $this->db->query($sql);
    }
    
    /*function update_display_order($display_order,$gallery_id)
    {
        $sql = "UPDATE gallery SET
                display_order = '".$display_order."' 
                WHERE gallery_id = '".(int)$gallery_id."'";
                
        $this->db->query($sql);
    }                                                        */
    
    function update_is_show_status($gallery_image_status,$gallery_id)
    {
        $sql = "UPDATE gallery SET
                gallery_image_status = '".$gallery_image_status."' 
                WHERE gallery_id = '".(int)$gallery_id."'";
                
        $this->db->query($sql);
    }
    
    function delete_gallery_image($gallery_id)
    {
        $sql = "SELECT * FROM gallery WHERE gallery_id = '".(int)$gallery_id."'"; 
        $queryResult = $this->db->query($sql);
        $picture_row = $queryResult->row_array();
        $old_image = $picture_row['gallery_image'];
        
        if($old_image != '')
        {
            unlink(_DIR_GALLERY."thumb_".$old_image);
            unlink(_DIR_GALLERY.$old_image);    
        }
        
        $sql = "DELETE FROM gallery WHERE gallery_id = '".(int)$gallery_id."'"; 
        $queryResult = $this->db->query($sql);
    }
    
    function get_total_news_count()
    {
        $SQL = "SELECT count(*) as total_news_count FROM news";
        $SQL.="  WHERE is_delete = '1'";    
        
        $queryResult = $this->db->query($SQL);
        $total_job_count = $queryResult->row_array();
        
        return $total_job_count['total_news_count'];   
    }
    
    function get_total_books_count()
    {
        $SQL = "SELECT count(*) as total_books_count FROM books";
        $SQL.="  WHERE is_delete = '1'";    
        
        $queryResult = $this->db->query($SQL);
        $total_books_count = $queryResult->row_array();
        
        return $total_books_count['total_books_count'];   
    }
    
    function get_total_articles_count()
    {
        $SQL = "SELECT count(*) as total_articles_count FROM articles";
        $SQL.="  WHERE is_delete = '1'";    
        
        $queryResult = $this->db->query($SQL);
        $total_articles_count = $queryResult->row_array();
        
        return $total_articles_count['total_articles_count'];   
    }
    
    function add_new_news($news)
    {
        $this->db->insert("news", $news);
        $news_id  = $this->db->insert_id();
        return $news_id;
    }                           
    
    function edit_news($news)
    {
        $this->db->where("news_id",$news['news_id']);
        $this->db->update("news",$news); 
    }
    
    function get_news_list_rows()
    {
        $SQL = "SELECT count(*) as total_rows FROM news WHERE is_delete = '1'";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function get_books_list_rows()
    {
        $SQL = "SELECT count(*) as total_rows FROM books";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function get_news_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT * FROM news WHERE news_id > 0 AND is_delete = '1'";
        
        if(isset($searchArray['news_status']) && $searchArray['news_status'] >= "0")
        {
            $SQL.=" AND news_status = '".$searchArray['news_status']."'";
        }
        
        if(isset($searchArray['news_title']) && $searchArray['news_title'] != "")
        {
            $SQL.=" AND news_title like '%".addslashes($searchArray['news_title'])."%'";
        }
        
        if(isset($searchArray['news_date_from']) && $searchArray['news_date_from'] != "")
        {
            $SQL.= " AND DATE(news_date) >= '".$searchArray['news_date_from']."'";
        }

        if(isset($searchArray['news_date_to']) && $searchArray['news_date_to'] != "")
        {
            $SQL.= " AND DATE(news_date) <= '".$searchArray['news_date_to']."'";
        }
        
        if(isset($searchArray['date_added_from']) && $searchArray['date_added_from'] != "")
        {
            $SQL.= " AND DATE(date_added) >= '".$searchArray['date_added_from']."'";
        }

        if(isset($searchArray['date_added_to']) && $searchArray['date_added_to'] != "")
        {
            $SQL.= " AND DATE(date_added) <= '".$searchArray['date_added_to']."'";
        }
        
        if(isset($searchArray['recent_news']))
        {
          $SQL.=" AND date_added >= DATE_ADD(NOW(), INTERVAL -1 MONTH) 
                  AND date_added <= NOW()"; 
        }
        
        $SQL.=" ORDER BY date_added DESC LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $news = $queryResult->result_array();
        
        return $news;   
    }
    
    function get_articles_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT * FROM articles WHERE article_id > 0 AND is_delete = '1'";
        
        if(isset($searchArray['article_status']) && $searchArray['article_status'] >= "0")
        {
            $SQL.=" AND article_status = '".$searchArray['article_status']."'";
        }
        
        if(isset($searchArray['article_title']) && $searchArray['article_title'] != "")
        {
            $SQL.=" AND article_title like '%".addslashes($searchArray['article_title'])."%'";
        }
        
        if(isset($searchArray['date_added_from']) && $searchArray['date_added_from'] != "")
        {
            $SQL.= " AND DATE(date_added) >= '".$searchArray['date_added_from']."'";
        }

        if(isset($searchArray['date_added_to']) && $searchArray['date_added_to'] != "")
        {
            $SQL.= " AND DATE(date_added) <= '".$searchArray['date_added_to']."'";
        }
        
        if(isset($searchArray['recent_articles']))
        {
          $SQL.=" AND date_added >= DATE_ADD(NOW(), INTERVAL -1 MONTH) 
                  AND date_added <= NOW()"; 
        }
        
        $SQL.=" ORDER BY date_added DESC LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $articles = $queryResult->result_array();
        
        return $articles;   
    }
    
    function get_books_list($searchArray,$offset,$limit)
    {
        $SQL = "SELECT * FROM books WHERE book_id > 0";
        
        if(isset($searchArray['book_status']) && $searchArray['book_status'] >= "0")
        {
            $SQL.=" AND book_status = '".$searchArray['book_status']."'";
        }
        
        if(isset($searchArray['book_type']) && $searchArray['book_type'] != "-1")
        {
            $SQL.=" AND book_type = '".$searchArray['book_type']."'";
        }
        
        if(isset($searchArray['book_title']) && $searchArray['book_title'] != "")
        {
            $SQL.=" AND book_title like '%".addslashes($searchArray['book_title'])."%'";
        }
        
        if(isset($searchArray['book_author']) && $searchArray['book_author'] != "")
        {
            $SQL.=" AND book_author like '%".addslashes($searchArray['book_author'])."%'";
        }
        
        if(isset($searchArray['book_title_filename']) && $searchArray['book_title_filename'] != "")
        {
            $SQL.=" AND book_title_filename like '%".addslashes($searchArray['book_title_filename'])."%'";
        }
        
        if(isset($searchArray['date_added_from']) && $searchArray['date_added_from'] != "")
        {
            $SQL.= " AND DATE(date_added) >= '".$searchArray['date_added_from']."'";
        }

        if(isset($searchArray['date_added_to']) && $searchArray['date_added_to'] != "")
        {
            $SQL.= " AND DATE(date_added) <= '".$searchArray['date_added_to']."'";
        }
        
        if(isset($searchArray['recent_books']))
        {
          $SQL.=" AND date_added >= DATE_ADD(NOW(), INTERVAL -1 MONTH) 
                  AND date_added <= NOW()"; 
        }
        
        $SQL.=" ORDER BY date_added DESC LIMIT ".$offset.", ".$limit;
        
        $queryResult = $this->db->query($SQL);
        $books = $queryResult->result_array();
        
        return $books;   
    }
    
    
    function update_news_status($status_id, $news_id)
    {
        if($status_id == 0)    
        {
           $SQL = "UPDATE news SET news_status = '0' WHERE news_id = '".(int)$news_id."'";
        }
        else
        {
          $SQL = "UPDATE news SET news_status = '1' WHERE news_id = '".(int)$news_id."'";
        }
        
        $this->db->query($SQL);
        return $status_id;
    }
    
    function get_news_details_by_news_id($news_id)
    {
        $SQL = "SELECT * FROM news";
        $SQL .= " WHERE news_id = '".(int)$news_id."'";

        $queryResult = $this->db->query($SQL);
        $news_row = $queryResult->row_array();
        return $news_row;
    }
    
    function get_news_row_by_news_id($news_id)
    {
        $SQL = "SELECT * FROM news";
        $SQL.="  WHERE news_id = '".$news_id."'";    
        
        $queryResult = $this->db->query($SQL);
        $news = $queryResult->row_array();
        
        return $news;   
    }
    
    function delete_news($news_id)
    {
        $SQL = "UPDATE news SET is_delete = '0' WHERE news_id = '".(int)$news_id."'";
        $this->db->query($SQL);
    }
    
    
    function delete_book($book_id)
    {
        $SQL = "Delete from books WHERE book_id = '".(int)$book_id."'";
        $this->db->query($SQL);
    }
    
    function delete_article($article_id)
    {
        $SQL = "UPDATE articles SET is_delete = '0' WHERE article_id = '".(int)$article_id."'";
        $this->db->query($SQL);
    }
    
    
    function update_display_order($table_name,$primaray_key_field,$display_order,$id)
    {
        $sql = "UPDATE ".$table_name." SET
                display_order = '".$display_order."' 
                WHERE ".$primaray_key_field." = '".(int)$id."'";
                
        $this->db->query($sql);
    }
    
    function update_status($table_name,$primaray_key_field,$set_field,$field_value,$id)
    {
        $sql = "UPDATE ".$table_name." SET ".$set_field." = '".(int)$field_value."' WHERE ".$primaray_key_field." = '".(int)$id."'";
                
        $this->db->query($sql);
    }
    
    
    function upload_book_title($book_id,$old_image='')
    {   
        $this->load->library('Iceimage');
        $iceImage = new iceImage(_DIR_BOOKS); 
        
        if(isset($_FILES["book_title_file"]))
        {
            $tempFile = $_FILES['book_title_file']['tmp_name'];
            $fileInfo = pathinfo($_FILES['book_title_file']['name']);
            $fileName = $fileInfo["filename"];
            $basename = $fileInfo["basename"];
            $extension = $fileInfo["extension"];
            
            $filename = $iceImage->getFilename($_FILES["book_title_file"]['name']);
            $FileencryptedFileName = $iceImage->getFileencryptedFileName();
            $mainimage = $FileencryptedFileName.".".$extension;
            
            $predFile = _DIR_BOOKS."title_page/".$mainimage;   
            if(move_uploaded_file($_FILES["book_title_file"]['tmp_name'],$predFile)) 
            {
                
               $thumbnail = _DIR_BOOKS."title_page/".'thumb_'.$mainimage;
               $preview_thumbnail = _DIR_BOOKS."title_page/".$mainimage;
               
                $iceImage->generate_thumbnail($predFile,$preview_thumbnail,BOOKS_W,BOOKS_H,$extension);
                $iceImage->generate_thumbnail($predFile,$thumbnail,BOOKS_THUMB_W,BOOKS_THUMB_H,$extension);
                
                $SQL = "UPDATE books SET
                        book_title_file = '".$mainimage."'
                        WHERE book_id = '".(int)$book_id."'";
                
                if($old_image != "")
                {
                    @unlink(_DIR_BOOKS."title_page/"."thumb_".$old_image);
                    @unlink(_DIR_BOOKS."title_page/".$old_image);
                }
                
                $this->db->query($SQL);
            }
            return true;
        }
        else
        {
            return false;
        }
    } 
    
    function upload_article_image($article_id,$old_image='')
    {   
        $this->load->library('Iceimage');
        $iceImage = new iceImage(_DIR_ARTICLE); 

        
        if(isset($_FILES["article_image"]))
        {
            $tempFile = $_FILES['article_image']['tmp_name'];
            $fileInfo = pathinfo($_FILES['article_image']['name']);
            $fileName = $fileInfo["filename"];
            $basename = $fileInfo["basename"];
            $extension = $fileInfo["extension"];
            
            $filename = $iceImage->getFilename($_FILES["article_image"]['name']);
            $FileencryptedFileName = $iceImage->getFileencryptedFileName();
            $mainimage = $FileencryptedFileName.".".$extension;
            
           $predFile = _DIR_ARTICLE.$mainimage;   
            if(move_uploaded_file($_FILES["article_image"]['tmp_name'],$predFile)) 
            {
                
               $thumbnail = _DIR_ARTICLE.'thumb_'.$mainimage;
               $preview_thumbnail = _DIR_ARTICLE.$mainimage;
               
                $iceImage->generate_thumbnail($predFile,$preview_thumbnail,ARTICLE_W,ARTICLE_H,$extension);
                $iceImage->generate_thumbnail($predFile,$thumbnail,ARTICLE_THUMB_W,ARTICLE_THUMB_H,$extension);
                
                echo $SQL = "UPDATE articles SET
                        article_image = '".$mainimage."'
                        WHERE article_id = '".(int)$article_id."'";
                
                if($old_image != "")
                {
                    @unlink(_DIR_ARTICLE."thumb_".$old_image);
                    @unlink(_DIR_ARTICLE.$old_image);
                }
                
                $this->db->query($SQL);
            }
                
                return true;
        }
        else
        {
            return false;
        }
    }
    
    function upload_book_back_page($book_id,$old_image='')
    {   
        $this->load->library('Iceimage');
        $iceImage = new iceImage(_DIR_BOOKS); 

        
        if(isset($_FILES["book_back_page"]))
        {
            $tempFile = $_FILES['book_back_page']['tmp_name'];
            $fileInfo = pathinfo($_FILES['book_back_page']['name']);
            $fileName = $fileInfo["filename"];
            $basename = $fileInfo["basename"];
            $extension = $fileInfo["extension"];
            
            $filename = $iceImage->getFilename($_FILES["book_back_page"]['name']);
            $FileencryptedFileName = $iceImage->getFileencryptedFileName();
            $mainimage = $FileencryptedFileName.".".$extension;
            
           $predFile = _DIR_BOOKS.$mainimage;   
            if(move_uploaded_file($_FILES["book_back_page"]['tmp_name'],$predFile)) 
            {
                
               $thumbnail = _DIR_BOOKS.'thumb_'.$mainimage;
               $preview_thumbnail = _DIR_BOOKS.$mainimage;
               
                $iceImage->generate_thumbnail($predFile,$preview_thumbnail,BOOKS_W,BOOKS_H,$extension);
                $iceImage->generate_thumbnail($predFile,$thumbnail,BOOKS_THUMB_W,BOOKS_THUMB_H,$extension);
                
                $SQL = "UPDATE books SET
                        book_back_page = '".$mainimage."'
                        WHERE book_id = '".(int)$book_id."'";
                
                if($old_image != "")
                {
                    @unlink(_DIR_BOOKS."thumb_".$old_image);
                    @unlink(_DIR_BOOKS.$old_image);
                }
                
                $this->db->query($SQL);
            }
                
                return true;
        }
        else
        {
            return false;
        }
    } 
    
    
    function upload_book_filename($book_id,$old_image='')
    {   
        $this->load->library('Iceimage');
        $iceImage = new iceImage(_DIR_PDF_BOOKS); 

        
        if(isset($_FILES["book_filename"]))
        {
            $tempFile = $_FILES['book_filename']['tmp_name'];
            $fileInfo = pathinfo($_FILES['book_filename']['name']);
            $fileName = $fileInfo["filename"];
            $basename = $fileInfo["basename"];
            $extension = $fileInfo["extension"];
            
            $filename = $iceImage->getFilename($_FILES["book_filename"]['name']);
            $FileencryptedFileName = $iceImage->getFileencryptedFileName();
            $mainimage = $FileencryptedFileName.".".$extension;
            
           $predFile = _DIR_PDF_BOOKS.$mainimage;   
            if(move_uploaded_file($_FILES["book_filename"]['tmp_name'],$predFile)) 
            {
               $SQL = "UPDATE books SET
                        book_filename = '".$mainimage."'
                        WHERE book_id = '".(int)$book_id."'";
                
                if($old_image != "")
                {
                    @unlink(_DIR_PDF_BOOKS.$old_image);
                }
                
                $this->db->query($SQL);
            }
                
                return true;
        }
        else
        {
            return false;
        }
    }
    
    function get_book_details_by_book_id($book_id)
    {
        $SQL = "SELECT * FROM books WHERE book_id = '".(int)$book_id."'";
        $query_result = $this->db->query($SQL);
        $book_details_row = $query_result->row_array();
        return $book_details_row;
    } 
    
    
    function get_article_details_by_article_id($article_id)
    {
        $SQL = "SELECT * FROM articles WHERE article_id = '".(int)$article_id."'";
        $query_result = $this->db->query($SQL);
        $article_details_row = $query_result->row_array();
        return $article_details_row;
    } 
    
    function get_newsletter_details_by_newsletter_id($newsletter_id)
    {
        $SQL = "SELECT * FROM newsletters";
        $SQL .= " WHERE newsletter_id = '".(int)$newsletter_id."'";

        $queryResult = $this->db->query($SQL);
        $newsletter_row = $queryResult->row_array();
        return $newsletter_row;
    }
    
    function get_book_images_list_rows($book_id)
    {
        $SQL = "SELECT count(*) as total_rows FROM book_pages WHERE book_id = '".(int)$book_id."'";
        $queryResult = $this->db->query($SQL);
        $result = $queryResult->row_array();
        return $result['total_rows'];
    }
    
    function get_book_pages_data_by_book_id($book_id,$limit,$offset="0")
     {
       $SQL = "SELECT * FROM book_pages";
       $SQL .= " WHERE book_id = '".(int)$book_id."'";
       $SQL .= " ORDER BY display_order";
       $SQL .= " LIMIT $offset,$limit";
       $queryResult = $this->db->query($SQL);
       
       $book_pages = $queryResult->result_array();
       return $book_pages;     
     }
}?>
