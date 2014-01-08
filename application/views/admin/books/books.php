<script>
    $(function()
    {
        $('#myTable').tablesorter({sortList: [[0,0]], locale: 'de', widgets: [''], useUI: true});
    });
</script> 
<style>
div#tableBody {
               width: 83em;
                padding: 0.3em;
            }
            table {
                width: 100%;
            }
            table th {
              padding: 0.3em;
            }
            table th span {
                float:right;
            }
            table tr.odd {
                background-color: #FFFFFF;
            }
            
</style>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/books">Manage Books</a></li>
                </ul>
                <h1>Manage Books</h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>

<div class="container" id="actualbody">

<div class="row clearfix">
    <div class="widget clearfix">
        <h2>Books List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                        <fieldset>
                            <legend>Filter By</legend>
                            <!--<?PHP
                                if(isset($_REQUEST['book_type']))
                                {
                                    $book_type = $_REQUEST['book_type'];
                                }
                                else
                                {
                                    $book_type = "-1";
                                }
                                
                                if($book_type == "pdf_format")
                                {
                                    $pdf_format = "selected";
                                    $scan_format = "";
                                    $view_all = "";
                                }
                                else if($book_type == "scan_format")
                                {
                                    $pdf_format = "";
                                    $scan_format = "selected";
                                    $view_all = "";
                                }
                                else if($book_type == -1)
                                {
                                    $pdf_format = "";
                                    $scan_format = "";
                                    $view_all = "selected";
                                }
                                else
                                {
                                    $pdf_format = "";
                                    $scan_format = "";
                                    $view_all = "selected";
                                }
                                ?>
                            <div>
                                <label class="lbl">Book Type</label> 
                                  <select name='book_type' id='book_type'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="pdf_format" <?PHP echo $pdf_format?>>PDF Format</option>
                                  <option value="scan_format" <?PHP echo $scan_format?>>Scan Format</option>
                                </select>
                            </div> -->
                            <?PHP
                                if(isset($_REQUEST['book_status']))
                                {
                                    $book_status = $_REQUEST['book_status'];
                                }
                                else
                                {
                                    $book_status = "-1";
                                }
                                
                                if($book_status == 1)
                                {
                                    $activate = "selected";
                                    $deactivate = "";
                                    $view_all = "";;
                                }
                                else if($book_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "selected";
                                    $view_all = "";;
                                }
                                else if($book_status == -1)
                                {
                                    $activate = "";
                                    $deactivate = "";
                                    $view_all = "selected";
                                }
                                else
                                {
                                    $activate = "";
                                    $deactivate = "";
                                    $view_all = "";
                                }
                                ?>
                            <div>
                                <label class="lbl">Book Status</label> 
                                  <select name='book_status' id='book_status'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="1" <?PHP echo $activate?>>Activate</option>
                                  <option value="0" <?PHP echo $deactivate?>>Deactivate</option>
                                </select>
                            </div>
                            

                             
                             
                            </fieldset> 
                           <fieldset>
                            <legend>Search By</legend>  
                             <div>
                                <label class="lbl">Book Title</label> 
                                <?PHP
                                if(isset($_REQUEST['book_title']))
                                {
                                    $book_title = $_REQUEST['book_title'];
                                }
                                else
                                {
                                    $book_title = "";
                                }
                                ?>
                                <input type="text" name="book_title" class="text" value="<?PHP echo $book_title?>">
                            </div>
                            
                             <div>
                                <label class="lbl">Book Author</label> 
                                <?PHP
                                if(isset($_REQUEST['book_author']))
                                {
                                    $book_author = $_REQUEST['book_author'];
                                }
                                else
                                {
                                    $book_author = "";
                                }
                                ?>
                                <input type="text" name="book_author" class="text" value="<?PHP echo $book_author?>">
                            </div>
                            
                            <div>
                                <label class="lbl">Book File Name Title</label> 
                                <?PHP
                                if(isset($_REQUEST['book_title_filename']))
                                {
                                    $book_title_filename = $_REQUEST['book_title_filename'];
                                }
                                else
                                {
                                    $book_title_filename = "";
                                }
                                ?>
                                <input type="text" name="book_title_filename" class="text" value="<?PHP echo $book_title_filename?>">
                            </div>
                           
                            </fieldset>
                            <fieldset>
                            <legend>Added On</legend>
                             <?PHP
                                if(isset($_REQUEST['date_added_from']))
                                {
                                    $date_added_from = $_REQUEST['date_added_from'];
                                }
                                else
                                {
                                    $date_added_from = "";
                                }
                                
                                if(isset($_REQUEST['date_added_to']))
                                {
                                    $date_added_to = $_REQUEST['date_added_to'];
                                }
                                else
                                {
                                   $date_added_to = "";
                                }
                                
                                ?>  
                             <div>
                                <label class="lbl">From</label>                                                   
                                <input type="text" name="date_added_from" class="text date_input" value="<?PHP echo $date_added_from ?>">
                            </div>
                             <div>
                                <label class="lbl">To</label> 
                                 
                                <input type="text" name="date_added_to" class="text date_input" value="<?PHP echo $date_added_to ?>">
                            </div>
                              
                            </fieldset>
                            
                            
                            <br /> 
                            <fieldset>
                                 <div>
                                    <label>&nbsp;</label> 
                                    <input name="btn" type="submit" value="Go" class="btn" /> 
                                    <input name="btn" type="reset" value="Reset"/>     
                               </div>
                             </fieldset> 
                             </fieldset>  
                    </form>                                        
                    </div> 
        <div class="widget_inside">
        <div class="col_12">
             <table>
                    <tr>    
                        <td class="align-right" colspan="10">
                        <?PHP echo anchor('admin/add_new_book/','Add new Book');?> &nbsp;
                        </td>
                    </tr>
                </table>
            <div id="tableBody">
                <table class='zebra' style="border-style:solid;"  id="myTable">
                <thead>
                        <tr>    
                            <th class="align-left" width="25%"><b>Book Title</b></th>
                            <th class="align-left" width="25%"><b>Book Author</b></th>
                            <!--<th class="align-left" width="7%"><b>Type</b></th>       -->
                            <th class="align-left" width="10%"><b>Display Order</b></th>
                            <th class="align-left" width="14%"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($books) && count($books) > 0)
                                {
                                    foreach($books as $book_row)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td><?PHP echo stripslashes(ucwords($book_row['book_title']));?></td>
                                <td><?PHP echo stripslashes(ucwords($book_row['book_author']));?></td>
                                <!--<td>
                                    <?PHP 
                                        if($book_row['book_type'] == "pdf_format")
                                        {
                                            echo "PDF";
                                        }
                                        else
                                        {
                                            echo "Scan";    
                                        }
                                    ?>
                                </td>    -->
                                <td style="text-align: center"><input type="text" name="display_order" value="<?PHP echo $book_row['display_order']; ?>" onchange="update_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_display_order?id=".$book_row['book_id'];?>&table_name=books&primaray_key_field=book_id')" size="4" value="<?PHP echo $book_row['display_order']?>"  onkeypress="return isNumberKey(event)" style="text-align: center;"></td>
                                <td>
                                <?PHP
                                    /*if($book_row['book_type'] == "scan_format")
                                    { 
                                         echo anchor('admin/view_book_images/'.$book_row['book_id'],'Add Book Pages',array('style'=>"color:blue"))." | ";
                                    /*}
                                    else
                                    {
                                        
                                    }*/
                                ?>
                                <?PHP echo anchor('admin/edit_book/'.$book_row['book_id'],'Edit',array('style'=>"color:green"));?> |
                                <?PHP echo anchor('admin/delete_book/'.$book_row['book_id'],
                                'Delete',array('style'=>"color:red",'onclick'=>"return confirm('Are you sure want to delete this Book ?')"));?>
                                </td>
                            </tr>
                            <?PHP }}else{?> 
                            <tr>
                                <td colspan="10">No record(s) found.</td>
                            </tr>
                            <?PHP }?>
                    </tbody>
                </table>
                <ul class="pagination hor-list">
                    <?PHP echo $pagination;?>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        </div><!--container -->
    </div>
</div>
  