<?php
include("Abstractvalidator.php");
class Faqsvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['faq_question']))
        {
              $this->setMessage("FAQ Question - required");
        }
        
        if($oV->isempty($data['faq_answer']))
        {
              $this->setMessage("FAQ Answer - required");
        }
       return $this;
    }
}
?>
