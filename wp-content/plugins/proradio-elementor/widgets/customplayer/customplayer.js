( function( $ ) {
	var ProradioElementorCustomPlayer = function( $scope, $ ) {
		try {
			var qtartworkInterval2 = false;
			var qtartworkCache2 = false;
			var qtcurrentImage2 = false;
			var qtart, qtimg;
			var customplayers = $('.proradio-customplayer');
			if(customplayers.length > 0){
				// Title
				if (typeof $.qtmplayerRadioFeedObj === 'object') {
					if (typeof $.qtPlayerObj.songdata !== 'undefined') {
						$.qtmplayerRadioFeedObj.fn.pushFeed( $.qtPlayerObj.songdata );
					}
				}
				// artwork
				var artworks = customplayers.find('.proradio-customplayer__art');
				if(artworks.length > 0){
					if(qtartworkInterval2){
						clearInterval(qtartworkInterval2); 
					}	
					qtart = $('.proradio-customplayer__art');
					qtimg = $('.proradio-customplayer__art img');
					qtartworkInterval2 = setInterval(function(){
						qtcurrentImage2 = $('.qtmplayer__cover img').attr('src');
						if(qtcurrentImage2 !== qtartworkCache2){ 
							qtartworkCache2 = qtcurrentImage2; 
						}
						if( qtartworkCache2 ){
							qtimg.attr('src', qtartworkCache2);
							qtart.attr('href', qtartworkCache2);
							qtimg.on('load', function(){
								qtart.removeClass('proradio-hidden');	
							})
						} else {
							qtart.addClass('proradio-hidden');
						}
					},1000); // arbitrary delay for refresh to avoid js overload. 
				}
			}
		} catch(e) {
			console.log(e);
		}
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-customplayer.default', ProradioElementorCustomPlayer );
	} );
} )( jQuery );