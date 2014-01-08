<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/sitecodes">Manage System Data Codes</a></li>
                </ul>
                <h1>Manage System Data Codes</h1>
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
        <h2>System Data Codes List</h2>
        <?PHP
            $this->load->view("admin/filter/init.filter.php"); 
        ?>
        <div class="filter_form">
                    <form name="filterfrm" id="filterfrm" action='' method="POST">
                        <fieldset>
                            <legend>Filter By</legend>
                            <div>
                                <label class="lbl">System Data Code</label> 
                                <?PHP
                                    if(isset($_POST['codeType']))
                                    {
                                        $codeType = $_POST['codeType'];  
                                    }
                                    else
                                    {
                                        $codeType = "";
                                    }
                                    ?>
                                <select name="codeType" class="required" id="codeType">
                                    <option value="">View All</option>
                                    <?PHP echo $this->SiteCodes_model->code_type_combo($codeType);?>
                                </select>
                            </div>
                            <div>
                                <label class="lbl">Status</label> 
                                <?PHP
                                if(isset($_POST['status']))
                                {
                                    $status = $_POST['status'];
                                }
                                else
                                {
                                    $status = "-1";
                                }
                                
                                if($status == 1)
                                {
                                    $activate = "selected";
                                    $deactivate = "";
                                    $view_all = "";;
                                }
                                else if($status == 0)
                                {
                                    $activate = "";
                                    $deactivate = "selected";
                                    $view_all = "";;
                                }
                                else if($status == -1)
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
                                  <select name='status' id='status'> 
                                  <option value="-1" <?PHP echo $view_all?>>View All</option>
                                  <option value="1" <?PHP echo $activate?>>Activate</option>
                                  <option value="0" <?PHP echo $deactivate?>>Deactivate</option>
                                </select>
                            </div>
                        </fieldset> 
                       <fieldset>
                        <legend>Search By</legend> 
                        <div>
                                <label class="lbl">System Data Code Value</label> 
                                <?PHP
                                if(isset($_POST['codeValue']))
                                {
                                    $codeValue = $_POST['codeValue'];
                                }
                                else
                                {
                                    $codeValue = "";
                                }
                                ?>
                                <input type="text" name="codeValue" class="text" value="<?PHP echo $codeValue?>">
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
                        <?PHP echo anchor('admin/add_new_codes/','Add New System Data Codes');?>
                        </td>
                    </tr>
                </table>
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">Code ID</th>
                            <th class="align-left">Code Type</th>
                            <th class="align-left">Code Value</th>
                            <th class="align-left">Status</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($sitecodes) && count($sitecodes) > 0)
                                {
                                    foreach($sitecodes as $sitecode)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td align="center"><?PHP echo $sitecode['codeID']?></td>
                                <td align="center"><?PHP echo $this->SiteCodes_model->get_code_type($sitecode['codeType']);?></td>
                                <td align="center"><?PHP echo stripslashes($sitecode['codeValue']);?></td>
                                <td align="center">
                                  <?PHP
                                  $checkedstr = "";
                                  if($sitecode['status'] == "1")
                                  {
                                        echo "Activate";
                                  }
                                  else
                                  {
                                         echo "Deactivate";    
                                  }
                                  
                                  ?>
                                
                                </td>
                                <td align="center">
                                <?PHP echo anchor('admin/edit_code/'.$sitecode['codeID'],'Edit');?>
                                 |
                                <?PHP
                                    if($sitecode['status'] == 1)
                                    {
                                ?>
                                <?PHP echo anchor('admin/update_code_status/0/'.$sitecode['codeID'],'Deactivate');?>
                                <?PHP } else { ?>
                                <?PHP echo anchor('admin/update_code_status/1/'.$sitecode['codeID'],'Activate');?>
                                <?PHP }?>
                                </td>
                          </tr>
                            <?PHP }}?> 
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
  
