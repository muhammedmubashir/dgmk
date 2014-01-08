<section id="page-title">
    	<div class="container clearfix">
            <h1>Artical</h1>
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>home">Home</a> &rsaquo;</li>
                    <li>Artical</li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- begin page title -->
    
    <!-- begin content -->
    <section id="content" class="container clearfix">
    	<ul id="search-results">
            <li>
            	<?php foreach ($art_data as $art) { ?>
                <img src="<?php echo base_url(); ?>img/articals/<?php echo $art['article_image']; ?> "width="40" height="40" >
                <h2><p><?php echo $art['short_desc']; ?></p></h2>
                <p><a class="button generic" href="<?php base_url();?>artical_detail/<?php echo $art['article_id']; ?>" >مزید پڑھیں</a></p>
                <?php } ?>
            </li>
        </ul>
    	
    </section>