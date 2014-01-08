<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/admin_users">Manage Admin Users</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_admin_user">Add new admin user</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
            </div>
        </div>
    </div>
</div>
<?PHP
    $this->load->view('admin/messages');
?>
<form name="admin_login" method="post" action="<?PHP echo $form_action?>">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide admin user information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label>First Name :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($admin_data) && count($admin_data) > 0)
                                {
                                    $users_fname = stripslashes(strip_quotes(($admin_data['users_fname'])));
                                }
                                else
                                {
                                    $users_fname = "";
                                }
                        ?>
                            <input type="text" name="users_fname" title="Enter first name" rel="tooltips"  value="<?PHP echo $users_fname;?>" class="validate[required] xlarge" />
                        </div>
                    </div>
                    
                    <div class="clearfix">
                        <label>Last Name :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($admin_data) && count($admin_data) > 0)
                                {
                                    $users_lname = stripslashes(strip_quotes(($admin_data['users_lname'])));
                                }
                                else
                                {
                                    $users_lname = "";
                                }
                        ?>
                            <input type="text" name="users_lname" title="Enter last name" rel="tooltips"  value="<?PHP echo $users_lname;?>" class="validate[required] xlarge" />
                        </div>
                    </div>
                    
                     <div class="clearfix">
                        <label>Email Address :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($admin_data) && count($admin_data) > 0)
                                {
                                    $users_email = $admin_data['users_email'];
                                }
                                else
                                {
                                    $users_email = "";
                                }
                        ?>
                            <input type="text" name="users_email" title="Enter email address" rel="tooltips"  value="<?PHP echo $users_email;?>" class="validate[required] xlarge" />
                        </div>
                    </div>
                    
                    <div class="clearfix">
                        <label>Password :</label>
                        <div class="input">
                            <input type="password" name="users_password" title="Enter password" rel="tooltips"  class="validate[required] xlarge" />
                            <?PHP
                            if(isset($admin_data) && $admin_data['users_password'] != "")
                            {
                                if($form_action == "edit_admin_user")
                                {
                            ?>
                            <p>Leave empty, If you dont want to change the password. </p>
                            <?PHP }}?>
                        </div>
                    </div>
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($users_id))
                                {
                                    $users_id = $users_id;
                                
                                }
                                else
                                {
                                    $users_id = "";
                                }
                                
                                ?>
                            <input type="hidden" name="users_id" value="<?PHP echo $users_id?>">    
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
