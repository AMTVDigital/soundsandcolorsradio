jQuery.storedPeaks=[];var qtDrawAudio=e=>{window.AudioContext=window.AudioContext||window.webkitAudioContext;const t=new AudioContext;if(jQuery("#qtmplayerTrackControl canvas").remove(),jQuery("#qtmplayerTrackControl").append("<canvas></canvas>"),jQuery.qtmplayerCanvas=jQuery("#qtmplayerTrackControl canvas"),jQuery("#qtmplayerTrackControl canvas").css({position:"absolute",top:0,left:0,width:"100%",height:"100%"}),void 0===jQuery.storedPeaks[e]){jQuery.ajax({type:"post",url:ajax_var.url,data:{action:"qtmplayer-get-peaks",nonce:ajax_var.nonce,url:e},success:function(a){if(a){var o=jQuery.parseJSON(a);jQuery.storedPeaks[e]=o,draw(e,o,!1)}else fetch(e).then(e=>e.arrayBuffer()).then(e=>t.decodeAudioData(e)).then(t=>draw(e,normalizeData(filterData(t)),!0))},fail:function(e){console.log(e)}})}else draw(e,jQuery.storedPeaks[e],!1)},filterData=e=>{const t=e.getChannelData(0),a=Math.floor(t.length/140),o=[];for(let e=0;e<140;e++){let r=a*e,n=0;for(let e=0;e<a;e++)n+=Math.abs(t[r+e]);o.push(n/a)}return o},normalizeData=e=>{const t=Math.pow(Math.max(...e),-1);return e.map(e=>e*t)},draw=(e,t,a)=>{const o=jQuery.qtmplayerCanvas[0],r=window.devicePixelRatio||1;o.width=o.offsetWidth*r,o.height=(o.offsetHeight+28)*r;const n=o.getContext("2d");n.scale(r,r),n.translate(0,o.offsetHeight/2+14);const s=o.offsetWidth/t.length;jQuery.storedPeaks[e]=t,1==a&&jQuery.ajax({type:"post",url:ajax_var.url,data:{action:"qtmplayer-store-peaks",nonce:ajax_var.nonce,url:e,peaks:t},success:function(e){return!0},fail:function(e){return console.log(e),!1}});for(let e=0;e<t.length;e++){const a=s*e;let r=t[e]*o.offsetHeight-14;r<0?r=0:r>o.offsetHeight/2&&(r=r>o.offsetHeight/2),drawLineSegment(n,a,r,s,(e+1)%2)}},drawLineSegment=(e,t,a,o,r)=>{e.lineWidth=1,e.strokeStyle="rgba(150,150,150,0.8)",e.beginPath(),a=r?a:-a,e.moveTo(t,0),e.lineTo(t,a),e.arc(t+o/2,a,o/2,Math.PI,0,r),e.lineTo(t+o,0),e.stroke()};
//# sourceMappingURL=qtmplayer-waveform-min.js.map