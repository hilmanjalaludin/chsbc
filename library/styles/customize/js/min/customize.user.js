/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	customize.user.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

Ext.DOM.ExtApplet=null;Ext.Session().getStore();Ext.DOM.INDEX=Ext.System.view_page_index();Ext.DOM.URL=Ext.System.view_app_url();Ext.DOM.LIBRARY=Ext.System.view_library_url();Ext.DOM.SYSTEM=Ext.System.view_sytem_url();Ext.DOM.V_STATUS_STORE=(function(){var a=Ext.Ajax({url:Ext.EventUrl(["CallReason","ReasonType"]).Apply(),method:"POST",param:{time:Ext.Date().getDuration()}}).json();return(typeof(a)=="object"?a:{})})();CTI.init(Ext.Session("HandlingType").getSession(),Ext.Session("HandlingType").getSession());Ext.DOM.onload=function(){CTI.prepareCTIClient();CTI.disableAllButton()};Ext.DOM.onUnload=function(){CTI.prepareDisconnect()};Ext.ActiveMenu().setup({});Ext.DOM.SMSNotification=function(){if(!Ext.Cmp("notification_bar_counter").IsNull()){$("#notification_bar_counter").notifyomen().init();window.setInterval(function(){$("#notification_bar_counter").notifyomen().callback(Ext.Ajax({url:Ext.EventUrl(["SMSInbox","Counter"]).Apply(),method:"GET",param:{read:0}}).json())},Ext.DOM.CONFIG.TIMER_LOOK_SMS)}};Ext.DOM.NotifyInformation=function(){if(!Ext.Cmp("notification_bar_warning").IsNull()){$("#notification_bar_warning").notifyomen().init();window.setInterval(function(){$("#notification_bar_warning").notifyomen().callback(Ext.Ajax({url:Ext.EventUrl(["QtyApprovalInterest","Interested"]).Apply(),method:"GET",param:{read:0}}).json())},5000)}};Ext.DOM.SMSBalance=function(){if(!Ext.Cmp("sms-content-balance").IsNull()){var a=new Array("Rp. ",0);window.setInterval(function(){var b=(Ext.Ajax({url:Ext.EventUrl(["SMSServer","Balance"]).Apply(),method:"GET",param:{time:Ext.Date().getDuration()}}).json());if(b.balance!=0){a=new Array("Rp. ",b.balance);Ext.Cmp("sms-content-balance").setText(a.join(" "))}},Ext.DOM.CONFIG.TIMER_LOOK_BALANCE);Ext.Cmp("sms-content-balance").setText(a.join(" "))}};var pageLayout;var createLayout=function(){$("#main_content").css({height:($(window).innerHeight()-($(".nav").innerHeight()+$(".ui-bottom-widget-navigation-bars").height()+16)),width:"99%",border:"0px solid #000000","margin-left":"3px","margin-right":"-5px","margin-top":"-29px","float":"left",display:"table-cell",overflow:"auto",padding:"12px 5px 5px 5px"})};$(document).ready(function(){ExtApplet=new Ext.ViewPort(document.ctiapplet);ExtApplet.setApplet();createLayout();$("#toolbars-foot").extToolbars({extUrl:Ext.DOM.LIBRARY+"/gambar/icon",extTitle:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Title(),extMenu:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Menu(),extIcon:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Icon(),extText:true,extInput:true,extOption:Ext.ActiveBars(Ext.Session("UserGroup").getSession()).Option()});Ext.DOM.SMSNotification();Ext.DOM.SMSBalance();Ext.DOM.NotifyInformation()});$(window).resize(function(){createLayout()});
