( function( $ ) {
	var ProradioElementorSectionCaption = function( $scope, $ ) {
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
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
					$('.proradio-anim').addClass('proradio-active');
				},
				800
			);
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-qt-caption.default', ProradioElementorSectionCaption );
	} );
} )( jQuery );