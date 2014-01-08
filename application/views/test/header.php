<!DOCTYPE HTML>
<!--[if IE 8]> <html class="ie8 no-js"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <!-- begin meta -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- end meta -->
    
    <!-- begin CSS -->
    <link href="<?php echo base_url();?>css/style.css" type="text/css" rel="stylesheet" id="main-style">
    <link href="<?php echo base_url();?>css/responsive.css" type="text/css" rel="stylesheet">
    <!--[if IE]> <link href="<?php echo base_url();?>css/ie.css" type="text/css" rel="stylesheet"> <![endif]-->
    <link href="<?php echo base_url();?>css/colors/green.css" type="text/css" rel="stylesheet" id="color-style">
    
    <!-- end CSS -->
    
    <link href="<?php echo base_url();?>images/favicon.png" type="image/x-icon" rel="shortcut icon">

    <!-- begin JS -->
    <script src="<?php echo base_url();?>js/jquery-1.8.2.min.js" type="text/javascript"></script> <!-- jQuery -->
    <script src="<?php echo base_url();?>js/ie.js" type="text/javascript"></script> <!-- IE detection -->
    <script src="<?php echo base_url();?>js/jquery.easing.1.3.js" type="text/javascript"></script> <!-- jQuery easing -->
    <script src="<?php echo base_url();?>js/modernizr.custom.js" type="text/javascript"></script> <!-- Modernizr -->
    <!--[if IE 8]>
    <script src="<?php echo base_url();?>js/respond.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>js/selectivizr-min.js" type="text/javascript"></script> 
    <![endif]--> 
    <!--<script src="style-switcher/style-switcher.js" type="text/javascript"></script> <!-- style switcher -->
    <script src="<?php echo base_url();?>js/ddlevelsmenu.js" type="text/javascript"></script> <!-- drop-down menu -->
    <script type="text/javascript"> <!-- drop-down menu -->
        ddlevelsmenu.setup("nav", "topbar");
    </script>
    <script src="<?php echo base_url();?>js/tinynav.min.js" type="text/javascript"></script> <!-- tiny nav -->
    <!--<script src="<?php echo base_url();?>js/jquery.validate.min.js" type="text/javascript"></script> <!-- form validation -->
    <script src="<?php echo base_url();?>js/jquery.flexslider-min.js" type="text/javascript"></script> <!-- slider -->
    <script src="<?php echo base_url();?>js/jquery.jcarousel.min.js" type="text/javascript"></script> <!-- carousel -->
    <script src="<?php echo base_url();?>js/jquery.ui.totop.min.js" type="text/javascript"></script> <!-- scroll to top -->
    <script src="<?php echo base_url();?>js/jquery.fitvids.js" type="text/javascript"></script> <!-- responsive video embeds -->
    <!--<script src="<?php echo base_url();?>js/jquery.tweet.js" type="text/javascript"></script> <!-- Twitter widget -->
    <!--<script type="text/javascript" src="<?php echo base_url();?>js/revslider.jquery.themepunch.plugins.min.js"></script> <!-- swipe gestures -->
    <script src="<?php echo base_url();?>js/jquery.tipsy.js" type="text/javascript"></script> <!-- tooltips -->
    <!--<script src="<?php echo base_url();?>js/jquery.fancybox.pack.js" type="text/javascript"></script> <!-- lightbox -->
    <!--<script src="<?php echo base_url();?>js/jquery.fancybox-media.js" type="text/javascript"></script> <!-- lightbox -->
    <!--<script src="<?php echo base_url();?>js/froogaloop.min.js" type="text/javascript"></script> <!-- video manipulation -->
    <script src="<?php echo base_url();?>js/custom.js" type="text/javascript"></script> <!-- jQuery initialization -->
    <script type="text/javascript" src="<?php echo base_url();?>js/popup.js"></script>
    <!-- end JS -->

	<!-- combo box -->
    <link href="<?php echo base_url(); ?>combo_box/select2.css" rel="stylesheet"/>
    <script src="<?php echo base_url(); ?>combo_box/select2.js"></script>
    <!-- combo box end -->
    
    <title>
        <?php 
        if(!isset($title))
        {
            $title = "Dr Ghulam Mustafa Khan Sahab R.A";
        }
            echo $title;
        ?>
    </title>
</head>
<style>
#wrapper{
    color:#000000;
    font-family:tahoma;
    font-size:14px;
    margin:0 auto;
    width:800px;
}

#wrapper a{
    cursor:pointer;
    font-size:15px;
    font-weight:bold;
    text-decoration:underline;
}

.box {
    background-color: #ffffff;
    color: #888888;
    height: 125px;
    left: 100%;
    padding: 20px;
    position: fixed;
    right: 30%;
    top: 25%;
    width: 555px;
    z-index: 101;
    border:5px solid #888888;
    border-radius:10px;
    -moz-border-radius:10px;
}

.overlay {
    background: #000000;
    bottom: 0;
    left: 0;
    position: fixed;
    right: 0;
    top: 0;
    z-index: 100;
    opacity:0.5;
}

a.boxclose {
    background: url("http://drghulammustafa.com/images/cancel.png") repeat scroll left top transparent;
    cursor: pointer;
    float: right;
    height: 26px;
    left: 32px;
    position: relative;
    top: -33px;
    width: 26px;
}
</style>

<body class="boxed" onload="openOffersDialog();">
<!-- begin container -->    
<div id="wrap">
