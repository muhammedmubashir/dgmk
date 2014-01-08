<?php
include("Abstractvalidator.php");
class Templatevalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['template_subject']))
        {
              $this->setMessage("Email Suject - required");
        }
        
        if($oV->isempty($data['template_content']))
        {
              $this->setMessage("Email Content - required");
        }
       
       return $this;
    }
}
?>
