<script>
$(function()
{
    $("#frm_fleet").validate();    
});
</script>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/books">Manage Books</a></li>
                    <?PHP
                    if($form_action == "add_new_book")
                    {
                    ?>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_book">Add new Book</a></li>
                    <?PHP } else {?>
                    <li><a href="#">Edit Book</a></li>
                    <?PHP }?>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="frm_hotels" id="frm_fleet" method="post" action="<?PHP echo $form_action?>" enctype="multipart/form-data">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide Book Information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                     <div class="clearfix">
                        <label>Book Title :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_title = stripslashes($book_data['book_title']);
                                }
                                else
                                {
                                    $book_title = "";
                                }
                        ?>
                            <input type="text" name="book_title" id="book_title" title="Enter Book Title" rel="tooltips"  value="<?PHP echo $book_title;?>" size="60" />
                        </div>
                    </div>
                    
                   
                    
                    <div class="clearfix">
                        <label>Book Author :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_author = stripslashes($book_data['book_author']);
                                }
                                else
                                {
                                    $book_author = "";
                                }
                        ?>
                            <input type="text" name="book_author" id="book_author" title="Enter Book Author" rel="tooltips"  value="<?PHP echo $book_author;?>" size="60" />
                        </div>
                    </div>
                    
                    <div class="clearfix" id="div_book_title">
                        <label>Book Title Page :</label>
                        <div class="input">
                        <input type="file" name="book_title_file" />
                         <?PHP 
                            if(isset($book_data) && count($book_data['book_title_file']) !="")
                            {
                                if(file_exists(_DIR_BOOKS."title_page/".$book_data['book_title_file']) && $book_data['book_title_file'] != "")
                                {
                                    $url = _URL_BOOKS;
                                ?>   
                                <br /><br />
                                <a href="<?PHP echo $url.$book_data['book_title_file']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$book_data['book_title_file']; ?>" alt="Picture" /></a>
                                <?PHP
                                }
                            }
                        ?>
                        </div>
                     </div>

                    <div class="clearfix">
                        <label>PDF FileName :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_pdf_filename = stripslashes($book_data['book_pdf_filename']);
                                }
                                else
                                {
                                    $book_pdf_filename = "";
                                }
                        ?>
                            <input type="text" name="book_pdf_filename" id="book_pdf_filename" title="Enter PDF Filename" rel="tooltips"  value="<?PHP echo $book_pdf_filename;?>" size="60" />
                        </div>
                    </div>

                    <div class="clearfix">
                        <label>Book Folder :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_folder = stripslashes($book_data['book_folder']);
                                }
                                else
                                {
                                    $book_folder = "";
                                }
                        ?>
                            <input type="text" name="book_folder" id="book_folder" title="Enter folder name to read online" rel="tooltips"  value="<?PHP echo $book_folder;?>" size="60" />
                        </div>
                    </div>
                     
                    <div class="clearfix">
                        <label><b>Book Description :</b></label>
                        <div class="input">
                        <br />
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_description = stripslashes(strip_quotes(($book_data['book_description'])));
                                }
                                else
                                {
                                    $book_description = "";
                                }
                        ?>
                            <textarea cols="200" rows="10" style="width: 1070; height: 500" name="book_description" id="book_description" title="Enter Book Description"><?PHP echo $book_description;?></textarea>
                        </div>
                        <label for="book_description" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                      
                     
                     
                    <div class="clearfix">
                        <label>Book Status :</label>
                        <div class="input">
                         <?PHP
                                
                            if(isset($book_data) && count($book_data) > 0)
                            {
                               $book_status = $book_data['book_status'];
                            }
                            else
                            {
                                $book_status = "1";
                            }
                            if($book_status == "1")
                            {
                                $yes = "checked='checked'";
                                $no = "";
                            }
                            else if($book_status == "0")
                            {
                                $yes = "";
                                $no = "checked='checked'";
                            }
                            ?>
                            <label id="active_status">
                            <input type="radio" name="book_status"  value="1" <?PHP echo $yes?> title="Select status" rel="tooltips">Activate</label>
                            <label id="deactive_status">
                            <input type="radio" name="book_status" value="0" <?PHP echo $no?> title="Select status" rel="tooltips">Deactivate</label>
   
                        </div> 
                    </div>
                    
                    
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                            <?PHP
                            if(isset($book_data) && count($book_data) > 0) 
                            {
                                $book_id = $book_data['book_id'];
                            }
                            else
                            {
                                $book_id = "";
                            }
                            ?>
                            <input type="hidden" name="book_id" value="<?PHP echo $book_id?>">    
                            <input type="hidden" name="action" value="<?PHP echo $form_action?>">    
                            
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
