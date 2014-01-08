<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/gallery">View Gallery</a></li>
                </ul>
                <h1>Gallery </h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $admin_user_id = $this->session->userdata('admin_uid');  
    if($admin_user_id != "")
    {
        $messages = new Modmessages();
        echo $messages->render();
    }
?>

<script>
$(function()
{
    
    
    if(FlashDetect.installed)
    {
        $('#flashupload').show();
        $("#uploadedfiles").addClass("required");
        
        $("#publishbtn").click(function()
        {
            $("#preview_btn").hide();
            $("#uploadedfiles").removeClass("required");    //remove class so it can upload the files
            if($("#upload_pictures").valid())
            {
                $('#uploadify').uploadifyUpload();
                $("#uploadedfiles").addClass("required");    //add class n again check if it validates
                
                $("#frmpublish").valid();
            } 
            
            return false;
        });
        
            var uploadedFiles = "";
            
            $("#uploadify").uploadify(
            {
                'uploader'  : '<?php echo base_url(); ?>images/assets/scripts/uploadify/uploadify.swf',
                'script'    : '<?php echo base_url();?>index.php/admin/uploadify/<?PHP echo $this->uri->segment(3)?>',
                'cancelImg' : '<?php echo base_url(); ?>images/cancel.png',            
                'queueID'   : 'fileQueue',
                'auto'      : true,
                'multi'     : true,
                'fileDesc'    : '*.jpg; *.jpeg; *.gif; *.tiff; *.png',
                'fileExt'    : '*.jpg; *.jpeg; *.gif; *.tiff; *.png',
                'sizeLimit'    : '',
                'onSelect'    : function(vent, queueID, fileObj) 
                               {
                               },
                'onComplete': function(event, queueID, fileObj, reposnse, data) 
                               {
                                 var imgHtml = "";
                                
                                var simpleName = reposnse.replace(".","");
                                
                                /*imgHtml = '<div><div class="prop_image"><br /><img id="img_'+$.trim(simpleName)+'" src="<?php echo _URL_IMAGES_FILES?>'+$.trim(reposnse)+'" height=50 width=50 /><div style="visibility:hidden"><a id="lnk_'+$.trim(simpleName)+'" href="javascript:removeNewImage(\''+$.trim(reposnse)+'\')">Delete</a></div></div></div>';
                                
                                
                                
                                $('.prop_image_list').html(imgHtml);
                                
                                $('.prop_image').hover(
                                    function(){
                                        $(this).find("div").css({"visibility":"visible"})
                                    },
                                    function(){
                                        $(this).find("div").css({"visibility":"hidden"})
                                    }
                                );*/
                                
                                   uploadedFiles += $.trim(reposnse+',');
                                 
                                 //uploadedFilesArray.push(reposnse);
                
                                
                               },            
                'onAllComplete' : function(event, data) 
                               {
                                    $("#uploadedfiles").val("");
                                    $("#preview_btn").show();
                                    $("#publishbtn").show();
                                    //$("#upload_pictures").submit();
                               },
                'onProgress' : function(event, queueID,fileObj,data) 
                                {
                                    $("#publishbtn").hide();
                                    $("#preview_btn").hide();
                                    $("#uploadedfileerror").hide();
                                    
                                }
            });
    }
    else
    {   
        //$('#flashupload').hide();
    }
});


function addAnotherFile(div)
{
    $('#'+div).show();
    $('#'+div).html($('#'+div).html()+"<input name='uploadedfile[]' type='file' /> <br />");
}
</script>
<script>

function redirect()
{
    <?PHP
    $action = $this->uri->segment(2);
    if($action == "view_images")
    {
    ?>  
    window.location = "<?php echo base_url();?>index.php/admin/galler";
    <?PHP
    }
    else
    {
    ?>
    window.location = "<?php echo base_url();?>index.php/admin/gallery";
    <?PHP
    }
    ?>
    
}
</script>


<?PHP
    $admin_user_id = $this->session->userdata('admin_uid');  
    if($admin_user_id != "")
    {
        $messages = new Modmessages();
        echo $messages->render();
    }
