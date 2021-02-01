/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.seletdown.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){if(typeof(a.fn.toogle)!=="function"){a.fn.toogle=function(e){var b=a(this),i=b.attr("id"),g=[i,"selectdown"],h=null,d=g.join("-"),f=["ajaxs",d].join("-");var c=function(){var l={};for(var k in e.param){if(typeof(e.param[k])=="object"){l[k]=e.param[k].toString()}else{l[k]=e.param[k]}}if(typeof(e.elval)=="object"){e.elval.map(function(m){l[m]=Ext.Cmp(m).getValue()})}var j=[Ext.DOM.INDEX,e.url];a("#"+f).load(j.join("/"),l)};this.defaults=function(){h=a("#"+d);h.addClass("toggle-active ui-down-default");h.bind("click",function(){var j=a(this).attr("class").split(/\s+/);if(j[0]=="toggle-active"){b.attr("multiple","true");b.removeClass("select long");b.addClass("select_multiple long");h.removeClass("toggle-active ui-down-default");h.addClass("toggle-notactive ui-down-default")}else{b.removeAttr("multiple");b.removeClass("select_multiple long");b.addClass("select long");h.removeClass("toggle-notactive ui-down-default");h.addClass("toggle-active ui-down-default")}})};this.AjaxToggle=function(){h=a("#"+d);h.addClass("toggle-active ui-down-active");e.param.id=i;e.param.type="dropdown";c();h.bind("click",function(){var k=a(this).attr("class").split(/\s+/);if(k[0]=="toggle-active"){h.removeClass("toggle-active ui-down-active");h.addClass("toggle-notactive ui-down-active");var j=new Ext.Cmp(i);e.param.select=(!j.IsNull()?j.getValue():"");e.param.id=i;e.param.type="listboxes";c()}else{h.removeClass("toggle-notactive ui-down-active");h.addClass("toggle-active ui-down-active");var j=new Ext.Cmp(i);e.param.type="dropdown";e.param.id=i;e.param.select=(!j.IsNull()?j.getValue():"");c()}})};if(typeof(e)=="undefined"){a('<div id="'+d+'"></div>').insertAfter(a(this));this.defaults()}if(typeof(e)=="object"){if(Ext.Cmp("field_"+a(this).attr("id")).IsNull()==false){$attrs=a("#field_"+a(this).attr("id"));a('<div id="'+f+'"></div>').insertBefore($attrs);a('<div id="'+d+'"></div>').insertAfter($attrs);$attrs.remove()}else{a('<div id="'+f+'"></div>').insertBefore(a(this));a('<div id="'+d+'"></div>').insertAfter(a(this));a(this).remove()}this.AjaxToggle()}}}})(jQuery);
