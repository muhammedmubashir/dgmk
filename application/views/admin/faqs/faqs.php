<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/faqs">Manage FAQS</a></li>
                </ul>
                <h1>Manage FAQS</h1>
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
        <h2>FAQS List</h2>
        <div class="widget_inside">
        
            <div class="col_12">
                <table>
                    <tr>    
                        <td class="align-right" colspan="10">
                        <?PHP echo anchor('admin/add_new_faq/','Add new faq');?>
                        </td>
                    </tr>
                </table>
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">FAQ Question</th>
                            <th class="align-left">Display Order</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
    
                        <?PHP
                                if(isset($faqs) && count($faqs) > 0)
                                {
                                    foreach($faqs as $faq)
                                    {
                            ?>
                            <tr class="gradeU">
                                <td align="left"><?PHP echo ucfirst($faq['faq_question']);?></td>
                                <td style="text-align: center"><input type="text" name="display_order" value="<?PHP echo $faq['display_order']; ?>" onchange="update_faq_display_order(this.value,'<?PHP echo base_url()."index.php/admin/update_faq_display_order?faq_id=".$faq['faq_id'];?>')" size="3" value="<?PHP echo (int)$faq['display_order']?>"  onkeypress="return isNumberKey(event)" style="text-align: center;"></td>
                                <td align="center">
                                <?PHP echo anchor('admin/edit_faq/'.$faq['faq_id'],'Edit');?> |
                                <?PHP echo anchor('admin/delete_faq/'.$faq['faq_id'],
                                'Delete',array('onclick'=>"return confirm('Are you sure want to delete this FAQ ?')"));?>
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
  