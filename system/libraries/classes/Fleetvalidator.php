<?php
include("Abstractvalidator.php");
class Fleetvalidator extends Abstractvalidator
{

    function Validate($data)
    {       
        $oV = new iceValidation();
        
        if($oV->isempty($data['fleet_type']))
        {
              $this->setMessage("Fleet Type - required");
        }
        
        if($data['fleet_type'] == "car_rental")
        {
           if($oV->isempty($data['car_rental_category_id']))
           {
              $this->setMessage("Rental Category - required");
           } 
        }
        
        if($data['fleet_type'] == "limousine")
        {
           if($oV->isempty($data['limousine_category_id']))
           {
              $this->setMessage("Limousine Category - required");
           } 
        }
        
        if($oV->isempty($data['company_id']))
        {
              $this->setMessage("Company - required");
        }
        
        if($oV->isempty($data['model_year_id']))
        {
              $this->setMessage("Model Year - required");
        }
        
        if($oV->isempty($data['car_name']))
        {
              $this->setMessage("Name - required");
        }
        
        if($oV->isempty($data['car_description']))
        {
              $this->setMessage("Description - required");
        }
        
        if(isset($data['is_for_sell']) && $data['is_for_sell'] == "yes")         
        {
            if($oV->isempty($data['car_price']))
            {
                $this->setMessage("Sell Price - required");
            }
            else if($oV->is_number($data['car_price']))        
            {
                $this->setMessage("Sell Price must be a number");
            }        
        }
        
        if(isset($data['daily_price']) && $data['daily_price'] != "")         
        {
            if($oV->isempty($data['daily_price']))
            {
                $this->setMessage("Daily Price - required");
            }
            else if($oV->is_number($data['daily_price']))        
            {
                $this->setMessage("Daily Price must be a number");
            }        
        }
        
        
        if(isset($data['weekly_price']) && $data['weekly_price'] != "")         
        {
            if($oV->isempty($data['weekly_price']))
            {
                $this->setMessage("Weekly Price - required");
            }
            else if($oV->is_number($data['weekly_price']))        
            {
                $this->setMessage("Weekly Price must be a number");
            }        
        }
        
        if(isset($data['monthly_price']) && $data['weekly_price'] != "")         
        {
            if($oV->isempty($data['monthly_price']))
            {
                $this->setMessage("Monthly Price - required");
            }
            else if($oV->is_number($data['monthly_price']))        
            {
                $this->setMessage("Monthly Price must be a number");
            }        
        }
        
        if(isset($data['cdw_price']) && $data['cdw_price'] != "")         
        {
            if($oV->isempty($data['cdw_price']))
            {
                $this->setMessage("CDW Price - required");
            }
            else if($oV->is_number($data['cdw_price']))        
            {
                $this->setMessage("CDW Price must be a number");
            }        
        }
        
       return $this;
    }
    
}
?>
