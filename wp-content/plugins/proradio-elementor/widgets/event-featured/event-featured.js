( function( $ ) {
	var WidgetProradioElementorEventFeaturedHandler = function( $scope, $ ) {
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
		}
		if(typeof( $.ProRadioMainObj ) !== 'object' ){
			console.log( 'Missing main theme script' );  
		}
		try {
			$.ProRadioMainObj.fn.countDown.init();
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-event-featured.default', WidgetProradioElementorEventFeaturedHandler );
	} );
} )( jQuery );