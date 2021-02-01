/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.customizetab.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(){var d={supportsFullScreen:false,isFullScreen:function(){return false},requestFullScreen:function(){},cancelFullScreen:function(){},fullScreenEventName:"",prefix:""},c="webkit moz o ms khtml".split(" ");if(typeof document.cancelFullScreen!="undefined"){d.supportsFullScreen=true}else{for(var b=0,a=c.length;b<a;b++){d.prefix=c[b];if(typeof document[d.prefix+"CancelFullScreen"]!="undefined"){d.supportsFullScreen=true;break}}}if(d.supportsFullScreen){d.fullScreenEventName=d.prefix+"fullscreenchange";d.isFullScreen=function(){switch(this.prefix){case"":return document.fullScreen;case"webkit":return document.webkitIsFullScreen;default:return document[this.prefix+"FullScreen"]}};d.requestFullScreen=function(e){return(this.prefix==="")?e.requestFullScreen():e[this.prefix+"RequestFullScreen"]()};d.cancelFullScreen=function(e){return(this.prefix==="")?document.cancelFullScreen():document[this.prefix+"CancelFullScreen"]()}}if(typeof jQuery!="undefined"){jQuery.fn.requestFullScreen=function(){return this.each(function(){var e=jQuery(this);if(d.supportsFullScreen){d.requestFullScreen(e)}})}}window.fullScreenApi=d})();(function(a){a.isCollape=false;if(typeof(a.fn.mytab)!=="function"){a.fn.mytab=function(){$uniq={};$fn=a(this);$id=[a(this).attr("id"),"close"].join("-");$uniq[a(this).attr("id")]=$id;var b={collapse:function(d){var e=document.getElementById(d);if(fullScreenApi.isFullScreen()){window.fullScreenApi.cancelFullScreen(e);a.isCollape=true;return}if(!fullScreenApi.isFullScreen()){window.fullScreenApi.requestFullScreen(e);a(e).css({overflow:"auto","overflow-x":"hidden","background-color":"#FFFEEE"});a.isCollape=false;return}},close:function(h,f){$fn=a(this);$id=[a(this).attr("id"),"close"].join("-");if(typeof(f)=="boolean"){if(a("#"+$id).length==0){var g='<div id="'+$id+'-minimize"></div>';a($fn.selector+" li.ui-tab-li-lasted").after(g);$btn=a("#"+$id+"-minimize");$btn.css("-moz-user-select","none");$btn.css("float","right");$btn.css("margin","2px 5px 0px 2px");$btn.css({padding:"3px 2px -1px 3px"});$btn.attr("unselectable","off");$btn.addClass("ui-icon ui-icon-plusthick ui-widget-tab-close-customize");$btn.bind("click",function(){$div=a(this).parent();if($div.parent().attr("id")!==""){b.collapse($div.parent().attr("id"));if(a.isCollape){a(this).removeClass("ui-icon-minusthick");a(this).addClass("ui-icon-plusthick")}else{a(this).removeClass("ui-icon-plusthick");a(this).addClass("ui-icon-minusthick")}}})}}for(var e in $uniq){if(a("#"+$uniq[e]).length==0){if(typeof(h)=="function"){a(this).find($uniq[e]).remove();var d='<div id="'+$uniq[e]+'"></div>';a("#"+e+" li.ui-tab-li-lasted").after(d);thisClose=a("#"+$uniq[e]);thisClose.css({"-moz-user-select":"none","float":"right",margin:"2px 5px 0px 2px",padding:"3px 2px -1px 3px",unselectable:"off"});thisClose.addClass("ui-icon ui-icon-closethick ui-widget-tab-close-customize");thisClose.bind("click",function(){if(typeof(h)=="function"){h($fn)}})}}}},add:function(e){$fn=a(this);var d='<div id="'+e+'"></div>';a($fn.selector+" li.ui-tab-li-add").after(d);$close=a("#"+e);$close.css("-moz-user-select","none");$close.css("float","right");$close.css("font-weight","normal");$close.css("font-size","11px");$close.css("margin","5px 5px 0px 2px");$close.attr("unselectable","off")}};for(var c in b){if(typeof(b[c])=="function"){$fn[c]=b[c]}}return $fn}}})(jQuery);