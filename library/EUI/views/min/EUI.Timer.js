/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.Timer.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

var IntervalTime=null;(function(d,a){d.prototype.Timer=function(e){var b={Active:function(c){"undefined"!=typeof document.ctiapplet&&(IntervalTime=window.setInterval(function(){a.Ajax({url:a.DOM.INDEX+"/MonAgentActivity/UserActivity/",param:{},ERROR:function(f){try{a.Util(f).proc(function(h){a.Cmp(e).setText(h.time)})}catch(g){console.log(g)}}}).post()},c))},IntervalID:function(){return null!=typeof IntervalTime?IntervalTime:null}};return"object"==typeof b?b:!1}})(E_ui,Ext);
