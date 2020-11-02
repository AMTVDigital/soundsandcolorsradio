( function( $ ) {
	var WidgetProradioElementorSponsors = function( $scope, $ ) {
		// console.log('Initialize sponsors carousel Elementor');
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
		}
		if(typeof( $.ProRadioMainObj ) !== 'object' ){
			console.log( 'Missing main theme script' );  
		}
		if($('#proradio-body').hasClass('elementor-editor-active')){
			try {
				$.ProRadioMainObj.fn.owlCarousel();

			} catch(e) {
				console.log(e);
			}
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-sponsors.default', WidgetProradioElementorSponsors );
	} );
} )( jQuery );