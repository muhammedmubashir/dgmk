<?php //foreach ($welcom_box as $box) { ?>
<?php //if($box['box_control'] != 0) { ?>
<!-- <div id="wrapper">
	<div id="overlay" class="overlay"></div>
	<div id="boxpopup" class="box">
		<a onclick="closeOffersDialog('boxpopup');" class="boxclose"></a>
		<div id="content" style="text-align:center;">
			
            
                <?php echo $box['ev_title']; ?>
			
			<a href="<?php echo $box['ev_link']; ?>">
				More Detail
			</a><br>
            
		</div>
	</div>
</div> -->
<?php //} } ?>
    <!-- begin content -->
    <section id="content" class="container clearfix">
        <!-- begin intro -->
        <section class="intro">
        	<h1>
                ہزاروں سال نرگس اپنی بے نوری پی روتی ہے
                <br>
                بڑی مشکل سے ہوتا ہے چمن  میں دیدہ  وَر  پیدا
            </h1>
        </section>
        <!-- end intro -->
        
        <hr>
        
        <!-- begin services -->
        <!-- <section>
        	<div class="iconbox-wrap clearfix">
                <div class="one-fourth">
                    <div class="iconbox applications">
                        <a href="services.html#design">
                            <h3 class="iconbox-title"><span class="iconbox-icon"></span>Design</h3>
                            <p>Sed tincidunt imperdiet sollicitudin. Maecenas luctus ipsum ut ante interdum ornare in at tortor. Mauris eros metus, rhoncus vitae dictum.</p>
                        </a>
                    </div>
                </div>
                
                <div class="one-fourth">
                    <div class="iconbox cog">
                        <a href="services.html#development">
                            <h3 class="iconbox-title"><span class="iconbox-icon"></span>Development</h3>
                            <p>Aenean feugiat interdum ligula, eget facilisis nunc ornare eu. Etiam vestibulum ultricies hendrerit. Praesent porttitor leo a erat ornare dictum.</p>
                        </a>
                    </div>
                </div>
                
                <div class="one-fourth">
                    <div class="iconbox iphone">
                        <a href="services.html#mobile">
                            <h3 class="iconbox-title"><span class="iconbox-icon"></span>Mobile</h3>
                            <p>Donec tristique fermentum lectus, eu tincidunt lacus vestibulum non. Nam nibh velit, dapibus ac imperdiet vitae, pellentesque ac ante.</p>
                        </a>
                    </div>
                </div>
                
                <div class="one-fourth">
                    <div class="iconbox chemical">
                        <a href="services.html#strategy">
                            <h3 class="iconbox-title"><span class="iconbox-icon"></span>Strategy</h3>
                            <p>Mauris eros metus, rhoncus vitae dictum ac, viverra nec turpis. Donec quis lacinia arcu. Cum sociis natoque penatibus et magnis dis parturient.</p>
                        </a>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- end services -->
        
        <!-- begin about us -->
        <section class="one-half">
            <h3 style="text-align:center;">ڈاکٹر غلام مصطفی خان حضرت صاحب ر ح کے بارے میں</h3>
            <div id="slider-about-us" class="about-us entry-slider">
                <div id="flexslider-about-us" class="flex-container">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="<?php echo base_url();?>images/entries/full-size/mazar-dr-ghulam-mustafa-khan-sahab-ra.jpg" alt="Mazar-shareef of Dr Ghulam Mustafa Khan Sahab RA" title="Mazar-shareef of Dr Ghulam Mustafa Khan Sahab RA">
                            </li>
                            <li>
                                <img src="<?php echo base_url();?>images/entries/full-size/inner-mazar-dr-ghulam-mustafa-khan-sahab-ra.jpg" alt="Inside Mazar-shareef of Dr Ghulam Mustafa Khan Sahab RA" title="Inside Mazar-shareef of Dr Ghulam Mustafa Khan Sahab RA">
                            </li>                                
                        </ul>
                    </div>
                </div>
            </div>
            
            <p align="right" style="font-size:18px;line-height:25px;">
                خوش بو ،  رنگ ،  روشنی،نور،  علم،  آگہی ،  حکمت، بصیرت، ہدایت، عجز،انکسار، مسکراہٹ، زہد، تقویٰ، عبادت، حلم، درک،ریاضت۔ ان سبصفات کو خمیرِسیرت سے ہم آہنگ کیا جائے تو ایک ایسے غلام مصطفےٰ کا چہرہ رشک آساوتقلید زا بنتا تھا،جس کے سایہ بن جایا کرتے تھے۔وہ سب اس سالار کے پیچھے چل کر ایک ایسے کارواں کا حصہ بن جاتے تھے کی منزل پر تو  غلامِ مصطفےٰ سے عبارت اور بجائے خود نقش ہائے سیرتِ بے مثل کی تلاش کی اشارت تھی!!۔ مگر اب جب کہ یہ چراغِ رشد و ہدایت ، 25 ستمبر کو گل ہوگیا۔اس کی ضیاؤں کو لوحِ وقت پر محفوظ کرنے کے لئے ان ہی کی زیست اور ان ہی کے  کارہائے نمایاں سے رجوع کرنے کی سبیل ِ واحد کے سوا باقی رہ گیا ہے۔
			</p>
            <a class="button generic" href="<?php base_url();?>home/intro" >مزید پڑھیں</a>
        </section>
        <!-- end about us -->
        
        <!-- begin latest posts -->
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
        <!-- end latest posts -->
        
        <hr>        
        <!-- begin clients 
        <section>
        	<h3>Our Clients</h3>
            <div class="client-wrap">
                <ul class="clients clearfix">
                    <li><a href="#"><img src="images/client-logos/themeforest.png" alt="ThemeForest" title="ThemeForest"></a></li>
                    <li><a href="#"><img src="images/client-logos/photodune.png" alt="PhotoDune" title="PhotoDune"></a></li>
                    <li><a href="#"><img src="images/client-logos/audiojungle.png" alt="AudioJungle" title="AudioJungle"></a></li>
                    <li><a href="#"><img src="images/client-logos/codecanyon.png" alt="CodeCanyon" title="CodeCanyon"></a></li>
                    <li><a href="#"><img src="images/client-logos/graphicriver.png" alt="GraphicRiver" title="GraphicRiver"></a></li>
                </ul>
            </div>
        </section>
        <!-- end clients -->  
    </section>
    <!-- end content -->  
    
   