// @codekit-prepend "swipebox/js/jquery.swipebox.js"
(function($){
	$.qtSwipeboxFunction = function(){
		$.qtSwipeboxEnable	= true; // this is for the main jquery file after ajax
		var linkstolink = $('.swipebox, .gallery a, a[href*=".jpg"], a[href*="youtube.com/watch"]:not(.qw_social), a[href*="youtu.be"]:not(.qw_social), a[href*="vimeo.com"]:not(.qw_social), a[href*="jpeg"], a[href*=".png"], a[href*=".gif"], .Collage a').not('.qt-popupwindow');
		linkstolink.each(function(){
			var thislink = $(this);
			$(this).swipebox({
				beforeOpen: function() {
					$.swipeboxState = 1;
				} // called before opening
			});
		});

	}
	$(window).on('load',function(){
		$.qtSwipeboxFunction();
		return;
	});
})(jQuery);