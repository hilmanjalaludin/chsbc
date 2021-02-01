/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	launcher.extra.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){a.fn.ribbon=function(f){if(!f){if(this.attr("id")){f=this.attr("id")}}var c=function(){return e};var e=c;c.selectedTabIndex=-1;var b=[];c.goToBackstage=function(){d.addClass("backstage")};c.returnFromBackstage=function(){d.removeClass("backstage")};var d=null;c.init=function(h){if(!h){h="ribbon"}d=a("#"+h);d.find(".ribbon-window-title").after('<div id="ribbon-tab-header-strip"></div>');var g=d.find("#ribbon-tab-header-strip");d.find(".ribbon-tab").each(function(j){var m=a(this).attr("id");if(m==undefined||m==null){a(this).attr("id","tab-"+j);m="tab-"+j}b[j]=m;var l=a(this).find(".ribbon-title");var i=a(this).hasClass("file");g.append('<div id="ribbon-tab-header-'+j+'" class="ribbon-tab-header"></div>');var k=g.find("#ribbon-tab-header-"+j);k.append(l);if(i){k.addClass("file");k.click(function(){c.switchToTabByIndex(j);c.goToBackstage()})}else{if(c.selectedTabIndex==-1){c.selectedTabIndex=j;k.addClass("sel")}k.click(function(){c.returnFromBackstage();c.switchToTabByIndex(j)})}a(this).hide()});d.find(".ribbon-button").each(function(i){var k=a(this).find(".button-title");k.detach();a(this).append(k);var j=a(this);this.enable=function(){j.removeClass("disabled")};this.disable=function(){j.addClass("disabled")};this.isEnabled=function(){return !j.hasClass("disabled")};if(a(this).find(".ribbon-hot").length==0){a(this).find(".ribbon-normal").addClass("ribbon-hot")}if(a(this).find(".ribbon-disabled").length==0){a(this).find(".ribbon-normal").addClass("ribbon-disabled");a(this).find(".ribbon-normal").addClass("ribbon-implicit-disabled")}});d.find(".ribbon-section").each(function(i){a(this).after('<div class="ribbon-section-sep"></div>')});d.find("div").attr("unselectable","on");d.find("span").attr("unselectable","on");d.attr("unselectable","on");c.switchToTabByIndex(c.selectedTabIndex)};c.switchToTabByIndex=function(h){var g=a("#ribbon #ribbon-tab-header-strip");g.find(".ribbon-tab-header").removeClass("sel");g.find("#ribbon-tab-header-"+h).addClass("sel");a("#ribbon .ribbon-tab").hide();a("#ribbon #"+b[h]).show()};a.fn.enable=function(){if(this.hasClass("ribbon-button")){if(this[0]&&this[0].enable){this[0].enable()}}else{this.find(".ribbon-button").each(function(){a(this).enable()})}};a.fn.disable=function(){if(this.hasClass("ribbon-button")){if(this[0]&&this[0].disable){this[0].disable()}}else{this.find(".ribbon-button").each(function(){a(this).disable()})}};a.fn.isEnabled=function(){if(this[0]&&this[0].isEnabled){return this[0].isEnabled()}else{return true}};c.init(f);a.fn.ribbon=c}})(jQuery);
