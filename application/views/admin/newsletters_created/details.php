<html lang="en-us">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
    

        <link rel="apple-touch-con" href="" />

    <title>Channeled Administration Panel</title>

        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

    <!-- The Columnal Grid and mobile stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/columnal/columnal.css" type="text/css" media="screen" />

    <!-- Fixes for IE -->
        
    <!--[if lt IE 9]>
            <link rel="stylesheet" href="assets/styles/columnal/ie.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="assets/styles/ie8.css" type="text/css" media="screen" />
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
            <script type="text/javascript" src="assets/scripts/flot/excanvas.min.js"></script>
    <![endif]-->        
        
    
    <!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="<?php echo base_url();?>css/system_messages.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/config.css" type="text/css" media="screen" />
        
        <!-- Use CDN on production server -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
        <!-- <script src="assets/scripts/jquery-1.6.4.min.js"></script> -->
        <!-- <script src="assets/scripts/jqueryui/jquery-ui-1.8.16.custom.min.js"></script> -->
        
        <!-- Menu -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/images/assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="<?php echo base_url(); ?>images/assets/scripts/superfish/superfish.js"></script>
        
        <!-- Adds HTML5 placeholder element to those lesser browsers -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>
        
        <!-- Adds charts -->
        <script type="text/javascript" src="href=<?php echo base_url(); ?>images/assets/scripts/flot/jquery.flot.min.js"></script>
        <script type="text/javascript" src="href=<?php echo base_url(); ?>images/assets/scripts/flot/jquery.flot.pie.min.js"></script>
        <script type="text/javascript" src="href=<?php echo base_url(); ?>images/assets/scripts/flot/jquery.flot.stack.min.js"></script>
        
        
         <!-- Form Validation Engine -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/formvalidator/jquery.validationEngine.js"></script>
        <script src="<?php echo base_url(); ?>images/assets/scripts/formvalidator/jquery.validationEngine-en.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/images/assets/scripts/formvalidator/validationEngine.jquery.css" type="text/css" media="screen" />
        
        <!-- Sortable, searchable DataTable -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/jquery.dataTables.min.js"></script>
        
        <!-- Custom Tooltips -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/twipsy.js"></script>
        
        <!-- WYSIWYG Editor -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/cleditor/jquery.cleditor.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/images/assets/scripts/cleditor/jquery.cleditor.css" type="text/css" media="screen" />
        
        <!-- Form Validation Engine -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/formvalidator/jquery.validationEngine.js"></script>
        <script src="<?php echo base_url(); ?>images/assets/scripts/formvalidator/jquery.validationEngine-en.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/scripts/formvalidator/validationEngine.jquery.css" type="text/css" media="screen" />
        
        <!-- Fullsized calendars -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/scripts/fullcalendar/fullcalendar.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/scripts/fullcalendar/fullcalendar.print.css" type="text/css" media="print" />
        <script src="<?php echo base_url(); ?>images/assets/scripts/fullcalendar/fullcalendar.min.js"></script>
        <script src="<?php echo base_url(); ?>images/assets/scripts/fullcalendar/gcal.js"></script>
        
        <!-- Colorbox is a lightbox alternative-->
        <script src="<?php echo base_url(); ?>images/assets/scripts/colorbox/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/images/assets/scripts/colorbox/colorbox.css" type="text/css" media="screen" />

        <!-- Colorpicker -->
        <script src="<?php echo base_url(); ?>images/assets/scripts/colorpicker/colorpicker.js"></script>
        <script src="<?php echo base_url(); ?>images/assets/scripts/muse.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/images/assets/scripts/colorpicker/colorpicker.css" type="text/css" media="screen" />
        
         <!-- All the js used in the demo -->
         <script src="<?php echo base_url(); ?>images/assets/scripts/demo.js"></script>
         
         <script src="<?php echo base_url(); ?>images/assets/scripts/ajax_functions.js"></script>
         <script src="<?php echo base_url(); ?>images/assets/scripts/native.cookie.js"></script>
         
<script>
        $(document).ready(function(){
            //Examples of how to assign the ColorBox event to elements
            $(".group1").colorbox({rel:'group1'});
            $(".group2").colorbox({rel:'group2', transition:"fade"});
            $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
            $(".group4").colorbox({rel:'group4', slideshow:true});
                        
            $(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
            $(".iframe").colorbox({iframe:true, width:"60%", height:"60%"});
            $(".inline").colorbox({inline:true, width:"50%"});
            $(".callbacks").colorbox({
                onOpen:function(){ alert('onOpen: colorbox is about to open'); },
                onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
                onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
                onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
                onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
            });
                        
                        //Example of preserving a JavaScript event for inline calls.
            $("#click").click(function(){ 
                $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                return false;
            });
                });
</script>         
<script>
  $(function() 
  {
        $( ".date_input" ).datepicker({ dateFormat: 'yy-mm-dd' }); 
        
        initToggleFilter(getCookie("filter_action_value"));      
    
   });
</script>         
<?PHP 
    if(isset($newsletter_data) && $newsletter_data != false){
?>
<meta charset="UTF-8"></head>
<body>

<div id="wrap">
    <div id="main">
            
<div class="container" id="actualbody">
    

<form name="admin_login" method="post" action="">           

<div class="row">
    <div class="widget clearfix">
        
        <h2>Newsletter Details</h2>
        <div class="widget_inside">
            <div class="col_12">
                <table class="regular" style="padding: 3em;">
                    <tbody>
                        <?PHP 
                            if($newsletter_data['newsletter_title'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%">Newsletter Title :</td>
                            <td><?PHP echo ucfirst($newsletter_data['newsletter_title'])?></td>
                        </tr>
                        <?PHP }?>
                        
                        <?PHP 
                            if($newsletter_data['newsletter_text'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%" style="vertical-align: top">Newsletter Details :</td>
                            <td><?PHP echo stripslashes($newsletter_data['newsletter_text'])?></td>
                        </tr>
                        <?PHP }?>
                        
                        <?PHP 
                            if($newsletter_data['date_added'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%">Creation Date:</td>
                            <td><?PHP echo long_date_format($newsletter_data['date_added'])?></td>
                        </tr>
                        <?PHP }?>
                        
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
</div>


</div>
</div>
</form>    
</div>
        </div><!--container -->
    </div>
<?PHP }?>
