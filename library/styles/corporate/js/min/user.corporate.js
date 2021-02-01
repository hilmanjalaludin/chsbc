/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	user.corporate.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

Ext.DOM.ExtApplet=null;Ext.Session().getStore();Ext.DOM.INDEX=Ext.System.view_page_index();Ext.DOM.URL=Ext.System.view_app_url();Ext.DOM.LIBRARY=Ext.System.view_library_url();Ext.DOM.SYSTEM=Ext.System.view_sytem_url();Ext.DOM.V_STATUS_STORE=(function(){var a=Ext.Ajax({url:Ext.EventUrl(["CallReason","ReasonType"]).Apply(),method:"POST",param:{time:Ext.Date().getDuration()}}).json();return(typeof(a)=="object"?a:{})})();CTI.init(Ext.Session("HandlingType").getSession(),Ext.Session("HandlingType").getSession());Ext.DOM.onload=function(){CTI.prepareCTIClient();CTI.disableAllButton()};Ext.DOM.onUnload=function(){CTI.prepareDisconnect()};Ext.ActiveMenu().setup([{id:"SrcCustomerList",name:"SrcCustomerList",title:"Customer Followup"},{id:"MgtCustomerInbound",name:"MgtCustomerInbound",title:"Call Inbound"},{id:"ModDashboard",name:"ModDashboard",title:"Agent Dashboard"}]);$(function(){ExtApplet=new Ext.ViewPort(document.ctiapplet);ExtApplet.setApplet();Ext.Timer("time_counter").Active(1000);$("#nav-menu li a.menu-li").click(function(b){b.preventDefault();$("#nav-menu li a.menu-li").addClass("hover-active").not(this).removeClass("hover-active")});$(" ul.submenu li.child").click(function(b){b.preventDefault();$(" ul.submenu li.child").addClass("hover-activew").not(this).removeClass("hover-activew")});var a=function(){var e=$(window).height(),b=$(window).height(),f=$("#accordion").width(),c=$(window).width(),d=$(window).height();e=e-90;b=b-90;$("body").css({overflow:"hidden"});aw=c-(f+10);d=d-(e-70);$(".content").css({background:"url("+Ext.DOM.LIBRARY+"/gambar/next.gif) no-repeat 0 0"});$("#main_content").css({height:($(window).height()-130),"overflow-y":"auto",background:"url("+Ext.DOM.LIBRARY+"/gambar/hilight.png) repeat-x 0 bottom","overflow-x":"hidden",border:"0px solid #000","margin-top":"-10px","margin-bottom":"-2px","padding-top":"5px","padding-left":"5px","padding-right":"5px",width:aw})};a();$(window).resize(function(){a()});$("#toolbars-foot").extToolbars({extUrl:Ext.DOM.LIBRARY+"/gambar/icon",extTitle:Ext.ActiveBars(Ext.Session("HandlingType").getSession()).Title(),extMenu:Ext.ActiveBars(Ext.Session("HandlingType").getSession()).Menu(),extIcon:Ext.ActiveBars(Ext.Session("HandlingType").getSession()).Icon(),extText:true,extInput:true,extOption:Ext.ActiveBars(Ext.Session("HandlingType").getSession()).Option()})});
