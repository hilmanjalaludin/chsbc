/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.jQuery.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

Ext.EQuery={TotalRecord:0,TotalPage:0,ShowRecord:true,Navigate:"",Content:"",Fields:{},Totals:"",Main:"dta_contact_detail.php",construct:function(b,a){this.Navigate=(b.custnav!=""?b.custnav:"");this.Content=(b.custlist!=""?b.custlist:"");this.Fields=(a!=""?a:"")},postText:function(){console.log(this.Fields);var b="";for(var a in this.Fields){b=b+"&"+a+"="+this.Fields[a]}b=b.substring(1,b.length);return b},postContentList:function(){if(parseInt(Ext.EQuery.TotalPage)!=0){Ext.query(function(){Ext.query("#pager").aqPaging({current:1,pages:Ext.EQuery.TotalPage,records:(Ext.EQuery.TotalRecord==""?0:Ext.EQuery.TotalRecord),rec:Ext.EQuery.ShowRecord,callfunc:Ext.EQuery,flip:true,cb:function(a){Ext.EQuery.Fields.v_page=a;$(".ui-widget-load-pager").html("Loading ...");$(".ui-widget-load-pager").addClass("pager-loader");$(".content_table").load(Ext.EQuery.Content,Ext.EQuery.Fields,function(c,b,d){$(".ui-widget-load-pager").html("");$(".ui-widget-load-pager").removeClass("pager-loader")})}})})}else{$(function(){$("#pager").aqPaging({current:1,pages:1,records:Ext.EQuery.TotalRecord,flip:true,cb:function(a){$(".ui-widget-load-pager").html("Loading ...");$(".ui-widget-load-pager").addClass("pager-loader");$(".content_table").load(Ext.EQuery.Content,Ext.EQuery.Fields,function(c,b,d){$(".ui-widget-load-pager").html("");$(".ui-widget-load-pager").removeClass("pager-loader")})}})})}},pageContent:function(a){var a=a;$(function(){$("#pager").aqPaging.flip("aqPaging_1",a,this.TotalPage)})},postContent:function(){$("#main_content").load(this.Navigate,this.Fields,function(b,a,c){if(a=="error"){$("#main_content").html(b)}})},orderBy:function(c,a){$.cookie("selected",0);var d=(this.Fields.type!=""?(this.Fields.type=="ASC"?"DESC":"ASC"):"ASC"),b=(typeof(c)=="undefined"?"":c);if(b){Ext.EQuery.Fields.order_by=b;Ext.EQuery.Fields.type=d}Ext.EQuery.postContent()},contactDetail:function(a,c){try{if(a.length>0&&c.length>0){Ext.query("#main_content").load(this.Main+"?customerid="+a+"&campaignid="+c);return}}catch(b){alert(b)}},verifiedContent:function(a,b,c){if((a!="")&&(b!="")){Ext.query("#main_content").load(this.Main+"?customerid="+a+"&campaignid="+b+"&VerifiedStatus="+c);return}else{alert("No Customer ID. Please try again..!");return false}},Ajax:function(a){if(typeof(a)=="object"){Ext.query("#main_content").load(Ext.Ajax({url:a.url,method:a.method,param:a.param})._ajaxSetup)}}};
