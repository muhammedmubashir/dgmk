 function update_hotel_display_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "hotel_display_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_package_display_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "package_display_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_tour_display_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "tour_display_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_image_display_order(obj,_url,id)
 {
     $("#save_msg_"+id).show().delay(600).fadeOut(1000).css("float","right");
     
     $.ajax({
        type: "POST",
        url: _url,
        data: "image_display_order="+obj,
        success: function(html)
        {
            
         //$("#save_msg_"+id).hide();
            
        }
    });
 } 
 function update_job_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "update_job_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_news_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "update_news_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 } 
 
 function update_product_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "update_product_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 

 
 
function onchange_country(value,_url)
  {
      if(value == 0)
        {
           $("#parentID_City_row").hide();
           $("#parentID_State_row").hide();
           $("#hotel_other_div").hide(); 
           return;
        }
        
        showOverlay();
        
        var data_str = "countries_name="+value;
        
        $.ajax({
            type: "POST",
            url: _url,
            data:     data_str ,
            success: function(response_ajax)
            {   
                $("#parentID_State_row").show();
                $("#parentID_State_data_row").html(response_ajax);
                hideOverlay();
            }
        });
  }
  
function onchange_leaving_country(value,_url)
{
  
  $("#leaving_city_id_other_div").hide(); 
  $("#others_leaving_city_id2").val("");
  
  if(value == 0)
    {
       $("#parentID_City_row").hide();
       $("#leaving_city_id_other_div").hide(); 
       return;
    }
    
    showOverlay();
    
    var data_str = "leaving_countries_name="+value;
    
    $.ajax({
        type: "POST",
        url: _url,
        data:     data_str ,
        success: function(response_ajax)
        {   
            $("#parentID_City_row").show();
            $("#div_ParentID_City_data").html(response_ajax);
            hideOverlay();
        }
    });
}

function onchange_hotel_country(value,_url)
{
  $("#hotel_city_id_other_div").hide(); 
  $("#others_hotel_city_id2").val("");
  
  if(value == 0)
    {
       $("#parentID_City_row").hide();
       $("#leaving_city_id_other_div").hide(); 
       return;
    }
    
    showOverlay();
    
    var data_str = "countries_name="+value;
    
    $.ajax({
        type: "POST",
        url: _url,
        data:     data_str ,
        success: function(response_ajax)
        {   
            $("#parentID_City_row").show();
            $("#div_ParentID_City_data").html(response_ajax);
            hideOverlay();
        }
    });
}

function onchange_going_country(value,_url)
{
  
  $("#going_city_id_other_div").hide(); 
  $("#going_leaving_city_id2").val("");
  
  if(value == 0)
    {
       $("#parentID_going_City_row").hide();
       $("#going_city_id_other_div").hide(); 
       return;
    }
    
    showOverlay();
    
    var data_str = "going_countries_name="+value;
    
    $.ajax({
        type: "POST",
        url: _url,
        data:     data_str ,
        success: function(response_ajax)
        {   
            $("#parentID_going_City_row").show();
            $("#div_ParentID_going_City_data").html(response_ajax);
            hideOverlay();
        }
    });
}

