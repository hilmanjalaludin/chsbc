/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.Browser.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){a.prototype.Browser=function(c){var c=(c?c:Ext.DOM),b={getName:function(){try{return(c.navigator.appName?c.navigator.appName:null)}catch(d){Ext.Error({log:d,name:c.navigator,lineNumber:d.lineNumber})}},getCode:function(){try{return(c.navigator.appCodeName?c.navigator.appCodeName:null)}catch(d){Ext.Error({log:d,name:c.navigator,lineNumber:d.lineNumber})}},getVersion:function(){try{return(c.navigator.appVersion?c.navigator.appVersion:null)}catch(d){Ext.Error({log:d,name:c.navigator,lineNumber:d.lineNumber})}},getBuildID:function(){try{return(c.navigator.buildID?c.navigator.buildID:null)}catch(d){Ext.Error({log:d,name:c.navigator,lineNumber:d.lineNumber})}},getPlatform:function(){try{return(c.navigator.platform?c.navigator.platform:null)}catch(d){Ext.Error({log:d,name:c.navigator,lineNumber:d.lineNumber})}}};return(b?b:Ext.Error({log:"Not found of property",name:"Ext.Browser() "}))}})(E_ui);
