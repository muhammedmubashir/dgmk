<?php
include("Abstractvalidator.php");
class Editcodesvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['codeType']))
        {
              $this->setMessage("Code Type - required");
        }
        
        if($oV->isempty($data['codeValue']))
        {
              $this->setMessage("Code Value - required");
        }        
       
       return $this;
    }
}
?>
