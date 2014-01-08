<script>
    $(function()
    {
        $('#myTable').tablesorter({sortList: [[0,0]], locale: 'de', widgets: ['zebra'], useUI: true});
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
                    <li><a href="<?php echo base_url();?>index.php/admin/users">Manage Users</a></li>
                </ul>
                <h1>Manage Users</h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $admin_user_id = $this->session->userdata('uid'); 
    if($admin_user_id != "")
    {
        $messages = new Modmessages();
        echo $messages->render();
    }
?>
<div class="container" id="actualbody">

<div class="row clearfix">
    <div class="widget clearfix">
        <h2>Users List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                           <fieldset>
                            <legend>Search By</legend>  
                            <div>
                                <label class="lbl">User Name</label> 
                                <?PHP
                                if(isset($_REQUEST['user_name']))
                                {
                                    $user_name = $_REQUEST['user_name'];
                                }
                                else
                                {
                                    $user_name = "";
                                }
                                ?>
                                <input type="text" name="user_name" class="text" value="<?PHP echo $user_name?>">
                            </div>
                            
                            <div>
                                <label class="lbl">User Email</label> 
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
                            <legend>Created On</legend>
                             <?PHP
                                if(isset($_REQUEST['date_from']))
                                {
                                    $register_date_from = $_REQUEST['date_from'];
                                }
                                else
                                {
                                    $register_date_from = "";
                                }
                                
                                if(isset($_REQUEST['date_to']))
                                {
                                    
                                    $register_date_to = $_REQUEST['date_to'];
                                }
                                else
                                {
                                    $register_date_to = "";
                                }
                                
                                ?>  
                             <div>
                                <label class="lbl">From</label>                                                   
                                <input type="text" name="date_from" class="text date_input" value="<?PHP echo $register_date_from ?>">
                            </div>
                             <div>
                                <label class="lbl">To</label> 
                                 
                                <input type="text" name="date_to" class="text date_input" value="<?PHP echo $register_date_to ?>">
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
                            <th class="align-left"><b>Name</b></th>
                            <th class="align-left"><b>Email</b></th>
                            <th class="align-left"><b>Country</b></th>
                            <th class="align-left"><b>Created On</b></th>
                            <th class="align-left"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
    
                        <?PHP
                                if(isset($users) && count($users) > 0)
                                {
                                    foreach($users as $user)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td align="center"> 
                                <?PHP
                                    echo anchor('admin/user_details/'.$user['user_id'],ucfirst(stripcslashes($user['first_name']))." ".ucfirst(stripcslashes($user['last_name'])),array('class' => 'iframe'));
                                ?></td>
                                <td align="center"><?PHP echo $user['email_address'];?></td>
                                <td align="center"><?PHP echo $user['countries_name'];?></td>
                                <td>
                                <?PHP echo long_date_format($user['register_date']);?>
                                </td>
                                <td align="center">
                                <?PHP
                                    echo anchor('admin/user_details/'.$user['user_id'],"View User Details",array('class' => 'iframe'));
                                ?>
                                </td>
                            </tr>
                            <?PHP }}else{?> 
                            <tr>
                                <td colspan="10" align="center">No record(s) found.</td>
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
  