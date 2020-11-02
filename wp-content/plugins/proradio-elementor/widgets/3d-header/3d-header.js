( function( $ ) {
	var Widget3dHeaderHandler = function( $scope, $ ) {
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
				function(o){
					console.log( 'To do: reinit the 3d Header properly');

					// $.ProRadioMainObj.fn.qt3dHeader.init();
					// $.ProRadioMainObj.fn.countDown.init();
					$.ProRadioMainObj.fn.customStylesHead();
					$('.proradio-txtfx').addClass('proradio-active');
				},
				800
			);
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-3dheader.default', Widget3dHeaderHandler );
	} );
} )( jQuery );