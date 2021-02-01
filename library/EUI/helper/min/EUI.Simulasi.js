/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.Simulasi.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

function ProductPremiTable(b){var a=Ext.Serialize("frmSimulasi");$("#ui-widget-pcroduct-premi").Spiner({url:new Array("Simulasi","PagePremi"),param:Ext.Join(new Array(a.getElement())).object(),order:{order_type:b.type,order_by:b.orderby,order_page:b.page},complete:function(d){var c=new Array("#",$(d).attr("id")).join("");$(c).attr("style","");$(c).css({padding:"4px 4px 4px 4px"});$("#ui-widget-content-markup-tabs").mytab().tabs("option","selected",0)}})}function ProductBenefitTable(a){$("#ui-widget-pcroduct-benefit").Spiner({url:new Array("Simulasi","PageBenefit"),param:{ProductPlanId:a.ProductPlanId},order:{order_type:a.type,order_by:a.orderby,order_page:a.page},complete:function(c){var b=new Array("#",$(c).attr("id")).join("");var d=$("#ProductName").val();$(b).attr("style","");$(b).css({padding:"4px 4px 4px 4px"});$("#ui-widget-content-markup-tabs").mytab().tabs("option","selected",1);$("#title-product").html(" ( "+d+" ) ")}})}function ShowProductBenefit(a){if(!Ext.Msg("Do you want to open detail benefit ?").Confirm()){return false}new ProductBenefitTable({orderby:"",type:"",page:0,ProductPlanId:a})}function ShowProductPremi(){new ProductPremiTable({orderby:"",type:"",page:0})}function ClearProductPremi(){Ext.Serialize("frmSimulasi").Clear();new ProductPremiTable({orderby:"",type:"",page:0});$("#ui-widget-pcroduct-benefit").html("");$("#title-product").html("")}$(document).ready(function(){$("#ui-widget-content-markup-tabs").mytab().tabs();$("#ui-widget-content-markup-tabs").mytab().tabs("option","selected",0);$("#ui-widget-content-markup-tabs").mytab().close({},true);$(".ui-widget-content-frame").css("background-color","#FFFFFF");$(".select").chosen();new ShowProductPremi();$("body").css({margin:"8px"})});
