<?php
include("Abstractvalidator.php");
class Newslettervalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        
        if($oV->isempty($data['newsletter_title']))
        {
              $this->setMessage("Newsletter Title - required");
        }
        
        if($oV->isempty($data['newsletter_text']))
        {
              $this->setMessage("Newsletter Details - required");
        }
       return $this;
    }
}
?>
