if($.browser.mozilla||$.browser.opera ){document.removeEventListener("DOMContentLoaded",jQuery.ready,false);document.addEventListener("DOMContentLoaded",function(){jQuery.ready()},false)}
jQuery.event.remove( window, "load", jQuery.ready );
jQuery.event.add( window, "load", function(){jQuery.ready();} );
jQuery.extend({
	includeStates:{},
	include:function(url,callback,dependency){
		if ( typeof callback!='function'&&!dependency){
			dependency = callback;
			callback = null;
		}
		url = url.replace('\n', '');
		jQuery.includeStates[url] = false;
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.onload = function () {
			jQuery.includeStates[url] = true;
			if ( callback )
				callback.call(script);
		};
		script.onreadystatechange = function () {
			if ( this.readyState != "complete" && this.readyState != "loaded" ) return;
			jQuery.includeStates[url] = true;
			if ( callback )
				callback.call(script);
		};
		script.src = url;
		if ( dependency ) {
			if ( dependency.constructor != Array )
				dependency = [dependency];
			setTimeout(function(){
				var valid = true;
				$.each(dependency, function(k, v){
					if (! v() ) {
						valid = false;
						return false;
					}
				})
				if ( valid )
					document.getElementsByTagName('body')[0].appendChild(script);
				else
					setTimeout(arguments.callee, 10);
			}, 10);
		}
		else
			document.getElementsByTagName('body')[0].appendChild(script);
		return function(){
			return jQuery.includeStates[url];
		}
	},

	readyOld: jQuery.ready,
	ready: function () {
		if (jQuery.isReady) return;
		imReady = true;
		$.each(jQuery.includeStates, function(url, state) {
			if (! state)
				return imReady = false;
		});
		if (imReady) {
			jQuery.readyOld.apply(jQuery, arguments);
		} else {
			setTimeout(arguments.callee, 10);
		}
	}
});

/************** Include Javascript Files ***************/

//$.include('js/superfish.js');

//if($('.testimonials').length || $('.pics').length || $('.pics_single').length || $('.single-pics').length) {$.include('js/jquery.cycle.all.min.js');}
if($('.zoomer').length) {$.include('js/jquery.fancybox.pack.js');}
//if($('.workPanelLink').length) {$.include('js/jquery.quicksand.js');}
//if($('#jstwitter').length) {$.include('js/twitter.js');}


/************* Sliders *************/

/* Nivo Slider --> Begin */
if ($('#imageSlider').length) {
	
	jQuery(window).load(function(){
		jQuery('#imageSlider').nivoSlider({ 
			effect:'random',
			animSpeed:600,
			startSlide: 0,
			pauseTime:4000,
			captionOpacity: 1, 
			pauseOnHover:true,
			directionNav: false,
			directionNavHide:false
		});
	});
}
/* Nivo Slider --> End */








/* Load Google Fonts --> Begin */
WebFontConfig = {
		google: {families: ['PT+Sans+Narrow::latin','Oswald::latin','Nova+Square::latin','Lobster::latin']}
	  };
	  (function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('body')[0];
		s.appendChild(wf, s);
	  })();
/* Load Google Fonts --> End */



  
    
/*********************** DOM READY --> Begin ****************************/

