!function(b){"use strict";b.qtWebsiteObj={},b.qtWebsiteObj.body=b("body"),b.fn.ttgReaktionsLoveitAjax=function(){var a,n;b.qtWebsiteObj.body.on("click","a.proradio_reaktions-link",function(t){return t.preventDefault(),n=b(this),a=n.data("post_id"),b.ajax({type:"post",url:ajax_var.url,data:"action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+a,success:function(t){"already"!=t&&(n.addClass("proradio-reaktions-btn-disabled"),n.find(".count").text(t))}}),!1})},b.fn.ttgRatingCounterAjax=function(){var t,a,n,e,f,l;b.qtWebsiteObj.viewCounterAjax=b(".ttg-reactions-viewconuterajax"),0!=b.qtWebsiteObj.viewCounterAjax&&b.qtWebsiteObj.body.on("change","input[name='proradio-reaktions-star']",function(t){t.preventDefault();var a=b(this),n,e=a.closest("form").attr("data-postid"),o=a.attr("value"),i="action=ttg_rating_submit&nonce="+ajax_var.nonce+"&ttg_rating_submit="+o+"&post_id="+e,r=ajax_var.url,s,u,d,c,p,j,v,g;b.ajax({type:"post",url:r,data:i,success:function(t){return f=b(".ttg-Ratings-Amount"),p=b(".ttg-Ratings-Avg"),v=b(".ttg-Ratings-Feedback"),c=f.attr("data-novote"),s=t.split("|avg="),l=f.attr("data-single"),j=f.attr("data-before"),g=v.attr("data-thanks"),"novote"===t?void v.html(c):(d=s[0],u=s[1],1<d&&(l=f.attr("data-multi")),p.html(parseFloat(u).toFixed(2)),v.html(g),void f.html(j+" "+d+" "+l))},error:function(t){}})})},b.fn.ttgViewCounterAjax=function(){var t,a,n,e;if(b.qtWebsiteObj.viewCounterAjax=b(".ttg-reactions-viewconuterajax"),0!=b.qtWebsiteObj.viewCounterAjax.length){var o=b.qtWebsiteObj.viewCounterAjax.attr("data-id"),i="action=ttg_post_views&nonce="+ajax_var.nonce+"&ttg_post_views=&post_id="+o,r=ajax_var.url;b.ajax({type:"post",url:r,data:i,success:function(t){n=b(".proradio-reaktions-Views-Amount"),e=n.attr("data-single"),1<t&&(e=n.attr("data-multi")),n.html(t+" "+e)},error:function(t){}})}},b.fn.ttgReaktionPopupwindow=function(){void 0!==b.fn.popupwindow&&b.fn.popupwindow()},b(document).ready(function(){b.fn.ttgReaktionPopupwindow(),b.fn.ttgReaktionsLoveitAjax(),b.fn.ttgViewCounterAjax(),b.fn.ttgRatingCounterAjax()})}(jQuery);