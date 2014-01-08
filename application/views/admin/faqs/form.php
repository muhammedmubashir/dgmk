<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/faqs">Manage FAQS</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_faq">Add new FAQ</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="admin_login" method="post" action="<?PHP echo $form_action?>">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide FAQ information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label>FAQ Question :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($faq_data) && count($faq_data) > 0)
                                {
                                    $faq_question = stripslashes(strip_quotes(($faq_data['faq_question'])));
                                }
                                else
                                {
                                    $faq_question = "";
                                }
                        ?>
                            <input type="text" name="faq_question" title="Enter faq question" rel="tooltips"  value="<?PHP echo $faq_question;?>" size="130"/>
                        </div>
                    </div>
                    
                     <div class="clearfix">
                        <label>FAQ Answer :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($faq_data) && count($faq_data) > 0)
                                {
                                    $faq_answer = stripslashes(strip_quotes(($faq_data['faq_answer'])));
                                }
                                else
                                {
                                    $faq_answer = "";
                                }
                        ?>
                            <textarea cols="200" rows="10" name="faq_answer" title="Enter faq answer"><?PHP echo $faq_answer;?></textarea>
                        </div>
                    </div>
                    
                      <div class="clearfix">
                        <label>FAQ Status :</label>
                        <div class="input">
                         <?PHP
                                
                                if(isset($faq_data) && count($faq_data) > 0)
                                {
                                   $faq_status = $faq_data['faq_status'];
                                }
                                else
                                {
                                    $faq_status = "1";
                                }
                                if($faq_status == "1")
                                {
                                    $yes = "checked='checked'";
                                    $no = "";
                                }
                                else if($faq_status == "0")
                                {
                                    $yes = "";
                                    $no = "checked='checked'";
                                }
                                ?>
                                <label id="active_status">
                                  <input type="radio" name="faq_status" id="faq_status_yes" value="1" <?PHP echo $yes?> title="Select status" rel="tooltips">Activate</label>
                                  <label id="deactive_status">
                                  <input type="radio" name="faq_status" id="faq_status_no" value="0" <?PHP echo $no?> title="Select status" rel="tooltips">Deactivate</label>
   
                        </div> 
                        </div>
                        
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($faq_id))
                                {
                                    $faq_id = $faq_id;
                                
                                }
                                else
                                {
                                    $faq_id = "";
                                }
                                
                                ?>
                            <input type="hidden" name="faq_id" value="<?PHP echo $faq_id?>">    
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
