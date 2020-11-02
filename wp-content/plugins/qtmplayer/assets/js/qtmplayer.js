/** @license
 *
 * ProRadio Music Player: JavaScript player with audio analyzer
 * ----------------------------------------------
 * http://proradio.com/
 *
 * Copyright (c) 2020, ProRadio / Igor Nardo. All rights reserved.
 * This software cna be used only within our products. It can't be edited or modified for reuse under other projects.
 * Cannot be re-sold or embedded in other products for sale.
 *
 */


// IMPORTANT: THE FOLLOWING IS NOT A COMMENT! IT IS JAVASCIPT IMPORTING! DO NOT DELETE
// ===================================================================================
// @codekit-prepend "../components/jquery.marquee.js"
// @codekit-prepend "../components/raphael/raphael.min.js"
// @codekit-prepend "../soundmanager/script/soundmanager2-nodebug-jsmin.js"
// @codekit-prepend "qtmplayer-smpo.js"
// @codekit-prepend "qtmplayer-radiofeed.js"

// Not required			codekit-prepend "qtmplayer-webapiplayer.js"

(function($){
	var qtAnalyzer  = $('#qtmplayer').data('analyzer'); // disable webaudio
	var qtInitialized = false;
	var qtPlayIsAllowed = false;
	var qtShowPlayer  = $('#qtmplayer').data('showplayer'); // disable webaudio

	if( /MSIE|Edge|Trident/i.test(navigator.userAgent) || ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) ){
		qtAnalyzer = 0;
	}

	function qtMplayer_filename(path){
	    path = path.substring(path.lastIndexOf("/")+ 1);
	    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
	}
	$.qtMplayerPlaylistCue = {
		minicue: false,
		tadv: false,
		init: function(){
			$.qtMplayerPlaylistCue.destroy();
			var item, offset, width,left,
				minicue, det;;
			item = $("li.qtmplayer-played");
			if(item.length > 0){
				offset = item.offset().left;
				width =  item.width();
				left = 0;
				item.append('<div id="qtMplayerPlaylistTrack" class="qtmplayer-playlist__track"><span id="qtMplayerPlaylistTrackAdv" data-qtmplayer-trackadv class="qtmplayer-track-adv qtmplayer-content-accent"></span><span id="qtMplayerPlaylistMinicue" class="qtmplayer-playlist-minicue"></span></div>');
				$.qtMplayerPlaylistCue.minicue = $("#qtMplayerPlaylistMinicue");
				$.qtMplayerPlaylistCue.tadv = $("#qtMplayerPlaylistTrackAdv");
				det = $("#qtMplayerPlaylistTrack");
				det.off("mousemove").off("click");
				det.on("mousemove", function(e){
					left = e.clientX - offset;
					$.qtMplayerPlaylistCue.minicue.css({'left': left});
				});
				det.on("click", function(e){
					$.qtPlayerObj.uniPlayer.seek((e.clientX - offset) / width * 100);
				});
			}
		},
		update:function(p){
			if($.qtMplayerPlaylistCue.tadv){
				$.qtMplayerPlaylistCue.tadv.css({"width": p+'%'});
			}
			if($.qtMplayerPlaylistCue.minicue){
				// $.qtMplayerPlaylistCue.minicue.css({"left": p+'%'});
			}
		},
		destroy: function(){
			$("#qtMplayerPlaylistTrack").remove();
		}
	};

	/**
	 * ===========================================================================
	 * Circle for podcast
	 * @type {Object}
	 * ===========================================================================
	 */
	$.qtRaphaelCircle = {
		container: $(".qtmplayer-circularplayer"),
		findXY: function(obj) {
			var curleft = 0, curtop = 0;
			do {
				curleft += obj.offsetLeft;
				curtop += obj.offsetTop;
			} while (!!(obj = obj.offsetParent));
			return [curleft,curtop];
		},
		getScrollLeft: function() {
			return ($('body').scrollLeft+document.documentElement.scrollLeft);
		},
		getScrollTop: function() {
			return ($('body').scrollTop+document.documentElement.scrollTop);
		},
		init: function(){
			var RC = $.qtRaphaelCircle,
				rcontainer = $("#qtdonut"),
				
				cH = rcontainer.height(),
				cW = rcontainer.width(),
				R = cH / 2;
			RC.destroy();
			rcontainer.find("svg").remove();
			RC.R = R;
			var archtype = new Raphael("qtdonut", cW, cH);
			archtype.customAttributes.arc = function (xloc, yloc, value, total, R) {
				var alpha = 360 / total * value,
					a = (90 - alpha) * Math.PI / 180,
					x = xloc + R * Math.cos(a),
					y = yloc - R * Math.sin(a),
					path;
				if (total === value) {
					path = [
						["M", xloc, yloc - R],
						["A", R, R, 0, 1, 1, xloc - 0.01, yloc - R]
					];
				} else {
					path = [
						["M", xloc, yloc - R],
						["A", R, R, 0, +(alpha > 180), 1, x, y]
					];
				}
				return {
					path: path
				};
			};
			var my_arc = archtype.path().attr({
				"stroke": "#fff",
				"stroke-width": '16px',
				arc: [0, 0, 0, 0, 0]
			});
			RC.arc = my_arc;
			RC.container = rcontainer;
			var	uA = navigator.userAgent,
				isOpera = (uA.match(/opera/i)),
				isChrome = (uA.match(/chrome/i)),
				isTouchDevice = (uA.match(/ipad|iphone/i)),
				fullCircle = (isOpera||isChrome?359.9:360),
				angle, offl, offt,
				dx,dy,coords, perc;

			rcontainer.on('click','svg',function(e){
				e = e?e:window.event;
				if (isTouchDevice && e.touches) {
					e = e.touches[0];
				}
				if (e.pageX || e.pageY) {
					coords = [e.pageX,e.pageY];
				} else if (e.clientX || e.clientY) {
					coords = [e.clientX+RC.getScrollLeft(),e.clientY+RC.getScrollTop()];
				}
				offl = rcontainer.offset().left;
				offt = rcontainer.offset().top - $(window).scrollTop() ;
				dx = e.clientX -  (offl + (cW / 2));
				dy = e.clientY -  (offt + (cH / 2));
				angle = Math.floor(fullCircle-(  (Math.atan2(dx,dy) * 180/Math.PI )  +180));
				perc = angle/fullCircle * 100;
				$.qtPlayerObj.uniPlayer.seek(perc);
			});
			rcontainer.addClass("active");
		},
		update: function(p){
			var RC = $.qtRaphaelCircle,
				R = RC.R;
			if(typeof(p) === 'undefined' || typeof(RC.arc) === 'undefined' ){
				return;
			}
			if(isNaN(p)){
				return;
			}
			RC.arc.animate({
				arc: [R, R, p*100, 100, R]
			}, 2, "ease");
		},
		destroy: function(){
			var RC = $.qtRaphaelCircle;

			if(typeof(RC.arc) !== 'undefined'){
				RC.arc.remove();
				RC.container.removeClass('active');
			}
			if(typeof(RC.container) !== 'undefined'){
				RC.container.removeClass('active');
			}
		}
	};


	$.qtPlayerObj = {
		isSoundApi: false,
		uniPlayer: {
			btnPlay: $("[data-qtmplayer-playbtn]"), //btnPlay: $("#qtmplayerPlay"),
			canMoove: true,
			pause: function(){
				// qtmplayer-radiofeed.js
				if('object' === typeof($.qtmplayerRadioFeedObj)){ // check if the file is loaded
					$.qtmplayerRadioFeedObj.fn.stopFeed();
				}
				$.qtPlayerObj.interface.justStop();
				if( 'radio' === $.qtPlayerObj.songdata.type ){
					// With this, after pausing from the bar, music can't restart
					$.qtPlayerObj.songdata.file_hold = $.qtPlayerObj.songdata.file; // Store stream in a temorary object
					$.qtPlayerObj.songdata.file = 'file_hold'; // replace stream with a string to block it
					if($.qtPlayerObj.isSoundApi === true){
						$.qtWebApiPlayer.stop();
					} else {
						$.qtSMPO.smStop();
					}

				} else {
					if($.qtPlayerObj.isSoundApi === true){
						$.qtWebApiPlayer.pause();
					} else {
						$.qtSMPO.smPause();
					}
				}
			},
			webapiPlay: function(){
				$.qtWebApiPlayer.play($.qtPlayerObj.songdata.file);
				$.qtPlayerObj.interface.doSpinner(false);
			},
			radioFeedCallback:function( feedImageUrl ){
				var fallback = $.qtPlayerObj.imgCover.attr('data-fallback');
				if(undefined !== feedImageUrl){
					$.qtPlayerObj.imgCover.attr('src', feedImageUrl).show();
				} else {
					if(fallback) {
						$.qtPlayerObj.imgCover.attr('src', fallback).show();
					} else {
						$.qtPlayerObj.imgCover.hide();
					}
				}
			},
			play: function(){
				// $.qtPlayerObj.songdata.callBack = false;
				// if( $.qtPlayerObj.interface.artwork ){
				// 	$.qtPlayerObj.imgCover = $.qtPlayerObj.interface.controls.find('.qtmplayer__cover img');
				// 	var original = $.qtPlayerObj.imgCover.attr('src');
				// 	if( original ){
				// 		$.qtPlayerObj.imgCover.attr('data-fallback', original);
				// 	}

				// 	$.qtPlayerObj.interface.controls.find('.qtmplayer__cover img').attr('data-fallback', original);
				// 	$.qtPlayerObj.songdata.callBack = this.radioFeedCallback;
				// }
				// qtmplayer-radiofeed.js
				// if('object' === typeof($.qtmplayerRadioFeedObj)){ // check if the file is loaded
				// 	if( 'radio' === $.qtPlayerObj.songdata.type ){
				// 		// $.qtmplayerRadioFeedObj.fn.pushFeed( $.qtPlayerObj.songdata );
				// 	} else {
				// 		$.qtmplayerRadioFeedObj.fn.stopFeed();
				// 	}
				// }

				if ($.qtPlayerObj.uniPlayer.btnPlay.find("i").html() === 'pause') {
					return;
				}
				if(qtInitialized && qtPlayIsAllowed){
					$.qtPlayerObj.uniPlayer.btnPlay.find("i").html("pause");
					if($.qtPlayerObj.isSoundApi === true){
						$.qtWebApiPlayer.play($.qtPlayerObj.songdata.file);
					} else {
						if( 'radio' === $.qtPlayerObj.songdata.type && 'file_hold' === $.qtPlayerObj.songdata.file ){
							$.qtPlayerObj.songdata.file = $.qtPlayerObj.songdata.file_hold;
						}
						$.qtSMPO.smPause();
						$.qtSMPO.smPlay();
					}
				}
			},
			seek: function(p){ // p = percentage
				if(isNaN(p)){
					return;
				}
				p = parseFloat(p);
				if(p > 100){
					p = 100;
				}
				if($.qtPlayerObj.isSoundApi === true){
					$.qtWebApiPlayer.seek(p);
				} else {
					$.qtSMPO.smSeek(p);
				}
			},
			seekTime: function(t){
				if(t === '00:00'){
					t = '00:00:00';
				}
				if($.qtPlayerObj.isSoundApi === true){
					$.qtWebApiPlayer.seekTime(t);
				} else {
					$.qtSMPO.smSeekTime(t);
				}
			},
			setVolume: function(v){
				if($.qtPlayerObj.isSoundApi === true){
					$.qtWebApiPlayer.setvolume(v / 100);
				} else {
					$.qtSMPO.sm.setVolume(v);
				}
			}
		},


		/**
		 * ================================================================
		 * 
		 * [interface functions controlling interaction and visual feedback]
		 * @type {Object}
		 *
		 * ================================================================ 
		 */
		interface: {
			window: $(window),
			body: $("body"),
			htmlAndbody: $('html,body'),
			player: $('#qtmplayer'),
			controls: $('#qtmplayer-controls'),
			qtmplayer: $('#qtmplayer-playlistcontainer'),
			playlist: $("#qtmplayer-playlist ul"),
			grooveadv:  $('#qtMplayerTadv'), // music cue
			buffer:  $('#qtMplayerBuffer'), // buffer
			progWave:  $('#qtMplayerprogWave'), // buffer
			advance: $("#qtMplayerTadv"),
			btnPlay: $("[data-qtmplayer-playbtn]"), // $("#qtmplayerPlay"),
			control: $("#qtmplayerTrackControl"),
			minicue: $("#qtMplayerMiniCue"),
			minicueT: $("#qtMplayerPlaylistTrackMinicue"),
			trackAdvance: $("#qtmplayerTrackAdv"),
			time: $("#qtmplayerTime"),
			autoplay: $('#qtmplayer').data('autoplay'),
			artwork: $('#qtmplayer').data('artwork'),
			dragging: false,
			vdragging: false,
			debug: function(msg){
				$("#qtmplayerDebug").prepend(msg+'<br>');
			},
			doSpinner: function(state, content){
				var notif = $('[data-qtmplayerNotif]');
				notif.html(content);
				if( true === state ){ 
					notif.addClass("active qtmplayer-spinner"); 
				} else {
					notif.removeClass("active").removeClass("qtmplayer-spinner"); 
				}
			},
			preloadTrack: function(){
				var p = $.qtPlayerObj,
					i = p.interface;
				i.playlist.find("li:first-child .qtmplayer-play-btn").each(function(i,c){
					var trk = $(c),
						q = 'qtmplayer-';

					// 2019 12 29 update: reduced mapping
					p.songdata = {};
					$.each(trk.data() , function(i,c){
						var newKey = i.replace("qtmplayer", "").toLowerCase();
						p.songdata[newKey] = c;
					});


					$('.qtmplayer-played').removeClass('qtmplayer-played');
					trk.closest(".qtmplayer-trackitem").addClass("qtmplayer-played");
					var c = $.qtPlayerObj.interface.controls,
						ot = false;
					if(qtShowPlayer){
						p.interface.showhide();
					}

					

					// if(qtShowPlayer){
					// 	c.addClass('open');
					// 	ot = setTimeout(function() {
					// 		c.removeClass('open');
					// 		clearTimeout(ot);
					// 	}, 4000);
					// }


					if(p.interface.deployTrack()){

						
						
						// Autoplay:If google allows
						if(p.interface.autoplay){
							setTimeout(
								p.uniPlayer.play, 
								2200
							);
						}
					}
				});
			},

			isMobile: function(){
				return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $.ProRadioMainObj.window.width() < 1170 ;
			},


			deployTrack: function(autoplay){
				var o = $.qtPlayerObj,
					i = o.interface,
					hd = i.controls,
					dt = o.songdata,
					mp = i.qtmplayer,
					durtime = $("#qtmplayerDuration"),
					cartlink,
					cartbt = hd.find('.qtmplayer__cart'),
					cur_url = window.location.href,
					wc_params = '',
					wc_classes = '',
					params, // for URL
					params_str; // for URL
				if(dt.file == ''){
					return;
				}
				if( 'radio' === dt.type ){
					i.minicue.hide();
					i.buffer.hide();
					i.trackAdvance.hide();
					durtime.hide();
					 $('#qtmplayerTrackControl canvas').remove();
					if( $.qtmplayerRadioFeedObj ){
						$.qtPlayerObj.songdata.callBack = false;
						if( $.qtPlayerObj.interface.artwork ){
							$.qtPlayerObj.imgCover = $.qtPlayerObj.interface.controls.find('.qtmplayer__cover img');
							var original = $.qtPlayerObj.imgCover.attr('src');
							if( original ){
								$.qtPlayerObj.imgCover.attr('data-fallback', original);
							}
							$.qtPlayerObj.interface.controls.find('.qtmplayer__cover img').attr('data-fallback', original);
							$.qtPlayerObj.songdata.callBack = $.qtPlayerObj.uniPlayer .radioFeedCallback;
						}
						$.qtmplayerRadioFeedObj.fn.pushFeed( $.qtPlayerObj.songdata );
					}
				} else {
					if( $.qtmplayerRadioFeedObj ){
						$.qtmplayerRadioFeedObj.fn.stopFeed();
					}

					i.minicue.show();
					i.buffer.show();
					i.trackAdvance.show();
					durtime.show();
					if( false === i.isMobile() ){
						var comp = new RegExp(location.host);
						try {
							if(comp.test( dt.file ) ){
								drawAudio(dt.file);
							} else {
								$('#qtmplayerTrackControl canvas').remove();
							}
						} catch(e){
							
							console.log(e);
						}
					}
				}


				if( dt.link !== ''){
					hd.find('.qtmplayer__title').html('<a href="'+dt.link+'"><strong>'+dt.title+'</strong></a> ');
				} else {
					hd.find('.qtmplayer__title').html(dt.title);
				}


				hd.find('.qtmplayer__artist').text(dt.artist);
				if(typeof( dt.album ) !== 'undefined' && dt.album !== ''){
					hd.find('.qtmplayer__title').append('['+dt.album+']');
				}
				hd.find('.qtmplayer__cover').attr("href", dt.link);
				// WooCommerce support added
				cartbt.addClass('qtmplayer__disabled');
				if(dt.buylink !== ''){

					cartbt.removeClass('qtmplayer__disabled');
					// WooCommerce
					cartlink = dt.buylink;
					if('undefined' !== typeof( dt.buylink )) { 
						dt.buylink = dt.buylink.toString(); 
						if (dt.buylink.match(/^-?\d+$/)) { // is a numeric ID
							params = { "add-to-cart":dt.buylink };
							params_str = jQuery.param( params );
							if(cur_url.indexOf('?') != -1) {
								cartlink = cur_url+"&"+params_str;
							}else{
								cartlink = cur_url+"?"+params_str;
							}
							// Extra cart classes and attrs
							wc_classes = ' product_type_simple add_to_cart_button ajax_add_to_cart ';
							cartbt.attr("href", cartlink).attr('data-quantity','1').attr('data-product_id', dt.buylink).addClass(wc_classes).show();
						} else {
							cartbt.attr("href", dt.buylink).removeClass('product_type_simple').removeClass('add_to_cart_button').removeClass('ajax_add_to_cart').show();

						}
					}
				} else {
					cartbt.removeClass('product_type_simple').removeClass('add_to_cart_button').removeClass('ajax_add_to_cart');
				}

				if(dt.icon == 'download') {
					dt.icon = 'file_download';
				} 
				if(dt.buylink == ''){
					cartbt.hide();
				} else {
					cartbt.show();
				}

				cartbt.find('i').html(dt.icon);

				i.advance.width(0);
				i.buffer.width(0);
				if(dt.cover !== '' && dt.cover !== undefined){
					mp.find('.qtmplayer__album img').attr("src", dt.cover).show();
					hd.find('.qtmplayer__cover img').attr("src", dt.cover).show();
					hd.find('.qtmplayer__bgimg').css({"background-image": 'url('+dt.cover+')' });
				} else {
					mp.find('.qtmplayer__album img').hide();
					hd.find('.qtmplayer__cover img').hide();
					hd.find('.qtmplayer__bgimg').css({"background-image": 'none' });
				}
				mp.find('.qtmplayer-albumlink').attr("href",dt.link);
				if(qtShowPlayer){
					i.showhide();
				}
				i.btnPlayClick();
				i.playTrack();
				if(autoplay){
					o.uniPlayer.play();
				}
				return true;
			},
			btnPlaySetup: function(dt){
				var state = 'pause', 
					o = $.qtPlayerObj,
					i = o.interface,
					b = i.btnPlay,
					p = o.uniPlayer;

				b.off("click");
				b.on("click", function(e){
					e.preventDefault();
					state = b.find("i").html();
					if(state === 'pause'){
						$(".qtmplayer-played .qtmplayer-play-btn").click();
					} else {
						$('#qtmplayer-playlist li:first-child').find(".qtmplayer-play-btn").click();
					}
				});
			},
			/**
			 * Questa funzione è probabilmente inutile adesso
			 */
			btnPlayClick: function(){
				var state = 'pause', 
					o = $.qtPlayerObj,
					i = o.interface,
					b = i.btnPlay,
					p = o.uniPlayer;
				b.off("click");
				b.on("click", function(e){
					e.preventDefault();
					state = b.find("i").html();
					if(false == qtInitialized){
						i.initializeAudio();
						setTimeout(
							p.play, 
							200
						);
					} else {
						if(state === 'pause'){
							p.pause();
						} else {
							qtPlayIsAllowed = true;
							p.play();
						}
					}
					return true;
				});
			},
			playTrack: function(){
				var p = $.qtPlayerObj,
					i = p.interface,
					u = p.uniPlayer;
				i.body.off("click", ".qtmplayer-play-btn");
				i.body.on("click", ".qtmplayer-play-btn", function(e){
					e.preventDefault();					
					qtPlayIsAllowed = true;
					var tr = $(this),
						item = tr.closest(".qtmplayer-trackitem"),
						isDonut = item.hasClass("qtmplayer-donut"),
						icon = tr.find("i"),
						clickedsong = tr.attr('data-qtmplayer-file'),
						playedclass = "qtmplayer-played",
						playedtrack = i.body.find("."+playedclass),
						iplay =  "dripicons-media-play",
						ipause = "dripicons-media-pause";
					

					if(item.hasClass(playedclass) && tr.find('i').html() === 'pause'){
						i.switchicon(icon, 'play');
						item.removeClass(playedclass);
						i.switchicon(playedtrack.find('.qtmplayer-play-btn i'), 'play');
						u.pause();
						e.stopPropagation();
						return;
					} else {
						// Check if is the same track. If yes pause, if not stop the first play the second
						// update 2019 05 22
						if(clickedsong === p.songdata.file) {
							if(playedtrack.length > 0){

								if(p.uniPlayer.btnPlay.find("i").html() === 'pause'){
									playedtrack.removeClass(playedclass);
									i.switchicon(playedtrack.find('.qtmplayer-play-btn i'), 'play');
									u.pause();
									e.stopPropagation();
									return;
								} else {
									u.pause();
									i.switchicon(playedtrack.find('.qtmplayer-play-btn i'), 'play');
									playedtrack.removeClass(playedclass);
								}

							}
						} else {
							i.switchicon(playedtrack.find('.qtmplayer-play-btn i'), 'play');
							playedtrack.removeClass(playedclass);
							i.justStop();
							u.pause();
						}
					

						if( undefined === tr.data("qtmplayer-type") ){
							tr.data("qtmplayer-type", 'track');
						}


						// 2019 12 29 new faster remapping of data
						p.songdata = {};
						$.each(tr.data() , function(i,c){
							var newKey = i.replace("qtmplayer", "").toLowerCase();
							p.songdata[newKey] = c;
						});

						i.seekBtn();
						i.switchicon(icon, 'pause');
						item.addClass(playedclass);
						if($("#qtdonut").length > 0){
							$("#qtdonut").removeAttr("id");
						}
						if(isDonut){
							item.attr("id", "qtdonut");
							$.qtMplayerPlaylistCue.destroy();
							if( 'track' === p.songdata.type){
								$.qtRaphaelCircle.init();
							}
						} else {
							if( 'track' === p.songdata.type){
								$.qtMplayerPlaylistCue.init();
							}
						}
						i.deployTrack();
						// safe initialization
						if(false == qtInitialized){
							i.initializeAudio();
							setTimeout(
								u.play, 
								2200
							);
						} else {
							u.play();
						}

						// u.play();
					}
					e.stopPropagation();
				});
			},
			
			switchicon: function(i, state) {
				if(state === 'play'){
					i.html('play_arrow');
				} else if (state === 'pause') {
					i.html('pause');
				}
			},
			progressUpdate: function(perc){ // buffered
				var i = $.qtPlayerObj.interface,
					p = perc * 100;
				i.buffer.css({width: p+'%'});
				i.minicue.addClass('actvd');
				
			},
			timeupdate: function(perc, time){
				var i = $.qtPlayerObj.interface,
					p = perc * 100;
				i.advance.css({width: (p)+'%'});
				i.time.html(time);
				if($('#qtMplayerprogWave')){
					$('#qtMplayerprogWave').css({width: (p)+'%'});
				}
				if(i.dragging === false) {
					i.minicue.css({left: (p)+'%'});
				}
			},
			seekBtn: function(){
				var o = $.qtPlayerObj,
					i = o.interface,
					c = i.control,
					m = i.minicue,
					ol = c.offset().left,
					w = c.outerWidth(),
					t = (o.songdata.type == 'radio') ? 'radio' : 'track',
					l,
					active = false,
			     	currentX, currentY, initialX, initialY,
			     	xOffset = 0;
			     	yOffset = 0;
			     	dragItem = m;
				c.off("touchstart").off("touchend").off('touchmove').off('mousedown').off('mouseup').off('mouseleave').off('mousemove');
				if(t === 'radio') {
					m.css({'left': 0});
				} else {
					c.on("touchstart", dragStart);
					c.on("touchend", dragEnd);
					c.on("touchmove", drag);
					c.on("mousedown", dragStart);
					c.on("mouseup", dragEnd);
					c.on("mouseleave", dragEnd);
					c.on("mousemove", drag);
					function dragStart(e) {
						i.dragging = true; 
						active = true;
						m.addClass('qtmplayer-touch');
				    }
				    function dragEnd(e) {
						i.dragging = false;
						active = false;
						m.removeClass('qtmplayer-touch');
				    }
				    function drag(e) {
				    	ol = c.offset().left;
						w = c.outerWidth();
						if (e.type === "touchmove") {
							l = e.originalEvent.touches[0].pageX - ol;
						} else {
							l = e.clientX - ol;
						}
						if(active){
							relocate(l);
						}
				    }
				    function relocate(l){
				    	var p = l / w;
				    	if( p < 0 || p > 99.9 ){
				    		return;
				    	}
				    	m.css({'left': l});
				    	o.uniPlayer.seek(p * 100);
				    }
				}
			},	
			appendAlbum: function(){
				var p = $.qtPlayerObj,
					i = p.interface,
					c = i.controls,
					cartlink,
					cur_url = window.location.href,
					wc_params = '',
					wc_classes = '',
					params, // for URL
					params_str, // for URL
					ot = false, // timeout
					notif = $('[data-qtmplayerNotif]');


					
				i.body.on("click", "[data-qtmplayer-addrelease]", function(e){
					e.preventDefault();
					var that = $(this),
						url = that.data("qtmplayer-addrelease"),
						playnow = that.data("playnow"),
						latestAdded = 'qtmplayer-latestadded';

					if(that.data("qtmplayer-addrelease") == '0'  || that.hasClass("disabled")){
						return;
					}
					$.getJSON(url, function( data ) {
						var newitem,
							special_action,
							tn = data.length;

						i.doSpinner(true, "+"+tn);

						$.each( data, function( key, val ) {
							// WooCommerce
							
							cartlink = val.buylink;
							if (val.buylink.match(/^-?\d+$/)) { // is a numeric ID
								params = { "add-to-cart":val.buylink };
								params_str = jQuery.param( params );
								if( cur_url) {
									if( cur_url.indexOf("?")>= 0 ) {
										cartlink = cur_url+"&"+params_str;
									}else{
										cartlink = cur_url+"?"+params_str;
									}
								}
								// Extra cart classes and attrs
								wc_classes = ' product_type_simple add_to_cart_button ajax_add_to_cart ';
								wc_params = ' data-quantity="1" data-product_id="'+ val.buylink +'" ';
							}

							special_action = '<i class="material-icons">'+val.icon+'</i>';
							if( typeof(val.price) !== 'undefined'){
								if (val.price !== ''){
									special_action = '<span class="qtmplayer-price qtmplayer-btn qtmplayer-btn-xs qtmplayer-btn-primary">'+val.price+'</span>';
								}
							}
							newitem = '<li class="qtmplayer-trackitem dynamic">';

							if(val.cover !== ''){
								newitem += '<img src="'+val.cover+'">';
							}

							newitem += '<span class="qtmplayer-play qtmplayer-link-sec qtmplayer-play-btn '+latestAdded+'" data-qtmplayer-type="track" data-qtmplayer-cover="'+val.cover+'" data-qtmplayer-price="'+val.price+'" data-qtmplayer-file="'+val.file+'" data-qtmplayer-title="'+val.title+'"'+'data-qtmplayer-artist="'+val.artist+'"'+'data-qtmplayer-album="'+val.album+'" data-qtmplayer-link="'+val.link+'" data-qtmplayer-buylink="'+val.buylink+'" data-qtmplayer-icon="'+val.icon+'"><i class="material-icons">play_arrow</i></span><p>	<span class="qtmplayer-tit">'+val.title+'</span><br>	<span class="qtmplayer-art">'+val.artist+'</span></p><a href="'+cartlink+'" '+wc_params+' class="qtmplayer-cart '+ wc_classes +'" target="_blank">'+special_action+'</a></li>';
							

							i.playlist.append(newitem);
							if(0 === key && playnow){
								$.qtPlayerObj.interface.justStop();
								$.qtPlayerObj.uniPlayer.pause();
								p.songdata = val;
								$("."+latestAdded).click();
							}
							latestAdded = '';
						});
						i.showhide();

						if(that.data("clickonce") === 1){
							that.hide();
							
							$(that.data("notificate")).addClass("active");

						} else {
							that.addClass('disabled');
							
						}

						notif.addClass("wait").delay(1500).promise().done(function(){
							notif.removeClass("wait");
							i.doSpinner(false);
						});

						// Disable the functionality
						that.attr("data-qtmplayer-addrelease", '0');


					});
				});
			},
			showhide: function(){
				var c = $.qtPlayerObj.interface.controls;
				c.addClass('open');
				ot = setTimeout(function() {
					c.removeClass('open');
					clearTimeout(ot);
				}, 4000);
			},
			prevNext: function(){
				$.qtPlayerObj.interface.controls.on("click",".qtmplayer__prev, .qtmplayer__next", function(e){
					e.preventDefault();
					var t = $(this), b;
					if(t.data("control") === "prev"){
						b = $(".qtmplayer-played").prev();
					} else {
						b = $(".qtmplayer-played").next();
					}
					b.find(".qtmplayer-play-btn").click();
				});
			},
			next: function(){
				var i = $.qtPlayerObj.interface,
					nt = $(".qtmplayer-played").next();
				if(nt !== undefined){
					if(nt.length > 0){
						nt.find(".qtmplayer-play-btn").click();
					} else {
						i.justStop();
					}
				} else {
					i.justStop();
				}
			},			
			justStop: function(){
				//$(".qtmplayer-played .qtmplayer-play-btn i").removeClass('dripicons-media-pause').addClass('dripicons-media-play');// igor
				$.qtPlayerObj.interface.switchicon($(".qtmplayer-played .qtmplayer-play-btn i"), 'play');
				$.qtPlayerObj.uniPlayer.btnPlay.find("i").html("play_arrow");
			},
			skipCue: function(){
				var o = $.qtPlayerObj,
					i = o.interface;
				i.body.on('click', '[data-qtplayercue]',function(){
					var t = $(this),
						k = t.data('qttrackurl'),
						c = t.data('qtplayercue');
					if("undefined" === typeof( o.songdata.type )) {
						return;
					}
					if(o.songdata.file === k) {
						o.uniPlayer.seekTime(c);
					}
				});
			},
			volBtn: function(){
				var o = $.qtPlayerObj,
					i = o.interface,
					c = $("[data-qtmplayer-vcontrol]"),
					ol = c.offset().top,
					w = c.outerHeight(),
					ct = $("[data-qtmplayer-vtrack]"), // cue
					f = $("[data-qtmplayer-vfill]"), // fill
					m = $("[data-qtmplayer-vball]"), // fill
					off = c.offset().top,
					h =  c.height(),
					vi = $('[data-qtmplayer-vicon]'),
					t, // top
					p = 100, // percentage
					tp = 100, // volume before muting to unmute
					d; // delta
				c.on("touchstart", vdragStart);
				c.on("touchend", vdragEnd);
				c.on("touchmove", vdrag);
				c.on("mousedown", vdragStart);
				c.on("mouseup", vdragEnd);
				c.on("mouseleave", vdragEnd);
				c.on("mousemove", vdrag);
				var vactive = false;
			    var vcurrentX;
			    var vcurrentY;
			    var vinitialX;
			    var vinitialY;
			    var vxOffset = 0;
			    var vyOffset = 0;
			    var vdragItem = m;
				function vdragStart(e) {
					i.vdragging = true; 
					vactive = true;
					m.addClass('qtmplayer-touch');
			    }
			    function vdragEnd(e) {
					i.vdragging = false;
					vactive = false;
					m.removeClass('qtmplayer-touch');
			    }
			    function vdrag(e) {
			    	off = c.offset().top - $(window).scrollTop();
			    	if(vactive){
				    	ol = c.offset().top;
						w = c.outerHeight();
						if (e.type === "touchmove") {
							l = off - e.originalEvent.touches[0].pageY;
						} else {
							l = off - e.clientY;
						}
						vrelocate(100 - Math.abs(l) );
					}
			    }
			    function vrelocate(l){
			    	if(l < 0 || l > 100){
			    		return;
			    	}
			    	m.css({'top': 100 -l});
			    	p = l;
			    	f.css({'height':p+'%'});
			    	$.qtPlayerObj.uniPlayer.setVolume(p);
			    	if(p > 1){
						if(p < 50){
							vi.html('volume_down');
						} else {
							vi.html('volume_up');
						}
					} else {
						vi.html('volume_off');
					}
			    }
			    vi.on('click', function(e){
			    	e.preventDefault();
			    	
			    	if(p > 1){
			    		tp = p;
			    		vrelocate(0);
			    	} else {
			    		vrelocate(tp);
			    	}
			    	e.stopPropagation();
			    });
			},
			setDuration: function(text){
				if(text === 'NaN:NaN' || text === '00:00'){
					$("#qtmplayerDuration").html();
					return;
				}
				$("#qtmplayerDuration").html(text);
			},
			bufferStart: function(){
				
				$("#qtmplayerDuration").html('...');
				$("#qtmplayer-buffer").show();
				$('#qtMplayerMiniCue,  #qtMplayerTadv').animate({'opacity':0.4}, 'fast' ).css({'pointer-events': 'none'});
			},
			bufferEnd: function(){
				$("#qtmplayer-buffer").hide();
				var returnAlive = setTimeout(function(){
					$('#qtMplayerMiniCue, #qtMplayerTadv').animate({'opacity':1}, 'fast' ).css({'pointer-events': 'all'});
				}, 300);
				
			},
			screenResize: function(){
				var resizeTimer,
					o = $.qtPlayerObj,
					i = o.interface,
					w = i.window,
					ww = w.width(),
					wh = w.height();
				w.on('resize', function() {
					clearTimeout(resizeTimer);
					resizeTimer = setTimeout(function() {
						if (w.width() !== ww || w.height() !== wh) {
							i.seekBtn();
							$.qtMplayerPlaylistCue.init();
						}
						
					}, 100);
				});
			},
			initializeAudio: function() {
				var o = $.qtPlayerObj,
				i = o.interface;
				if(qtAnalyzer){
					var hasAudioContext = false;
					i.doSpinner(true);
					try {
						hasAudioContext = window.AudioContext || window.webkitAudioContext;
					} catch(e) {
						if($.qtSMPO.init()){
							qtInitialized = true;
							i.doSpinner(false);
							return true;
						};
					}
					if(hasAudioContext !== false){
						o.isSoundApi = true;
						if($.qtWebApiPlayer.init()){
							i.doSpinner(false);
							qtInitialized = true;
							return true;
						}
					}
				} else {
					if($.qtSMPO.init()){
						i.doSpinner(false);
						qtInitialized = true;
						return true;
					};
				}
			},
			resumeAudio: function(){
				var o = $.qtPlayerObj,
					i = o.interface;
				i.initializeAudio(); // Appply new fixes
				qtPlayIsAllowed = true;
				if(i.autoplay){
					setTimeout(
						o.uniPlayer.play, 
						2200
					);
					
				}
				document.removeEventListener("click", i.resumeAudio);
			}
		},
		initPlayer: function(){
			var o = $.qtPlayerObj,
				i = o.interface,
				c = i.controls,
				b = i.body,
				ot; // ot = outTimer
			o.songdata = {};
			b.addClass("qtmplayer-enabled");
			$(document).on("click", "[data-playlistopen]", function(){
				b.toggleClass("qtmplayer-openplaylist");
			});
			b.on("click", "[data-playeropen]", function(){
				b.toggleClass("qtmplayer-open");
			});
			c.find('.qtmplayer__cover').html('<img src="">');
			i.qtmplayer.find('.qtmplayer__album').prepend('<img src="">');
			// i.initializeAudio(); // Appply new fixes
			document.addEventListener("click", i.resumeAudio); // trick: if autoplay is enabled and blocked, any click will start audio
			i.preloadTrack();
			i.prevNext();
			i.appendAlbum();
			i.seekBtn();
			i.volBtn();
			i.bufferEnd();
			i.skipCue();
			i.screenResize();
			c.mouseenter(function(){
				c.addClass('open');
				i.seekBtn();
				clearTimeout(ot);
			}).mouseleave(function(){				
				ot = setTimeout(function() {
					c.removeClass('open');
				}, c.data('hidetimeout'));
			});
		},
	};
	$(document).ready(function() {
		if(0 === $('#qtmplayer-playlist li').length ){
			return;
		}
		$.qtPlayerObj.initPlayer();
	});
})(jQuery);