function onchange_state(value,_url)
{
    
    if(value == 0)
    {
       $("#parentID_City_row").hide();
       $("#div_ParentID_City_data").html("");  
       return;
    }
    
    if(value == "others")
    {
        $("#state_others_div").show();
        $("#city_other_div").hide(); 
    }
    else
    {
        $("#state_others_div").hide();    
    }
    
    $("#city_other_div").hide(); 
    var data_str = "states_name="+value;
    showOverlay();

    $.ajax({
        type: "POST",
        url: _url,
        data:     data_str ,
        success: function(response_ajax)
        {
            if(response_ajax == "")
            {
                $("#parentID_City_row").hide();
                $("#div_ParentID_City_data").html("");      
            }
            else
            {
                $("#parentID_City_row").show();
                $("#div_ParentID_City_data").html(response_ajax); 
                   hideOverlay();   
            }
            
        }
    });
}


 function onchange_country_search(value,_url)
  {
      if(value == 0)
        {
           $("#parentID_City_row").hide();
           $("#parentID_State_row").hide();
           return;
        }
        
        var data_str = "countries_name="+value;
        showOverlay();
        $.ajax({
            type: "POST",
            url: _url,
            data:     data_str ,
            success: function(response_ajax)
            {   
                $("#parentID_State_row").show();
                $("#parentID_State_data_row").html(response_ajax);
                hideOverlay();   s
            }
        });
  }
  
  function onchange_leaving_city_id_other(value)
  {
      if(value == "others")
        {
           $("#others_leaving_city_id2").addClass('required');
           $("#others_leaving_city_id").removeClass('required');
           $("#leaving_city_id_other_div").show();
        }
        else
        {
           $("#others_leaving_city_id2").removeClass('required');
           $("#others_leaving_city_id").removeClass('required');
           $("#others_leaving_city_id2").val("");
           $("#leaving_city_id_other_div").hide(); 
        }
  }
  
  function onchange_hotel_city_id_other(value)
  {
      if(value == "others")
        {
           $("#others_hotel_city_id2").addClass('required');
           $("#others_hotel_city_id").removeClass('required');
           $("#hotel_city_id_other_div").show();
        }
        else
        {
           $("#others_hotel_city_id2").removeClass('required');
           $("#others_hotel_city_id").removeClass('required');
           $("#others_hotel_city_id2").val("");
           $("#hotel_city_id_other_div").hide(); 
        }
  }
  
  function onchange_going_city_id_other(value)
  {
      if(value == "others")
        {
           $("#others_going_city_id2").addClass('required');
           $("#others_going_city_id").removeClass('required');
           $("#going_city_id_other_div").show();
        }
        else
        {
           $("#others_going_city_id2").removeClass('required');
           $("#others_going_city_id").removeClass('required');
           $("#others_going_city_id2").val("");
           $("#going_city_id_other_div").hide(); 
        }
  }
  
  function onchange_city_other(value)
  {
      if(value == "others")
        {
           $("#others_users_city2").addClass('required');
           $("#city_other_div").show();
        }
        else
        {
           $("#city_other_div").hide(); 
           ("#others_users_city2").removeClass('required') ;
        }
  }
  
  function onchange_hotel_city_other(value)
  {
      if(value == "others")
        {
            $("#others_city2").addClass('required');                       
            $("#hotel_other_div").show();
        }
        else
        {
           $("#others_city2").removeClass('required');                       
           $("#hotel_other_div").hide(); 
        }
  }
  
  
  
function update_hotel_featured_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        featured_status = "1";
     else                             
        featured_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "featured_status="+featured_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_package_featured_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        featured_status = "1";
     else                             
        featured_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "featured_status="+featured_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_tour_featured_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        tour_status = "1";
     else                             
        tour_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "tour_status="+tour_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_airline_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        airline_status = "1";
     else                             
        airline_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "airline_status="+airline_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_service_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        service_status = "1";
     else                             
        service_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "service_status="+service_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_hotel_is_top_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        is_top_status = "1";
     else                             
        is_top_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "is_top_status="+is_top_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_hotel_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        hotel_status = "1";
     else                             
        hotel_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "hotel_status="+hotel_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_flight_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        flight_status = "1";
     else                             
        flight_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "flight_status="+flight_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_package_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        package_status = "1";
     else                             
        package_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "package_status="+package_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_tour_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        tour_status = "1";
     else                             
        tour_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "tour_status="+tour_status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
       
       
function markStatus(obj,field_id,_url)
{
	var data_str = "field_id="+field_id;
     if(obj.checked)
        data_str += "&status=1";
     else                             
        data_str += "&status=0";

    
    $.ajax({
        type: "POST",
        url: _url,
        data: data_str,
        success: function(html)
        {
            alert(html);
        }
    });
 }
 
  
 
 function ToggleFilter(filter_form_id,action,cookie_not_needed)
 {
     var filter_div = "filterfrm"; // to toggle show hide
     if(filter_form_id != undefined && filter_form_id != null)
     {
         filter_div = filter_form_id;
     }
     
     if(action ==  undefined && action != "")
     {
        var action = $("#filter_action_string").html().toLowerCase();
     }
     
     var cookie_needed = 0;
     if(cookie_not_needed == undefined || cookie_not_needed == null)
        cookie_needed = 1;
     

       if(action == "open")
     {
        //$("#"+filter_div).show();
        $("#"+filter_div).slideDown(600);
        $("#filter_action_string").html("Close");
     }
     else
     {
        $("#filter_action_string").html("Open");
        $("#"+filter_div).hide();
        //$("#"+filter_div).slideUp(300);
     } 
     
     if(cookie_needed == 0)
        return;
     
     setCookie("filter_action_value",action);
     
     return;
     /*
     $.ajax({
        type: "POST",
        url: "admin.php?section=filter&action=setFilterAction",
        data: "filter_action="+action,
        success: function(html)
        {
        }
    });
     */
 }
 

function initToggleFilter(action)
{
    ToggleFilter(null,action,1)
}

function numbersonly(myfield, e, dec)
    {
        var key;
        var keychar;
 
        if (window.event)
            key = window.event.keyCode;
        else if (e)
            key = e.which;
        else
            return true;
        keychar = String.fromCharCode(key);
 
        // control keys
        if ((key==null) || (key==0) || (key==8) ||
            (key==9) || (key==13) || (key==27) )
            return true;
        // numbers
        else if ((("0123456789").indexOf(keychar) > -1))
            return true;
        else
            return false;
    }