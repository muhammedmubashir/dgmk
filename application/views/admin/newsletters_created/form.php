<script>
$(function()
{
    $("#frm_job").validate();    
});
</script>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/newsletters_created">Manage created newsletters</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_newsletter">Create new newsletter</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="frm_job" id="frm_job" method="post" action="<?PHP echo $form_action?>">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide newsletter information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label><b>Newsletter Title</b> :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($newsletter_data) && count($newsletter_data) > 0)
                                {
                                    $newsletter_title = stripslashes($newsletter_data['newsletter_title']);
                                }
                                else
                                {
                                    $newsletter_title = "";
                                }
                        ?>
                            <input type="text" name="newsletter_title" id="newsletter_title" title="Enter newsletter title" rel="tooltips"  value="<?PHP echo $newsletter_title;?>" class="required xxlarge" />
                        </div>
                        <label for="newsletter_title" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                   
                    <div class="clearfix">
                        <div class="input">
                        <h4>Newsletter Details</h4><br />
                        <?PHP 
                            if(isset($newsletter_data) && count($newsletter_data) > 0)
                                {
                                    $newsletter_text = $newsletter_data['newsletter_text'];
                                }
                                else
                                {
                                    $newsletter_text = "";
                                }
                        ?>
                        <textarea cols="10" rows="10" name="newsletter_text" id="newsletter_text" style="width: 1070px; height: 500px;"><?PHP echo str_replace('\\r\\n','', $newsletter_text);?></textarea>
                        
                        <?PHP
                          /*  include(FCK_PATH) ; 
                            $oFCKeditor = new FCKeditor('newsletter_text') ;
                            $oFCKeditor->BasePath = base_url()."/js/fckeditor/" ;
                            $oFCKeditor->ToolbarSet = "MyToolbar";
                            $oFCKeditor->Width = 1070;
                                $oFCKeditor->Height = 450;
                            $oFCKeditor->Value =  html_entity_decode(stripslashes($newsletter_text));
                            $oFCKeditor->Create() ;   */
                        ?>
                        </div>
                 </div> 
                 
                         
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($newsletter_id))
                                {
                                    $newsletter_id = $newsletter_id;
                                
                                }
                                else
                                {
                                    $newsletter_id = "";
                                }
                                
                                ?>
                                
                            <input type="hidden" name="newsletter_id" value="<?PHP echo $newsletter_id?>">    
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
