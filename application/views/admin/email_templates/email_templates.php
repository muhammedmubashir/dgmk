<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/email_templates">Manage Email Templates</a></li>
                </ul>
                <h1>Manage Email Templates</h1>
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
        <h2>Email Templates</h2>
        <div class="widget_inside">
        
            <div class="col_12">
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">Subject</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($email_templates) && count($email_templates) > 0)
                                {
                                    foreach($email_templates as $email_template)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td align="left"><?PHP echo stripslashes($email_template['template_subject']);?></td>
                                <td><?PHP echo anchor('admin/edit_email_template/'.$email_template['template_id'],'Edit');?></td>
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
  