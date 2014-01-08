<?php foreach ($welcom_box as $box) { ?>
<?php if($box['box_control'] != 0) { ?>
<div id="wrapper">
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
</div>
<?php } } ?>    