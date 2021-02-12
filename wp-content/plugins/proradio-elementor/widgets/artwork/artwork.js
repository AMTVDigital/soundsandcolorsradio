( function( $ ) {
	var qtartworkInterval = false;
	var qtartworkCache = false;
	var qtcurrentImage = false;
	$('.qtmplayer__cover img').hide();
	var ProradioElementorArtwork = function( $scope, $ ) {
		try {
			if(qtartworkInterval){
				clearInterval(qtartworkInterval);
			}
			qtartworkInterval = setInterval(function(){
				if($('.qtmplayer__cover img').length > 0){

					qtcurrentImage = $('.qtmplayer__cover img').attr('src');
					if(qtcurrentImage !== qtartworkCache){
						qtartworkCache = qtcurrentImage;
					}
					if( qtartworkCache ){
						$('.proradio-elementor--artwork__img img').attr('src', qtartworkCache);
						$('.proradio-elementor--artwork__img').attr('href', qtartworkCache);
						$('.qtmplayer__cover img').show();
						$('.proradio-elementor--artwork').removeClass('proradio-hidden');
					} else {
						$('.qtmplayer__cover img').hide();
						$('.proradio-elementor--artwork').addClass('proradio-hidden');
					}
				}
				// console.log('art');
			},1000); // arbitrary delay for refresh to avoid js overload. 
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-artwork.default', ProradioElementorArtwork );
	} );
} )( jQuery );