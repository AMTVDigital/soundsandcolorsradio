/**
* 
* @package qtmplayer
* @subpackage  qtmplayer-radiofeed
* 
*/

(function($) {
	"use strict";
	function isXML(xml){
	    try {
	        xmlDoc = $.parseXML(xml); //is valid XML
	        return true;
	    } catch (err) {
	        // was not XML
	        return false;
	    }
	}


	$.qtmplayerRadioFeedObj = {
		body: $("body"),
		window: $(window),
		document: $(document),
		htmlAndbody: $('html,body'),
		qtFeedData: {},
		timeInterval: 30000, 
		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * START SITE FUNCTIONS 																													|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
		fn: {
			cachedThumbsArray: [], // when this changes, we fetch a new cover
			// ----------------------------------------------- FEED READERS END ------------------------------------
			getThumbnail: function(that, termArray, callBack){
				termArray = termArray.split(' - ').join('-').split(' ').join('+');
				var thumb; // image from itunes
				var apiUrl = 'https://itunes.apple.com/search?term='+termArray;
				if( undefined === that.cachedThumbsArray[termArray] ) {
					$.ajax({
						type: 'GET',
						cache: true,
						url: apiUrl,
						async: true,
						dataType: 'jsonp',
						context: this,
						success: function(json) {
							if('object' !== typeof( json )){
								json = JSON.parse(json);
							}
							if(json.resultCount > 0){
								thumb = json.results[0].artworkUrl100.split('100x100bb.jpg').join('1000x1000bb.jpg');
								that.cachedThumbsArray[termArray] = thumb;
								callBack(thumb);
								return;
							}
						}
					});
				} else {
					// return cached image
					callBack( that.cachedThumbsArray[termArray] );
					return;
				}
			},



			/**====================================================================
			 *
			 * 
			 *  Marquee for longer texts
			 *  
			 * 
			 ====================================================================*/
			marqueeInstances: [],
			marqueeText: function(that) {
				if('function' !== typeof( $.fn.marquee ) ){ // missing marquee library? quit
					return;
				}
				var marquees = $('body').find('.proradio-marquee');
				// Destroy any old instance of the marquee
				if( that.marqueeInstances.length > 0 ){
					for( var mi = 0; mi < that.marqueeInstances.length; mi++ ){
						if( 'undefined' !== typeof( that.marqueeInstances[mi] )){
							that.marqueeInstances[mi].marquee('destroy');
						}
					}
					that.marqueeInstances = []; // reset
				}
				$.each(marquees, function(i,c){
					var item = $(c);
					if(item.find('.marquee').length === 0){
						item.html('<span class="marquee">'+item.html()+'</span>');
					}
					if(  item.outerWidth() >  item.find('.marquee').outerWidth() ){ // the title is short? quit!
						return;
					}
					that.marqueeInstances[i] = item.marquee({
						duration: 12000,
						gap: item.outerWidth(),
						delayBeforeStart: 1000,
						direction: 'left',
						duplicated: false,
						pauseOnCycle: 5000,
						startVisible: true
					});
				});
			},

			qtApplyTitle: function(result, callBack){
				var that = this;
				if(result && result !== ''){



					// result = decodeURIComponent(escape(result));




					var feedsplit = result.split(" - ");
					var artist;
					var title;
					if(feedsplit.length > 1){
						artist = feedsplit[0],
						title = feedsplit[1];
					} else {
						artist = "";
						title = result;
					}
					var artistSplit = artist.split('[');
					if( artistSplit.length > 1 ){
						artist = artistSplit[0];
					}
					var titleSplit = title.split('[');
					if( titleSplit.length > 1 ){
						title = titleSplit[0];
					}
					title = $.trim(title);
					artist = $.trim(artist);
					$(".qtmplayer-feed").show();
					$('.qtmplayer__title').html(title);
					$('.qtmplayer__artist').html(artist);
					that.marqueeText( that );
					var termArray = artist+'-'+title;
					if( callBack ){
						this.getThumbnail(that, termArray, callBack );
					}
				} else {
					$(".qtmplayer-feed").hide();
				}
				return;
			},
			newFeedReading: function(){
				var o 	= $.qtmplayerRadioFeedObj,
					fd = o.qtFeedData,
					callBack = fd.callBack,
					fn 	= o.fn,
					qtradiofeedHost		=  (undefined !== fd.host) ? fd.host : '',
					qtradiofeedPort 	=  (undefined !== fd.port) ? fd.port : '',
					qtradiofeedProtocol =  (undefined !== fd.protocol) ? fd.protocol : 'http',
					theChannel 			=  (undefined !== fd.channel) ? fd.channel : '',
					qticecasturl 		=  (undefined !== fd.icecasturl) ? fd.icecasturl : '',
					qticecastmountpoint	=  (undefined !== fd.icecastmountpoint) ? fd.icecastmountpoint : '',
					qticecastchannel	=  (undefined !== fd.icecastchannel) ? fd.icecastchannel : '',
					qtradiodotco		=  (undefined !== fd.radiodotco) ? fd.radiodotco : '',
					qtairtime			=  (undefined !== fd.airtime) ? fd.airtime : '',
					qtradionomy 		=  (undefined !== fd.radionomy) ? fd.radionomy : '',
					qttextfeed 			=  (undefined !== fd.textfeed) ? fd.textfeed : '',
					qtUseProxy 			=  (undefined !== fd.useproxy) ? fd.useproxy : '',
					qtlive365 			=  (undefined !== fd.live365) ? fd.live365 : '',
					qtradioking 		=  (undefined !== fd.radioking) ? fd.radioking : '',
					qtazuracast 		=  (undefined !== fd.azuracast) ? fd.azuracast : '',
					qtsecuresystems 	=  (undefined !== fd.securesystems) ? fd.securesystems : '',
					qtradiojar 			=  (undefined !== fd.radiojar) ? fd.radiojar : '',
					qtradioboss			=  (undefined !== fd.radioboss) ? fd.radioboss : '',
					qtFeedPlayerTrack = $('#qtFeedPlayerTrack'),
					qtFeedPlayerAuthor = $('#qtFeedPlayerAuthor'),
					qtPlayerTrackInfo = $("#qtPlayerTrackInfo"),
					author, title, result, feedsplit;
					o = $.qtmplayerRadioFeedObj;
					var proxyURL = $("#qtmplayer-radiofeed-proxyurl").data('proxyurl');
					if( fd.servertype == 'type-auto' ){
						$.ajax({
						   	type: 'GET',
							url: proxyURL,
						    jsonpCallback: 'parseMusic',
							async: true,
							cache: false,
							data: { "qtproxycall": fd.file, 'icymetadata': '1'  },
							success: function(data) {
								fn.qtApplyTitle( data, callBack );
							}
						});
						return;
					}
					if(qtradioboss === '' && qtsecuresystems === '' && qtradiojar === '' && qtradioking === '' && qtazuracast === '' && qttextfeed === '' && qtradionomy === '' && qtlive365 === '' && qtairtime === '' && (qtradiofeedHost === '' || qtradiofeedPort === '' || typeof(qtradiofeedHost) === 'undefined') && qticecasturl === '' && qtradiodotco === '') {
						
						fn.qtApplyTitle();
						return;
					} else {

						var timestamp = new Date().getUTCMilliseconds();

						/**
						 * ===================================================================
						 *
						 *	Radioboss
						 *
						 * ===================================================================
						 */
						if( qtradioboss !== ''){
							qtradioboss = qtradioboss + '?rand='+timestamp;
							// RadioBoss requires always the proxy
							qtradioboss =  proxyURL+'?qtproxycall='+qtradioboss;
							$.ajax({
								type: 'GET',
								cache: false,
								url: qtradioboss,
								async: true,
								contentType: "application/json",
								success: function(data) {
									data = JSON.parse(data);
									title = data['nowplaying'];
									fn.qtApplyTitle(title, callBack);
								},
							});
						}


						/**
						 * ===================================================================
						 *
						 *	Radiojar
						 *
						 * ===================================================================
						 */
						if( qtradiojar !== ''){
							qtradiojar = qtradiojar + '?rand='+timestamp;
							if(qtUseProxy){
								qtradiojar =  proxyURL+'?qtproxycall='+qtradiojar;
							}
							$.ajax({
								type: 'GET',
								cache: false,
								url: qtradiojar,
								async: true,
								contentType: "application/json",
								success: function(data) {
									title = data.artist+' - '+data.title;
									
									if(data.thumb && 'function' === typeof(callBack)){
										callBack(data.thumb+'#.jpg');
										callBack = false;
									}
									fn.qtApplyTitle(title, callBack);
								},
							});
						}




						/**
						 * ===================================================================
						 *
						 *	SecureSystems
						 *
						 * ===================================================================
						 */
						if( qtsecuresystems !== ''){
							qtsecuresystems =qtsecuresystems;
							if(qtUseProxy){
								qtsecuresystems =  proxyURL+'?qtproxycall='+qtsecuresystems;
							}
							$.ajax({
								type: 'GET',
								cache: false,
								url: qtsecuresystems,
								async: true,
								dataType: "xml",
								success: function(data) {
									if($(data).find('cover').html() !== ''  && 'function' === typeof(callBack)){
										callBack($(data).find('cover').html());
										callBack = false;
									}
									fn.qtApplyTitle( $(data).find('artist').html()+ ' - ' + $(data).find('title').html() , callBack);
								},
								error: function(e){
									console.log(e);
								}
							});
						}





						/**
						 * ===================================================================
						 *
						 *	qtlive365
						 *
						 * ===================================================================
						 */
						if( qtlive365 !== ''){
							qtlive365 = 'https://api.live365.com/station/'+qtlive365;
							if(qtUseProxy){
								qtlive365 =  proxyURL+'?qtproxycall='+qtlive365;
							}
							$.ajax({
								type: 'GET',
								cache: false,
								url: qtlive365,
								async: true,
								success: function(data) {
									jsondata = JSON.parse(data);
									fn.qtApplyTitle(jsondata['current-track'].artist+' - '+jsondata['current-track'].title, callBack);									
								},
								error: function(e){
								}
							});
						}

						/**
						 * ===================================================================
						 *
						 *	Text
						 *
						 * ===================================================================
						 */
						else if(qttextfeed !== ''){
							var tfeedurl,jsondata, title, proxyURL, mydata;
							if(qtUseProxy){
								tfeedurl = $("#qtmplayer-radiofeed-proxyurl").data('proxyurl');
								mydata = { 
							        "qtproxycall": qttextfeed,
							    };
							} else {
								tfeedurl = qttextfeed;
							}
							$.ajax({
							   	type: 'GET',
								cache: false,
								url: tfeedurl,
								async: true,
								data: mydata,
								dataType: "html",
								success: function(data) {
									fn.qtApplyTitle( data, callBack );
								},
								error: function(e){
									console.log(e);
								}
							});
						} 
						/**
						 * ===================================================================
						 *
						 *	Radionomy
						 *
						 * ===================================================================
						 */
						else if(qtradionomy !== '' ) {
							$.ajax({
							   	type: 'GET',
								url: qtradionomy,
								async: true,
								cache: false,
								dataType: "xml",
								success: function(data) {
									fn.qtApplyTitle( $(data).find('artists').html()+ ' - ' + $(data).find('title').html() );
								},
								error: function(e){
									console.log(e);
								}
							});
						} 

						/**
						 * ===================================================================
						 *
						 *	AirTime
						 *
						 * ===================================================================
						 */
						else if(qtairtime !== '' && qtairtime !== 'undefined' && qtairtime !== undefined && typeof(qtairtime) !== 'undefined'){
							var jsondata, title;
							$.ajax({
								type: 'GET',
								cache: false,
								url: proxyURL,
								async: true,
								data: {
							        "qtproxycall": qtairtime,
							    },
								contentType: "application/json",
								success: function(data) {
									jsondata = JSON.parse(data);
									title = jsondata.tracks.current.name;
									fn.qtApplyTitle(title);
								},
								error: function(e) {
								}
							});
						}

						/**
						 * ===================================================================
						 *
						 *	Icecast
						 *
						 * ===================================================================
						 */
						else if(qticecasturl !== '' && typeof(qticecasturl) !== 'undefined') {
							var feedurl = qticecasturl;
							var source;
							var title;
							var songdata;
							if(qtUseProxy){
								feedurl = proxyURL;
								songdata = {
							        "qtproxycall":  qticecasturl,
							    };
							}
							// beta

							

						

							// Original
							$.ajax({
								type: 'GET',
								cache: false,
								url: feedurl,
								async: true,
								jsonpCallback: "parseMusic",
								jsonp: false,
								// dataType: 'jsonp', // not working with some radios
								data: songdata,
								contentType: "application/json",
								success: function(json) {
									// console.log(json);
									if('object' !== typeof( json )){
										json = JSON.parse(json);
									}
									source = json.icestats.source;
									if('undefined' === typeof(source)){ 
										return; 
									}
									if(qticecastmountpoint){
										source = source[qticecastmountpoint];
									}
									if(qticecastchannel){
										// console.log("set source to 0");
										source = source[qticecastchannel];
									}
									// since PR.3.2.3
									// If there is no channel and there is no title, channel must be 0
									if(!qticecastchannel && 'undefined' === typeof(source.title)){
										source = source[0];
									}
									title = source.title;

									if( source.artist ){
										title = title +' - '+source.artist;
									}
									fn.qtApplyTitle(title, callBack);
								},error: function(e) {
									console.log(e);
								}
							});

							

						} 
						/**
						 * ===================================================================
						 *
						 *	ShoutCast
						 *
						 * ===================================================================
						 */
						else if (qtradiofeedHost !== '' && qtradiofeedPort !== '' && typeof(qtradiofeedHost) !== 'undefined'){
							// to tide up
							var feedData = {
								shoutcast_host: qtradiofeedHost,
								shoutcast_port: qtradiofeedPort,
								shoutcast_protocol: qtradiofeedProtocol,
								shoutcast_channel: theChannel
							};
							var channel = feedData.shoutcast_channel || 1;
							var protocol = 'http';
							if(feedData.shoutcast_port === '443' || feedData.shoutcast_protocol === 'https' ){
								protocol 	= 'https';
							}
							var shoutcastUrl = protocol+'://'+feedData.shoutcast_host+':'+feedData.shoutcast_port+'/stats?sid='+channel+'&json=1';
							var feedurl 	= shoutcastUrl;
							if(qtUseProxy){
								feedurl = proxyURL;
								songdata = {
							        "qtproxycall":  shoutcastUrl,
							    };
							}
							$.ajax({
								type: 'GET',
								cache: false,
								url: feedurl,
								async: true,
								data: songdata,
								contentType: "application/json",
								success: function(json) {
									if('object' !== typeof( json )){
										json = JSON.parse(json);
									}
									fn.qtApplyTitle( json.songtitle, callBack);
								},error: function(e) {
									console.log(feedurl);
									console.log(e);
								}
							});
							return;
						} 
						/**
						 * ===================================================================
						 *
						 *	Radio.co
						 *
						 * ===================================================================
						 */
						else if (qtradiodotco !== '' && typeof(qtradiodotco) !== 'undefined'){
							var rUrl = 'https://public.radio.co/stations/'+qtradiodotco+'/status'
							$.ajax({
								type: 'GET',
								cache: false,
								url: rUrl,
								async: true,
								contentType: "application/json",
								success: function(data) {
									title = data['current_track']['title'];
									fn.qtApplyTitle(title, callBack);
								},
								error: function(e) {
								}
							});
						}
						/**
						 * ===================================================================
						 *
						 *	Radioking
						 *
						 * ===================================================================
						 */
						else if (fd.servertype == 'type-radioking' && qtradioking !== '' ){
							var rUrl = 'https://api.radioking.io/widget/radio/'+qtradioking+'/track/current';
							$.ajax({
								type: 'GET',
								cache: false,
								url: rUrl,
								async: true,
								contentType: "application/json",
								success: function(data) {
									title = data.artist+' - '+data.title;
									
									if(data.cover && 'function' === typeof(callBack)){
										callBack(data.cover);
										callBack = false;
									}
									fn.qtApplyTitle(title, callBack);
								},
								error: function(e) {
									console.log(e);
								}
							});
						}
						/**
						 * ===================================================================
						 *
						 *	Azuracast
						 *
						 * ===================================================================
						 */
						else if (fd.servertype == 'type-azuracast' && qtazuracast !== '' ){
							var rUrl = '';

							qtazuracast = qtazuracast + '?rand='+timestamp;

							$.ajax({
								type: 'GET',
								cache: false,
								url: qtazuracast,
								async: true,
								contentType: "application/json",
								success: function(data) {
									data = data[0];
									author = data.now_playing.song.artist;
									title = data.now_playing.song.title;
									if('' !== author){
										title = author+' - '+title;
									}
									if(data.now_playing.song.cover && 'function' === typeof(callBack)){
										callBack(data.now_playing.song.cover);
										callBack = false;
									}
									if(data.now_playing.song.art && 'function' === typeof(callBack)){
										console.log(data.now_playing.song.art);
										callBack(data.now_playing.song.art);
										callBack = false;
									}

									if(data.cover && 'function' === typeof(callBack)){
										callBack(data.cover);
										callBack = false;
									}
									if(data.art && 'function' === typeof(callBack)){
										callBack(data.art);
										callBack = false;
									}
									fn.qtApplyTitle(title, callBack);
								},
								error: function(e) {
									console.log(e);
								}
							});
						}
					}
				return;
			},
			feedInterval: null,
			stopFeed: function(){
				var o = $.qtmplayerRadioFeedObj;
				if("undefined" !== typeof($.qtmplayerRadioFeedObj.fn.qtFeedInterval) ){
					clearInterval($.qtmplayerRadioFeedObj.fn.qtFeedInterval);
				}
			},
			pushFeed: function( data ){
				var o = $.qtmplayerRadioFeedObj;
				o.qtFeedData = data;
				o.fn.stopFeed();
				o.fn.newFeedReading();
				$.qtmplayerRadioFeedObj.fn.qtFeedInterval = setInterval(
					function(){ 
						o.fn.newFeedReading(); 
					}, 
					$.qtmplayerRadioFeedObj.timeInterval
				);
			},
		}

	};
	$(document).ready(function(){
		$.qtmplayerRadioFeedObj.fn.qtApplyTitle();
	});
})(jQuery);





