 <html lang="en-us">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
    

        <link rel="apple-touch-con" href="" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

    <!-- The Columnal Grid and mobile stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/columnal/columnal.css" type="text/css" media="screen" />

    <!-- Fixes for IE -->
        
    <!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="<?php echo base_url();?>css/system_messages.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/config.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>images/assets/styles/config.css" type="text/css" media="screen" />
        
        <!-- Use CDN on production server -->
        <script type="text/javascript" src="<?php echo base_url(); ?>images/assets/scripts/google/jquery.min.js"></script>

        
        <script type="text/javascript" src="<?php echo base_url(); ?>js/fckeditor/fckeditor.js"></script>
        
        <script type="text/javascript" src="<?php echo base_url(); ?>images/assets/scripts/google/jquery-ui.min.js"></script>
        
        
        
        <!-- <script src="<?php echo base_url(); ?>images/assets/scripts/jquery-1.6.4.min.js"></script> -->
        <!-- <script src="<?php echo base_url(); ?>images/assets/scripts/jqueryui/jquery-ui-1.8.16.custom.min.js"></script> -->
        
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
         <script src="<?php echo base_url(); ?>images/assets/scripts/jquery.validate.js"></script>
         <script src="<?php echo base_url(); ?>images/assets/scripts/jquery.form.js"></script>
         <script src="<?php echo base_url(); ?>images/assets/scripts/uploadify/swfobject.js"></script>
         <script src="<?php echo base_url(); ?>images/assets/scripts/uploadify/uploadify.js"></script>
         
<script>
        $(document).ready(function(){
            //Examples of how to assign the ColorBox event to elements
            $(".group1").colorbox({rel:'group1'});
            $(".group2").colorbox({rel:'group2', transition:"fade"});
            $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
            $(".group4").colorbox({rel:'group4', slideshow:true});
            
                        
            $(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
            $(".iframe").colorbox(
            {    
                iframe:true, width:"80%", height:"80%",
            }
            );
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
        
<meta charset="UTF-8"></head>
<body>

<div id="wrap">
    <div id="main">
            
<div class="container" id="actualbody">
<div class="row">
    <div class="widget clearfix">
        
        <h2>Testimonial Details</h2>
        <div class="widget_inside">
            <div class="col_12">
                <table class="regular">
                    <tbody>
                          <div style="text-align: center;">
                           <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data['original_source_file']) !="")
                            {
                                if(file_exists(_DIR_TESTIMONAILS."/".$testimonial_data['original_source_file']) && $testimonial_data['original_source_file'] != "")
                                {
                                    $url = _URL_TESTIMONAILS_SOURCE_FILE;
                                ?>   
                                <a href="<?PHP echo $url.$testimonial_data['original_source_file']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$testimonial_data['original_source_file']; ?>" alt="Picture" /></a>
                                <br /><br />
                                <?PHP
                                }
                            }
                        ?> 
                        
                        <div style="text-align: center;">
                           <?PHP 
                            if(isset($testimonial_data) && count($testimonial_data['worked_source_file']) !="")
                            {
                                if(file_exists(_DIR_TESTIMONAILS."/".$testimonial_data['worked_source_file']) && $testimonial_data['worked_source_file'] != "")
                                {
                                    $url = _URL_TESTIMONAILS_WORKED_FILE;
                                ?>   
                                <a href="<?PHP echo $url.$testimonial_data['worked_source_file']; ?>" target="_BLANK" class="group3 cboxElement"><img src="<?PHP echo $url."thumb_".$testimonial_data['worked_source_file']; ?>" alt="Picture" /></a>
                                <br /><br />
                                <?PHP
                                }
                            }
                        ?> 
                       
                       <?PHP 
                            if(isset($testimonial_data) && $testimonial_data['testimonial_client_name'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%"><b>Client Name :</b></td>
                            <td>
                                    <?PHP 
                                        if($testimonial_data['testimonial_client_name'] != "")
                                        {
                                            echo stripslashes($testimonial_data['testimonial_client_name']);
                                        }
                                    ?>
                            </td>
                        </tr>
                        <?PHP }?>
                        
                         <?PHP 
                            if(isset($testimonial_data) && $testimonial_data['client_designation'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%"><b>Client Designation :</b></td>
                            <td>
                                    <?PHP 
                                        if($testimonial_data['client_designation'] != "")
                                        {
                                            echo stripslashes($testimonial_data['client_designation']);
                                        }
                                    ?>
                            </td>
                        </tr>
                        <?PHP }?>
                        
                        
                        <?PHP 
                            if(isset($testimonial_data) && $testimonial_data['testimonial_text'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%"><b>Testimonial Text :</b></td>
                            <td style="vertical-align: top;">
                                    <?PHP 
                                        if($testimonial_data['testimonial_text'] != "")
                                        {
                                            echo stripslashes($testimonial_data['testimonial_text']);
                                        }
                                    ?>
                            </td>
                        </tr>
                        <?PHP }?>
                        
                        
                        <?PHP 
                            if(isset($testimonial_data) && $testimonial_data['testimonial_status'] !="")
                            {
                        ?>
                        <tr>
                            <td width="25%"><b>Testimonial Status :</b></td>
                            <td>
                                    <?PHP 
                                        if($testimonial_data['testimonial_status'] == 1)
                                        {
                                            echo "Activate";
                                        }
                                        else
                                        {
                                            echo "Deactivate";
                                        }
                                        
                                    ?>
                            </td>
                        </tr>
                        <?PHP }?>
                        
                        <?PHP 
                            if(isset($testimonial_data) && $testimonial_data['date_added'] !="")   
                            {
                        ?>
                        <tr>
                            <td><b>Added On :</b></td><td><?PHP echo long_date_format($testimonial_data['date_added']);?></td>
                        </tr>
                        <?PHP }?>
                        
                        <?PHP 
                            if(isset($testimonial_data) && $testimonial_data['date_updated'] !="")   
                            {
                        ?>
                        <tr>
                            <td><b>Updated On :</b></td><td><?PHP echo long_date_format($testimonial_data['date_updated']);?></td>
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

</div>
        </div><!--container -->
    </div>

