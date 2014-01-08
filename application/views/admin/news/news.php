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
                    <li><a href="<?php echo base_url();?>index.php/admin/news">Manage news</a></li>
                </ul>
                <h1>Manage news</h1>
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
        <h2>News List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                        <fieldset>
                        <?PHP
                                if(isset($_REQUEST['news_status']))
                                {
                                    $news_status = $_REQUEST['news_status'];
                                }
                                else
                                {
                                    $news_status = "-1";
                                }
                                
                                if($news_status == 1)
                                {
                                    $activate = "selected";
                                    $deactivate = "";
                                    $view_all = "";;
                                }
                                else if($news_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "selected";
                                    $view_all = "";;
                                }
                                else if($news_status == -1)
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
                            <legend>Filter By</legend>
                            <div>
                                <label class="lbl">News Status</label> 
                                  <select name='news_status' id='news_status'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="1" <?PHP echo $activate?>>Activate</option>
                                  <option value="0" <?PHP echo $deactivate?>>Deactivate</option>
                                </select>
                            </div>
                             
                             
                            </fieldset> 
                           <fieldset>
                            <legend>Search By</legend>  
                             <div>
                                <label class="lbl">News Title</label> 
                                <?PHP
                                if(isset($_REQUEST['news_title']))
                                {
                                    $news_title = $_REQUEST['news_title'];
                                }
                                else
                                {
                                    $news_title = "";
                                }
                                ?>
                                <input type="text" name="news_title" class="text" value="<?PHP echo $news_title?>">
                            </div>
                           
                            </fieldset>
                            
                            <fieldset>
                            <legend>News Date</legend>
                             <?PHP
                                if(isset($_REQUEST['news_date_from']))
                                {
                                    $news_date_from = $_REQUEST['news_date_from'];
                                }
                                else
                                {
                                    $news_date_from = "";
                                }
                                
                                if(isset($_REQUEST['news_date_to']))
                                {
                                    $news_date_to = $_REQUEST['news_date_to'];
                                }
                                else
                                {
                                   $news_date_to = "";
                                }
                                
                                ?>  
                             <div>
                                <label class="lbl">From</label>                                                   
                                <input type="text" name="news_date_from" class="text date_input" value="<?PHP echo $news_date_from ?>">
                            </div>
                             <div>
                                <label class="lbl">To</label> 
                                 
                                <input type="text" name="news_date_to" class="text date_input" value="<?PHP echo $news_date_to ?>">
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
                        <?PHP echo anchor('admin/add_new_news/','Add new news');?> &nbsp;
                        </td>
                    </tr>
                </table>
            <div id="tableBody">
                <table class='zebra' style="border-style:solid;"  id="myTable">
                <thead>
                        <tr>    
                            <th class="align-left" width="4%"><b>ID</b></th>
                            <th class="align-left" width="36%"><b>Title</b></th>
                            <th class="align-left" width="7%"><b>Date</b></th>
                            <th class="align-left" width="7%"><b>Added On</b></th>
                            <th class="align-left" width="8%"><b>Display Order</b></th>
                            <th class="align-left" width="14%"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($news) && count($news) > 0)
                                {
                                    foreach($news as $news_row)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td style="width: auto;"><?PHP echo $news_row['news_id'];?></td>     
                                <td><?PHP echo anchor('admin/news_details/'.$news_row['news_id'],stripslashes(ucwords($news_row['news_title'])),array("class" => "iframe"));?></td>
                                <td style="width: auto;"><?PHP echo short_date_format($news_row['news_date']);?></td>
                                <td style="width: auto;"><?PHP echo short_date_format($news_row['date_added']);?></td>
                                <td style="text-align: center"><input type="text" name="display_order" value="<?PHP echo $news_row['display_order']; ?>" onchange="update_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_display_order?id=".$news_row['news_id'];?>&table_name=news&primaray_key_field=news_id')" size="4" value="<?PHP echo $news_row['display_order']?>"  onkeypress="return isNumberKey(event)" style="text-align: center;"></td>
                                <td>
                                <?PHP echo anchor('admin/edit_news/'.$news_row['news_id'],'Edit');?> |
                                <?PHP
                                    if($news_row['news_status'] == 1)
                                    {
                                ?>
                                <?PHP echo anchor('admin/update_news_status/0/'.$news_row['news_id'],'Deactivate');?>
                                <?PHP } else { ?> 
                                <?PHP echo anchor('admin/update_news_status/1/'.$news_row['news_id'],'Activate');?>
                                <?PHP }?> 
                                |
                                <?PHP echo anchor('admin/news_details/'.$news_row['news_id'],"View",array("class" => "iframe"));?>
                                |
                                <?PHP echo anchor('admin/delete_news/'.$news_row['news_id'],
                                'Delete',array('onclick'=>"return confirm('Are you sure want to delete this News ?')"));?>
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
  