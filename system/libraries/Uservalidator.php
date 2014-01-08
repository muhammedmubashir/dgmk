<?php
include("Abstractvalidator.php");
class Uservalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($data['roles_id'] == "-1")
        {
             $this->setMessage("User Role- required");
        } 
        
        if($oV->isempty($data['users_fname']))
        {
              $this->setMessage("First Name - required");
        }
        else if($oV->is_alpha_only_string($data['users_fname']))
        {
              $this->setMessage("Invalid First Name");
        }
        
        if($oV->isempty($data['users_lname']))
        {
              $this->setMessage("Last Name - required");
        }        
        else if($oV->is_alpha_only_string($data['users_lname']))
        {
              $this->setMessage("Invalid Last Name");
        }
        
       
        if($oV->isempty($data['users_email']))
        {
              $this->setMessage("Email - required");
        }
        else if($oV->isemail($data['users_email']) == false)
        {
           $this->setMessage("Email - Invalid");  
        }
        
        
        if($oV->isempty($data['users_uname']))
        {
              $this->setMessage("Username - required");
        }
        
        else if($oV->only_alpha_numeric($data['users_uname'])) 
        {
            $this->setMessage("Username must be only alpha numeric");
        } 
        
        else if(strlen($data['users_uname']) < 4) 
        {
            $this->setMessage("Username must be atleast 4 characters long");
        }
        
        
        if($this->getEditMode() == true)
        {                                     
            if(strlen($data['users_password']) < 6 && $data['users_password'] != "") 
            {
                $this->setMessage("Password must be atleast 6 characters long");
            }
        }
        else
        {
            if($oV->isempty($data['users_password']))
            {
                  $this->setMessage("Password - required");
            }
            else if(strlen($data['users_password']) < 6 && $data['users_password'] != "" ) 
            {
                $this->setMessage("Password must be atleast 6 characters long");
            }    
        
        }
        
        if($oV->isempty($data['users_phone']))
        {
              $this->setMessage("Phone Number - required");
        }
        
        if($data['countries_id'] == "-1")
        {
             $this->setMessage("Country- required");
        }
        
        if($data['users_status'] == "-1")
        {
             $this->setMessage("Status - required");
        }
        
        if($data['users_mobileAlerts'] == "-1")
        {
             $this->setMessage("Mobile Alerts - required");
        }
        
           
        
       return $this;
    }
}
?>
