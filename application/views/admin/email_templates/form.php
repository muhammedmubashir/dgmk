<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/email_templates">Manage Email Templates</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="admin_login" method="post" action="<?PHP echo $form_action?>" enctype="multipart/form-data">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide email template information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_8 last">
                <div class="form">
                    
                    <div class="clearfix">
                        <label>Email Subject :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($template_data) && count($template_data) > 0)
                                {
                                    $template_subject = $template_data['template_subject'];
                                }
                                else
                                {
                                    $template_subject = "";
                                }
                        ?>
                            <input type="text" name="template_subject" title="Enter email subject" rel="tooltips"  
                                        value="<?PHP echo stripslashes(strip_quotes(($template_subject)));?>" class="xlarge" />
                        </div>
                    </div>
                    
                   <div class="clearfix">
                        <label>Set Email Content :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($template_data) && count($template_data) > 0)
                                {
                                    $template_content = $template_data['template_content'];
                                }
                                else
                                {
                                    $template_content = "";
                                }
                        ?>
                            <textarea class="cleditor" cols="100" rows="15" name="template_content"><?PHP echo stripslashes(strip_quotes(($template_content)));?></textarea>
                        </div>
                    </div>
                   
                   
                   <div class="clearfix">
                        <label>Identifiers :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($identifiers) && count($identifiers) > 0)
                            {
                                 foreach ($identifiers as $key => $val) {?>
                                 <?php echo $key?>:&nbsp;&nbsp;<b><?php echo $val?></b><br><br>
                                        <?php }?>
                            <?PHP }?>
                        </div>
                    </div>
                    
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($template_id))
                                {
                                    $template_id = $template_id;
                                
                                }
                                else
                                {
                                    $template_id = "";
                                }
                                
                                ?>
                            <input type="hidden" name="template_id" value="<?PHP echo $template_id?>">    
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