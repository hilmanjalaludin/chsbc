/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.pager.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(c){c.fn.pager=function(d){var e=c.extend({},c.fn.pager.defaults,d);return this.each(function(){c(this).empty().append(b(parseInt(d.pagenumber),parseInt(d.pagecount),d.buttonClickCallback));c(".pages li").mouseover(function(){document.body.style.cursor="pointer"}).mouseout(function(){document.body.style.cursor="auto"})})};function b(e,j,g){var k=c('<ul class="pages"></ul>');k.append(a("first",e,j,g)).append(a("prev",e,j,g));var h=1;var f=9;if(e>4){h=e-4;f=e+4}if(f>j){h=j-8;f=j}if(h<1){h=1}for(var i=h;i<=f;i++){var d=c('<li class="page-number">'+(i)+"</li>");i==e?d.addClass("pgCurrent"):d.click(function(){g(this.firstChild.data)});d.appendTo(k)}k.append(a("next",e,j,g)).append(a("last",e,j,g));return k}function a(h,d,g,f){var e=c('<li class="pgNext">'+h+"</li>");var i=1;switch(h){case"first":i=1;break;case"prev":i=d-1;break;case"next":i=d+1;break;case"last":i=g;break}if(h=="first"||h=="prev"){d<=1?e.addClass("pgEmpty"):e.click(function(){f(i)})}else{d>=g?e.addClass("pgEmpty"):e.click(function(){f(i)})}return e}c.fn.pager.defaults={pagenumber:1,pagecount:1}})(jQuery);
