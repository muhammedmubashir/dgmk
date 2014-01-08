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
<section id="content" class="container clearfix">
<?php foreach ($art_data as $art) { ?>
<img src="<?php echo base_url(); ?>img/articals/<?php echo $art['article_image']; ?> "width="40" height="40" >
<h2><p><?php echo $art['article_description']; ?></p></h2>

<?php } ?>
</section>