jQuery(document).ready(function(){

/* Superfish Menu Plugin --> Begin */
	$('#navigation > ul').superfish({ 
		animation: {height:'show'},  
		delay:     1200   	// 1.2 second delay on mouseout 
	});
/* Superfish Menu Plugin  --> End */


/* Query data-rel to rel --> Begin */
	if ($("a[data-rel]").length) {
		$('a[data-rel]').each(function() {$(this).attr('rel', $(this).data('rel'));});
	}	
/* Query data-rel to rel --> End */	


/* Pics --> Begin */	
	if (jQuery(".pics").length) {
		jQuery('.pics').cycle({ 	
			fx:     'scrollHorz', 
			timeout: 0, 
			next:   '.next',
			prev:   '.prev',
			easing: 'easeOutQuint'
		});
	}
	if (jQuery(".single-pics").length) {
		jQuery('.single-pics').cycle({ 	
			fx:     'scrollHorz', 
			timeout: 0, 
			next:   '.next',
			prev:   '.prev',
			easing: 'easeOutQuint'
		});
	}
/* Pics --> End */


/* Tables --> Begin */
	var $table = $('table.feature-table', this);
	$('table.feature-table thead tr th:first-child').addClass('leftR');
	$('table.feature-table thead tr th:last-child').addClass('rightR');
		$table.find('tbody tr:odd').addClass('odd');
/* Tables --> End */


/* Scroll to Top --> Begin */
	$('a[href=#top]').click(function(){
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	});
/* Scroll to Top --> End */




/* Box close --> Begin */
	$notifications_collection = $('.success, .info, .error, .warning');
	$notifications_collection.append('<span class="close-box">&times;</span>').wrap('<div class="custom-box-wrap">');
	var closeBox = $('.close-box', this);
		closeBox.bind('click',function() {	
			var $this = $(this); 
			var box = $this.parent().parent('.custom-box-wrap');
			var boxChild = $this.parent('.box');
			box.animate({opacity:'0'},500, function() {
				box.animate({height:'0'},500);
				boxChild.animate({margin:'0'},400);
			});
		});
/* Box close --> End */


/* To top --> Begin */
    $BackTop = $('#back-top');
    var animating = false;
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100 && !animating) {
            $BackTop.fadeIn(1000);
        } else {
            $BackTop.fadeOut(1000);
        }
    });

    $('#back-top a').click(function () {
        $BackTop.fadeOut(400);
        animating = true;
        $('body,html').animate({
            scrollTop: 0
        }, 800, function() {
            animating = false;
        });
        return false;
    });
/* To top --> End */


/* Image wrapper --> Begin */
    function handle_image(img) {
        var $curtain = $('<span class="curtain">&nbsp</span>');
        img.after($curtain);        
    }
	
    $img_collection = $('.zoomer img, .workPanelLink img');
    $img_collection.each(function() {
        handle_image($(this));
    });
/* Image wrapper --> End */
	
	
/* Prepare loading fancybox --> Begin */
	if($('.zoomer').length) {
		jQuery('.zoomer').fancybox({
			'overlayShow'	: false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic'
		});
	}	
/* Prepare loading fancybox --> End */


/* Tabs --> Begin */
	var tabs1 = $('.tabs-1');
	var tabs2 = $('.tabs-2');
	var tabs3 = $('.tabs-3');
	
	$.fn.tabs = function(link) {
		$(link).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(link).find(".tab_container .tab_content:first").show(); //Show first tab content

		//On Click Event
		$(link).find('ul.tabs li').click(function() {

			$(link).find('ul.tabs li').removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			link.find('.tab_content').hide(); //Hide all tab content

			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn('normal'); //Fade in the active ID content
			return false;
		});
	}
	tabs1.tabs(tabs1);
	tabs2.tabs(tabs2);
	tabs3.tabs(tabs3);
/* Tabs --> End */




});/************** DOM READY --> End ***********************/


var topPanelHidden=true, topPanelShowing, hasClosed;
if(jQuery) (function($){

	$.fn.workPanel = function(params){
		var conf = $.extend({
			blockPanel:'#workPanel',
			blockHover:'img'
		}, params);
		return this.each(function(){
			var o=$(this),c=conf,targetPane=o.attr('href'),panel=$(c.blockPanel);

			o.bind('click', function(){
				if(topPanelHidden != true){
					o.removeClass('selected');
					panel.stop().animate({height:'0px',opacity:0},500);
					$('.workPanelContent').fadeOut(500);
					$('body').scrollTo({top:panel.offset().top, left:0}, 1000, {easing:'easeInOutCubic'});
					hasClosed=true;
				}
				if(topPanelShowing != targetPane || topPanelHidden == true){
					topPanelShowing=targetPane;
					o.addClass('selected');
					$('article'+targetPane).animate({opacity:1}, 500, function(){	
						$('article'+targetPane).fadeIn(500);
					});
					panel.stop().animate({height:'415px',opacity:1},500);
					$('body').scrollTo({top:panel.offset().top, left:0}, 1000, {easing:'easeInOutCubic'});
					hasClosed=false;
				}
				topPanelHidden = hasClosed;
				return false;
			});
		});
	}
})(jQuery);