<script>
$(function()
{
    $("#frm_news").validate();    
});
</script>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/news">Manage news</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_news">Add new news</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="frm_news" id="frm_news" method="post" action="<?PHP echo $form_action?>">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide news information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label><b>News Title</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($news_data) && count($news_data) > 0)
                                {
                                    $news_title = stripslashes($news_data['news_title']);
                                }
                                else
                                {
                                    $news_title = "";
                                }
                        ?>
                            <input type="text" name="news_title" id="news_title" title="Enter news title" rel="tooltips"  value="<?PHP echo stripslashes(strip_quotes(($news_title)));?>"  class="required"  size="90"/>
                        </div>
                        <label for="news_title" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    
                    <div class="clearfix">
                        <label><b>News Date</b> :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($news_data) && count($news_data) > 0)
                                {
                                    $news_date = stripslashes($news_data['news_date']);
                                }
                                else
                                {
                                    $news_date = "";
                                }
                        ?>
                            <input type="text" name="news_date" id="news_date" title="Enter news date" rel="tooltips"  value="<?PHP echo $news_date;?>" class="required date_input" size="11"/>
                        </div>
                        <label for="news_date" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                   
                    <div class="clearfix">
                        <div class="input">
                        <h4>News Details</h4><br />
                        <?PHP 
                            if(isset($news_data) && count($news_data) > 0)
                                {
                                    $news_details = $news_data['news_details'];
                                }
                                else
                                {
                                    $news_details = "";
                                }
                        ?>
                           <textarea cols="200" style="width: 1070; height: 500" rows="10" name="news_details"><?PHP echo str_replace('\\r\\n','', $news_details);?></textarea>
                        </div>
                 </div> 
                 
                  <div class="clearfix">
                        <label><b>News Status :</b></label>
                        <div class="input">
                         <?PHP
                                
                                if(isset($news_data) && count($news_data) > 0)
                                {
                                   $news_status = $news_data['news_status'];
                                }
                                else
                                {
                                    $news_status = "1";
                                }
                                if($news_status == 1)
                                {
                                    $activate = "checked='checked'";
                                    $deactivate = "";
                                }
                                else if($news_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "checked='checked'";
                                }
                                ?>
                                <label id="active_status">
                                  <input type="radio" name="news_status" id="active_status" value="1" <?PHP echo $activate?> title="Select status" rel="tooltips">Activate</label>
                                  <label id="deactive_status">
                                  <input type="radio" name="news_status" id="deactive_status" value="0" <?PHP echo $deactivate?> title="Select status" rel="tooltips">Deactivate</label>
   
                        </div> 
                    </div>                    
                      
                         
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($news_id))
                                {
                                    $news_id = $news_id;
                                
                                }
                                else
                                {
                                    $news_id = "";
                                }
                                
                                ?>
                                
                            <?PHP 
                                if(isset($news_data) && count($news_data) > 0)
                                {
                                    $display_order = $news_data['display_order'];
                                }
                                else
                                {
                                    $display_order = "";
                                }
                            ?>
                                
                            <input type="hidden" name="news_id" value="<?PHP echo $news_id?>">    
                            <input type="hidden" name="display_order" value="<?PHP echo $display_order?>">    
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
