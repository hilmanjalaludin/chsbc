/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	telkom.modal.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){"function"===typeof define&&define.amd?define(["jquery"],a):a(jQuery)})(function(v){var t=[],f=v(document),s=navigator.userAgent.toLowerCase(),i=v(window),u=[],e=null,d=/msie/.test(s)&&!/opera/.test(s),c=/opera/.test(s),h,a;h=d&&/msie 6./.test(s)&&"object"!==typeof window.XMLHttpRequest;a=d&&/msie 7.0/.test(s);v.modal=function(b,g){return v.modal.impl.init(b,g)};v.modal.close=function(){v.modal.impl.close()};v.modal.focus=function(b){v.modal.impl.focus(b)};v.modal.setContainerDimensions=function(){v.modal.impl.setContainerDimensions()};v.modal.setPosition=function(){v.modal.impl.setPosition()};v.modal.update=function(b,g){v.modal.impl.update(b,g)};v.fn.modal=function(b){return v.modal.impl.init(this,b)};v.modal.defaults={appendTo:"body",focus:!0,opacity:50,overlayId:"simplemodal-overlay",overlayCss:{},containerId:"simplemodal-container",containerCss:{},dataId:"simplemodal-data",dataCss:{},minHeight:null,minWidth:null,maxHeight:null,maxWidth:null,autoResize:!1,autoPosition:!0,zIndex:1000,close:!0,closeHTML:'<a class="modalCloseImg" title="Close"></a>',closeClass:"simplemodal-close",escClose:!0,overlayClose:!1,fixed:!0,position:null,persist:!1,modal:!0,onOpen:null,onShow:null,onClose:null};v.modal.impl={d:{},init:function(b,g){if(this.d.data){return !1}e=d&&!v.support.boxModel;this.o=v.extend({},v.modal.defaults,g);this.zIndex=this.o.zIndex;this.occb=!1;if("object"===typeof b){if(b=b instanceof v?b:v(b),this.d.placeholder=!1,0<b.parent().parent().size()&&(b.before(v("<span></span>").attr("id","simplemodal-placeholder").css({display:"none"})),this.d.placeholder=!0,this.display=b.css("display"),!this.o.persist)){this.d.orig=b.clone(!0)}}else{if("string"===typeof b||"number"===typeof b){b=v("<div></div>").html(b)}else{return alert("SimpleModal Error: Unsupported data type: "+typeof b),this}}this.create(b);this.open();v.isFunction(this.o.onShow)&&this.o.onShow.apply(this,[this.d]);return this},create:function(b){this.getDimensions();if(this.o.modal&&h){this.d.iframe=v('<iframe src="javascript:false;"></iframe>').css(v.extend(this.o.iframeCss,{display:"none",opacity:0,position:"fixed",height:u[0],width:u[1],zIndex:this.o.zIndex,top:0,left:0})).appendTo(this.o.appendTo)}this.d.overlay=v("<div></div>").attr("id",this.o.overlayId).addClass("simplemodal-overlay").css(v.extend(this.o.overlayCss,{display:"none",opacity:this.o.opacity/100,height:this.o.modal?t[0]:0,width:this.o.modal?t[1]:0,position:"fixed",left:0,top:0,zIndex:this.o.zIndex+1})).appendTo(this.o.appendTo);this.d.container=v("<div></div>").attr("id",this.o.containerId).addClass("simplemodal-container").css(v.extend({position:this.o.fixed?"fixed":"absolute"},this.o.containerCss,{display:"none",zIndex:this.o.zIndex+2})).append(this.o.close&&this.o.closeHTML?v(this.o.closeHTML).addClass(this.o.closeClass):"").appendTo(this.o.appendTo);this.d.wrap=v("<div></div>").attr("tabIndex",-1).addClass("simplemodal-wrap").css({height:"100%",outline:0,width:"100%"}).appendTo(this.d.container);this.d.data=b.attr("id",b.attr("id")||this.o.dataId).addClass("simplemodal-data").css(v.extend(this.o.dataCss,{display:"none"})).appendTo("body");this.setContainerDimensions();this.d.data.appendTo(this.d.wrap);(h||e)&&this.fixIE()},bindEvents:function(){var b=this;v("."+b.o.closeClass).bind("click.simplemodal",function(g){g.preventDefault();b.close()});b.o.modal&&b.o.close&&b.o.overlayClose&&b.d.overlay.bind("click.simplemodal",function(g){g.preventDefault();b.close()});f.bind("keydown.simplemodal",function(g){b.o.modal&&9===g.keyCode?b.watchTab(g):b.o.close&&b.o.escClose&&27===g.keyCode&&(g.preventDefault(),b.close())});i.bind("resize.simplemodal orientationchange.simplemodal",function(){b.getDimensions();b.o.autoResize?b.setContainerDimensions():b.o.autoPosition&&b.setPosition();h||e?b.fixIE():b.o.modal&&(b.d.iframe&&b.d.iframe.css({height:u[0],width:u[1]}),b.d.overlay.css({height:t[0],width:t[1]}))})},unbindEvents:function(){v("."+this.o.closeClass).unbind("click.simplemodal");f.unbind("keydown.simplemodal");i.unbind(".simplemodal");this.d.overlay.unbind("click.simplemodal")},fixIE:function(){var b=this.o.position;v.each([this.d.iframe||null,!this.o.modal?null:this.d.overlay,"fixed"===this.d.container.css("position")?this.d.container:null],function(g,k){if(k){var j=k[0].style;j.position="absolute";if(2>g){j.removeExpression("height"),j.removeExpression("width"),j.setExpression("height",'document.body.scrollHeight > document.body.clientHeight ? document.body.scrollHeight : document.body.clientHeight + "px"'),j.setExpression("width",'document.body.scrollWidth > document.body.clientWidth ? document.body.scrollWidth : document.body.clientWidth + "px"')}else{var m,l;b&&b.constructor===Array?(m=b[0]?"number"===typeof b[0]?b[0].toString():b[0].replace(/px/,""):k.css("top").replace(/px/,""),m=-1===m.indexOf("%")?m+' + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"':parseInt(m.replace(/%/,""))+' * ((document.documentElement.clientHeight || document.body.clientHeight) / 100) + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"',b[1]&&(l="number"===typeof b[1]?b[1].toString():b[1].replace(/px/,""),l=-1===l.indexOf("%")?l+' + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"':parseInt(l.replace(/%/,""))+' * ((document.documentElement.clientWidth || document.body.clientWidth) / 100) + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"')):(m='(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"',l='(document.documentElement.clientWidth || document.body.clientWidth) / 2 - (this.offsetWidth / 2) + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"');j.removeExpression("top");j.removeExpression("left");j.setExpression("top",m);j.setExpression("left",l)}}})},focus:function(b){var g=this,b=b&&-1!==v.inArray(b,["first","last"])?b:"first",j=v(":input:enabled:visible:"+b,g.d.wrap);setTimeout(function(){0<j.length?j.focus():g.d.wrap.focus()},10)},getDimensions:function(){var b="undefined"===typeof window.innerHeight?i.height():window.innerHeight;t=[f.height(),f.width()];u=[b,i.width()]},getVal:function(j,g){return j?"number"===typeof j?j:"auto"===j?0:0<j.indexOf("%")?parseInt(j.replace(/%/,""))/100*("h"===g?u[0]:u[1]):parseInt(j.replace(/px/,"")):null},update:function(j,g){if(!this.d.data){return !1}this.d.origHeight=this.getVal(j,"h");this.d.origWidth=this.getVal(g,"w");this.d.data.hide();j&&this.d.container.css("height",j);g&&this.d.container.css("width",g);this.setContainerDimensions();this.d.data.show();this.o.focus&&this.focus();this.unbindEvents();this.bindEvents()},setContainerDimensions:function(){var j=h||a,g=this.d.origHeight?this.d.origHeight:c?this.d.container.height():this.getVal(j?this.d.container[0].currentStyle.height:this.d.container.css("height"),"h"),j=this.d.origWidth?this.d.origWidth:c?this.d.container.width():this.getVal(j?this.d.container[0].currentStyle.width:this.d.container.css("width"),"w"),m=this.d.data.outerHeight(!0),l=this.d.data.outerWidth(!0);this.d.origHeight=this.d.origHeight||g;this.d.origWidth=this.d.origWidth||j;var o=this.o.maxHeight?this.getVal(this.o.maxHeight,"h"):null,n=this.o.maxWidth?this.getVal(this.o.maxWidth,"w"):null,o=o&&o<u[0]?o:u[0],n=n&&n<u[1]?n:u[1],k=this.o.minHeight?this.getVal(this.o.minHeight,"h"):"auto",g=g?this.o.autoResize&&g>o?o:g<k?k:g:m?m>o?o:this.o.minHeight&&"auto"!==k&&m<k?k:m:k,o=this.o.minWidth?this.getVal(this.o.minWidth,"w"):"auto",j=j?this.o.autoResize&&j>n?n:j<o?o:j:l?l>n?n:this.o.minWidth&&"auto"!==o&&l<o?o:l:o;this.d.container.css({height:g,width:j});this.d.wrap.css({overflow:m>g||l>j?"auto":"visible"});this.o.autoPosition&&this.setPosition()},setPosition:function(){var j,g;j=u[0]/2-this.d.container.outerHeight(!0)/2;g=u[1]/2-this.d.container.outerWidth(!0)/2;var k="fixed"!==this.d.container.css("position")?i.scrollTop():0;this.o.position&&"[object Array]"===Object.prototype.toString.call(this.o.position)?(j=k+(this.o.position[0]||j),g=this.o.position[1]||g):j=k+j;this.d.container.css({left:g,top:j})},watchTab:function(b){if(0<v(b.target).parents(".simplemodal-container").length){if(this.inputs=v(":input:enabled:visible:first, :input:enabled:visible:last",this.d.data[0]),!b.shiftKey&&b.target===this.inputs[this.inputs.length-1]||b.shiftKey&&b.target===this.inputs[0]||0===this.inputs.length){b.preventDefault(),this.focus(b.shiftKey?"last":"first")}}else{b.preventDefault(),this.focus()}},open:function(){this.d.iframe&&this.d.iframe.show();v.isFunction(this.o.onOpen)?this.o.onOpen.apply(this,[this.d]):(this.d.overlay.show(),this.d.container.show(),this.d.data.show());this.o.focus&&this.focus();this.bindEvents()},close:function(){if(!this.d.data){return !1}this.unbindEvents();if(v.isFunction(this.o.onClose)&&!this.occb){this.occb=!0,this.o.onClose.apply(this,[this.d])}else{if(this.d.placeholder){var b=v("#simplemodal-placeholder");this.o.persist?b.replaceWith(this.d.data.removeClass("simplemodal-data").css("display",this.display)):(this.d.data.hide().remove(),b.replaceWith(this.d.orig))}else{this.d.data.hide().remove()}this.d.container.hide().remove();this.d.overlay.hide();this.d.iframe&&this.d.iframe.hide().remove();this.d.overlay.remove();this.d={}}}}});
