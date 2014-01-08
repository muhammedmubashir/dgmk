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
                    <li><a href="<?php echo base_url();?>index.php/admin/testimonials">Manage Testimonials</a></li>
                </ul>
                <h1>Manage Testimonials</h1>
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
        <h2>Testimonials List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                        <fieldset>
                       <br />     
                        <legend>Filter By</legend>
                        <?PHP
                                if(isset($_REQUEST['testimonial_status']))
                                {
                                    $testimonial_status = $_REQUEST['testimonial_status'];
                                }
                                else
                                {
                                    $testimonial_status = "-1";
                                }
                                
                                if($testimonial_status == 1)
                                {
                                    $activate = "selected";
                                    $deactivate = "";
                                    $view_all = "";;
                                }
                                else if($testimonial_status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "selected";
                                    $view_all = "";;
                                }
                                else if($testimonial_status == -1)
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
                            
                            <div>
                                <label class="lbl">Testimonial Status</label> 
                                  <select name='testimonial_status' id='testimonial_status'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="1" <?PHP echo $activate?>>Activate</option>
                                  <option value="0" <?PHP echo $deactivate?>>Deactivate</option>
                                </select>
                            </div>
                        </fieldset> 
                           <fieldset>
                            <legend>Search By</legend> 
                            <br /> 
                             <div>
                                <label class="lbl">Client Name</label> 
                                <?PHP
                                if(isset($_REQUEST['testimonial_client_name']))
                                {
                                    $testimonial_client_name = $_REQUEST['testimonial_client_name'];
                                }
                                else
                                {
                                    $testimonial_client_name = "";
                                }
                                ?>
                                <input type="text" name="testimonial_client_name" class="text" value="<?PHP echo $testimonial_client_name?>">
                            </div>
                           
                            </fieldset>
                            
                            <fieldset>
                            <br />
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
                        <?PHP echo anchor('admin/add_new_testimonial/','Add New Testimonial');?>
                        </td>
                    </tr>
                </table>
                 <div id="tableBody">
                <table class='zebra' style="border-style:solid;"  id="myTable">
                <thead>
                        <tr>    
                            <th class="align-left" style="width:300;"><b>Client Name</b></th>
                            <th class="align-left" style="width:300;"><b>Added On</b></th>
                            <th class="align-left" style="width:150px;"><b>Display Order</b></th>
                            <th class="align-left" style="width:120px;"><b>Is Activate?</b></th>
                            <th class="align-left" style="width:120px;"><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                            if(isset($testimonials) && count($testimonials) > 0)
                            {
                                foreach($testimonials as $testimonial)
                                {
                        ?>
                        <tr class="gradeU">
                            <td style="width:290px;">
                            <b>
                                <?PHP
                                    echo anchor('admin/testimonial_details/'.$testimonial['testimonial_id'],ucfirst(stripslashes($testimonial['testimonial_client_name'])),array('class' => 'iframe','style'=>"color:0774a7"));
                                ?>
                            </b>
                            </td>
                           
                            <td><?PHP echo long_date_format($testimonial['date_added'])?></td>
                            <td style="text-align: center"><input type="text" name="display_order" value="<?PHP echo $testimonial['display_order']; ?>" onchange="update_testimonial_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_testimonial_display_order?testimonial_id=".$testimonial['testimonial_id'];?>')" size="3" value="<?PHP echo $testimonial['display_order']?>"  onkeypress="return isNumberKey(event)" style="text-align: center;"></td>
                            
                            <td style="text-align:center;"> 
                            <?PHP
                                $checkedstr = "";
                                if($testimonial['testimonial_status'] == "1")
                                {
                                $checkedstr = " checked='checked'"; 
                                }
                            ?>
                            <input type="checkbox" value="1" onclick="return update_testimonial_status(this,'<?PHP echo base_url()."index.php/admin/update_testimonial_status?testimonial_id=".$testimonial['testimonial_id'];?>',<?PHP echo $testimonial['testimonial_id']?>)" <?PHP echo $checkedstr; ?>>
                            </td>
                            
                            <td align="center">
                            <b>
                            <?PHP 
                                 echo anchor('admin/edit_testimonial/'.$testimonial['testimonial_id'],'Edit',array('style'=>"color:black"));?>
                            </b>
                            </td>
                        </tr>
                        <?PHP }} else{?>
                        <tr>
                        <td colspan="10"  style="text-align: center;">
                           <b><?PHP echo "No records found";?> </b> 
                        </td>
                        </tr>
                        <?PHP }?> 
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
  
