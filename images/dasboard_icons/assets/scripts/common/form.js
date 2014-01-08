jQuery(document).ready(function() 
{
     // prepare Options Object 
    var options = { 
        targetDiv:     '#licenses_certifications_response_div', 
        beforeSubmit: validate,
        success:       showResponse,
        error:       EmploymentHistoryError,
        dataType:  'json'
    }; 
 
 // bind to the form's submit event 
    $('#licenses_certifications').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        
        $(this).ajaxSubmit(options); 

        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
  
});

function EmploymentHistoryError(xhr, ajaxOptions, thrownError)
{
    $('#licenses_certifications_btn').removeAttr('disabled'); 
    $(".ajax_loading").hide();

    JumpFadeInDiv("#licenses_certifications_response_div","Oops! We are unable to complete your request. Please try again.");  
}


function showResponse(responseText, statusText, xhr, $form)  
{ 
    alert(responseText);
    
    var jsonResponse = responseText;
    
    $(".ajax_loading").hide();  
    
    if(jsonResponse.code == "ERROR")
    {
        $('#licenses_certifications_btn').removeAttr('disabled');  
         
        var error_str = "";
        $.each(jsonResponse.ice_response.error, function(key,value){
            error_str +=  value;
        });

       JumpFadeInDiv("#licenses_certifications_response_div",error_str,"r_error");

    } 
    else if(jsonResponse.code == "SUCCESS")
    {
       var response = jsonResponse.ice_response.success.response;
       JumpFadeInDiv("#licenses_certifications_response_div",response.message,"r_success");
       setTimeout("closeFB()",2000);
       $("#div_licenses_certifications").html(response.LicensesCertificationsDataString);
    }
}

function validate(formData, jqForm, options) 
{ 
   
   $(options.targetDiv).html("");
   $(options.targetDiv).hide();

   //required Fields
   var required_fields = ["name"]; 
   
   var is_error = 0;
   
   $.each(required_fields, function(index, field) 
   { 

       var _value  = jQuery.trim($("#licenses_certifications input[name="+field+"]").val());
       
       if(_value == '')
       {
           ShowVisibility("#err_"+field);
           is_error = 1;
       }
       else
       {                                                        
           HideVisibility("#err_"+field);
       }
   });
   
   if(is_error == 1)
   {
       JumpFadeInDiv("#licenses_certifications_response_div","Please fill all the required fields.","r_error");  
       return false; 
   }
   
   $(".ajax_loading").show();                                   
   $('input[type=submit]', jqForm).attr('disabled', 'disabled');
   return true;
}
   