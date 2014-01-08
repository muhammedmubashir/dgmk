<section class="one-half column-last">
            <h3 style="text-align:center;">حالیہ خبریں</h3>
            <!-- begin post carousel -->
            <ul class="post-carousel">
                <!-- begin first column -->
                <li>
                <?php
                foreach($news_data as $news)
                {
                    $date = date("d",strtotime($news['news_date']));
                    $month = date("M",strtotime($news['news_date']));
                    ?>
                    <div class="entry" style="text-align:right;">
                        <div class="entry-date">
                            <div class="entry-day"><?php echo $date;?></div>
                            <div class="entry-month"><?php echo $month;?></div>
                        </div>
                        <div class="entry-body">
                            <h4 class="entry-title"><a><?php echo trim($news['news_title']);?></a></h4>
                            <div class="entry-content">
                                <p style="font-size:16px;"><?php echo strip_tags(trim($news['news_details']));?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </li>
            </ul>
            <!-- end post carousel -->
        </section>