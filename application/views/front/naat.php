<section id="page-title">
    <div class="container clearfix">
        <h1>NAATS</h1>
    </div>
</section>

<div id="txtHint">
    <table class="gen-table">
        <?php 
            foreach ($naat_data as $name=>$naats) 
            {
                ?>
                <tr>
                    <td colspan="2"><h1><?php echo ucwords(str_replace("_"," ",$name));?></h1></td>
                </tr>
                <tr>
                    <th>Naat Title</th>
                    <th>Listen</th>
                </tr>
                <?php 
                foreach ($naats as $naat) 
                {
                ?>
                    <tr>
                        <td><?php echo ucwords(str_replace("_"," ",$naat)); ?></td>
                        <td>
                            <!--<audio src="<?php echo base_url(); ?>img/naat/<?php echo $naat['naat_file']; ?>" controls preload></audio>-->
                            <a href="<?php echo base_url(); ?>img/naat/<?php echo $naat; ?>">Download</a>
                        </td>
                    </tr>
                <?php 
                }
            } 
        ?>
    </table>
</div>