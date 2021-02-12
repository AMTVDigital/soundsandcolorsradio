jQuery(document).ready(function($) {
	if($('#proradio-ajax-textarea').length > 0){
		wp.codeEditor.initialize($('#proradio-ajax-textarea'), cm_settings);
	}
})