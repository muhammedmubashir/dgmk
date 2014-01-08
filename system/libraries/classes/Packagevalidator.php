<?php
include("Abstractvalidator.php");
class Packagevalidator extends Abstractvalidator
{

    function Validate($data)
    {                         
        $oV = new iceValidation();
        /*if($oV->isempty($data['package_name']))
        {
              $this->setMessage("Package Name - required");
        }                                      */
        
        /*if($oV->isempty($data['package_amount']))
        {
              $this->setMessage("package_amount - required");
        }
        else if($oV->is_number($data['package_amount']))        
        {
            $this->setMessage("Package Price must be a number");
        }                                        */
       return $this;
    }
}
?>
