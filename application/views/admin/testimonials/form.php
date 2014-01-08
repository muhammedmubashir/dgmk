<script>
$(function()
{
    $("#frm_fleet").validate();    
});
</script>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/testimonials">Manage Testimonials</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_testimonial">Add new testimonial</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="frm_hotels" id="frm_fleet" method="post" action="<?PHP echo $form_action?>" enctype="multipart/form-data">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide Testimonial Information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    
                    <div class="clearfix">
                        <label>Client Name :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data) > 0)
                                {
                                    $testimonial_client_name = stripslashes($testimonial_data['testimonial_client_name']);
                                }
                                else
                                {
                                    $testimonial_client_name = "";
                                }
                        ?>
                            <input type="text" name="testimonial_client_name" id="testimonial_client_name" title="Enter client name" rel="tooltips"  value="<?PHP echo $testimonial_client_name;?>" size="60" />
                        </div>
                    </div>
                    
                    <div class="clearfix">
                        <label>Client Designation :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data) > 0)
                                {
                                    $client_designation = stripslashes($testimonial_data['client_designation']);
                                }
                                else
                                {
                                    $client_designation = "";
                                }
                        ?>
                            <input type="text" name="client_designation" id="client_designation" title="Enter client designation" rel="tooltips"  value="<?PHP echo $client_designation;?>" size="60" />
                        </div>
                    </div>
                    
                      <div class="clearfix">
                        <label>Testimonial Text :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data) > 0)
                                {
                                    $testimonial_text = stripslashes(strip_quotes(($testimonial_data['testimonial_text'])));
                                }
                                else
                                {
                                    $testimonial_text = "";
                                }
                        ?>
                            <textarea cols="200" rows="10" name="testimonial_text" id="testimonial_text" title="Enter testimonial text"><?PHP echo $testimonial_text;?></textarea>
                        </div>
                        <label for="testimonial_text" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    
                    
                       <div class="clearfix" id="div_cdw_price">
                            <label>Original Source File :</label>
                            <div class="input">
                            <input type="file" name="original_source_file" />
                             <?PHP 
                                            if(isset($testimonial_data) && count($testimonial_data['original_source_file']) !="")
                                            {
                                                if(file_exists(_DIR_TESTIMONAILS."/".$testimonial_data['original_source_file']) && $testimonial_data['original_source_file'] != "")
                                                {
                                                    $url = _URL_TESTIMONAILS_SOURCE_FILE;
                                                ?>   
                                                <br /><br />
                                                <a href="<?PHP echo $url.$testimonial_data['original_source_file']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$testimonial_data['original_source_file']; ?>" alt="Picture" /></a>
                                                <?PHP
                                                }
                                            }
                                        ?> 
                            </div>
                         
                     </div>
                     
                     
                      <div class="clearfix" id="div_cdw_price">
                            <label>Worked Source File :</label>
                            <div class="input">
                            <input type="file" name="worked_source_file" />
                             <?PHP 
                                            if(isset($testimonial_data) && count($testimonial_data['worked_source_file']) !="")
                                            {
                                                if(file_exists(_DIR_TESTIMONAILS."/".$testimonial_data['worked_source_file']) && $testimonial_data['worked_source_file'] != "")
                                                {
                                                    $url = _URL_TESTIMONAILS_WORKED_FILE;
                                                ?>   
                                                <br /><br />
                                                <a href="<?PHP echo $url.$testimonial_data['worked_source_file']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$testimonial_data['worked_source_file']; ?>" alt="Picture" /></a>
                                                <?PHP
                                                }
                                            }
                                        ?> 
                            </div>
                         
                     </div>
                     
                     
                        <div class="clearfix">
                        <label>Testimonial Status :</label>
                        <div class="input">
                         <?PHP
                                
                                if(isset($testimonial_data) && count($testimonial_data) > 0)
                                {
                                   $testimonial_status = $testimonial_data['testimonial_status'];
                                }
                                else
                                {
                                    $testimonial_status = "1";
                                }
                                if($testimonial_status == "1")
                                {
                                    $yes = "checked='checked'";
                                    $no = "";
                                }
                                else if($testimonial_status == "0")
                                {
                                    $yes = "";
                                    $no = "checked='checked'";
                                }
                                ?>
                                <label id="active_status">
                                  <input type="radio" name="testimonial_status"  value="1" <?PHP echo $yes?> title="Select status" rel="tooltips">Activate</label>
                                  <label id="deactive_status">
                                  <input type="radio" name="testimonial_status" value="0" <?PHP echo $no?> title="Select status" rel="tooltips">Deactivate</label>
   
                        </div> 
                        </div>
                    
                    
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                               if(isset($testimonial_data) && count($testimonial_data) > 0) 
                                {
                                    $testimonial_id = $testimonial_data['testimonial_id'];
                                }
                                else
                                {
                                    $testimonial_id = "";
                                }
                                
                                ?>
                                
                        <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data) > 0)
                            {
                                $original_source_file = $testimonial_data['original_source_file'];
                            }
                            else
                            {
                                $original_source_file = "";
                            }
                            ?>
                            
                            <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data) > 0)
                            {
                                $worked_source_file = $testimonial_data['worked_source_file'];
                            }
                            else
                            {
                                $worked_source_file = "";
                            }
                            ?>
                            <input type="hidden" name="original_source_file" value="<?PHP echo $original_source_file?>">  
                              
                            <input type="hidden" name="worked_source_file" value="<?PHP echo $worked_source_file?>">    
                            
                            <input type="hidden" name="testimonial_id" value="<?PHP echo $testimonial_id?>">    
                            <input type="hidden" name="action" value="<?PHP echo $form_action?>">    
                            
                            <input type="submit" class="button blue" value="Save" name="submit"></input>
                            <INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-1)">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>   
</div>
    </div>
</div>
</form>
