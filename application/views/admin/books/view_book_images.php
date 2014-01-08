<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/books">Manage Books</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/view_book_images/<?PHP echo $this->uri->segment(3);?>">View Book Pages</a></li>
                </ul>
                <h1><?PHP echo ucfirst($book_pages_data['book_title']);?> Book Pages</h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<div class="container" id="actualbody">
 <div class="row">
    <div class="widget clearfix">
        <h2>Set Book Front And Back Pages</h2>
        <form name="admin_login" method="post" action="<?php echo base_url();?>index.php/admin/upload_yearbook_fornt_back_images" enctype="multipart/form-data">
        <div class="widget_inside">
            <div class="col_12">
                <h2>Manage <?PHP echo ucfirst($book_pages_data['book_title']);?> Pages</h2>
                <ul class="gallery medium">
                <table style="width:100%;">
                    <tr>
                        <td>
                            <table style="width:100%;">
                                <tr>
                                    <td colspan="2"><b>Book Front Page</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <?PHP 
                            if(isset($book_pages_data) && count($book_pages_data['book_front_page']) !="")
                            {
                                $front_text = "Change Front Page";
                                if(file_exists(_DIR_BOOKS."/".$book_pages_data['book_front_page']) && $book_pages_data['book_front_page'] != "")
                                {
                                    $url = _URL_BOOKS;
                                ?>   
                                
                                <a href="<?PHP echo $url.$book_pages_data['book_front_page']; ?>" target="_BLANK" class="group4 cboxElement"><img src="<?PHP echo $url."thumb_".$book_pages_data['book_front_page']; ?>" alt="Picture" /></a><br />
                                
                                <?PHP
                                }
                            }
                            else
                            {
                                $front_text = "Upload Book Front Page";
                            }
                            ?>
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                   <b><?PHP echo $front_text?></b>
                                </td>
                                <td>
                                <input type="file" name="book_front_page" title="Browse Picture" rel="tooltips"  value="" class="validate[required] xlarge" />
                                </td>
                            </tr>
                            </table>
                        </td>
                        <td><table style="width:100%;">
                                <tr>
                                    <td colspan="2"><b>Book Back Page</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                        <?PHP 
                            if(isset($book_pages_data) && count($book_pages_data['book_back_page']) !="")
                            {
                                $back_text = "Change Back Page"; 
                                if(file_exists(_DIR_BOOKS."/".$book_pages_data['book_back_page']) && $book_pages_data['book_back_page'] != "")
                                {
                                    $url = _URL_BOOKS;
                                ?> 
                                <a href="<?PHP echo $url.$book_pages_data['book_back_page']; ?>" target="_BLANK" class="group4 cboxElement"><img src="<?PHP echo $url."thumb_".$book_pages_data['book_back_page']; ?>" alt="Picture" /></a>
                                <?PHP
                                }
                            }
                            else
                            {
                                $back_text = "Upload Book Back Image";
                            }
                            ?>
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                   <b><?PHP echo $back_text?></b> 
                                </td>
                                <td>
                                <input type="file" name="book_back_page" title="Browse Picture" rel="tooltips"/>
                                </td>
                            </tr>
                            </table></td>
                    </tr>
                </table>
                </ul>
            </div>
            <?PHP
                $book_id = $this->uri->segment(3);
            ?>
            <input type="hidden" name="book_id" value="<?PHP echo $book_id ?>">
            <input type="submit" name="upload_image" value="Save" class="button blue">
            </form>
        </div>
    </div>
</div>
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
    if($action == "view_book_images")
    {
    ?>  
    window.location = "<?php echo base_url();?>index.php/admin/view_book_images/<?PHP echo $this->uri->segment(3);?>";
    <?PHP
    }
    else
    {
    ?>
    window.location = "<?php echo base_url();?>index.php/admin/view_book_images/<?PHP echo $this->uri->segment(3);?>";
    <?PHP
    }
    ?>
    
}
</script>

<form name="upload_pictures" id="upload_pictures" method="post" action="<?php echo base_url();?>index.php/admin/uploadPublishedFlashPictures" enctype="multipart/form-data">           
<label id="uploadedfileerror" for="uploadedfiles" class="error" style="display:none"></label> 
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide Book Pages Information</h2>
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
                              <?PHP $book_id = $this->uri->segment(3);
                                if(isset($book_id))
                                {
                                    $book_id = $book_id;
                                
                                }
                                else
                                {
                                    $book_id = "";
                                }
                                
                                ?>
                            <input type="hidden" name="book_id" value="<?PHP echo $book_id?>"> 
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
    </div>
</div>
</form>

<div class="row">
<br /><br />
    <div class="widget clearfix">
     <h2>Book Pages</h2> 
        <div class="widget_inside">
            <div class="col_12">
               <!-- <table>
                    <tr>    
                        <td class="align-right" colspan="10">
                        <?PHP echo anchor('admin/upload_book_page_images/'.$book_id,'Upload Pictures');?> 
                        </td>
                    </tr>
                </table> -->
            </div>
        </div>
        <div class="widget_inside">
            <div class="col_12">
       <?PHP
        if(isset($book_pages) && count($book_pages) > 0)
        {   
        ?>
                <ul class="gallery medium" style="padding-left: 10%;">
                <?PHP
                
                foreach($book_pages as $book_page)
                {
                
             if(file_exists(_DIR_BOOKS."/".$book_page['book_page_file']) && $book_page['book_page_file'] != "")
                    {
                    $url = _URL_BOOKS;    
            ?>
                    <li>
                        <a href="<?PHP echo $url.$book_page['book_page_file']; ?>" class="group4"><img src="<?PHP echo $url."thumb_".$book_page['book_page_file']; ?>" alt="Picture" /></a>
                        <br />
                       <br /><label id="save_msg_<?PHP echo $book_page['book_page_id'];?>" style="display:none; color: green;"><b>Saving</b></label>
                        <br />
                        <?PHP echo anchor('admin/delete_year_book_image/'.$book_id.'/'.$book_page['book_page_id'],
                        'Delete',array('onclick'=>"return confirm('Are you sure want to delete this Picture ?')"));?> |     
                        
                        <b> Page Display Order </b> : <input type="text" name="display_order" value="<?PHP echo $book_page['display_order']; ?>" onchange="update_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_display_order?id=".$book_page['book_page_id'];?>&table_name=book_pages&primaray_key_field=book_page_id')" size="4" value="<?PHP echo $book_page['display_order']?>"  onkeypress="return isNumberKey(event)" style="text-align: center;">
                        <!--<br />
                        <?PHP
                                    $checkedstr = "";
                                    if($book_page['is_show'] == "1")
                                    {
                                    $checkedstr = " checked='checked'"; 
                                    }
                        ?>
                                <input type="checkbox" value="1" onclick="return update_is_show_status(this,'<?PHP echo base_url()."index.php/admin/update_is_show_status?YearBookImage_Id=".$book_page['YearBookImage_Id'];?>',<?PHP echo $book_page['YearBookImage_Id']?>)" <?PHP echo $checkedstr; ?>> <span id="publish_<?PHP echo $book_page['YearBookImage_Id'];?>" style="font-weight: bold;color:gray;"><?php echo ($checkedstr=="")?"Unpublish":"Publish";?></span>-->
                    </li>
            <?PHP }}?>
                </ul>
                
                
                
        <?PHP 
        }
        else 
        {
        ?>
            No piture(s) found.
        <?PHP 
        }
        ?>
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
<br /><br /><br /><br />
  
