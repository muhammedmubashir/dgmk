<form name="admin_login" method="post" action="login">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <br /><br /><br /><h2>ADMINISTRATION LOGIN</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_12 last">
                <div class="form">
                    <div class="clearfix">
                        <label>Email address :</label>
                        <div class="input">
                        <?PHP
                        $admin_username ="";
                        if(isset($_SESSION['admin_username']))
                        {
                            $admin_username = $_SESSION['admin_username'];
                            unset($_SESSION['admin_username']);
                        }
                        ?>
                            <input type="text" name="admin_username" title="Enter your email address" value="<?PHP echo $admin_username?>" rel="tooltips" class="validate[required] xlarge" />
                        </div>
                    </div>
                    <div class="clearfix">
                        <label>Password :</label>
                        <div class="input">
                            <input type="password" name="admin_passwd" title="Enter your password" rel="tooltips" class="xlarge" />
                        </div>
                    </div>
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                            <input type="submit" class="button blue" value="Login" name="submit"></input>
                            <input type="reset" class="button grey" value="Reset"></input>
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
</form><br /><br /><br /><br /><br />


    
    
    

