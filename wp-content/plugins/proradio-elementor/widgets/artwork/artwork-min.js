!function(e){var r=!1,o=!1,t=!1;e(".qtmplayer__cover img").hide();var n=function(e,n){try{r&&clearInterval(r),r=setInterval((function(){n(".qtmplayer__cover img").length>0&&((t=n(".qtmplayer__cover img").attr("src"))!==o&&(o=t),o?(n(".proradio-elementor--artwork__img img").attr("src",o),n(".proradio-elementor--artwork__img").attr("href",o),n(".qtmplayer__cover img").show()):n(".qtmplayer__cover img").hide()),console.log("art")}),1e3)}catch(e){console.log(e)}};e(window).on("elementor/frontend/init",(function(){elementorFrontend.hooks.addAction("frontend/element_ready/proradio-elementor-artwork.default",n)}))}(jQuery);
//# sourceMappingURL=artwork-min.js.map