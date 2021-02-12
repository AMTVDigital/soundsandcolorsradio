( function( $ ) {
	var WidgetProradioElementorRadiofeed = function( $scope, $ ) {
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
		}
		if(typeof( $.qtmplayerRadioFeedObj ) !== 'object' ){
			console.log( 'Missing player script' );  
		}
		try {
			if (typeof $.qtmplayerRadioFeedObj === 'object') {
				if (typeof $.qtPlayerObj.songdata !== 'undefined') {
					$.qtmplayerRadioFeedObj.fn.pushFeed( $.qtPlayerObj.songdata );
				}
			}
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-radiofeed.default', WidgetProradioElementorRadiofeed );
	} );
} )( jQuery );