function onchange_book_type(value)
{   
    if(value == "pdf_format")
    {
        $("#div_book_title_filename").show();  
        $("#div_book_filename").show();  
        $("#div_pdf_book_image").show();  
        $("#div_book_front_page").hide();  
        $("#div_book_back_page").hide();  
    }
    
    if(value == "scan_format")
    {
        $("#div_book_front_page").show();  
        $("#div_book_back_page").show();  
        $("#div_book_title_filename").hide();  
        $("#div_book_filename").hide();  
        $("#div_pdf_book_image").hide();  
        
    }
    
    if(value == "-1")
    {
        $("#div_book_front_page").hide();  
        $("#div_book_back_page").hide();  
        $("#div_book_title_filename").hide();  
        $("#div_book_filename").hide();  
        $("#div_pdf_book_image").hide();  
    }
}
 
 function update_status(obj,_url)
 {
     showOverlay(); 
     if(obj.checked)
        status = "1";
     else                             
        status = "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "status=" + status,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_display_order(value,_url)
 {
     
     showOverlay(); 
     $.ajax({
        type: "POST",
        url: _url,
        data: "display_order="+value,
        success: function(html)
        {
            
            hideOverlay();       
        }
    });
 }
 
 function update_is_show_status(obj,_url,id)
 {
     if(obj.checked)
     {
        is_show = "1";
        tmp_msg = "Active";
     }
     else                             
     {
        is_show= "0";
        tmp_msg = "InActive";
     } 
     $.ajax({
        type: "POST",
        url: _url,
        data: "is_show="+is_show,
        success: function(html)
        {
            
            $("#publish_"+id).html(tmp_msg);
            $("#save_msg_"+id).show().delay(500).fadeOut(1000).css("float","right");  
        }
    });
 }
 
 function update_picture_title(obj,_url,id)
 {
     $("#save_msg_"+id).show().delay(500).fadeOut(1000).css("float","right");
     
     $.ajax({
        type: "POST",
        url: _url,
        data: "image_text="+obj,
        success: function(html)
        {
            
         //$("#save_msg_"+id).hide();
            
        }
    });
 } 
 
function onchange_package_type(value)
{   
    if(value == "")
    {
        $("#digitizing_id").removeClass("required");
        $("#stitches_id").removeClass("required");
        $("#jacket_back_logo_id").removeClass("required");
        $("#div_digitizing_package_type").hide();  
        $("#div_stitches_package_type").hide();  
        $("#div_back_logo_package_type").hide();  
    }
    else
    {
        if(value == "digitizing")
        {
          $("#digitizing_id").addClass("required");
          $("#stitches_id").removeClass("required");
          $("#jacket_back_logo_id").removeClass("required");
          $("#div_digitizing_package_type").show();  
          $("#div_stitches_package_type").hide();  
          $("#div_back_logo_package_type").hide();
          
            
        }
        else if(value == "stitches")
        {
          $("#stitches_id").addClass("required");
          $("#digitizing_id").removeClass("required");
          $("#jacket_back_logo_id").removeClass("required");
          $("#div_stitches_package_type").show();  
          $("#div_digitizing_package_type").hide();  
          $("#div_back_logo_package_type").hide(); 
        }
        else if(value == "jacket_back_logo")
        {
          $("#jacket_back_logo_id").addClass("required");
          $("#stitches_id").removeClass("required");
          $("#digitizing_id").removeClass("required");
          
          $("#div_back_logo_package_type").show(); 
          $("#div_digitizing_package_type").hide();  
          $("#div_stitches_package_type").hide();  
        }
    }
    
    if(value == "digitizing")
    {
      $("#div_digitizing_package_type").show();  
      $("#div_support_value").show();  
      $("#div_logos_a_month_value").show();  
      $("#div_test_sew_out_value").show();
      $("#div_left_chest_value").show();
      $("#div_hour_turn_around_time_value").show();
      $("#div_quick_quote_editing_value").show();
      $("#div_unlimited_stitch_count").show();
      $("#div_quick_quote_editing_value").show();
      $("#div_package_amount").show();
      
      $("#div_back_logo_package_type").hide();
      $("#div_stitches_package_type").hide();
      $("#div_complexity_description").hide();    
    }
    
    if(value == "stitches")
    {
      $("#div_stitches_package_type").show();  
      $("#div_support_value").show();  
      $("#div_logos_a_month_value").show();  
      $("#div_test_sew_out_value").show();
      $("#div_left_chest_value").show();
      $("#div_hour_turn_around_time_value").show();
      $("#div_quick_quote_editing_value").show();
      $("#div_quick_quote_editing_value").show();
      $("#div_package_amount").show();
      
      $("#div_unlimited_stitch_count").hide();  
      $("#div_digitizing_package_type").hide();  
      $("#div_back_logo_package_type").hide();
      $("#div_complexity_description").hide();    
    }
    
    if(value == "jacket_back_logo")
    {
      $("#div_back_logo_package_type").show(); 
      $("#div_complexity_description").show();
      
      
      $("#div_support_value").hide();  
      $("#div_logos_a_month_value").hide();  
      $("#div_test_sew_out_value").hide();
      $("#div_left_chest_value").hide();
      
      $("#div_hour_turn_around_time_value").hide();
      $("#div_quick_quote_editing_value").hide();
      $("#div_free_quote_value").hide();
      $("#div_package_amount").hide();
      $("#div_unlimited_stitch_count").hide();  
      $("#div_digitizing_package_type").hide();  
      $("#div_stitches_package_type").hide(); 
    }
    if(value == "")  
    {
      $("#div_back_logo_package_type").hide(); 
      $("#div_stitches_package_type").hide(); 
      $("#div_digitizing_package_type").hide();  
      
      
      $("#div_support_value").show();  
      $("#div_logos_a_month_value").show();  
      $("#div_test_sew_out_value").show();
      $("#div_left_chest_value").show();
      $("#div_hour_turn_around_time_value").show();
      $("#div_quick_quote_editing_value").show();
      $("#div_package_amount").show();
      $("#div_unlimited_stitch_count").show();  
      $("#div_complexity_description").show();
    }
    
}
 function update_faq_display_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "display_order="+obj,
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
        data: "display_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 } 
 
 function update_testimonial_display_order(obj,_url,id)
 {
     showOverlay();
     $.ajax({
        type: "POST",
        url: _url,
        data: "display_order="+obj,
        success: function(html)
        {
            hideOverlay();       
        }
    });
 }
 
 function update_fleet_stauts(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        fleet_stauts = "1";
     else                             
        fleet_stauts= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "fleet_stauts="+fleet_stauts,
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
 
 function update_testimonial_status(obj,_url,id)
 {
     showOverlay();    
     
     if(obj.checked)
        testimonial_status = "1";
     else                             
        testimonial_status= "0";
        
     $.ajax({
        type: "POST",
        url: _url,
        data: "testimonial_status="+testimonial_status,
        success: function(html)
        {
            hideOverlay();       
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