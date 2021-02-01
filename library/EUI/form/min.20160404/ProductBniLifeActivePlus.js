/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	ProductBniLifeActivePlus.js
 * @ Date		:	4/1/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

var tmp_selected_box={};var tmp_selected_bnf={};var config={};(function(){var a=Ext.Ajax({url:Ext.EventUrl(new Array("ActiveMenu","UserConfig")).Apply(),method:"GET",param:{time:Ext.Date().getDuration()}}).json();if(typeof(a)=="object"){for(var b in a){config[b]=a[b]}}})();var INT_DEPEND_CODE=config.INS_CODE_DEPEND;var INT_MAIN_CODE=config.INS_CODE_MAIN;var INT_RIDER_CODE=config.INS_CODE_RIDER;var INT_SPOUSE_CODE=config.INS_CODE_SPOUSE;var INT_FAMILY_CODE=config.INS_CODE_FAMILY;var VAR_MAIN_CODE=new Array(config.INS_CODE_MAIN,1).join("_");var VAR_SPOUSE_CODE=new Array(config.INS_CODE_SPOUSE,1).join("_");var VAR_RIDER_CODE=new Array(config.INS_CODE_RIDER,1).join("_");function OpenCheckedBeneficiary(){var c=Ext.Cmp("Benefiecery").getValue();for(var b in c){var a=new Array(".frmbenef",c[b]).join("_");$(a).each(function(){Ext.Cmp($(this).attr("id")).disabled(false)})}}function NodeClass(a){var b=$(a).attr("class");if(a.value=="Y"){$(".node-"+b).attr("disabled",false);$(".node-"+b).addClass("yes-required-input");$(".node-"+b).removeClass("no-required-input")}else{$(".node-"+b).addClass("no-required-input");$(".node-"+b).removeClass("yes-required-input");$(".node-"+b).attr("disabled",true)}}function ValidateUnderwriting(){var c={};var a=Ext.Serialize("frmUnderwriting").getElement();for(var b in a){var d=$("#"+b).attr("class").split(/\s+/);if($("#"+b).attr("class").split(/\s+/).indexOf("no-required-input")>0){c[b]=b}}return Object.keys(c)}function IsUnderwriting(){var a=Ext.Cmp("isunderwriting").getValue();if(a==1){return true}else{return false}}function OpenCheckedInsured(){var c=Ext.Cmp("GroupPremi").getValue();for(var b in c){var a=new Array(".form",c[b]).join("_");$(a).each(function(){Ext.Cmp($(this).attr("id")).disabled(false)})}}function SelectDeleteBox(){var c=Ext.Cmp("GroupPremi").getCheckBox().IsUnchecked(),b=Ext.Cmp("Benefiecery").getCheckBox().IsUnchecked(),a={InsuredBox:c,BenefitBox:b};return a}function SelectValidationPercentage(){var b=Ext.Cmp("Benefiecery").getValue(),f={};for(var d in b){var a=new Array("frmbenef",b[d]).join("_");$(new Array(".",a).join("")).each(function(){var g=$(this).attr("class").split(" ");if(g.indexOf("ui-self-percentage")>0){f[$(this).attr("id")]=$(this).attr("id")}})}var c=100,e=0;for(var d in f){e=e+parseInt(Ext.Cmp(f[d]).getValue())}return((e>c)?false:true)}function SelectValidationBenefiecery(){var b=Ext.Cmp("Benefiecery").getValue(),e={};for(var c in b){var a=new Array("frmbenef",b[c]).join("_");$(new Array(".",a).join("")).each(function(){e[$(this).attr("id")]=$(this).attr("id")})}var d=Ext.Serialize("frmBenefiecery").Required(Object.keys(e));if(d){return true}return false}function SelectValidationInsured(){var e=Ext.Cmp("GroupPremi").getValue(),b={};if(e.length==0){return false}for(var c in e){if(e[c]!=VAR_MAIN_CODE){var a=new Array("form",e[c]).join("_");$(new Array(".",a).join("")).each(function(){var f=$(this).attr("class").split(" ");if(f.indexOf("not-required")<0){b[$(this).attr("id")]=$(this).attr("id")}})}}var d=Ext.Serialize("frmSpouseInsured").Required(Object.keys(b));if(d){return true}var d=Ext.Serialize("frmDependentInsured").Required(Object.keys(b));if(d){return true}return false}function SelectedInterfaceTab(a){if(typeof(a)=="undefined"){$("#result_content_add").mytab().tabs("option","selected",0)}else{$("#result_content_add").mytab().tabs("option","selected",a)}}function SetEventSubmit(){var g=Ext.Serialize("frmDataProduct"),f=Ext.Serialize("frmDataPayersContact"),e=Ext.Serialize("frmDataPayersPersonal"),j=Ext.Serialize("frmDataPayersZipcode"),l=Ext.Serialize("frmDependentInsured"),i=Ext.Serialize("frmSpouseInsured"),a=Ext.Serialize("frmMainInsured"),c=Ext.Serialize("frmBenefiecery"),d=Ext.Serialize("frmTransactionPlan"),h=Ext.Serialize("frmTransactionCard"),k=new SelectDeleteBox(),m=Ext.Serialize("frmUnderwriting"),b=new ValidateUnderwriting();if(!g.Complete(new Array("PolicyNumber"))){Ext.Msg("Form Product Not Complete").Info();new SelectedInterfaceTab(0);return false}if(!e.Complete(new Array("PayerIdentificationNum"))){Ext.Msg("Form Personal Data Not Complete").Info();new SelectedInterfaceTab(0);return false}if(!a.Complete(new Array("SubmitedPremi_2_1"))){Ext.Msg("Form Main Insured Not Complete").Info();new SelectedInterfaceTab(1);return false}if(!SelectValidationInsured()){Ext.Msg("Form Insured Not Complete").Info();new SelectedInterfaceTab(1);return false}if(!d.Complete()){Ext.Msg("Form Plan Insured Not Complete").Info();new SelectedInterfaceTab(2);return false}if(IsUnderwriting()&&!m.Complete(b)){Ext.Msg("Form Underwriting Not Complete").Info();new SelectedInterfaceTab(3);return false}if(!SelectValidationBenefiecery()){Ext.Msg("Form Beneficiary Not Complete").Info();new SelectedInterfaceTab(4);return false}if(!SelectValidationPercentage()){Ext.Msg("Form Beneficiary Percentage Invalid!").Info();new SelectedInterfaceTab(4);return false}Ext.Ajax({url:Ext.EventUrl(new Array("ProductBniLifeActivePlus","SaveDataEntry")).Apply(),method:"POST",param:Ext.Join(new Array(g.getElement(),f.getElement(),e.getElement(),j.getElement(),l.getElement(),i.getElement(),a.getElement(),c.getElement(),d.getElement(),h.getElement(),m.getElement(),k)).object(),ERROR:function(n){Ext.Util(n).proc(function(o){if(o.success){Ext.Msg("Save Data Entry").Success();Ext.Cmp("PolicyNumber").setValue(o.PolicyNumber)}else{Ext.Msg("Save Data Entry").Failed()}})}}).post()}function SelectCalculatorPremi(b){var b=b,a={listener:function(){return(Ext.Ajax({url:Ext.EventUrl(new Array("ProductBniLifeActivePlus","SelectPremiPersonal")).Apply(),method:"POST",param:{personal_data:JSON.stringify(b)}}).json())},object:function(){try{return this.listener()}catch(c){return{}}}};return(typeof(a)=="object"?a:{})}function MainInsuredCopy(d){var c=tmp_selected_box;if(d==VAR_MAIN_CODE){var h=new Array("InsuredDOB",d).join("_"),e=new Array("GenderId",d).join("_"),b=new Array("SalutationId",d).join("_"),g=new Array("InsuredFirstName",d).join("_"),f=new Array("RelationshipTypeId",d).join("_"),a=new Array("InsuredAge",d).join("_");InsuredPremi=new Array("SubmitedPremi",d).join("_");if(typeof(c[h])=="undefined"){Ext.Cmp(h).setValue(Ext.Cmp("PayerDOB").getValue())}else{if(Ext.Cmp("PayerDOB").empty()){Ext.Cmp(h).setValue(c[h])}else{Ext.Cmp(h).setValue(Ext.Cmp("PayerDOB").getValue())}}if(typeof(c[e])=="undefined"){Ext.Cmp(e).setValue(Ext.Cmp("PayerGenderId").getValue())}else{if(Ext.Cmp("PayerGenderId").empty()){Ext.Cmp(e).setValue(c[e])}else{Ext.Cmp(e).setValue(Ext.Cmp("PayerGenderId").getValue())}}if(typeof(c[b])=="undefined"){Ext.Cmp(b).setValue(Ext.Cmp("PayerSalutationId").getValue())}else{if(Ext.Cmp("PayerSalutationId").empty()){Ext.Cmp(b).setValue(c[b])}else{Ext.Cmp(b).setValue(Ext.Cmp("PayerSalutationId").getValue())}}if(typeof(c[g])=="undefined"){Ext.Cmp(g).setValue(Ext.Cmp("PayerFirstName").getValue())}else{if(Ext.Cmp("PayerFirstName").empty()){Ext.Cmp(g).setValue(c[g])}else{Ext.Cmp(g).setValue(Ext.Cmp("PayerFirstName").getValue())}}if(typeof(c[a])=="undefined"){Ext.Cmp(a).setValue(Ext.Cmp("PayerAge").getValue())}else{if(Ext.Cmp("PayerAge").empty()){Ext.Cmp(a).setValue(c[a])}else{Ext.Cmp(a).setValue(Ext.Cmp("PayerAge").getValue())}}if(typeof(c[f])!="undefined"){Ext.Cmp(f).setValue(c[f])}else{Ext.Cmp(f).setValue(0)}if(typeof(c[InsuredPremi])!="undefined"){Ext.Cmp(InsuredPremi).setValue(c[InsuredPremi])}else{Ext.Cmp(InsuredPremi).setValue("")}}}function InsuredAge(a){return(Ext.Ajax({url:Ext.EventUrl(new Array("ProductBniLifeActivePlus","SelectInsuredAge")).Apply(),method:"GET",param:{Date:a.Date,GroupPremi:a.GroupPremi,ProductId:a.ProductId},}).json())}function AgeCallculator(a){return(Ext.Ajax({url:Ext.EventUrl(new Array("ProductBniLifeActivePlus","SelectCalculateAge")).Apply(),method:"GET",param:{Date:(typeof(a)!="undefined"?a:"")},}).json())}function SetBenefieceryChecked(b){var a=new Array(".frmbenef",$(b).val()).join("_");if(b.checked){$(a).each(function(){var c=$(this).attr("id");Ext.Cmp(c).disabled(false);if(typeof(tmp_selected_bnf[c])!="undefined"){Ext.Cmp(c).setValue(tmp_selected_bnf[c])}})}else{$(a).each(function(){var c=$(this).attr("id");tmp_selected_bnf[c]=Ext.Cmp(c).getValue();Ext.Cmp(c).setValue("");Ext.Cmp(c).disabled(true)})}}function RegisterChosenPlugin(){var a=$.datepicker._updateDatepicker;$.datepicker._updateDatepicker=function(){var b=a.apply(this,arguments);this.dpDiv.find("select").chosen();return b}}function SetInsuredChecked(b){var a=new Array(".form",$(b).val()).join("_");if(b.checked){new MainInsuredCopy(b.value);$(a).each(function(){var c=$(this).attr("id");Ext.Cmp(c).disabled(false);if(b.value!=VAR_MAIN_CODE&&typeof(tmp_selected_box[c])!="undefined"){Ext.Cmp(c).setValue(tmp_selected_box[c])}})}else{$(a).each(function(){var c=$(this).attr("id");tmp_selected_box[c]=Ext.Cmp(c).getValue("");Ext.Cmp(c).setValue("");Ext.Cmp(c).disabled(true)})}}function EventBirthBeneficiary(){$(".benefiecery-dob").datepicker({showOn:"button",buttonImage:window.opener.Ext.DOM.LIBRARY+"/gambar/calendar.gif",buttonImageOnly:true,dateFormat:"dd-mm-yy",yearRange:"1945:2030",changeYear:true,changeMonth:true,onSelect:function(c){var a=$(this).attr("id").split("_");var b=new AgeCallculator($(this).val());var d=new Array("BenefAge",a[1]).join("_");if(typeof b=="object"){Ext.Cmp(d).setValue(b.Age);Ext.Cmp(d).disabled(true)}else{Ext.Cmp(d).disabled(true);Ext.Cmp(d).setValue("")}}})}function EventBirthInsured(){$(".insured-dob").datepicker({showOn:"button",buttonImage:window.opener.Ext.DOM.LIBRARY+"/gambar/calendar.gif",buttonImageOnly:true,dateFormat:"dd-mm-yy",yearRange:"1945:2030",changeYear:true,changeMonth:true,onSelect:function(b){var a=$(this).attr("id").split("_");if(a.length==2){var d=new Array("InsuredAge",a[1]).join("_")}else{var d=new Array("InsuredAge",a[1],a[2]).join("_")}if(typeof(b)=="string"){if(new Date(b.replace(/-/gi,"/"))>new Date()){alert("Invalid Date");Ext.Cmp($(this).attr("id")).setValue("")}else{var c=new InsuredAge({GroupPremi:a[1],ProductId:$("#ProductId").val(),Date:$(this).val(),});if(typeof(c)=="object"&&c.success==1){Ext.Cmp(d).setValue(c.InsuredAge);Ext.Cmp(d).disabled(true);if(a[1]==INT_MAIN_CODE){Ext.Cmp("PayerAge").setValue(c.InsuredAge)}}else{Ext.Cmp(d).setValue("");Ext.Cmp(d).disabled(true);if(a[1]==INT_MAIN_CODE){Ext.Cmp("PayerAge").setValue(0)}}}}}})}function SetPremiPersonal(e){var c=Ext.Cmp("GroupPremi").getValue();var b={};for(var d in c){var j=new Array("GenderId",c[d]);var g=new Array("InsuredAge",c[d]);b[c[d]]={GroupPremi:parseInt(c[d]),ProductId:parseInt(Ext.Cmp("ProductId").getValue()),PlanId:parseInt(Ext.Cmp("InsuredPlanType").getValue()),PayMode:parseInt(Ext.Cmp("InsuredPayMode").getValue()),GenderId:parseInt(Ext.Cmp(j.join("_")).getValue()),PersonalAge:parseInt(Ext.Cmp(g.join("_")).getValue())}}var h=0;if(typeof b=="object"){var f=new SelectCalculatorPremi(b);var a=f.object();if(typeof(a)=="object"){for(var d in a){if(typeof a[d].PremiPerson!="undefined"){var i=new Array("SubmitedPremi",d).join("_");var k=Ext.Format(a[d].PremiPerson).IDR();Ext.Cmp(i).setValue(k);Ext.Cmp(i).disabled(true);h+=parseInt(a[d].PremiPerson)}}}}Ext.Cmp("InsuredPremi").disabled(true);Ext.Cmp("InsuredPremi").setValue(Ext.Format(h).IDR())}function SearchByKeyword(a){a.ProvinceId=Ext.Cmp("PayerProvinceId").getValue();a.ProductId=Ext.Cmp("ProductId").getValue();a.Keyword=Ext.Cmp("AddressKeywords").getValue();a.Limit=20;a.Event=1;Ext.Ajax({url:Ext.EventUrl(["ModCallHistory","PageAddress"]).Apply(),method:"POST",param:{keyword:a.Keyword,ProvinceId:a.ProvinceId,ProductId:a.ProductId,limit:a.Limit,event:a.Event,orderby:a.orderby,type:a.type,page:a.page}}).load("product_list_preview")}function SearchZip(){var a=[];if(!Ext.Cmp("PayerProvinceId").empty()){a=(Ext.Ajax({url:window.opener.Ext.DOM.INDEX+"/ProductForm/GetZip/",method:"POST",param:{time:Ext.Date().getDuration(),province:Ext.Cmp("PayerProvinceId").getValue()}}).json())}return a}function WindowLayout(){$("#result_content_add").mytab().tabs();$("#result_content_add").mytab().tabs("option","selected",0);$("#result_content_add").mytab().close({},true);$("#result_content_add").css({margin:"10px 10px 20px 10px","float":"center"});$("#product-footer-button").css({"margin-top":"-10px","margin-left":"10px"});$(".zx-select").chosen()}function WindowSelector(){$(".dfl-disabled").each(function(){Ext.Cmp($(this).attr("id")).disabled(true)})}function WindowEvent(){$("#PayerProvinceId").bind("change",function(){new SearchByKeyword({orderby:"",type:""})});$("#AddressKeywords").bind("keyup",function(){new SearchByKeyword({orderby:"",type:""})})}function InitDatePicker(){$(".date").datepicker({showOn:"button",buttonImage:window.opener.Ext.DOM.LIBRARY+"/gambar/calendar.gif",buttonImageOnly:true,dateFormat:"dd-mm-yy",yearRange:"1945:2030",changeYear:true,changeMonth:true,onSelect:function(a){if(typeof(a)=="string"){if(new Date(a.replace(/-/gi,"/"))>new Date()){alert("Invalid Date");Ext.Cmp($(this).attr("id")).setValue("")}else{if($(this).attr("id")=="InsuredDOB"){Ext.CountDOB("InsuredDOB","InsuredAge")}else{if($(this).attr("id")=="PayerDOB"){Ext.CountDOB("PayerDOB","PayerAge")}}}}}})}function EnableWindowParent(){try{window.opener.Ext.Cmp("CallStatus").disabled(false);window.opener.Ext.Cmp("CallResult").disabled(false);window.opener.Ext.Cmp("ProductForm").disabled(false);window.opener.Ext.Cmp("ButtonUserCancel").disabled(false);window.opener.Ext.Cmp("ButtonUserSave").disabled(false)}catch(a){console.log(a)}}function SetEventExit(){if(Ext.Msg("Do you want to close from this session?").Confirm()){new EnableWindowParent();window.close(this)}}function ButtonDisabled(){$(".button_disabled").each(function(){$(this).attr("disabled",true);$(this).css({color:"#DDDFFF"})})}Ext.DOM.SelectSearch=function(a){if(typeof(a)=="object"){Ext.Cmp("PayerCity").setValue(a.ZipKotaKab);Ext.Cmp("PayerZipCode").setValue(a.ZipCode)}Ext.DOM.SearchByKeyword({orderby:"",type:""})};function EmailAddress(){var a=window.opener.Ext.Cmp("CustomerEmail").getValue();Ext.Cmp("PayerEmail").setValue(a)}$(document).ready(function(){new WindowLayout();new WindowSelector();new WindowEvent();new RegisterChosenPlugin();new EventBirthInsured();new EventBirthBeneficiary();new OpenCheckedInsured();new OpenCheckedBeneficiary();new ButtonDisabled();new SearchByKeyword({orderby:"",type:""});new EmailAddress()});$(window).bind("resize",function(){$("#result_content_add").css({margin:"10px 10px 20px 10px","float":"center"});$("#product-footer-button").css({"margin-top":"-10px","margin-left":"10px"});$(".box-content-data").css({})});$(window).bind("beforeunload",function(a){new EnableWindowParent();try{window.opener.Ext.DOM.initFunc.validParam=Ext.DOM.init.ValidPrefix}catch(a){console.log(a)}});
