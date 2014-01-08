<?php

class session_model extends CI_Model{
    
	
    function session_model()
    {
       // parent::Model();
    }
	
	function loginUser($params)
    {
		$query = $this->db->query("SELECT * FROM users WHERE user_name = '".$params['user_name']."' AND password = '".$params['password']."'");
		if($query->num_rows() > 0){
			$row = $query->row();
			$this->load->library('session');
			$newdata = array( 'user_id'  => $row->id, 'user_type'  => $row->user_type, 'user_types'  => $row->user_types, 'email'  => $row->email );
			
			//exit;
			
			$this->session->set_userdata($newdata);
			#$_SESSION['user_id'] = $row->user_id;
			return true;
		}else{
			return false;
		}
	}
	
	function isAdmin($user_id)
    {
	   	$query = $this->db->query("SELECT is_admin FROM users WHERE user_id='$user_id'");
		$row = $query->row();	
	   	return $row->is_admin;
	}
	
	/*
	* This method is used by facebook class for user registartion
	*/
	

  
}



?>