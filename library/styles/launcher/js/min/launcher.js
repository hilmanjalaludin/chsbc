/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	launcher.js
 * @ Date		:	2/25/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

var getScriptURL=(function(){var a=(document.getElementsByTagName("script")),b=((a.length)-1),c=(a[b]);return function(){return c.src}})();(function(c){var a={layout:"launcher",root:"js"};var d=function(g){var h=c.System.view_library_url(),f=c.Date().getDuration(),e=c.define.version;return{isload:{},load:function(k){this.isload[h]=h;this.isload[g]=g;this.isload[a.layout]=a.layout;this.isload[a.root]=a.root;if(this.isload.length!=0){var j=Object.keys(this.isload).join("/"),i=j+"/"+k+".js?layout="+a.layout+"&amp;version="+e+"&amp;time="+f;if(i){document.write('<script language="text/javascript" type="text/javascript" src="'+i+'"><\/script>')}}},core:function(i){if(getScriptURL().indexOf("dev")!=-1){return new Array("dev",i).join("/")}else{if(getScriptURL().indexOf("min")!=-1){return new Array("min",i).join("/")}}},self:function(i){if(getScriptURL().indexOf("dev")!=-1){return new Array("dev",i).join("/")}else{if(getScriptURL().indexOf("min")!=-1){return new Array("min",i).join("/")}}}}};var b=new d("styles");new Ext.Inialize("EUI").View(b.core("EUI.Main"));new Ext.Inialize("EUI").View(b.core("EUI.Contact"));new Ext.Inialize("EUI").View(b.core("EUI.Timer"));new Ext.Inialize("EUI").Helper(b.core("EUI.jQueryMsg"));new Ext.Inialize("EUI").Helper(b.core("EUI.jQuery"));new Ext.Inialize("EUI").Helper(b.core("EUI.ActiveMenu"));new Ext.Inialize("EUI").Helper(b.core("EUI.CTIScript"));new Ext.Inialize("EUI").Helper(b.core("EUI.Treeview"));new Ext.Inialize("EUI").Helper(b.core("EUI.Dialog"));new Ext.Inialize("EUI").Helper(b.core("EUI.Purr"));new Ext.Inialize("EUI").Helper(b.core("EUI.Chat"));new Ext.Inialize("EUI").Helper(b.core("EUI.Masking"));b.load(b.self("launcher.extra"));b.load(b.self("launcher.osx"));b.load(b.self("launcher.modal"));b.load(b.self("launcher.user"))})(Ext);
