!function(e){var n={};function t(a){if(n[a])return n[a].exports;var i=n[a]={i:a,l:!1,exports:{}};return e[a].call(i.exports,i,i.exports,t),i.l=!0,i.exports}t.m=e,t.c=n,t.d=function(e,n,a){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:a})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(t.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var i in e)t.d(a,i,function(n){return e[n]}.bind(null,i));return a},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="",t(t.s=716)}({716:function(e,n,t){e.exports=t(717)},717:function(e,n){var t;(t=jQuery)(document).ready((function(){var e=t("#give-licenses-container"),n=t("#give-license-activator-wrap"),a=t("form",n),i=t('input[name="give_license_key"]',n),o=t('input[type="submit"]',a),r=t(".give-license-notices",n);r.on("click",t(".notice-dismiss",r),(function(e){r.empty().hide()})),a.on("submit",(function(){var n=i.val().trim(),a=t('input[name="give_license_activator_nonce"]',t(this)).val().trim();return r.empty(),n?(t.ajax({url:ajaxurl,method:"POST",data:{action:"give_get_license_info",license:n,_wpnonce:a},beforeSend:function(){o.val(o.attr("data-activating")),o.prop("disabled",!0),Give.fn.loader(e)},success:function(n){if(r.show(),i.val(""),!0!==n.success)n.data.hasOwnProperty("errorMsg")&&n.data.errorMsg?r.html(Give.notice.fn.getAdminNoticeHTML(n.data.errorMsg,"error")):r.html(Give.notice.fn.getAdminNoticeHTML(give_addon_var.notices.invalid_license,"error"));else if(n.data.hasOwnProperty("download")&&n.data.download){var t="string"==typeof n.data.download?give_addon_var.notices.download_file.replace("{link}",n.data.download):give_addon_var.notices.download_file.substring(0,give_addon_var.notices.download_file.indexOf(".")+1);r.html(Give.notice.fn.getAdminNoticeHTML(t,"success")),e.parent().parent().removeClass("give-hidden"),e.html(n.data.html)}else r.html(Give.notice.fn.getAdminNoticeHTML(give_addon_var.notices.invalid_license,"error"))}}).always((function(){Give.fn.loader(e,{show:!1}),o.val(o.attr("data-activate")),o.prop("disabled",!1)})),!1):(r.show(),r.html(Give.notice.fn.getAdminNoticeHTML(give_addon_var.notices.invalid_license,"error")),!1)})),e.on("click",".give-button__license-activate",(function(n){n.preventDefault();var a=t(this),i=a.parents(".give-addon-wrap"),o=t(".give-license-notice-container",i),r=a.prev('.give-license__key input[type="text"]').val().trim();o.empty().removeClass("give-addon-notice-shown").show(),r?t.ajax({url:ajaxurl,method:"POST",data:{action:"give_get_license_info",license:r,single:1,addon:a.attr("data-addon"),_wpnonce:t("#give_license_activator_nonce").val().trim()},beforeSend:function(){Give.fn.loader(i)},success:function(n){!0!==n.success?o.addClass("give-addon-notice-shown").prepend(Give.notice.fn.getAdminNoticeHTML(n.data.errorMsg,"error")):n.data.hasOwnProperty("is_all_access_pass")&&n.data.is_all_access_pass?e.html(n.data.html):i.replaceWith(n.data.html)}}).done((function(){Give.fn.loader(i,{show:!1})})):o.addClass("give-addon-notice-shown").prepend(Give.notice.fn.getAdminNoticeHTML(give_addon_var.notices.invalid_license,"error")),e.on("click",".notice-dismiss",(function(){o.slideUp(150,(function(){o.removeClass("give-addon-notice-shown")}))}))})),e.on("click",".give-license__deactivate",(function(n){n.preventDefault();var a=t(this),i=a.parents(".give-addon-wrap"),o=t(".give-license-notice-container",i),r=1<a.parents(".give-addon-inner").find(".give-addon-info-wrap").length,d=t(".give-addon-wrap").index(i);o.empty().removeClass("give-addon-notice-shown").show(),t.ajax({url:ajaxurl,method:"POST",data:{action:"give_deactivate_license",license:a.attr("data-license-key"),item_name:a.attr("data-item-name"),plugin_dirname:a.attr("data-plugin-dirname"),_wpnonce:a.attr("data-nonce")},beforeSend:function(){r?Give.fn.loader(e):Give.fn.loader(i)},success:function(n){!0===n.success?(r?e.html(n.data.html):i.replaceWith(n.data.html),i=t(".give-addon-wrap").get(d),(o=t(".give-license-notice-container",i)).addClass("give-addon-notice-shown").prepend(Give.notice.fn.getAdminNoticeHTML(n.data.msg,"success")),e.html().trim().length||e.parent().parent().addClass("give-hidden")):o.addClass("give-addon-notice-shown").prepend(Give.notice.fn.getAdminNoticeHTML(n.data.errorMsg,"error"))}}).done((function(){r?Give.fn.loader(e,{show:!1}):Give.fn.loader(i,{show:!1})})),e.on("click",".notice-dismiss",(function(){o.slideUp(150,(function(){o.removeClass("give-addon-notice-shown")}))}))})),e.on("click",".give-button__license-reactivate",(function(n){n.preventDefault();var a=t(this),i=a.attr("data-license").trim(),o=t(".give-addon-wrap").index(r),r=a.parents(".give-addon-wrap"),d=t(".give-license-notice-container",r);d.empty().removeClass("give-addon-notice-shown").show(),i?t.ajax({url:ajaxurl,method:"POST",data:{action:"give_get_license_info",license:i,single:1,reactivate:1,addon:a.attr("data-addon"),_wpnonce:t("#give_license_activator_nonce").val().trim()},beforeSend:function(){Give.fn.loader(r)},success:function(n){!0!==n.success?(n.data.hasOwnProperty("html")&&n.data.html.length&&(n.data.hasOwnProperty("is_all_access_pass")&&n.data.is_all_access_pass?e.html(n.data.html):r.replaceWith(n.data.html)),r=t(".give-addon-wrap").get(o),(d=t(".give-license-notice-container",r)).addClass("give-addon-notice-shown").prepend(Give.notice.fn.getAdminNoticeHTML(n.data.errorMsg,"error"))):n.data.hasOwnProperty("is_all_access_pass")&&n.data.is_all_access_pass?e.html(n.data.html):r.replaceWith(n.data.html)}}).done((function(){Give.fn.loader(r,{show:!1})})):d.addClass("give-addon-notice-shown").prepend(Give.notice.fn.getAdminNoticeHTML(give_addon_var.notices.invalid_license,"error")),e.on("click",".notice-dismiss",(function(){d.slideUp(150,(function(){d.removeClass("give-addon-notice-shown")}))}))})),t("#give-button__refresh-licenses").on("click",(function(n){n.preventDefault();var a=t(this);t.ajax({url:ajaxurl,method:"POST",data:{action:"give_refresh_all_licenses",_wpnonce:a.attr("data-nonce")},beforeSend:function(){a.text(a.attr("data-activating")),Give.fn.loader(e)},success:function(n){!0===n.success&&(e.html(n.data.html),t("#give-last-refresh-notice").text(n.data.lastUpdateMsg)),n.success&&!n.data.refreshButton||a.prop("disabled",!0)}}).done((function(){Give.fn.loader(e,{show:!1}),a.text(a.attr("data-activate"))}))}))})),t(document).ready((function(){var e=t(".give-upload-addon-form-wrap"),n=t("form",e),a=t('input[type="file"]',n),i=t(".give-activate-addon-wrap",n),o=t("button",n),r=t(".give-addon-upload-notices",n),d=t("#give-licenses-container");function c(a){r.empty(),t.ajax({url:"".concat(ajaxurl,"?action=give_upload_addon&_wpnonce=").concat(t('input[name="_give_upload_addon"]',n).val().trim()),method:"POST",data:a,contentType:!1,processData:!1,dataType:"json",beforeSend:function(){r.show(),Give.fn.loader(e,{loadingText:Give.fn.getGlobalVar("loader_translation").uploading})},success:function(e){var n;if(!0===e.success)return r.hide(),i.show(),o.attr("data-pluginPath",e.data.pluginPath),o.attr("data-pluginName",e.data.pluginName),o.attr("data-nonce",e.data.nonce),void d.html(e.data.licenseSectionHtml);n=e.data.hasOwnProperty("errorMsg")&&e.data.errorMsg?e.data.errorMsg:e.data.error,r.html(Give.notice.fn.getAdminNoticeHTML(n,"error"))}}).always((function(){Give.fn.loader(e,{show:!1})}))}e.on("drop",(function(e){e.stopPropagation(),e.preventDefault(),t(this).removeClass("give-dropzone-active");var n=e.originalEvent.dataTransfer.files,a=new FormData;a.append("file",n[0]),c(a)})),n.on("dragover",(function(e){t(this).addClass("give-dropzone-active")})).on("dragleave",(function(e){t(this).removeClass("give-dropzone-active")})),r.on("click",t(".notice-dismiss",r),(function(e){r.empty().hide(),n.removeClass("give-dropzone-active")})),a.on("change",(function(e){e.stopPropagation(),e.preventDefault();var n=new FormData,t=a[0].files[0];if(!t)return!1;n.append("file",t),c(n)})),o.on("click",(function(e){e.preventDefault(),r.empty(),t.ajax({url:ajaxurl,method:"POST",data:{action:"give_activate_addon",plugin:o.attr("data-pluginPath"),_wpnonce:o.attr("data-nonce")},beforeSend:function(){r.show(),o.text(o.attr("data-activating"))},success:function(e){if(!0===e.success){var n=give_addon_var.notices.addon_activated.replace("{pluginName}",o.attr("data-pluginName"));return r.show(),r.html(Give.notice.fn.getAdminNoticeHTML(n,"success")),void d.html(e.data.licenseSectionHtml)}e.data.hasOwnProperty("errorMsg")&&e.data.errorMsg?r.html(Give.notice.fn.getAdminNoticeHTML(e.data.errorMsg,"error")):Give.notice.fn.getAdminNoticeHTML(give_addon_var.notices.addon_activation_error,"error")}}).always((function(){o.text(o.attr("data-activate")),i.hide()}))}))}))}});