<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/site_contents">Manage Site Contents</a></li>
                </ul>
                <h1>Manage Site Contents</h1>
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
        <h2>Site Contents</h2>
        <div class="widget_inside">
        
            <div class="col_12">
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">Page</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                                if(isset($site_contents) && count($site_contents) > 0)
                                {
                                    foreach($site_contents as $site_content)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td align="left"><?PHP echo stripslashes($site_content['page_title']);?></td>
                                <td><?PHP echo anchor('admin/edit_content/'.$site_content['page_id'],'Edit');?></td>
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
  