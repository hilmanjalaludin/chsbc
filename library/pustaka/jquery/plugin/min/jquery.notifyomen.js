/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.notifyomen.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){if(typeof a.fn.notifyomen!=="function "){a.fn.notifyomen=function(){this.data={},this.callback=function(b){if(typeof(b)=="object"){this.data=b;if(this.data.success==1){this.show();this.counter(this.data.count)}else{this.hide()}}},this.init=function(){a(this).addClass("ui-widget-notification")},this.show=function(){a(this).css("display","inline")},this.hide=function(){a(this).css("display","none")};this.counter=function(b){a("#ui-counter-content").html(" ( "+(b?b:0)+" ) ")};return this}}})(jQuery);
