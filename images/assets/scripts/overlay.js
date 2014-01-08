
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ( $(window).height() - this.height() ) / 2 + $(window).scrollTop() + "px");
    this.css("left", ( $(window).width() - this.width() ) / 2 + $(window).scrollLeft() + "px");
    return this;
}

var loadingDivObj = null;
$(function() { 
	initOverlay();
});

function initOverlay()
{
	if(document.getElementById("overlay_div"))
	{
		loadingDivObj = $('#overlay_div'); //overlay_div
		$(loadingDivObj).css("width",  $(document).width()   + "px");
		$(loadingDivObj).css("height",  $(document).height()  + "px");
		
		//$(".overlay #loading_div").center();

	}
}

function showOverlay()
{
	$(loadingDivObj).fadeIn();
	$(".overlay_loading_div").show();
	
}

function hideOverlay()
{
	$(".overlay_loading_div").hide();
	$(loadingDivObj).fadeOut();
}


