/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.Contact.js
 * @ Date		:	2/15/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){a.prototype.ViewPort=function(c){var b={ctiParam:{},ctiMax:13,ctiApplet:null,setApplet:function(){try{if(typeof(c)=="object"){ExtApplet.ctiApplet=c}}catch(d){Ext.Error({log:d,name:"setApplet"})}},getApplet:function(){if(ExtApplet.ctiApplet!=null){return ExtApplet.ctiApplet}},getValidate:function(d){if(d.length>ExtApplet.ctiMax){return false}else{return true}},setData:function(e){if(typeof(e)=="object"){ExtApplet.ctiParam=e;var d=ExtApplet.getApplet(),f={Call:function(){try{if(ExtApplet.getValidate(e.Phone)){d.callDialCustomer("",(e.Phone?e.Phone:""),(e.CustomerId?e.CustomerId:""),(e.CustomerId?e.CustomerId:""));return}else{console.log("to long phone to dial");return}}catch(g){Ext.Msg(g).Error()}}}}return f},setHangup:function(){if(typeof(ExtApplet.getApplet())=="object"){ExtApplet.getApplet().callHangup();document.ctiapplet.callHangup();return false}},getCtiParam:function(){if(typeof(ExtApplet.ctiParam)=="object"){return ExtApplet.ctiParam}},getPhoneNumber:function(){if(typeof(ExtApplet.ctiParam)=="object"){return ExtApplet.ctiParam.Phone}},getCustomerId:function(){if(typeof(ExtApplet.ctiParam)=="object"){return ExtApplet.ctiParam.CustomerId}else{return false}},getCallerId:function(){if(typeof(ExtApplet.getApplet())=="object"){return document.ctiapplet.getCallerId()}else{return false}},getDirection:function(){try{if(typeof(ExtApplet.getApplet())=="object"){return document.ctiapplet.getCallDirection()}else{return false}}catch(d){console.log(d);return 0}},getCallSessionId:function(){try{if(typeof(ExtApplet.getApplet())=="object"){return document.ctiapplet.getCallSessionKey()}else{return 0}}catch(d){console.log(d);return 0}},getIvrData:function(){if(typeof(ExtApplet.getApplet())=="object"){document.ctiapplet.getCallerId()}else{return false}}};return b}})(E_ui);
