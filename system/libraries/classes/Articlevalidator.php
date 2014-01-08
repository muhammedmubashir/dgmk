<?php
include("Abstractvalidator.php");
class Articlevalidator extends Abstractvalidator
{

    function Validate($data)
    {       
       $oV = new iceValidation();
       
       if($oV->isempty($data['article_title']))
       {
             $this->setMessage("Article Title - required");
       }        
       
       if(isset($_FILES["article_image"]['name']) && $_FILES["article_image"]['name'] != "")
       {
           $this->validate_article_image();
       }  
       
       /*if($data['book_type'] == "pdf_format")
       {
            if($oV->isempty($data['book_title_filename']))
            {
                $this->setMessage("Book File Title  - required");
            }            
       }                                     */
       return $this;
    }
    
    private function validate_article_image()
    {
        $iceUpload = new iceUpload();
        
        if($_FILES["article_image"]['name'] == "")  
        {
            $this->setMessage("Article Image - required");
        }
        else if($iceUpload->CheckImageType($_FILES["article_image"]['type']) == false && $_FILES["article_image"]['type'] != "")
        {      
            $this->setMessage("Front Page Image must be PNG/GIF/JPG only");
        } 
        else
        {
            return true;
        }
    }
}
?>
