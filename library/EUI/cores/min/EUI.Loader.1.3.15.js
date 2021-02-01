/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.Loader.1.3.15.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){a.prototype.Inialize=function(b){var c={};var d=b;var e={url:Ext.System.view_library_url(),time:Ext.Date().getDuration(),ver:Ext.define.version};return{quick_class_views:{},quick_class_helper:{},quick_class_plugin:{},View:function(f){this.quick_class_views[f]=e.url+"/"+d+"/views/"+f+".js?version="+e.ver+"&amp;time="+e.time;this.loader(this.quick_class_views)},Helper:function(f){this.quick_class_helper[f]=e.url+"/"+d+"/helper/"+f+".js?version="+e.ver+"&amp;time="+e.time;this.loader(this.quick_class_helper)},loader:function(g){if(typeof(g)=="object"){for(var f in g){document.write('<script language="text/javascript" type="text/javascript" src="'+g[f]+'"><\/script>')}}},$:function(f){this.quick_class_plugin[f]=e.url+"/"+d+"/"+f+".js?version="+e.ver+"&amp;time="+e.time;$(function(){for(var g in this.quick_class_plugin){$.getScript(this.quick_class_plugin[g],function(h){})}})}}}})(E_ui);
