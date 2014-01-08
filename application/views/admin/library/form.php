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
                    <li><a href="<?php echo base_url();?>index.php/admin/library_list">Manage Library</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_book_in_library">Add new Book in Library</a></li>
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
        <h2>Provide Book information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label><b>Topic of Book</b> :</label>
                        <div class="input">
                            <select name="category" id="category" title="Enter Book topic" rel="tooltips" class="required"  style="width:320px;font-size:16px;">
                                <option value="0">--select--</option>
                                <?php
                                foreach ($categories as $category) {
                                    $select = "";
                                    if($category['category_id'] == $book_data['category_id'])
                                    {
                                        $select = "selected='selected'";
                                    }
                                    ?>
                                    <option value="<?php echo $category['category_id'];?>" <?php echo $select;?>>
                                        <?php echo $category['category_name'];?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label for="category" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book Title</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_name = $book_data['book_name'];
                                }
                                else
                                {
                                    $book_name = "";
                                }
                        ?>
                            <input type="text" name="book_name" id="book_name" title="Enter Book title" rel="tooltips"  value="<?PHP echo $book_name;?>"  class="required"  size="90"/>
                        </div>
                        <label for="book_name" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    
                    <div class="clearfix">
                        <label><b>Book Sub-Title</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_sub_title = $book_data['book_sub_title'];
                                }
                                else
                                {
                                    $book_sub_title = "";
                                }
                        ?>
                            <input type="text" name="book_sub_title" id="book_sub_title" title="Enter Book sub-title" rel="tooltips"  value="<?PHP echo $book_sub_title;?>"  class="required"  size="90"/>
                        </div>
                        <label for="book_sub_title" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>


                    <div class="clearfix">
                        <label><b>Book Author</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_author = $book_data['book_author'];
                                }
                                else
                                {
                                    $book_author = "";
                                }
                        ?>
                            <input type="text" name="book_author" id="book_author" title="Enter Book Author Name" rel="tooltips"  value="<?PHP echo $book_author;?>"  class="required"  size="90"/>
                            <select name="author_type" id="author_type">
                                <option value="author">Author</option>
                                <option value="complier">Complier</option>
                                <option value="translator">Translator</option>
                                <option value="editor">Editor</option>
                            </select>
                        </div>
                        <label for="book_author" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>


                    <div class="clearfix">
                        <label><b>Book Publisher</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_publisher = $book_data['book_publisher'];
                                }
                                else
                                {
                                    $book_publisher = "";
                                }
                        ?>
                            <input type="text" name="book_publisher" id="book_publisher" title="Enter Book Publisher Name" rel="tooltips"  value="<?PHP echo $book_publisher;?>"  class="required"  size="90"/>
                        </div>
                        <label for="book_publisher" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>


                    <div class="clearfix">
                        <label><b>Book Publisher City</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $publisher_city = $book_data['publisher_city'];
                                }
                                else
                                {
                                    $publisher_city = "";
                                }
                        ?>
                            <input type="text" name="publisher_city" id="publisher_city" title="Enter Book Publisher City" rel="tooltips"  value="<?PHP echo $publisher_city;?>"  class="required"  size="90"/>
                        </div>
                        <label for="publisher_city" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book Publishing Date</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $publishing_date = $book_data['publishing_date'];
                                }
                                else
                                {
                                    $publishing_date = "";
                                }
                        ?>
                            <input type="text" name="publishing_date" id="publishing_date" title="Enter Book Publishing Date" rel="tooltips"  value="<?PHP echo $publishing_date;?>" size="90"/>
                        </div>
                        <label for="publishing_date" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>
                    
                    <div class="clearfix">
                        <label><b>Book Publishing Number</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $publishing_number = $book_data['publishing_number'];
                                }
                                else
                                {
                                    $publishing_number = "";
                                }
                        ?>
                            <input type="text" name="publishing_number" id="publishing_number" title="Enter Book Publishing Number(Ashaat Number)" rel="tooltips"  value="<?PHP echo $publishing_number;?>"  size="90"/>
                        </div>
                        <label for="publishing_number" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book Publishing Quantity</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $publish_quantity = $book_data['publish_quantity'];
                                }
                                else
                                {
                                    $publish_quantity = "";
                                }
                        ?>
                            <input type="text" name="publish_quantity" id="publish_quantity" title="Enter Book Publishing Quantity" rel="tooltips"  value="<?PHP echo $publish_quantity;?>"  size="90"/>
                        </div>
                        <label for="publish_quantity" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Number of Copies</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $no_of_copies = $book_data['no_of_copies'];
                                }
                                else
                                {
                                    $no_of_copies = "";
                                }
                        ?>
                            <input type="text" name="no_of_copies" id="no_of_copies" title="Enter Number of copies" rel="tooltips"  value="<?PHP echo $no_of_copies;?>"  size="90"/>
                        </div>
                        <label for="no_of_copies" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book - No. of pages</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_pages = $book_data['book_pages'];
                                }
                                else
                                {
                                    $book_pages = "";
                                }
                        ?>
                            <input type="text" name="book_pages" id="book_pages" title="Enter No. of pages" rel="tooltips"  value="<?PHP echo $book_pages;?>"  size="90"/>
                        </div>
                        <label for="book_pages" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book Language</b> :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                            {
                                $book_language = $book_data['book_language'];
                            }
                            else
                            {
                                $book_language = "";
                            }
                        ?>
                            <select name="book_language" id="book_language" style="width:220px;">
                                <option value="0">--Select--</option>
                                <option value="Urdu">Urdu</option>
                                <option value="Turkish">Turkish</option>
                                <option value="Sindhi">Sindhi</option>
                                <option value="Persian">Persian</option>
                                <option value="Hindi">Hindi</option>
                                <option value="English">English</option>
                                <option value="Arabic">Arabic</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>
                        <label for="book_language" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book Price</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $book_price = $book_data['book_price'];
                                }
                                else
                                {
                                    $book_price = "";
                                }
                        ?>
                            <input type="text" name="book_price" id="book_price" title="Enter Book Price" rel="tooltips"  value="<?PHP echo $book_price;?>"  size="90"/>
                        </div>
                        <label for="book_price" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <div class="clearfix">
                        <label><b>Book Glossary</b> :</label>
                        <div class="input">
                        <?PHP 
                        
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $glossary = $book_data['glossary'];
                                }
                                else
                                {
                                    $glossary = "";
                                }
                        ?>
                            <input type="text" name="glossary" id="glossary" title="Enter Book Glossary" rel="tooltips"  value="<?PHP echo $glossary;?>"  size="90"/>
                        </div>
                        <label for="glossary" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>

                    <!--<div class="clearfix">
                        <label><b>News Date</b> :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $news_date = stripslashes($book_data['news_date']);
                                }
                                else
                                {
                                    $news_date = "";
                                }
                        ?>
                            <input type="text" name="news_date" id="news_date" title="Enter news date" rel="tooltips"  value="<?PHP echo $news_date;?>" class="required date_input" size="11"/>
                        </div>
                        <label for="news_date" class="error" style="display:none;text-align: left;">required.</label>  
                    </div>-->
                   
                    <div class="clearfix">
                        <div class="input">
                        <h4>Book Details</h4><br />
                        <?PHP 
                            if(isset($book_data) && count($book_data) > 0)
                                {
                                    $detail = $book_data['detail'];
                                }
                                else
                                {
                                    $detail = "";
                                }
                        ?>
                           <textarea cols="200" style="width: 1070; height: 500" rows="10" name="detail"><?PHP echo $detail;?></textarea>
                        </div>
                    </div> 
                 
                    <div class="clearfix">
                        <label><b>Book Status :</b></label>
                        <div class="input">
                         <?PHP
                            if(isset($book_data) && count($book_data) > 0)
                            {
                               $status = $book_data['status'];
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
                              <input type="radio" name="status" id="active_status" value="1" <?PHP echo $activate?> title="Select status" rel="tooltips">Activate
                            </label>
                            <label id="deactive_status">
                              <input type="radio" name="status" id="deactive_status" value="0" <?PHP echo $deactivate?> title="Select status" rel="tooltips">Deactivate
                            </label>
                        </div> 
                    </div>
                         
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($lib_book_id))
                                {
                                    $lib_book_id = $lib_book_id;
                                }
                                else
                                {
                                    $lib_book_id = "";
                                }
                                ?>
                            <input type="hidden" name="lib_book_id" value="<?PHP echo $lib_book_id;?>">    
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
