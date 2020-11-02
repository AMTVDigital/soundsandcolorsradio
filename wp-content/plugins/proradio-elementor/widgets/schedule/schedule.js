( function( $ ) {
	var WidgetProradioElementorSchedule = function( $scope, $ ) {
		if(!$('#proradio-body').hasClass('elementor-editor-active')){
			return;
		}
		
		$.ProRadioMainObj.fn.tabsComponent();
		
	};
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/proradio-elementor-schedule.default', WidgetProradioElementorSchedule );
	} );
} )( jQuery );