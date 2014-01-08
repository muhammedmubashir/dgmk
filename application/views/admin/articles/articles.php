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
                    <li><a href="<?php echo base_url();?>index.php/admin/articles">Manage Articles</a></li>
                </ul>
                <h1>Manage Articles</h1>
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
        <h2>Articles List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                        <fieldset>
                        <?PHP
                                if(isset($_REQUEST['article_status']))
                                {
                                    $article_status = $_REQUEST['article_status'];
                                }
                                else
                                {
                                    $article_status = "-1";
                                }
                                
                                if($article_status == 1)
                                {
                                    $activate = "selected";
                                    $deactivate = "";
                                    $view_all = "";;
                                }
                                else if($article_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "selected";
                                    $view_all = "";;
                                }
                                else if($article_status == -1)
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
                                <label class="lbl">Article Status</label> 
                                  <select name='article_status' id='article_status'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="1" <?PHP echo $activate?>>Activate</option>
                                  <option value="0" <?PHP echo $deactivate?>>Deactivate</option>
                                </select>
                            </div>
                             
                             
                            </fieldset> 
                           <fieldset>
                            <legend>Search By</legend>  
                             <div>
                                <label class="lbl">Article Title</label> 
                                <?PHP
                                if(isset($_REQUEST['article_title']))
                                {
                                    $article_title = $_REQUEST['article_title'];
                                }
                                else
                                {
                                    $article_title = "";
                                }
                                ?>
                                <input type="text" name="article_title" class="text" value="<?PHP echo $article_title?>">
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
                        <?PHP echo anchor('admin/add_new_article/','Add new article');?> &nbsp;
                        </td>
                    </tr>
                </table>
            <div id="tableBody">
                <table class='zebra' style="border-style:solid;"  id="myTable">
                <thead>
                        <tr>    
                            <th class="align-left" width="36%"><b>Article Title</b></th>
                            <th class="align-left" width="8%"><b>Display Order</b></th>
                            <th class="align-left" width="8%"><b>Is Active ?</b></th>
                            <th class="align-left" width="14%"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($articles) && count($articles) > 0)
                                {
                                    foreach($articles as $article)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td><?PHP echo $article['article_title'];?></td>
                                <td style="text-align: center"><input type="text" name="display_order" value="<?PHP echo $article['display_order']; ?>" onchange="update_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_display_order?id=".$article['article_id'];?>&table_name=articles&primaray_key_field=article_id')" size="4" value="<?PHP echo $article['display_order']?>" style="text-align: center;"></td>
                                <td style="text-align: center">
                                <?PHP
                                    $checkedstr = "";
                                    if($article['article_status'] == "1")
                                    {
                                    $checkedstr = " checked='checked'"; 
                                    }
                                ?>
                                <input type="checkbox" value="1" onclick="return update_status(this,'<?PHP echo base_url()."index.php/admin/update_status?id=".$article['article_id'];?>&table_name=articles&primaray_key_field=article_id&set_field=article_status')" <?PHP echo $checkedstr; ?>">
                                </td>
                                <td>
                                <?PHP echo anchor('admin/edit_article/'.$article['article_id'],'Edit');?>
                                |
                                <?PHP echo anchor('admin/delete_article/'.$article['article_id'],
                                'Delete',array('style'=>"color:red",'onclick'=>"return confirm('Are you sure want to delete this Article ?')"));?>
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
  