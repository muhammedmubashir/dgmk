<script>
$(function()
{
    $("#site_codes_frm").validate();    
});
</script>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/sitecodes">Manage System Data Codes</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_codes">Add New System Data Codes</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<?PHP
    $this->load->model('SiteCodes_model');
?>
<form name="site_codes_frm" id="site_codes_frm" method="post" action="<?PHP echo $form_action?>">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide System Data Codes Information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label> System Data Code :</label>
                        <div class="input">
                        <?PHP
                        if(isset($codes_data) && count($codes_data) > 0)
                        {
                            $codeType = $codes_data['codeType'];  
                        }
                        else
                        {
                            $codeType = "";
                        }
                        ?>
                        <select name="codeType" class="required" id="codeType">
                            <option value="">Please select</option>
                            <?PHP echo $this->SiteCodes_model->code_type_combo($codeType);?>
                        </select>
                        </div>
                        <label for="codeType" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    
                    <div class="clearfix">
                        <label>Data Code Value :</label>
                         <?PHP
                        if(isset($codes_data) && count($codes_data) > 0)
                        {
                            $comma_data = $codes_data['comma_data'];  
                        }
                        else
                        {
                            $comma_data = "";
                        }
                        ?>
                        <div class="input">
                        <input type="text" name="comma_data" id="comma_data" size="125" class="required">
                        <br/ ><p>"," separate each value (example: <b>value1, value2, value3</b>)</p>
                        <div><label for="comma_data" class="error" style="display:none;text-align: left;">required.</label>  </div>
                        </div>
                        
                    </div>
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
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