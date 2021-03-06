/**====================================================================
 *
 *  QT Ajax Page Loader main script
 *  @author ProRadio
 *  
 ====================================================================**/
(function($) {
	"use strict";
	var emergencyTimeout = false;
	$.ProradioAjaxPreloader = {
		init: function(){
			this.num = $('#proradio-ajax-num');
			this.progressBar = $('#proradio-ajax-progress');
			this.progressBar.css({'transform':'scaleX(0)'});
			this.mask = $('#proradio-ajax-mask');
			if(this.mask.hasClass('proradio-ajax-visible')){
				this.show();
				this.start();
			}
		},
		perc: 0,
		show: function(){
			this.mask.addClass("proradio-ajax-visible");
			var progressBar = this.progressBar;
			progressBar.animate({'transform':'scaleX(0)'}, 0 );
			this.perc = 0;
			this.num.html('0%');
			// this.num.fadeTo(1000,0.1);
		},
		start: function( container ){



			if('undefined' === typeof(container)){
				container = $('body');
			}
			var countImages = container.find('img').size();
			// var preloader = this;
			var countLoadedImages, perc = 0;
			var progressBar = this.progressBar;
			var num = this.num;
			var mask = this.mask;
			var size;
			
			num.html('0%');

			progressBar.animate({'transform':'scaleX(0)'}, 0, function(){
				progressBar.hide();
			});
			container.imagesLoaded().done(function(  ){

				// Emergency timeout
				emergencyTimeout = setTimeout(function(){
					mask.removeClass("proradio-ajax-visible"); // note
				}, 10000);
			}).progress( function( instance, image ) {
				if( emergencyTimeout ){
					clearTimeout( emergencyTimeout );
				}
				if( countImages > 0 ){
					progressBar.show();
					if(image.isLoaded) {
						$(image.img).addClass('proradio-ajax-loaded');
						countLoadedImages = container.find('img.proradio-ajax-loaded').size();
						perc = Math.ceil( countLoadedImages / countImages *  100 );
						if(perc > 100){
							perc = 100;
						}
						var counter = parseInt(  num.html() );
						var interval = setInterval(function(){
							counter = counter + 1;
							num.html( counter+'%' );
							size = counter/100;
							progressBar.css({'transform':'scaleX('+size+')'});
							if(counter == perc){
								if( perc == 100 ){
									setTimeout(function(){
										// num.fadeTo(50,0);
										progressBar.animate({'transform':'scaleX(0)'}, 0, function(){
											progressBar.hide();
										});
										setTimeout(function(){
											mask.removeClass("proradio-ajax-visible");// note
											if(emergencyTimeout){
												clearTimeout( emergencyTimeout );
											}
										}, 5);
									}, 5);
								}
								clearInterval(interval);
							}
						},3);
					}
				} else {
					num.html( '100%' );
					progressBar.css({'transform':'scaleX(1)'});
					setTimeout(function(){
						// num.fadeTo(70,0);
						progressBar.animate({'transform':'scaleX(0)'}, 0, function(){
							progressBar.hide();
						});
						setTimeout(function(){
							mask.removeClass("proradio-ajax-visible");// note
						}, 60);
					}, 60);
				}
			});

			// Fallback timeout
			var displayTimeout = false;
			if(displayTimeout){
				clearTimeout(displayTimeout);
			}
			displayTimeout = setTimeout(function(o){
				// num.fadeTo(100,0);
				progressBar.animate({'transform':'scaleX(0)'}, 0, function(){
					progressBar.hide();
				});
				setTimeout(function(){
					mask.removeClass("proradio-ajax-visible");// note
				}, 300);
			}, 6000); // 10 seconds timeout to remove the preloader
		}
	};

	



	/**
	 * [Main ajax initialization function]
	 */
	var qtAplSelector = "#proradio-ajax-master",
		qtAplMaincontent = $(qtAplSelector),
		atAplPreloader = $("#qtajaxpreloadericon");


	/**
	 * Normal loading fallback
	 */
	$.fn.qtAplFallbackLink = function(e, link, code){
		if(false !== e){
			return e;
		}
		if( link ){
			window.location.replace(link);
		}
	}



	/**
	 * [Before switching content let's scroll to top]
	 * @return {[bol]}
	 */
	$.fn.qtAplScrollTop = function(){
		$('html, body').animate({
			scrollTop: 0
		},100);
		return true;
	};

	// WPML exclusion
	$('.wpml-ls-item').on("click",'a', function(e) {
		$.fn.qtAplFallbackLink(e, $(this).attr('href'), '001');
		return e;
	});

	$.fn.qtAplInitAjaxPageLoad = function(){


		
		/**
		 * [Bind click function to all the links]
		 */
		$("body").off("click",'a').on("click",'a', function(e) {
			var that = $(this),
				href = $(this).attr('href');
			if(href === undefined){
				return e;
			}
			if(href === ""){
				return e;
			}

			/**
			 * Skip ajax for WooCommerce endpoints
			 */
			$.each( $('#qt-ajax-pageload-woocommerce-urls').data(), function(index,endpointUrl){
				if( href === endpointUrl ){
					return e;
				}
			});

			// Since 2019 04 18 + support internal links
			var pageURL = $(location).attr("href"),
				pageURL_array = pageURL.split('#'),
				pageURL_naked = pageURL_array[0],
				href_array = href.split('#'),
				href_naked = href_array[0];

			if(href_naked === pageURL_naked && href_array.length > 1 ) {
				return e;
			}


			/**
			 * [exceptions that will skip ajax loading]
			 */

			var qtAjaxpatt = /(\/respond|\/wp-admin|mailto:|\.zip|\.jpg|\.gif|\.mp3|\.pdf|\.png|\.rar|#noajax|noajax|download_file)/;
			if ( that.hasClass("ajax_add_to_cart") || that.parent().hasClass("noajax") || ( !href.match(document.domain) )  || that.attr("target") === '_blank' || that.hasClass("noajax") || that.attr("type") === 'submit' || that.attr("type") === 'button' || href.match(qtAjaxpatt) ) {
				return e;
			}

			
			if(href.match(document.domain) ){
				e.preventDefault();
				try {
					if (window.history.pushState) {
						var pageurl = href;
						if (pageurl !== window.location) {
							window.history.pushState({
							path: pageurl,
							state:'new'
							}, '', pageurl);
						}
					}
				} catch (e) {
					console.log (e);
				}
				
				/**
				 * Close the sidebar and player
				 */
				$("li.current_page_item").removeClass("current_page_item");
				that.closest("li").addClass("current_page_item");
				

				qtAplExecuteAjaxLink(href);
				qtAplMaincontent.fadeTo( 100 ,0, function() {
					 $.fn.qtAplScrollTop();
				});
			}
		});


		
		/**
		 * [ajax call]
		 * @param  {[text]} link [url to load]
		 * @return {[bol]}
		 */
		function qtAplExecuteAjaxLink(link){
			var docClass, parser;



			if( jQuery('#proradio-ajax-mask').hasClass( 'proradio-changeloader' ) ){
				$.ProradioAjaxPreloader.show();
			}

			$.ajax({
				url: link,
				success:function(data) {


					$.fn.qtAplScrollTop();

					/*
					*   Retrive the contents
					*/
				
					$.ajaxData = data;
					parser = new DOMParser();

					$.qtAplAjaxContents = $($.ajaxData).find(qtAplSelector).html();
					$.qtAplAjaxTitle = $($.ajaxData).filter("title").text();
					docClass = $($.ajaxData).filter("body").attr("class");
					$.qtAplBodyMatches = data.match(/<body.*class=["']([^"']*)["'].*>/);

					if(typeof($.qtAplBodyMatches) !== 'undefined' && $.qtAplBodyMatches !== null){
						docClass = $.qtAplBodyMatches[1];
					}else{
						$.fn.qtAplFallbackLink(false, link, '002');
						return;
					}

					// New method better working: 
					var modifiedAjaxResult = data.replace(/<body/i,'<div id="re_body"').replace(/<\/body/i,'</div'),
						bodyClassesNew = $(modifiedAjaxResult).filter("#re_body").attr("class"),
						//20190527
						//Custom css change id
						js_composer_front_css= $(modifiedAjaxResult).filter('#js_composer_front-inline-css').text();

					if(bodyClassesNew){
						docClass = bodyClassesNew;
					}

					// since 2.2 checkbox skip
					if(  bodyClassesNew.indexOf("proradio-ajax-skip") > 0 ){
						$.fn.qtAplFallbackLink(false, link, '003');
						return;
					}

					$.wpadminbar = $($.ajaxData).filter("#wpadminbar").html(); 
					$.visual_composer_styles = $($.ajaxData).filter('style[data-type=vc_shortcodes-custom-css]').text();					
					/**
					 * [if we have WPML plugin language selector]
					 */
					if($("#qwLLT")){
						$.langswitcher = $($.ajaxData).find("#qwLLT").html(); 
					}

					/*
					*   Start putting the data in the page
					*/
					
					if(docClass !== undefined && $.qtAplAjaxContents !== undefined){
					 
						$("body").attr("class",docClass);
						$("title").text($.qtAplAjaxTitle);
						$("#wpadminbar").html($.wpadminbar);
						$("#qwLLT").html($.langswitcher);

						if($("style[data-type=vc_shortcodes-custom-css]").length > 0){
							$("style[data-type=vc_shortcodes-custom-css]").append($.visual_composer_styles);
						} else {
							$("head").append('<style type="text/css"  data-type="vc_shortcodes-custom-css">'+$.visual_composer_styles+'</style>');
						}

						// 2019 may 27 js composer update css
						if( js_composer_front_css != '' && js_composer_front_css != false && js_composer_front_css != undefined ){
							if($("style#js_composer_front-inline-css").length > 0){
								$("style#js_composer_front-inline-css").html(js_composer_front_css);
							} else {
								$("head").append('<style id="js_composer_front-inline-css">'+js_composer_front_css+'</style>');
							}
						} else {
							$("head style#js_composer_front-inline-css").remove();
						}
						
						qtAplMaincontent.html( $.qtAplAjaxContents ).delay(100).promise().done(function(){
							var scripts = qtAplMaincontent.find("script");
							if(scripts.length > 0){
								scripts.each(function(){
									var code = $(this).html();
									code = '('+code+')'; // not really needed
									try{
										eval($(this).html());
									} catch(e){
										console.log(e);
									}
								});	
							}

							if(true === $.ProRadioMainObj.fn.initializeAfterAjax()){
								qtAplMaincontent.fadeTo( "fast" ,1).promise().done(function(){
									// After reloading we scroll till the place of the anchor
									// Since 2019 04 18 + support internal links
									var link_array = link.split('#');
									if( link_array.length > 1){
										var targetDiv = $('#'+link_array[1] );
										if( targetDiv.length > 0 ){
											var point = targetDiv.offset().top;
											$('html, body').animate(
												{
												  scrollTop: point
												},
												400
											  );
											 return;
										}
									}
								});

								/**
								 * @since  2.4
								 * Execute custom javascript
								 */
								$.getScript(  $('#qt-ajax-customscript-url').data('customscripturl') ) 
									.done(function( script, textStatus ) {}) 
									.fail(function( jqxhr, settings, exception ) {});

								
								/**
								 * @since  3.1
								 * Load all elementor scripts
								 */
								$.targetScripts = $($.ajaxData).filter('script');
								if( $.targetScripts.length > 0){

									var jsurl;
									$.each( $.targetScripts, function(index,item){
										jsurl = $(item).attr('src');
										if (/elementor\/assets/i.test( jsurl )){
											$.getScript(  jsurl );
										}
									});
								}
								/**
								 * @since  3.0
								 * Load all Elementor styles
								 */
								$.targetStyles = $($.ajaxData).filter("link[rel='stylesheet']");
								if( $.targetStyles.length > 0){
									var cssurl;
									$.each( $.targetStyles, function(index,item){
										cssurl = $(item).attr('href');
										if(jQuery("link[href*='"+cssurl+"']").length == 0 ){
											$('head').append('<link rel="stylesheet" id="'+$(item).attr('id')+'" href="'+cssurl+'" media="'+$(item).attr('media')+'">');
										}
									});
								}
								// Reinitialize elementor scripts
								if (typeof window.elementorFrontend === 'object') {
									elementorFrontend.init();
								} else {
									console.log('Ajax Page Load notice: Not possible to reinit');
								}

								/**
								 * @since  2.4
								 * Reload woocommerce scripts
								 */
								$.each( $('#qt-ajax-pageload-woocommerce-scripts').data(), function(index,scriptUrl){
									$.getScript(scriptUrl);
								});


								if (typeof $.qtmplayerRadioFeedObj === 'object') {
									if (typeof $.qtPlayerObj.songdata !== 'undefined') {
										$.qtmplayerRadioFeedObj.fn.pushFeed( $.qtPlayerObj.songdata );
									}
								}


								/**
								 * All done! If images are all loaded, show the content                                                                                                                                                 [description]
								 */
								if( jQuery('#proradio-ajax-mask').hasClass( 'proradio-changeloader' ) ){
									$.ProradioAjaxPreloader.start( qtAplMaincontent ); // qtAplMaincontent = container to check where images are loaded
								}							
							}else{
								$.fn.qtAplFallbackLink(false, link, '004');
								return;
							}
						});   

					}else{
						$.fn.qtAplFallbackLink(false, link, '005');
						return;
					}
				},
				error: function () {
					//Go to the link normally
					$.fn.qtAplFallbackLink(false, link, '006');
					return;
				}
			});
			return true;
		}
		/**
		 * Manage browser back and forward arrows
		 */
		$(window).on("popstate", function(e) {
			var href;
			if (e.originalEvent.state !== null) {
				href = location.href;
				if(href !== undefined){
					if (!href.match(document.domain))    {
						$.fn.qtAplFallbackLink(false, link, '006');
						return;
					} else {
						qtAplMaincontent.fadeTo( "fast" ,0, function() {
							$.fn.qtAplScrollTop();
						}).promise().done(function(){
							qtAplExecuteAjaxLink(href);
						});
					}
				}
			} else {
				href = location.href;
				if(href !== undefined){

					if (!href.match(document.domain)){
						$.fn.qtAplFallbackLink(false, href, '007');
						return;
					} else {

						// Since 2019 04 18 + support internal links
						var pageURL = $(location).attr("href"),
							pageURL_array = pageURL.split('#'),
							pageURL_naked = pageURL_array[0],
							href_array = href.split('#'),
							href_naked = href_array[0];
						if(href_naked === pageURL_naked) {
							if( undefined !== href_array[1]){
								var targetDiv = $('#'+href_array[1] );
								if( targetDiv.length > 0 ){
									var point = targetDiv.offset().top;
									e.preventDefault();
									$('html, body').animate(
										{
										  scrollTop: point,
										},
										1500
									  );
									 return false;			

									// return e;
								} else {
									return e;
								}
							}
						}
						qtAplMaincontent.fadeTo( "fast" ,0, function() {
							$.fn.qtAplScrollTop();
						}).promise().done(function(){
							qtAplExecuteAjaxLink(href);
						});
					}
								
				}
			}
		});
	}; // $.fn.qtAplInitAjaxPageLoad

	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 	This needs to call only $.fn.qtInitTheme
	 * 
	 ====================================================================*/
	jQuery(document).ready(function() {
		$.fn.qtAplInitAjaxPageLoad();		
		$.ProradioAjaxPreloader.init();
	});

})(jQuery);
