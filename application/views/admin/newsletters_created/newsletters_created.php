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
                    <li><a href="<?php echo base_url();?>index.php/admin/newsletters_created">Manage created newsletters</a></li>
                </ul>
                <h1>Manage Created Newsletters</h1>
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
        <h2>Created Newsletters List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                           <fieldset>
                            <legend>Search By</legend>  
                             <div>
                                <label class="lbl">Newsletter Title</label> 
                                <?PHP
                                if(isset($_REQUEST['newsletter_title']))
                                {
                                    $newsletter_title = $_REQUEST['newsletter_title'];
                                }
                                else
                                {
                                    $newsletter_title = "";
                                }
                                ?>
                                <input type="text" name="newsletter_title" class="text" value="<?PHP echo $newsletter_title?>">
                            </div>
                           
                            </fieldset>
                            
                            <fieldset>
                            <legend>Created On</legend>
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
                        <?PHP echo anchor('admin/add_new_newsletter/','Create new newsletter');?> &nbsp;
                        </td>
                    </tr>
                </table>
            <div id="tableBody">
                <table class='zebra' style="border-style:solid;"  id="myTable">
                <thead>
                        <tr>    
                            <th class="align-left" width="5%"><b>ID</b></th>
                            <th class="align-left" width="25%"><b>Title</b></th>
                            <th class="align-left" width="8%"><b>Date</b></th>
                            <th class="align-left" width="20%"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($newsletters_created) && count($newsletters_created) > 0)
                                {
                                    foreach($newsletters_created as $newsletter)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td style="width: auto;"><?PHP echo $newsletter['newsletter_id'];?></td>     
                                <td><?PHP echo anchor('admin/newsletter_details/'.$newsletter['newsletter_id'],stripslashes(ucfirst($newsletter['newsletter_title'])),array("class" => "iframe"));?></td>
                                <td style="width: auto;"><?PHP echo long_date_format($newsletter['date_added']);?></td>
                                <td>
                                <?PHP echo anchor('admin/edit_newsletter/'.$newsletter['newsletter_id'],'Edit');?> |
                                
                                <?PHP echo anchor('admin/newsletter_details/'.$newsletter['newsletter_id'],"View Newsletter Details",array("class" => "iframe"));?>
                                |
                                <?PHP echo anchor('admin/send_newsletter/'.$newsletter['newsletter_id'],'Send Newsletter');?> |
                                
                                <?PHP echo anchor('admin/delete_newsletter/'.$newsletter['newsletter_id'],
                                'Delete',array('onclick'=>"return confirm('Are you sure want to delete this Newsletter ?')"));?>
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
  