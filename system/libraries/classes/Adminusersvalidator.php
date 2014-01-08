<?php
include("Abstractvalidator.php");
class Adminusersvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['users_fname']))
        {
              $this->setMessage("First Name - required");
        }
        
        if($oV->isempty($data['users_lname']))
        {
              $this->setMessage("Last Name - required");
        }        
        
        if($oV->isempty($data['users_email']))
        {
              $this->setMessage("Email - required");
        }
        else if($oV->isemail($data['users_email']) == false)
        {
           $this->setMessage("Email - Invalid");  
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
       
       return $this;
    }
}
?>
