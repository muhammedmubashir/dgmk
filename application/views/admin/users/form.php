<script>
$(function()
{
    $("#frm_artist").validate();
    <?PHP
    if($form_action == "edit_artist")
    {
    ?>
    $("#artist_password").removeClass("required");
    <?PHP    
    }?>
});
</script>
<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/artists">Manage Artist</a></li>
                    <li><a href="<?php echo base_url();?>index.php/admin/add_new_artist">Add new artist</a></li>
                </ul>
                <h1><?PHP echo $form_heading?></h1>
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
<form name="frm_artist" method="post" action="<?PHP echo $form_action?>" id="frm_artist" enctype="multipart/form-data">           
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        <h2>Provide user information</h2>
        <div class="widget_inside">
            <div class="col_12">
            <div class="col_10 last">
                <div class="form">
                
                <div class="clearfix">
                        <label>First Name :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($user_data) && count($user_data) > 0)
                                {
                                    $first_name = stripslashes(($user_data['first_name']));
                                }
                                else
                                {
                                    $first_name = "";
                                }
                        ?>
                            <input type="text" name="first_name" id="first_name" title="Enter first name" rel="tooltips"  value="<?PHP echo $first_name;?>" class="required xlarge" />
                        </div>
                        <label for="first_name" class="error" style="display:none;text-align: left;">required.</label>
                    </div>
                    
                     <div class="clearfix">
                        <label>Last Name :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($user_data) && count($user_data) > 0)
                                {
                                    $last_name = stripslashes(($user_data['last_name']));
                                }
                                else
                                {
                                    $last_name = "";
                                }
                        ?>
                            <input type="text" name="last_name" title="Enter last name" rel="tooltips"  value="<?PHP echo $last_name;?>" class="required xlarge" />
                        </div>
                        <label for="last_name" class="error" style="display:none;text-align: left;">required.</label>
                    </div>
                    
                    <div class="clearfix">
                        <label>Email Address :</label>
                        <div class="input">
                        <?PHP 
                            if(isset($user_data) && count($user_data) > 0)
                                {
                                    $email_address = stripslashes(($user_data['email_address']));
                                }
                                else
                                {
                                    $email_address = "";
                                }
                        ?>
                            <input type="text" name="email_address" id="email_address" title="Enter email address" rel="tooltips"  value="<?PHP echo $email_address;?>" class="required email xlarge" />
                        </div>
                        <label for="email_address" class="error" style="display:none;text-align: left;">required valid email address.</label>
                    </div>
                    
                    <div class="clearfix">
                        <label>Password :</label>
                        <div class="input">
                            <input type="password" name="user_password" id="user_password" title="Enter password" rel="tooltips"  class="required xlarge" />
                            <?PHP
                            if(isset($user_data) && $user_data['user_password'] != "" && $form_action  == "edit_user")
                            {
                            ?>
                            <p>Leave empty, If you don't want to change the password. </p>
                            <?PHP }?>
                        </div>
                        <label for="user_password" class="error" style="display:none;text-align: left;">Atleast 6 characters required.</label>
                    </div>
                    
                   
                    
                    <div class="clearfix">
                        <label>Gender :</label>
                        <div class="input">
                           <select name='gender_id' id='gender_id' title="Select gender" rel="tooltips" class="required"> 
                                <option value="">Please select</option> 
                                <?PHP
                                if(isset($user_data) && count($user_data) > 0)
                                {
                                    $gender_id = $user_data['gender_id'];
                                }
                                else
                                {
                                    $gender_id = "";
                                }
                                 echo SiteCodes_model::comboCodeValues(SiteCodes_model::$_GENDER,$gender_id,false)
                                ?>
                           </select>
                        </div>
                        <label for="gender_id" class="error" style="display:none;text-align: left;">required.</label>
                    </div>
                   
                    <div class="clearfix">
                        <label>Country :</label>
                        <div class="input">
                           <select name='country_id' id='country_id' title="Select country" rel="tooltips" class="required"> 
                           <option value="">Please select</option>
                        <?PHP 
                            if(isset($user_data) && count($user_data) > 0)
                                {
                                    $country_id = $user_data['country_id'];
                                }
                                else
                                {
                                    $country_id = "";
                                }
                                
                                echo SiteCodes_model::comboCodeValues(SiteCodes_model::$_COUNTRY,$country_id,false)
                        ?> 
                           </select>
                        </div>
                        <label for="country_id" class="error" style="display:none;text-align: left;">required.</label>
                    </div>
                    
                    <div class="clearfix">
                        <label>Upload Profile Picture :</label>
                        <div class="input">
                            <input type="file" name="profile_picture" class="text"> 
                            <?PHP 
                            if(isset($user_data) && count($user_data['profile_picture']) !="")
                            {
                                if(file_exists(_DIR_USER."/".$user_data['profile_picture']) && $user_data['profile_picture'] != "")
                                {
                                    $url = _URL_USER;
                                ?>   
                                <br /><br />
                                <a href="<?PHP echo $url.$user_data['profile_picture']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$user_data['profile_picture']; ?>" alt="Picture" /></a>
                                <?PHP
                                }
                            }
                            ?> 
                        </div>
                    </div>
                    
                    <div class="clearfix">
                        <label>Status :</label>
                        <div class="input">
                         <?PHP
                                
                                if(isset($user_data) && count($user_data) > 0)
                                {
                                   $user_status = $user_data['user_status'];
                                }
                                else
                                {
                                    $user_status = "1";
                                }
                                if($user_status == 1)
                                {
                                    $activate = "checked='checked'";
                                    $deactivate = "";
                                }
                                else if($user_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "checked='checked'";
                                }
                                ?>
                                <label id="active_status">
                                  <input type="radio" name="user_status" id="active_status" value="1" <?PHP echo $activate?> title="Select status" rel="tooltips">Activate</label>
                                  <label id="deactive_status">
                                  <input type="radio" name="user_status" id="deactive_status" value="0" <?PHP echo $deactivate?> title="Select status" rel="tooltips">Deactivate</label>
   
                        </div> 
                    </div>                    
                    
                    <div class="clearfix grey-highlight">
                        <div class="input no-label">
                              <?PHP
                                if(isset($user_data))
                                {
                                    $user_id = $user_data['user_id'];
                                
                                }
                                else
                                {
                                    $user_id = "";
                                }
                                
                                ?>
                            <?PHP
                            if(isset($user_data) && count($user_data) > 0)
                            {
                                      $old_password = $user_data['user_password'];
                            ?>
                            <input type="hidden" name="old_password" value="<?PHP echo $old_password?>">    
                            <?PHP }?>
                            
                            <input type="hidden" name="user_id" value="<?PHP echo $user_id?>"> 
                             <?PHP 
                                    if(isset($user_data) && count($user_data) > 0)
                                    {
                                        $profile_picture = $user_data['profile_picture'];
                                    }
                                    else
                                    {
                                        $profile_picture = "";
                                    }
                                ?>
                            <input type="hidden" name="profile_picture" value="<?PHP echo $profile_picture?>">       
                            
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
