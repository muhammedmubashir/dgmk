<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/categories">Manage Admin Users</a></li>
                </ul>
                <h1>Manage Admin Users</h1>
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
        <h2>Admin Users List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                        <fieldset>
                            <legend>Filter By</legend>
                            <div>
                                <label class="lbl">User Status</label> 
                                <?PHP
                                if(isset($_POST['users_status']))
                                {
                                    $users_status = $_POST['users_status'];
                                }
                                else
                                {
                                    $users_status = "-1";
                                }
                                
                                if($users_status == 1)
                                {
                                    $activate = "selected";
                                    $deactivate = "";
                                    $view_all = "";;
                                }
                                else if($users_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "selected";
                                    $view_all = "";;
                                }
                                else if($users_status == -1)
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
                                  <select name='users_status' id='users_status'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="1" <?PHP echo $activate?>>Activate</option>
                                  <option value="0" <?PHP echo $deactivate?>>Deactivate</option>
                                </select>
                            </div>
                            </fieldset> 
                            
                           <fieldset>
                            <legend>Search By</legend>  
                             <div>
                                <label class="lbl">Name</label> 
                                <?PHP
                                if(isset($_POST['user_name']))
                                {
                                    $user_name = $_POST['user_name'];
                                }
                                else
                                {
                                    $user_name = "";
                                }
                                ?>
                                <input type="text" name="user_name" class="text" value="<?PHP echo $user_name?>">
                            </div>
                            
                            <div>
                                <label class="lbl">Email</label> 
                                <?PHP
                                if(isset($_POST['users_email']))
                                {
                                    $users_email = $_POST['users_email'];
                                }
                                else
                                {
                                    $users_email = "";
                                }
                                ?>
                                <input type="text" name="users_email" class="text" value="<?PHP echo $users_email?>">
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
                        <?PHP echo anchor('admin/add_new_admin_user/','Add new admin user');?>
                        </td>
                    </tr>
                </table>
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">Admin ID</th>
                            <th class="align-left">Name</th>
                            <th class="align-left">Email</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
    
                        <?PHP
                                if(isset($admin_users) && count($admin_users) > 0)
                                {
                                    foreach($admin_users as $admin_user)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td align="left"><?PHP echo $admin_user['users_id'];?></td>
                                <td><?PHP echo ucfirst(stripslashes(strip_quotes(($admin_user['users_fname']))));?> <?PHP echo ucfirst(stripslashes(strip_quotes(($admin_user['users_lname']))));?></td>
                                <td><?PHP echo $admin_user['users_email'];?></td>
                                <td align="center">
                                <?PHP echo anchor('admin/edit_admin_user/'.$admin_user['users_id'],'Edit');?> |
                                <?PHP echo anchor('admin/delete_admin_user/'.$admin_user['users_id'],
                                'Delete',array('onclick'=>"return confirm('Are you sure want to delete this user ?')"));?>
                                </td>
                            </tr>
                            <?PHP }}
                            ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
        </div><!--container -->
    </div>
</div>
  