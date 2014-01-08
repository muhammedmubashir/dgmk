<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
               
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
        <h2>Provide password information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label>Current Password :</label>
                        <div class="input">
                            <input type="password" name="current_password" title="Enter current password" rel="tooltips"  class="validate[required] xlarge" />
                        </div>
                    </div>
                    
                    <div class="clearfix">
                        <label>New Password :</label>
                        <div class="input">
                            <input type="password" name="new_password" title="Enter new password" rel="tooltips"  class="validate[required] xlarge" />
                        </div>
                    </div>
                    
                    <div class="clearfix">
                        <label>Confirm Password :</label>
                        <div class="input">
                            <input type="password" name="confirm_password" title="Enter confirm password" rel="tooltips"  class="validate[required] xlarge" />
                        </div>
                    </div>
                    
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                            <input type="submit" class="button blue" value="Change" name="submit"></input>
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

</div>
    </div>
</div>