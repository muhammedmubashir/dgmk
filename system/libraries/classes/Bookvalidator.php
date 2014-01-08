<?php
include("Abstractvalidator.php");
class Bookvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
       $oV = new iceValidation();
       
       if($oV->isempty($data['book_title']))
       {
             $this->setMessage("Book Title - required");
       }        
       
       if($oV->isempty($data['book_author']))
       {
             $this->setMessage("Book Author - required");
       }        
       
       /*if($data['book_type'] == "pdf_format")
       {
            if($oV->isempty($data['book_title_filename']))
            {
                $this->setMessage("Book File Title  - required");
            }            
       }
        if($oV->isempty($data['book_title_filename']))
        {
            $this->setMessage("Book File Title  - required");
        }            

       
       if(isset($_FILES["book_filename"]['name']) && $_FILES["book_filename"]['name'] != "")
       {
           $this->validate_book_filename();
       }
       
       if(isset($_FILES["book_front_page"]['name']) && $_FILES["book_front_page"]['name'] != "")
       {
           $this->validate_book_front_page_image();
       }  
        
       if(isset($_FILES["book_back_page"]['name']) && $_FILES["book_back_page"]['name'] != "")
       {
           $this->validate_book_book_back_page();
       }
       */
       
       return $this;
    }
    
    private function validate_book_front_page_image()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["book_front_page"]['name'] == "")  
        {
            $this->setMessage("Front Page Image - required");
        }
        else if($iceUpload->CheckImageType($_FILES["book_front_page"]['type']) == false && $_FILES["book_front_page"]['type'] != "")
        {      
            $this->setMessage("Front Page Image must be PNG/GIF/JPG only");
        } 
        else
        {
            return true;
        }
    }
    
    private function validate_book_book_back_page()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["book_back_page"]['name'] == "")  
        {
            $this->setMessage("Back Page Image - required");
        }
        else if($iceUpload->CheckImageType($_FILES["book_back_page"]['type']) == false && $_FILES["book_back_page"]['type'] != "")
        {      
            $this->setMessage("Back Page Image must be PNG/GIF/JPG only");
        } 
        else
        {
            return true;
        }
    }
    
    private function validate_book_filename()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["book_filename"]['name'] == "")
        {
            $this->setMessage("Book File - required");
        }
        else if($iceUpload->OnlyPDFCheckType($_FILES["book_filename"]['type']) == false && $_FILES["book_filename"]['type'] != "")
        {      
            $this->setMessage("Invalid Book File, File must be PDF only");
        }
        else
        {
            return true;
        }
    }
}
?>
