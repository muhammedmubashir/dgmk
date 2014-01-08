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
                    <li><a href="<?php echo base_url();?>index.php/admin/articles">Manage Articles</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_article">Add new Article</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="frm_news" id="frm_news" method="post" action="<?PHP echo $form_action?>" enctype="multipart/form-data">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide Articles Information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label><b>Article Title</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($article_data) && count($article_data) > 0)
                                {
                                    $article_title = stripslashes($article_data['article_title']);
                                }
                                else
                                {
                                    $article_title = "";
                                }
                        ?>
                            <input type="text" name="article_title" id="article_title" title="Enter article title" rel="tooltips"  value="<?PHP echo stripslashes(strip_quotes(($article_title)));?>"  class="required"  size="90"/>
                        </div>
                        <label for="article_title" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    
                    <div class="clearfix">
                            <label><b>Article Image :</b></label>
                            <div class="input">
                            <input type="file" name="article_image" />
                             <?PHP 
                                if(isset($article_data) && count($article_data['article_image']) !="")
                                {
                                    if(file_exists(_DIR_ARTICLE."/".$article_data['article_image']) && $article_data['article_image'] != "")
                                    {
                                        $url = _URL_ARTICLE;
                                    ?>   
                                    <br /><br />
                                    <a href="<?PHP echo $url.$article_data['article_image']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$article_data['article_image']; ?>" alt="Picture" /></a>
                                    <?PHP
                                    }
                                }
                            ?> 
                            </div>
                         
                     </div>
                     
                    <div class="clearfix">
                        <div class="input">
                        <h4>Article Description</h4><br />
                        <?PHP 
                            if(isset($article_data) && count($article_data) > 0)
                                {
                                    $article_description = $article_data['article_description'];
                                }
                                else
                                {
                                    $article_description = "";
                                }
                        ?>
                           <textarea cols="200" style="width: 1070; height: 500" rows="10" name="article_description"><?PHP echo str_replace('\\r\\n','', $article_description);?></textarea>
                        </div>
                 </div> 
                 
                  <div class="clearfix">
                        <label><b>Article Status :</b></label>
                        <div class="input">
                         <?PHP
                                
                                if(isset($article_data) && count($article_data) > 0)
                                {
                                   $article_status = $article_data['article_status'];
                                }
                                else
                                {
                                    $article_status = "1";
                                }
                                if($article_status == 1)
                                {
                                    $activate = "checked='checked'";
                                    $deactivate = "";
                                }
                                else if($article_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "checked='checked'";
                                }
                                ?>
                                <label id="active_status">
                                  <input type="radio" name="article_status" id="active_status" value="1" <?PHP echo $activate?> title="Select status" rel="tooltips">Activate</label>
                                  <label id="deactive_status">
                                  <input type="radio" name="article_status" id="deactive_status" value="0" <?PHP echo $deactivate?> title="Select status" rel="tooltips">Deactivate</label>
   
                        </div> 
                    </div>                    
                      
                         
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($article_id))
                                {
                                    $article_id = $article_id;
                                
                                }
                                else
                                {
                                    $article_id = "";
                                }
                                
                                ?>
                            
                             <?PHP 
                            if(isset($article_data) && count($article_data) > 0)
                            {
                                $article_image = $article_data['article_image'];
                            }
                            else
                            {
                                $article_image = "";
                            }
                            ?>
                                
                            <?PHP 
                                if(isset($article_data) && count($article_data) > 0)
                                {
                                    $display_order = $article_data['display_order'];
                                }
                                else
                                {
                                    $display_order = "";
                                }
                            ?>
                                
                           <input type="hidden" name="article_image" value="<?PHP echo $article_image?>">  
                            <input type="hidden" name="article_id" value="<?PHP echo $article_id?>">    
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
