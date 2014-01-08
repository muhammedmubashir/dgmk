<html lang="en-us">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	

        <link rel="apple-touch-con" href="" />

	<title>:: DR. GHULAM MUSTAFA ADMINISTRATION PANEL ::</title>

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
  $(function() 
  {
        $( ".date_input" ).datepicker({ dateFormat: 'yy-mm-dd' }); 
        
        initToggleFilter(getCookie("filter_action_value"));      
    
   });
</script>         

<meta charset="UTF-8"></head>

<body>

<div id="wrap">
	<div id="main">
            <header class="container">
                <div class="row clearfix">
                    <div class="left">
                        <h4 style="color: white;">DR. GHULAM MUSTAFA ADMINISTRATION PANEL</h4>
                    </div>
                </div>
            </header>
            
            <nav class="container">
                <select class="mobile-only row clearfix" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
                    <option value="index.php?t=dashboard">Dashboard</option>
                    <option value="tables.php?t=tables">Useres</option>
                    <option value="forms.php?t=forms">Forms</option>
                    <option value="dialogbox.php?t=dialog+boxes">Dialog Boxes</option>
                    <option value="statistics.php?t=statistics">Statistics</option>
                    <option value="gallery.php?t=gallery">Gallery</option>
                    <option value="typography.php?t=typography">Typography</option>
                    <option value="grids.php?t=grids">Grid</option>
                    <option value="calendar.php?t=calendar">Calendar</option>
                    <option value="icons.php?t=icons">Icons</option>
                </select>
            </nav>


            <a class="trigger demo_4" href="#">Customize!</a>

            <div id="aurora_option" class="form panel">

                <div class="clearfix">
                    <label>Select Preset</label>
                    <div class="input">
                        <select id="preset" onchange="changePreset()">
                            <option value="#292929,#454545,#0774a7,header_blueprint.png,none">Default</option>
                            <option value="#16331f,#25781a,#216f47,11.png,none">Green Earth</option>
                            <option value="#4d1919,#702929,#662222,7.png,none">Royal Red</option>
                            <option value="#2d354d,#3b4966,#606060,2.png,brushed_alu.png">Ice Blue</option>
                            <option value="#29231b,#4d3d2c,#5e553d,header_blueprint.png,stucco.png">Chocolate Brown</option>
                            <option value="#291325,#322236,#382f38,2.png,diagonal-noise.png">King's Garment</option>
                        </select>
                    </div>
                </div>

                <span id="aurora_or">or <span>make your own!</span></span>

                <div class="clearfix">
                    <label>Header Color</label>
                    <div class="input">
                        <div id="in-header" class="picker"></div>
                    </div>
                </div>
                <div class="clearfix">
                    <label>Navigation Color</label>
                    <div class="input">
                        <div id="in-nav" class="picker"></div>
                    </div>
                </div>
                <div class="clearfix">
                    <label>Title Color</label>
                    <div class="input">
                        <div id="in-title" class="picker"></div>
                    </div>
                </div>
                <div class="clearfix">
                    <label>Title Pattern</label>
                    <div class="input">
                        <select id="titlepattern" onchange="changeTitlePattern()">
                            <option value="none">None</option>
                            <option value="header_blueprint.png">Blueprint</option>
                            <option value="1.png">Pattern 1</option>
                            <option value="2.png">Pattern 2</option>
                            <option value="3.png">Pattern 3</option>
                            <option value="4.png">Pattern 4</option>
                            <option value="5.png">Pattern 5</option>
                            <option value="6.png">Pattern 6</option>
                            <option value="7.png">Pattern 7</option>
                            <option value="8.png">Pattern 8</option>
                            <option value="9.png">Pattern 9</option>
                            <option value="10.png">Pattern 10</option>
                            <option value="11.png">Pattern 11</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix">
                    <label>Background Pattern</label>
                    <div class="input">
                        <select id="backgroundpattern" onchange="changeBGPattern()">
                            <option value="none">None</option>
                            <option value="body_blueprint.png">Blueprint</option>
                            <option value="stucco.png">Stucco</option>
                            <option value="noise.png">Noise</option>
                            <option value="brushed_alu.png">Brushed Aluminium</option>
                            <option value="beige_paper.png">Beige Paper</option>
                            <option value="concrete_wall.png">Concrete Wall</option>
                            <option value="diagonal-noise.png">Diagonal Noise</option>
                            <option value="noisy.png">Noisy</option>
                        </select>
                    </div>
                </div>
            </div>       
<?PHP
    if(isset($_SESSION['Error_Message']))
    {
        $messages = new Modmessages();
        echo $messages->render();
        unset($_SESSION['Error_Message']);
    }
?>