?>
<form name="upload_pictures" id="upload_pictures" method="post" action="<?php echo base_url();?>index.php/admin/uploadPublishedFlashFiles" enctype="multipart/form-data"> 
<label id="uploadedfileerror" for="uploadedfiles" class="error" style="display:none"></label>           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide Gallery Information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    
                    <div class"clearfix" style="padding:30px; overflow:hidden;">
                        <b style="float: left; margin: 10px;">Please select files to upload</b>
                        <div id="flashupload">
                        
                        <input type="file" name="uploadify" id="uploadify" />
                    </div> 
                    <div id="fileQueue"></div>
                    </div>
                    <div class="clearfix">
                        <div class="prop_image_list">
                        </div>
                    </div>
                    
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                            <input type="hidden" name="uploadedfiles" value="" id="uploadedfiles" />   
                           <INPUT TYPE="BUTTON" ID="preview_btn" class="button blue" VALUE="Save and Preview" ONCLICK="return redirect()" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
    </div>   
</div>
    </div>
</div>
</form>
<div class="container" id="actualbody">
<div class="row clearfix">
    <div class="widget clearfix">
        <h2>Manage Gallery </h2>
        
        
         <div class="row">
    <div class="widget clearfix">
        <h2>Gallery</h2>
        <div class="widget_inside">
            <div class="col_12">
        <?PHP
        if(isset($gallery_pictures) && count($gallery_pictures) > 0)
        {   
        ?>
                <ul class="gallery medium">
                <?PHP
                
                foreach($gallery_pictures as $gallery_picture)
                {
                
             if(file_exists(_DIR_GALLERY."/".$gallery_picture['gallery_image']) && $gallery_picture['gallery_image'] != "")
                    {
                    $url = _URL_GALLERY."/";    
            ?>
                    <li>
                        <a href="<?PHP echo $url.$gallery_picture['gallery_image']; ?>" class="group4"><img src="<?PHP echo $url."thumb_".$gallery_picture['gallery_image']; ?>" alt="Picture" /></a>
                       <label id="save_msg_<?PHP echo $gallery_picture['gallery_id'];?>" style="display:none; color: green;"><b>Saving</b></label><br />
                      Description Area<br /><br />
                      <textarea name="image_text" cols="30" rows="5" onchange="update_picture_title(this.value,'<?PHP echo base_url()."index.php/admin/update_picture_title?gallery_id=".$gallery_picture['gallery_id'];?>',<?PHP echo $gallery_picture['gallery_id']?>)"><?PHP echo $gallery_picture['image_text']; ?></textarea> 
                       <br /><br />
                        <?PHP echo anchor('admin/delete_gallery_image/'.$gallery_picture['gallery_id'],
                        'Delete',array('onclick'=>"return confirm('Are you sure want to delete this Picture ?')"));?> |     
                        
                        <b>Display Order</b> : <input type="text" name="display_order" value="<?PHP echo $gallery_picture['display_order']; ?>" onchange="update_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_display_order?gallery_id=".$gallery_picture['gallery_id'];?>',<?PHP echo $gallery_picture['gallery_id']?>)" size="3" value="<?PHP echo $gallery_picture['display_order']?>"  onkeypress="return isNumberKey(event)" style="text-align: center;">
                        <br />
                        <?PHP
                                    $checkedstr = "";
                                    if($gallery_picture['gallery_image_status'] == "1")
                                    {
                                    $checkedstr = " checked='checked'"; 
                                    }
                        ?>
                                <input type="checkbox" value="1" onclick="return update_is_show_status(this,'<?PHP echo base_url()."index.php/admin/update_is_show_status?gallery_id=".$gallery_picture['gallery_id'];?>',<?PHP echo $gallery_picture['gallery_id']?>)" <?PHP echo $checkedstr; ?>> <span id="publish_<?PHP echo $gallery_picture['gallery_id'];?>" style="font-weight: bold;color:gray;"><?php echo ($checkedstr=="")?"Inactive":"Active";?></span>
                    </li>
            <?PHP }}?>
                </ul>
                
        <?PHP 
        } else {?>
        No piture(s) found.
        <?PHP }?>
            </div>
        </div>
        <div class="pagination" style="float: right;margin-right:20px;">
            <ul><li><?PHP echo $pagination;?></li></ul>   
        </div>
    </div>
</div>
    </div>
</div>
</div>
        </div><!--container -->
    </div>
</div>
  