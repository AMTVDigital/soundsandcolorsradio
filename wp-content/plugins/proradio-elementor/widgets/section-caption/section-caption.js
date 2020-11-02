/* jshint unused:false */
/*globals snabbt */
( function( $ ) {
	var ProradioElementorSectionCaption = function( $scope, $ ) {
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
		}
		if(typeof( $.ProRadioMainObj ) !== 'object' ){
			console.log( 'Missing main theme script' );  
		}
		try {

			if('undefined' !== typeof(timeout) ){
				clearTimeout(timeout);					
			} else {
				var timeout = false;
			}
			timeout = setTimeout(
				function(){
					$.ProRadioMainObj.fn.customStylesHead();
					$('.proradio-txtfx').addClass('proradio-active');
					$('.proradio-anim').addClass('proradio-active');
				},
				800
			);
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-section-caption.default', ProradioElementorSectionCaption );
	} );
} )( jQuery );