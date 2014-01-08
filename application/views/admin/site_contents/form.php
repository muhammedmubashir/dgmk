
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/site_contents">Manage Site Contents</a></li>
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
        <h2>Provide page information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    
                    <div class="clearfix">
                        <label>Page Title :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($content_data) && count($content_data) > 0)
                                {
                                    $page_title = $content_data['page_title'];
                                }
                                else
                                {
                                    $page_title = "";
                                }
                        ?>
                            <input type="text" name="page_title" title="Enter page title" rel="tooltips"  
                                        value="<?PHP echo stripslashes(strip_quotes(($page_title)));?>" class="xxlarge" />
                        </div>
                    </div>
                    
                   <div class="clearfix">
                        <div class="input">
                        <?PHP 
                            if(isset($content_data) && count($content_data) > 0)
                                {
                                    $page_content = $content_data['page_content'];
                                }
                                else
                                {
                                    $page_content = "";
                                }
                        ?>
                        <textarea cols="200" style="width: 1070; height: 500" rows="10" name="page_content"><?PHP echo str_replace('\\r\\n','', $page_content);?></textarea>
                            <?PHP
                                /*include(FCK_PATH) ;
                                $oFCKeditor = new FCKeditor('page_content') ;
                                $oFCKeditor->BasePath = base_url()."/js/fckeditor/" ;
                                $oFCKeditor->ToolbarSet = "MyToolbar";
                                $oFCKeditor->Width = 1070;
                                $oFCKeditor->Height = 500;
                                $oFCKeditor->Value =  stripslashes($page_content);
                                $oFCKeditor->Create() ;*/
                            ?>
                            
                        </div>
                    </div>
                   
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($page_id))
                                {
                                    $page_id = $page_id;
                                
                                }
                                else
                                {
                                    $page_id = "";
                                }
                                
                                ?>
                            <input type="hidden" name="page_id" value="<?PHP echo $page_id?>">    
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

  
