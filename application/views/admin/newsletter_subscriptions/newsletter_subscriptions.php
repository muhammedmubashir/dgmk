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
                    <li><a href="<?php echo base_url();?>index.php/admin/job_applications">Manage newsletter subscriptions</a></li>
                </ul>
                <h1>Manage Newsletter Subscriptions</h1>
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
        <h2>Newsletter Subscriptions List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                       
                           <fieldset>
                            <legend>Search By</legend>  
                             <div>
                                <label class="lbl">Email Address</label> 
                                <?PHP
                                if(isset($_REQUEST['email_address']))
                                {
                                    $email_address = $_REQUEST['email_address'];
                                }
                                else
                                {
                                    $email_address = "";
                                }
                                ?>
                                <input type="text" name="email_address" class="text" value="<?PHP echo $email_address?>">
                            </div>
                           
                            </fieldset>
                            
                            <fieldset>
                            <legend>Subscription On</legend>
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
            <div id="tableBody">
                <table class='zebra' style="border-style:solid;"  id="myTable">
                <thead>
                        <tr>    
                            <th class="align-left" width="5%"><b>ID</b></th>
                            <th class="align-left" width="25%"><b>Email Address</b></th>
                            <th class="align-left" width="8%"><b>Date</b></th>
                            <th class="align-left" width="20%"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($newsletter_subscriptions) && count($newsletter_subscriptions) > 0)
                                {
                                    foreach($newsletter_subscriptions as $newsletter_subscription)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td style="width: auto;"><?PHP echo $newsletter_subscription['newsletter_subscription_id'];?></td>     
                                <td><?PHP echo $newsletter_subscription['email_address'];?></td>
                                <td style="width: auto;"><?PHP echo long_date_format($newsletter_subscription['date_added']);?></td>
                                <td>
                                <?PHP
                                    if($newsletter_subscription['subscription_status'] == 1)
                                    {
                                ?>
                                <?PHP echo anchor('admin/update_subscription_status/0/'.$newsletter_subscription['newsletter_subscription_id'],'Deactivate');?>
                                <?PHP } else { ?> 
                                <?PHP echo anchor('admin/update_subscription_status/1/'.$newsletter_subscription['newsletter_subscription_id'],'Activate');?>
                                <?PHP }?> 
                                |
                                    <?PHP echo anchor('admin/delete_subscription/'.$newsletter_subscription['newsletter_subscription_id'],'Delete',array('onclick'=>"return confirm('Are you sure want to delete this Subscription?')"));?>
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
  