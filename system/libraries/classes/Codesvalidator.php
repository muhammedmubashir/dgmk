<?php
include("Abstractvalidator.php");
class Codesvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['codeType']))
        {
              $this->setMessage("Code Type - required");
        }
        
        if($oV->isempty($data['comma_data']))
        {
              $this->setMessage("Code Value - required");
        }        
       
       return $this;
    }
}
?>
