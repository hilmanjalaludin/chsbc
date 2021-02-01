/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.UserLogin.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

Ext.DOM.IMAGE=Ext.System.view_library_url();Ext.DOM.URL=Ext.System.view_app_url();Ext.DOM.SYSTEM=Ext.System.view_sytem_url();Ext.DOM.INDEX=Ext.System.view_page_index();Ext.DOM.ENTER=13;$(document).ready(function(){$(document).bind("resize",function(){$("body").css("height",$(window).height())});$("body").css("height",$(window).height());var d=1,a=2,c=3,b=4,e=5;Ext.DOM.UserLogin=function(){var f=Ext.Serialize("frmLogin").Required(["username","password"]);if(f){Ext.Ajax({url:Ext.DOM.INDEX+"/Auth/login",method:"POST",param:{username:Ext.Cmp("username").Encrypt(),password:Ext.Cmp("password").Encrypt()},ERROR:function(g){Ext.Util(g).proc(function(h){if(h.success==1){Ext.DOM.location=Ext.DOM.INDEX;return true}else{if(h.success==a){Ext.Msg("\nYour account already login on ( "+h.location+" ).\nPlease contact Your Administrator").Info();return false}else{if(h.success==c){Ext.Msg("Your account already login").Info();return false}else{if(h.success==b){Ext.Msg("Incorrect Username Or Password").Error();return false}else{Ext.Msg("Incorrect Username Or Password").Error();return false}}}}})}}).post()}};$(window).bind("keydown",function(f){if(f.keyCode==Ext.DOM.ENTER){return Ext.DOM.UserLogin()}})});
