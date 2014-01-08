<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/categories">Manage Book Topics</a></li>
                </ul>
                <h1>Manage Topics</h1>
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
        <h2>Book Topics List</h2>
        <div class="widget_inside">
        
            <div class="col_12">
                <table>
                    <tr>    
                        <td class="align-right" colspan="10">
                        <?PHP echo anchor('admin/add_category/','Add new Topic');?>
                        </td>
                    </tr>
                </table>
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">Topic ID</th>
                            <th class="align-left">Topic</th>
                            <th class="align-left">Status</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                            if(isset($categories) && count($categories) > 0)
                            {
                                foreach($categories as $category)
                                {
                                ?>
                                    <tr class="gradeU">
                                        <td align="left"><?PHP echo $category['category_id'];?></td>
                                        <td align="left" style="font-size:16px;"><?PHP echo $category['category_name'];?></td>
                                        <td align="left"><?PHP echo ($category['category_status']==1) ? "Enable" : "Disable";?></td>
                                        <td align="center">
                                            <?PHP echo anchor('admin/edit_book_category/'.$category['category_id'],'Edit');?> |
                                            <?PHP 
                                                if($category['category_status'] == 1)
                                                {
                                                    echo anchor('admin/update_category_status/'.$category['category_id'].'/0','Deactivate',array('onclick'=>"return confirm('Are you sure want to Deactivate this topic?')"));
                                                }
                                                elseif($category['category_status'] == 0)
                                                {
                                                    echo anchor('admin/update_category_status/'.$category['category_id'].'/1','Activate',array('onclick'=>"return confirm('Are you sure want to Activate this topic?')"));
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?PHP 
                                }
                            }
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
  