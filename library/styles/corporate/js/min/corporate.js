/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	corporate.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

var getScriptURL=(function(){var a=(document.getElementsByTagName("script")),b=((a.length)-1),c=(a[b]);return function(){return c.src}})();(function(d){var a={layout:"corporate",root:"js"};var c=function(h){var i=d.System.view_library_url(),g=d.Date().getDuration(),f=d.define.version;return{isload:{},load:function(l){this.isload[i]=i;this.isload[h]=h;this.isload[a.layout]=a.layout;this.isload[a.root]=a.root;if(this.isload.length!=0){var k=Object.keys(this.isload).join("/"),j=k+"/"+l+".js?layout="+a.layout+"&amp;version="+f+"&amp;time="+g;if(j){document.write('<script language="text/javascript" type="text/javascript" src="'+j+'"><\/script>')}}},core:function(j){if(getScriptURL().indexOf("dev")!=-1){return new Array("dev",j).join("/")}else{if(getScriptURL().indexOf("min")!=-1){return new Array("min",j).join("/")}}},self:function(j){if(getScriptURL().indexOf("dev")!=-1){return new Array("dev",j).join("/")}else{if(getScriptURL().indexOf("min")!=-1){return new Array("min",j).join("/")}}}}};var b=new c("styles");var e=new Ext.Inialize("EUI");e.View(b.core("EUI.Main"));e.View(b.core("EUI.Contact"));e.View(b.core("EUI.Timer"));e.Helper(b.core("EUI.jQueryMsg"));e.Helper(b.core("EUI.Purr"));e.Helper(b.core("EUI.jQuery"));e.Helper(b.core("EUI.Chat"));e.Helper(b.core("EUI.ActiveMenu"));e.Helper(b.core("EUI.CTIScript"));e.Helper(b.core("EUI.Treeview"));b.load(b.self("user.corporate"))})(Ext);
