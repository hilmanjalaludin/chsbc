/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	launcher.user.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

Ext.DOM.ExtApplet=null;Ext.Session().getStore();Ext.DOM.INDEX=Ext.System.view_page_index();Ext.DOM.URL=Ext.System.view_app_url();Ext.DOM.LIBRARY=Ext.System.view_library_url();Ext.DOM.SYSTEM=Ext.System.view_sytem_url();Ext.DOM.V_STATUS_STORE=(function(){var a=Ext.Ajax({url:Ext.EventUrl(["CallReason","ReasonType"]).Apply(),method:"POST",param:{time:Ext.Date().getDuration()}}).json();return(typeof(a)=="object"?a:{})})();CTI.init(Ext.Session("HandlingType").getSession(),Ext.Session("HandlingType").getSession());Ext.DOM.onload=function(){CTI.prepareCTIClient();CTI.disableAllButton()};Ext.DOM.onUnload=function(){CTI.prepareDisconnect()};Ext.ActiveMenu().setup({});Ext.DOM.SMSNotification=function(){if(!Ext.Cmp("notification_bar_counter").IsNull()){$("#notification_bar_counter").notifyomen().init();window.setInterval(function(){$("#notification_bar_counter").notifyomen().callback(Ext.Ajax({url:Ext.EventUrl(["SMSInbox","Counter"]).Apply(),method:"GET",param:{read:0}}).json())},Ext.DOM.CONFIG.TIMER_LOOK_SMS)}};Ext.DOM.SMSBalance=function(){if(!Ext.Cmp("sms-content-balance").IsNull()){var a=new Array("Rp. ",0);window.setInterval(function(){var b=(Ext.Ajax({url:Ext.EventUrl(["SMSServer","Balance"]).Apply(),method:"GET",param:{time:Ext.Date().getDuration()}}).json());if(b.balance!=0){a=new Array("Rp. ",b.balance);Ext.Cmp("sms-content-balance").setText(a.join(" "))}},Ext.DOM.CONFIG.TIMER_LOOK_BALANCE);Ext.Cmp("sms-content-balance").setText(a.join(" "))}};var pageLayout;$(document).ready(function(){ExtApplet=new Ext.ViewPort(document.ctiapplet);ExtApplet.setApplet();$("#ribbon").ribbon();$(".ribbon-section").click(function(){$(".ribbon-section").removeClass("ribbon-button-active");$(this).addClass("ribbon-button-active")});var a=function(){$("body").css({"margin-top":"0px","padding-top":($("#ribbon").height()),"background-color":"#FFFFFF","border-bottom":"0px solid #FFFFFF"});$("#ribbon").css({"margin-top":"-7px"});$(".ribbon-tab").css({height:"70px"});$("#main_content").css({"margin-left":"-4px","margin-top":"0px","margin-right":"-4px",padding:"12px",height:($(window).height()-155)+"px",overflow:"auto","background-color":"#FFFFFF"})};a();$(window).resize(function(){a()});$("#toolbars-foot").extToolbars({extUrl:Ext.DOM.LIBRARY+"/gambar/icon",extTitle:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Title(),extMenu:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Menu(),extIcon:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Icon(),extText:true,extInput:true,extOption:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Option()})});
