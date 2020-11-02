( function( $ ) {
	var WidgetProradioElementorUpcomingShowsSlider = function( $scope, $ ) {
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
		}
		if(typeof( $.ProRadioMainObj ) !== 'object' ){
			console.log( 'Missing main theme script' );  
		}
		try {
			$.ProRadioMainObj.fn.owlCarousel();
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-upcoming-shows-slider.default', WidgetProradioElementorUpcomingShowsSlider );
	} );
} )( jQuery );