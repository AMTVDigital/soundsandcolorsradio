!function(r){"use strict";r.fn.qtChartvoteInit=function(){r("body a.proradio-chartvote-link").off("click"),r("body a.proradio-chartvote-link").each(function(a,t){var o=r(t),e="voted-"+o.data("chartid")+"-"+o.data("position");"1"==r.cookie(e)&&(r(t).addClass("disabled"),r(t).parent().addClass("disabled"))}),r("body a.proradio-chartvote-link").on("click",function(a){a.preventDefault(),a.stopPropagation();var o=r(this),t="voted-"+o.data("chartid")+"-"+o.data("position");"1"==r.cookie(t)?o.addClass("disabled"):(r.cookie(t,"1",{expires:1,path:"/"}),r.ajax({type:"post",url:chartvote_ajax_var.url,cache:!1,data:"action=track-vote&nonce="+chartvote_ajax_var.nonce+"&position="+o.data("position")+"&move="+o.data("move")+"&chartid="+o.data("chartid"),success:function(a){var t=jQuery.parseJSON(a);o.parent().find(".proradio-chartvote-number").html(t.newvalue),o.parent().find("a").addClass("disabled"),o.parent().addClass("disabled")},error:function(a){console.log(a.Error)}}))})},jQuery(document).ready(function(){r.fn.qtChartvoteInit()})}(jQuery);