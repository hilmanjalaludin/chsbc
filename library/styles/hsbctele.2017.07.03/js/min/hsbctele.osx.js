/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	hsbctele.osx.js
 * @ Date		:	6/27/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

jQuery(function(b){var a={container:null,init:function(){b("div.osx,span.osx,li.osx,a.osx,input.osx, a.osx").click(function(c){c.preventDefault();console.log(typeof(b("#osx-modal-content").modal))})},open:function(e){var c=this;c.container=e.container[0];e.overlay.fadeIn("slow",function(){b("#osx-modal-content",c.container).show();var d=b("#osx-modal-title",c.container);d.show();e.container.slideDown("slow",function(){setTimeout(function(){var f=b("#osx-modal-data",c.container).height()+d.height()+20;e.container.animate({height:f},200,function(){b("div.close",c.container).show();b("#osx-modal-data",c.container).show()})},300)})})},close:function(e){var c=this;e.container.animate({top:"-"+(e.container.height()+20)},500,function(){c.close()})}};a.init()});
