<section id="page-title">
    <div class="container clearfix">
        <h1>??????</h1>
        
    </div>
</section>

<!-- <section align='center'>
    <h3>Releated Books</h3>
    <div class="client-wrap">
        <ul class="clients clearfix">
            <?php foreach ($categ as $categories) { ?>
            <li><a href="#"><?php echo $categories['category_name']; ?></a></li>
            <?php } ?>       
        </ul>
    </div>
</section> -->


<section>
    
    <!-- begin project carousel -->
    <ul class="project-carousel project-list">
        
        <?php foreach ($books_cat as $book) { ?>
            <li class="entry">
            <a class="entry-image lightbox" href="<?php echo base_url(); ?>books/book_front_page/<?php echo $book['book_front_page']; ?>" title="<?php echo $book['book_title_filename']; ?>"><span class="zoom"></span><img src="<?php echo base_url(); ?>books/book_front_page/<?php echo $book['book_front_page']; ?>" alt=""></a>
            <a class="entry-meta" href="portfolio-item-image.html">
            <h2 class="entry-title"><?php echo $book['book_title']; ?></h2>
            <div class="entry-content">
            <a href="<?php echo base_url(); ?>books/pdf/<?php echo $book['pdf_book_image']; ?>">Download</a>                    <!-- <p><?php echo $book['book_front_page']; ?></p> -->
            </div>
            </a>
            </li>
        <?php } ?>
    </ul>
    <!-- end project carousel -->
</section>