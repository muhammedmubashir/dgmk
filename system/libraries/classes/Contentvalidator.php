<?php
include("Abstractvalidator.php");
class Contentvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['page_title']))
        {
              $this->setMessage("Title - required");
        }
        
        if($oV->isempty($data['page_content']))
        {
              $this->setMessage("Content - required");
        }
       
       return $this;
    }
}
?>
