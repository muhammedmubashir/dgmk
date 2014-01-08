<?php
include("Abstractvalidator.php");
class Testimonialvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['testimonial_text']))
        {
              $this->setMessage("Testimonial Text - required");
        }        
       
       if($data['action'] == "add_new_testimonial")
       {
            if($_FILES["original_source_file"]['name'] == "")
            {
                $this->validate_original_source_file();
            }

            if($_FILES["worked_source_file"]['name'] == "")
            {
                $this->validate_worked_source_file();
            }
       }
       
       if($data['action'] == "edit_testimonial")
       {
            if($_FILES["worked_source_file"]['name'] == "" && $_FILES["worked_source_file"]['type'] != "")
            {
                $this->validate_original_source_file();
            }

            if($_FILES["worked_source_file"]['name'] == "" && $_FILES["worked_source_file"]['type'] != "")
            {
                $this->validate_worked_source_file();
            }
       }
       
         
       return $this;
    }
    
    private function validate_original_source_file()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["worked_source_file"]['name'] == "")  
        {
            $this->setMessage("Original Source File - required");
        }
        /*else if($iceUpload->CheckImageType($_FILES["original_source_file"]['type']) == false && $_FILES["original_source_file"]['type'] != "")
        {      
            $this->setMessage("Picture must be PNG/GIF/JPG only");
        } */
        else
        {
            return true;
        }
    }
    
    
    private function validate_worked_source_file()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["worked_source_file"]['name'] == "")
        {
            $this->setMessage("Worked Source File - required");
        }
        /*else if($iceUpload->CheckImageType($_FILES["original_source_file"]['type']) == false && $_FILES["original_source_file"]['type'] != "")
        {      
            $this->setMessage("Picture must be PNG/GIF/JPG only");
        } */
        else
        {
            return true;
        }
    }
}
?>
