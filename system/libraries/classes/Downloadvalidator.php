<?php
include("Abstractvalidator.php");
class Downloadvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['download_title']))
        {
              $this->setMessage("Download Title - Required");
        }        
        
       
       if($data['form_action'] == "edit_download")
       {
            if(isset($_FILES["download_file"]['name']) && $_FILES["download_file"]['name'] != "")
            {
                $this->validate_file();
            }                                                                                     
       }
       else
       {
            if(isset($_FILES["download_file"]['name']))
            {
                $this->validate_file();
            }   
       }
       
       return $this;
    }
    
    private function validate_file()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["download_file"]['name'] == "")
        {
            $this->setMessage("Download File - required");
        }
        else if($iceUpload->CheckType($_FILES["download_file"]['type']) == false && $_FILES["download_file"]['type'] != "")
        {      
            $this->setMessage("Invalid Download File, File must be Word Process, Spread Sheet,  PDF or Image");
        }
        else
        {
            return true;
        }
    }
}
?>