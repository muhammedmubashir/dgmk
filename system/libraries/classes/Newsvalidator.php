<?php
include("Abstractvalidator.php");
class Newsvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        
        if($oV->isempty($data['news_title']))
        {
              $this->setMessage("News Title - required");
        }
        
        if($oV->isempty($data['news_details']))
        {
              $this->setMessage("News Details - required");
        }
        
        if($oV->isempty($data['news_date']))
        {
              $this->setMessage("News Date - required");
        }
       return $this;
    }
}
?>
