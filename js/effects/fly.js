// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Last updated: 2011-10-27
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
function ws_fly(c,a,b){var d=jQuery;b.css("overflow","visible");a.each(function(e){if(!e){d(this).show()}else{d(this).hide()}});this.go=function(e,i,f){var g=0;if(f){if(f>=1){g=1}if(f<=-1){g=0}}var k=(g?1:-1)*c.width/4;var j=d(a.get(e));j.stop(1,1);j.css({opacity:"hide",left:k,"z-index":3});j.animate({opacity:"show"},{duration:c.duration,queue:false});j.animate({left:0},{duration:2*c.duration/3,queue:false});var h=d(a.get(i));setTimeout(function(){h.animate({left:-k,opacity:"hide"},2*c.duration/3,function(){h.css("left",0);j.css({"z-index":"",opacity:1})})},c.duration/3);return e}};// -----------------------------------------------------------------------------------
// http://wowslider.com/
// JavaScript Wow Slider is a free software that helps you easily generate delicious 
// slideshows with gorgeous transition effects, in a few clicks without writing a single line of code.
// Last updated: 2011-10-27
//
//***********************************************
// Obfuscated by Javascript Obfuscator
// http://javascript-source.com
//***********************************************
jQuery("#wowslider-container1").wowSlider({effect:"fly",prev:"",next:"",duration:10*100,delay:50*100,outWidth:998,outHeight:480,width:998,height:480,autoPlay:true,stopOnHover:false,loop:false,bullets:true,caption:true,controls:true});