
// Set up audio context
window.AudioContext = window.AudioContext || window.webkitAudioContext;
const audioContext = new AudioContext();

// Igor 
jQuery.storedPeaks = [];

/**
 * Retrieves audio from an external source, the initializes the drawing function
 * @param {String} url the url of the audio we'd like to fetch
 */
try { 
	const drawAudio = url => {
		jQuery('#qtmplayerTrackControl canvas').remove();
		jQuery('#qtmplayerTrackControl').append('<canvas></canvas>');
		jQuery.qtmplayerCanvas = jQuery('#qtmplayerTrackControl canvas');
		jQuery('#qtmplayerTrackControl canvas').css({position: "absolute", 'top':0,'left':0,'width':'100%','height':'100%'});
		
		

		if( undefined === jQuery.storedPeaks[url] ){
			var storedSongPeaks = false;
			// first try to get peaks from the database
			jQuery.ajax({
				type: "post",
				url: ajax_var.url,
				data: {
					'action': 'qtmplayer-get-peaks',
					'nonce': ajax_var.nonce,
					'url': url
				},
				success: function( response ){
					if(!response){
						fetch(url)
						.then(response => response.arrayBuffer())
						.then(arrayBuffer => audioContext.decodeAudioData(arrayBuffer))
						.then(audioBuffer => draw(url,normalizeData(filterData(audioBuffer)),true)); // third parameter: store the data?
					} else {
						var peaks = jQuery.parseJSON(response );
						jQuery.storedPeaks[url] = peaks;
						draw(url, peaks, false);
					}
					
				},
				fail: function(e){
					console.log( e );
				}
			});
		} else {
			draw(url, jQuery.storedPeaks[url], false);
		}
	};

	/**
	 * Filters the AudioBuffer retrieved from an external source
	 * @param {AudioBuffer} audioBuffer the AudioBuffer from drawAudio()
	 * @returns {Array} an array of floating point numbers
	 */
	const filterData = audioBuffer => {
		const rawData = audioBuffer.getChannelData(0); // We only need to work with one channel of data
		const samples = 140; // Number of samples we want to have in our final data set
		const blockSize = Math.floor(rawData.length / samples); // the number of samples in each subdivision
		const filteredData = [];
		for (let i = 0; i < samples; i++) {
			let blockStart = blockSize * i; // the location of the first sample in the block
			let sum = 0;
			for (let j = 0; j < blockSize; j++) {
				sum = sum + Math.abs(rawData[blockStart + j]); // find the sum of all the samples in the block
			}
			filteredData.push(sum / blockSize); // divide the sum by the block size to get the average
		}
		return filteredData;
	};

	/**
	 * Normalizes the audio data to make a cleaner illustration 
	 * @param {Array} filteredData the data from filterData()
	 * @returns {Array} an normalized array of floating point numbers
	 */
	const normalizeData = filteredData => {
		const multiplier = Math.pow(Math.max(...filteredData), -1);
		let normalized = filteredData.map(n => n * multiplier);
		return normalized;
	}



	/**
	 * Draws the audio file into a canvas element.
	 * @param {Array} normalizedData The filtered array returned from filterData()
	 * @returns {Array} a normalized array of data 
	 */
	const draw = ( url, normalizedData, storeData) => {
		const canvas = jQuery.qtmplayerCanvas[0];//document.querySelector("canvas");
		const dpr = window.devicePixelRatio || 1;
		const padding = 14;
		canvas.width = canvas.offsetWidth * dpr;
		canvas.height = (canvas.offsetHeight + padding * 2) * dpr;
		const ctx = canvas.getContext("2d");
		ctx.scale(dpr, dpr);
		ctx.translate(0, canvas.offsetHeight / 2 + padding); // set Y = 0 to be in the middle of the canvas
		// draw the line segments
		const width = canvas.offsetWidth / normalizedData.length;
		jQuery.storedPeaks[url] = normalizedData;// Save the peaks associated with the URL to avoid reloading the same file again
		

		if(true == storeData){
			jQuery.ajax({
				type: "post",
				url: ajax_var.url,
				data: {
					'action': 'qtmplayer-store-peaks',
					'nonce': ajax_var.nonce,
					'url': url,
					'peaks': normalizedData
				},
				success: function( response ){
					return true;
				},
				fail: function(e){
					console.log( e );
					return false;
				}
			});
		}
		for (let i = 0; i < normalizedData.length; i++) {
			const x = width * i;
			let height = normalizedData[i] * canvas.offsetHeight - padding;
			if (height < 0) {
					height = 0;
			} else if (height > canvas.offsetHeight / 2) {
					height = height > canvas.offsetHeight / 2;
			}
			drawLineSegment(ctx, x, height, width, (i + 1) % 2);
		}
	};






	/**
	 * A utility function for drawing our line segments
	 * @param {AudioContext} ctx the audio context 
	 * @param {number} x  the x coordinate of the beginning of the line segment
	 * @param {number} height the desired height of the line segment
	 * @param {number} width the desired width of the line segment
	 * @param {boolean} isEven whether or not the segmented is even-numbered
	 */
	const drawLineSegment = (ctx, x, height, width, isEven) => {
		ctx.lineWidth = 1; // how thick the line is
		ctx.strokeStyle = "rgba(150,150,150,0.8)"; // what color our line is
		ctx.beginPath();
		height = isEven ? height : -height;
		ctx.moveTo(x, 0);
		ctx.lineTo(x, height);
		ctx.arc(x + width / 2, height, width / 2, Math.PI, 0, isEven);
		ctx.lineTo(x + width, 0);
		ctx.stroke();
	};

	
} catch (e) { 
	console.log(e);
}