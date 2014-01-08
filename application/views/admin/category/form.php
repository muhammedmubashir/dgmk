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
                    <li><a href="<?php echo base_url();?>index.php/admin/categories">Manage Topics</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_category">Add new topic for book</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="frm_news" id="frm_news" method="post" action="">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide Topic information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label><b>Topic Name</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($category_data) && count($category_data) > 0)
                                {
                                    $category_name = $category_data['category_name'];
                                }
                                else
                                {
                                    $category_name = "";
                                }
                        ?>
                            <input type="text" name="category_name" id="category_name" dir="rtl" title="Enter Topic title" rel="tooltips"  value="<?PHP echo $category_name;?>"  class="required"  size="50" style="font-size:18px;"/>
                        </div>
                        <label for="category_name" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    

                    <div class="clearfix">
                        <label><b>Topic Status :</b></label>
                        <div class="input">
                         <?PHP
                            if(isset($category_data) && count($category_data) > 0)
                            {
                               $status = $category_data['category_status'];
                            }
                            else
                            {
                                $status = "1";
                            }
                            if($status == 1)
                            {
                                $activate = "checked='checked'";
                                $deactivate = "";
                            }
                            else if($status == 0)
                            {
                                $activate = "";
                                $deactivate = "checked='checked'";
                            }
                            ?>
                            <label id="active_status">
                              <input type="radio" name="category_status" id="active_status" value="1" <?PHP echo $activate?> title="Select status" rel="tooltips">Activate
                            </label>
                            <label id="deactive_status">
                              <input type="radio" name="category_status" id="deactive_status" value="0" <?PHP echo $deactivate?> title="Select status" rel="tooltips">Deactivate
                            </label>
                        </div> 
                    </div>
                         
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($category_id))
                                {
                                    $category_id = $category_id;
                                }
                                else
                                {
                                    $category_id = "";
                                }
                                ?>
                            <input type="hidden" name="category_id" value="<?PHP echo $category_id;?>">    
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
