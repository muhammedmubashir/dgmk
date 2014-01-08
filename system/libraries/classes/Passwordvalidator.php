<?php
include("Abstractvalidator.php");
class Passwordvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
            if($oV->isempty($data['current_password']))
            {
                  $this->setMessage("Current Password - required");
            }
            else if(strlen($data['current_password']) < 6 && $data['current_password'] != "" ) 
            {
                $this->setMessage("Current Password must be atleast 6 characters long");
            }    
            
            if($oV->isempty($data['new_password']))
            {
                  $this->setMessage("New Password - required");
            }
            else if(strlen($data['new_password']) < 6 && $data['new_password'] != "" ) 
            {
                $this->setMessage("New Password must be atleast 6 characters long");
            }    
            
            if($oV->isempty($data['confirm_password']))
            {
                  $this->setMessage("Confirm Password - required");
            }
            else if(strlen($data['confirm_password']) < 6 && $data['confirm_password'] != "" ) 
            {
                $this->setMessage("Confirm Password must be atleast 6 characters long");
            }
            
            if($data['new_password'] != $data['confirm_password'])
            {
                $this->setMessage("New Password Confirm Password and  didn't match");                                   
            }
            
       return $this;
    }
}
?>
