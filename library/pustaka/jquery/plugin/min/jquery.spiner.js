/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.spiner.js
 * @ Date		:	3/17/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){if(typeof(a.fn.Spiner)!="function"){a.fn.Spiner=function(f){var d={},g=(typeof(f.url)=="object"?Ext.EventUrl(f.url).Apply():f.url);if(typeof(f)=="object"){if(typeof f.param=="object"){for(var c in f.param){d[c]=f.param[c]}}if(typeof f.order=="object"){d.orderby=(f.order.order_by!="undefined"?f.order.order_by:"");d.type=(f.order.order_type!="undefined"?f.order.order_type:"");d.page=(f.order.order_page!="undefined"?f.order.order_page:"")}var b=((f.complete!=="undefined"&&typeof(f.complete)=="function")?f.complete:"");var e=a(document).prop("title");a(document).prop("title","...Please Wait....");a(this).html("");a(this).css("height","120px");a(this).addClass("ui-widget-ajax-spiner");a(this).load(g,d,function(i,h,j){if(h=="success"){a(document).prop("title",e);if(typeof(b)=="function"){b(a(this))}}a(this).removeClass("ui-widget-ajax-spiner");if(h=="error"){a(this).html("Error 404");a(document).prop("title",e)}})}};a.fn.waiter=function(f){var d={},g=(typeof(f.url)=="object"?Ext.EventUrl(f.url).Apply():f.url);if(typeof(f)=="object"){if(typeof f.param=="object"){for(var c in f.param){d[c]=f.param[c]}}if(typeof f.order=="object"){d.orderby=(f.order.order_by!="undefined"?f.order.order_by:"");d.type=(f.order.order_type!="undefined"?f.order.order_type:"");d.page=(f.order.order_page!="undefined"?f.order.order_page:"")}var b=((f.complete!=="undefined"&&typeof(f.complete)=="function")?f.complete:"");var e=a(document).prop("title");a(document).prop("title","...Please Wait....");a(this).html("<div id='ui-widget-ajax-spiner' class='ui-widget-ajax-spiner'></div>");a(this).css("height","120px");a(this).load(g,d,function(i,h,j){if(h=="success"){a(document).prop("title",e);a("#ui-widget-ajax-spiner").remove();if(typeof(b)=="function"){b(a(this))}}a("#ui-widget-ajax-spiner").remove();if(h=="error"){a(document).prop("title",e);a(this).html("Error 404")}})}};a.fn.loader=function(f){var d={},g=(typeof(f.url)=="object"?Ext.EventUrl(f.url).Apply():f.url);if(typeof(f)=="object"){if(typeof f.param=="object"){for(var c in f.param){d[c]=f.param[c]}}if(typeof f.order=="object"){d.orderby=(f.order.order_by!="undefined"?f.order.order_by:"");d.type=(f.order.order_type!="undefined"?f.order.order_type:"");d.page=(f.order.order_page!="undefined"?f.order.order_page:"")}var b=((f.complete!=="undefined"&&typeof(f.complete)=="function")?f.complete:"");var e=a(document).prop("title");a(document).prop("title","...Please Wait....");a(this).html("");a(this).css("height","50px");a(this).addClass("ui-widget-ajax-spiner-min");a(this).load(g,d,function(i,h,j){if(h=="success"){a(document).prop("title",e);a(this).removeClass("ui-widget-ajax-spiner-min");if(typeof(b)=="function"){b(a(this))}}if(h=="error"){a(document).prop("title",e);a(this).removeClass("ui-widget-ajax-spiner-min");a(this).html("Error 404")}a(document).prop("title",e);a(this).removeClass("ui-widget-ajax-spiner-min")})}}}})(jQuery);