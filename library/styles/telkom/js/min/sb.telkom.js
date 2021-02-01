/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	sb.telkom.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

$(function(){$("#side-menu").metisMenu()});$(function(){$(window).bind("load resize",function(){topOffset=50;width=(this.window.innerWidth>0)?this.window.innerWidth:this.screen.width;if(width<768){$("div.navbar-collapse").addClass("collapse");topOffset=100}else{$("div.navbar-collapse").removeClass("collapse")}height=((this.window.innerHeight>0)?this.window.innerHeight:this.screen.height)-1;height=height-topOffset;if(height<1){height=1}if(height>topOffset){$("#main_content").css("margin-top",$(".navbar-fixed-top").height())}});var a=window.location;var b=$("ul.nav a").filter(function(){return this.href==a||a.href.indexOf(this.href)==0}).addClass("active").parent().parent().addClass("in").parent();if(b.is("li")){b.addClass("active")}});
