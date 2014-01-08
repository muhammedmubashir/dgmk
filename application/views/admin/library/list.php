<div id="titlediv">
    <div class="clearfix container" id="pattern">
        <div class="row">
            <div class="col_12">
                <ul class="breadcrumbs hor-list">
                    <li><a href="<?php echo base_url();?>index.php/admin/library_list">Manage Library</a></li>
                </ul>
                <h1>Manage Library</h1>
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
        <h2>Library Book List</h2>
        <div class="widget_inside">
        
            <div class="col_12">
                <table>
                    <tr>    
                        <td class="align-right" colspan="10">
                        <?PHP echo anchor('admin/add_book_in_library/','Add new book');?>
                        </td>
                    </tr>
                </table>
                <table class='dataTable'>
                <thead>
                        <tr>    
                            <th class="align-left">Book Name</th>
                            <th class="align-left">Author</th>
                            <th class="align-left">Category</th>
                            <th class="align-left">Publisher</th>
                            <th class="align-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?PHP
                            if(isset($book_list) && count($book_list) > 0)
                            {
                                foreach($book_list as $book)
                                {
                                ?>
                                    <tr class="gradeU">
                                        <td align="left"><?PHP echo ucfirst($book['book_name']);?></td>
                                        <td align="left"><?PHP echo ucfirst($book['book_author']);?></td>
                                        <td align="left"><?PHP echo ucfirst($book['category_name']);?></td>
                                        <td align="left"><?PHP echo ucfirst($book['book_publisher']);?></td>
                                        <td align="center">
                                            <?PHP echo anchor('admin/edit_book_in_library/'.$book['lib_book_id'],'Edit');?> |
                                            <?PHP echo anchor('admin/delete_book_in_library/'.$book['lib_book_id'],'Delete',array('onclick'=>"return confirm('Are you sure want to delete this Book from Library ?')"));?>
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
  