<script>

var QUALITY_APPROVE= [<?php __(json_encode($jsonAssesment)); ?>]; 

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */

 
Ext.DOM.initFunc =  { 
	validParam 	: false,
	isCallPhone : false,
	isRunCall 	: false,
	isHangup 	: false,
	isCancel 	: true,
	isSave 		: false,
	isDial		: false	
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

 Ext.DOM.ProdPreview = function( ProductId )
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdPreview/",
		method 	: 'GET',
		param 	: {
			ProductId 	 : ProductId,
			CustomerId 	 : Ext.Cmp('CustomerId').getValue(),
			CustomerDOB	 : Ext.Cmp('PayerDOB').getValue(),
			GenderId	 : Ext.Cmp('PayerGenderId').getValue()
		}
	}).load("product_list_preview");
}


// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 Ext.DOM.QualityCallHistory = function( obj )
{
   var CustomerId = Ext.Cmp('CustomerId').getValue();
   Ext.Ajax 
   ({
		url    : Ext.EventUrl(['ModCallHistory','PageCallQualityHistory']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: CustomerId,
			page 		: obj.page,
			orderby 	: obj.orderby,
			type 		: obj.type
		}
   }).load("tabs-1");
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
Ext.DOM.PageCallRecording = function( obj )
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	Ext.Ajax 
	({
		url    : Ext.EventUrl(['ModCallHistory','PageCallRecording']).Apply(),
		method : 'GET',
		param  : {
			CustomerId 	: CustomerId,
			page 		: obj.page,
			orderby 	: obj.orderby,
			type 		: obj.type
		}
	}).load('tabs-2');
}


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
$(document).ready( function() 
{
  $('.xchosen').chosen();	
  $("#tabs-panels").mytab().tabs();
  $("#tabs-panels").mytab().tabs("option", "selected", 0);
  $("#tabs-panels").mytab().close({}, true);
  
  $("#tabs").mytab().tabs();
  $("#tabs").mytab().tabs().tabs("option", "selected", 0);
  $("#tabs").mytab().close({}, true);
  
  $('#toolbars').extToolbars
 ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Product Script'],[]],
		extMenu   : [[],[]],
		extIcon   : [['page_white_acrobat.png'],[]],
		extText   : true,
		extInput  : true,
		extOption  : [{
				render : 1,
				type   : 'combo',
				header : null,
				id     : 'v_result_script', 	
				name   : 'v_result_script',
				triger : 'ShowWindowScript',
				width  : 220,
				store  : [Ext.Ajax({url:Ext.DOM.INDEX+'/SetProductScript/getScript/', param : {
					CampaignId : Ext.Cmp('CampaignId').getValue()	
				} 
				
				}).json()]
			}]
	});
// ---------- Product Preview ----------------	
	
	
	
});



/* 
 * @ def : UpdatePayer
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.UpdateBenefiacery = function()
{
	var param = [];
	Ext.Serialize("frmBenefiecery").prop(function(items){
		for( var i in items ){
			if( i!= 'BeneficiaryId' ){
				if( !Ext.Cmp(i).getAttribute().NodeValue('class').match(/disabled/g) ) {
					param[i] = items[i];
				}
			}
		}
	});
	
	// update Beneficiary data 
	
	param['BeneficiaryId'] = Ext.Cmp('BeneficiaryId').getChecked();
	if(Ext.Cmp('BeneficiaryId').getChecked().length > 0 ) {
		Ext.Ajax
		({  
			url 	: Ext.DOM.INDEX +"/QtyApprovalInterest/UpdateBenefiacery/", 
			method 	: 'POST',
			param 	: Ext.Join([param]).object() 
		}).json();
	}	
}
	
 

/* 
 * @ def : UpdatePayer
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.UpdatePayer =function () 
{
	
var formRequired = {}; // will validation 
var frmPayer = Ext.Serialize("frmPayer");

 $(".undisabled").each(function(){
	formRequired[$(this).attr('id')] = $(this).attr('id');
 });	
 
 
 var cond = frmPayer.Required( Object.keys(formRequired) );
 if(!cond ) {
	 Ext.Msg("Form Input Not Complete").Info();
	 $("#tabs-panels").mytab().tabs("option", "selected", 1);
	 return false;
 }	 
 
 if( !Ext.Msg("Do you want to update this Policy Holder ?").Confirm() ){
	 return false;
 }
 
  Ext.Ajax
 ({ 
	 url 	: Ext.EventUrl(new Array('QtyApprovalInterest','UpdatePayer')).Apply(), 
	 method : 'POST',
	 param 	: Ext.Join(new Array( frmPayer.getElement() )).object(),
	 ERROR 	: function(e)
	{
		Ext.Util(e).proc(function(response){
			if(response.success){
				Ext.Msg("Update Policy Holder ").Success();
			}
			else{
				Ext.Msg("update Policy Holder").Failed();
				return false;
			}
		});
	}
 }).post();
 
}

/* 
 * @ def : UpdateInsured
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.UpdateInsured =function () 
{
 var formRequired = {}; // will validation 
 var frmDetailInsured = Ext.Serialize("InsuredDetailForm");
 $(".undisabled").each(function(){
	formRequired[$(this).attr('id')] = $(this).attr('id');
 });	
 
 var cond = frmDetailInsured.Required(Object.keys(formRequired));
 if(!cond ) {
	 Ext.Msg("Form Input Not Complete").Info();
	 $("#tabs-panels").mytab().tabs("option", "selected", 5);
	 return false;
 }	 
 
 if( !Ext.Msg("Do you want to update this Insured?").Confirm() ){
	 return false;
 }
 
  Ext.Ajax
 ({ 
	 url 	: Ext.EventUrl(new Array('QtyApprovalInterest','UpdateInsured')).Apply(), 
	 method : 'POST',
	 param 	: Ext.Join(new Array( frmDetailInsured.getElement() )).object(),
	 ERROR 	: function(e)
	{
		Ext.Util(e).proc(function(response){
			if(response.success){
				Ext.Msg("Update Insured").Success();
			}
			else{
				Ext.Msg("update Insured").Failed();
			}
		});
	}
 }).post();
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.Play  = function( RecordId ) 
 {
	var WinUrl  = new Ext.EventUrl([ "QtyApprovalInterest",  "VoicePlay"]), WinHeight = 100;
	var WinPlay = new Ext.Window
	({
		url    : WinUrl.Apply(),
		name   : 'winplay',
		top    : 0,
		left   : $(window).width(),  
		width  : ($(window).width()/2),
		height : (($(window).height()/2) - WinHeight),
		param  :  {
			RecordId : RecordId
		} 
	});
	
	WinPlay.popup();
	
 }
 
/* 
 * @ def : ShowWindowScript
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

Ext.DOM.ShowWindowScript = function(ScriptId)
{
	var WindowScript = new Ext.Window ({
			url    : Ext.DOM.INDEX +'/SetProductScript/ShowProductScript/',
			name    : 'WinProduct',
			height  : (Ext.Layout(window).Height()),
			width   : (Ext.Layout(window).Width()),
			left    : (Ext.Layout(window).Width()/2),
			top	    : (Ext.Layout(window).Height()/2),
			param   : {
				ScriptId : Ext.BASE64.encode(ScriptId),
				Time	 : Ext.Date().getDuration()
			}
		}).popup();
		
	if( ScriptId =='' ) {
		window.close();
	}
}


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.CancelActivity =function()
{
	var ControllerId = Ext.Cmp("ControllerId").getValue();
	Ext.ShowMenu(new Array(ControllerId,"index"), 
		Ext.System.view_file_name(),
	{
		time : Ext.Date().getDuration()
	});
 }
 

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 
 Ext.DOM.SetQualityReason = function( obj ) 
{
	var urlObject = Ext.EventUrl( new Array( "QtyApprovalInterest","SetQualityReason")).Apply();
	$( '#ui-widget-qty-reason' ).load( urlObject, { 
		QualityStatus : obj.value,
		CustomerId : Ext.Cmp('CustomerId').getValue()
	}, function( response, status, xhr ) {
		 if( status == 'success' ){
			$( '.xchosen' ).chosen();
		 }
	});
}
 
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.SaveQualityActivity =function()
{
	
 var params = new Array();
 var frmQualityActivity = Ext.Serialize('frmQualityActivity');
 if( !frmQualityActivity.Complete(['QualityReasonStatus','AddPhoneNumber','edit_policy_box']) ){
	Ext.Msg("Form input not complete!").Info();
	return false;
 }
 
// -------------- add info -------------------------------------------------
 params['CustomerId'] = Ext.Cmp("CustomerId").getValue();
 params['CampaignId'] = Ext.Cmp("CampaignId").getValue();
 
// ------------ test send and save ----------------------------------------
// ------------------------------------------------------------------------- 
 Ext.Ajax
 ({
	url 	: Ext.EventUrl(new Array("QtyApprovalInterest","SaveQualityActivity")).Apply(), 
	method 	: 'POST',
	param 	: Ext.Join(new Array( frmQualityActivity.getElement(), params) ).object(),
	ERROR   : function( rs )
	{
		Ext.Util( rs ).proc(function( data )
		{
			if( data.success ){
				Ext.Msg("Save Activity").Success();
				$("#tabs").mytab().tabs().tabs("option", "selected", 0);
				Ext.DOM.QualityCallHistory({page : 0, orderby : "", type : ""});
			} else if ( data.scoring == 0 )  {
				Ext.Msg("Save Form Scoring or Choose Reason Status!").Failed();
			} else {
				Ext.Msg("Save Activity").Failed();
			}	
			
		});	
	}
}).post();

}

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

 Ext.DOM.QualitySkillAttribute = function()
{
	var arr_skill = Object.keys( Ext.QualitySkill() );
	
	if( typeof ( arr_skill ) == 'object' )
	{
		$('.ui-widget-qty-disabled').each(function(){
			Ext.Cmp($(this).attr('id')).disabled(true);
		});	
		
		$("#tabs-panels").tabs("option", "disabled", [5]);
		//if( $.inArray( CONFIG.QUALITY_APPROVE.toString(), arr_skill ) !=-1 ) {
			$('.ui-widget-qty-disabled').each(function(){
				Ext.Cmp($(this).attr('id')).disabled(false);
			});		
		//}
		
		if( $.inArray( CONFIG.QUALITY_SCORES.toString(), arr_skill) !=-1 ){
			$("#tabs-panels").tabs("enable", 5);
		}
	}
}

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 $(document).ready(function()
{
  $('#CustomerDOB').datepicker({  dateFormat : 'yy-mm-dd',  changeYear : true,  changeMonth : true  });
    Ext.DOM.QualityCallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.PageCallRecording({page : 0, orderby : "", type : ""});
    Ext.DOM.QualitySkillAttribute();
	
	$('.button_disabled').each(function(){
		$(this).css({"cursor":"not-allowed"});  
		$(this).css({"color":"silver"});
		$(this).attr("disabled", true);
		
		if( $(this).prop("tagName").indexOf('IMG') !=-1 || 
		  $(this).prop("tagName").indexOf('SPAN') !=-1 )
		{
			$(this).attr('onclick', "javascript:void(0);");
		}	
	});
	
	Ext.DOM.SetQualityReason(Ext.Cmp('QualityStatus').getElementId())
});
  

  
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.AjaxStart = function(){
		Ext.Cmp("tabs-panel-5").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='17px;'>"+
		"<span style='color:red;'>&nbsp;&nbsp;Please Wait...</span>");
  }
  
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.DetailInsuredForm = function(checkbox){
	Ext.Cmp(checkbox.id).oneChecked(checkbox);
	if(checkbox.checked) 
	{
		$('#tabs-panels').tabs( "option", "selected", 4 );
		Ext.DOM.AjaxStart();
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/QtyApprovalInterest/DetailInsured/',
			mthod 	: 'GET',
			param 	: {
				InsuredId : checkbox.value
			}
		}).load("tabs-panel-5");
		$('.xchosen').chosen();
	}
	else {
		Ext.Cmp('tabs-panel-5').setText('');
	}
}

// ---------- dial activity QA --------------------------

Ext.DOM.dialCustomer = function()
{
 if( (Ext.DOM.initFunc.isDial==false ) )
 {
	ExtApplet.setData({   
		Phone : Ext.Cmp("PhoneNumber").getValue(), 
		CustomerId  : Ext.Cmp("CustomerId").getValue() 
	}).Call();
	
	//console.log(ExtApplet);
	Ext.DOM.initFunc.isCallPhone = true;
	Ext.DOM.initFunc.isCancel = false;
	window.setTimeout(function(){
		Ext.DOM.initFunc.isRunCall = true;
		Ext.DOM.initFunc.isDial = true;
	},1000);
  }
  else{
	console.log('on dial');
 }  
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 Ext.DOM.EeventFromProduct = function( obj )
{
  if( obj.checked )
  {
	 Ext.Window 
	({
		url 		: Ext.DOM.INDEX+'/ProductForm/index/',	
		method 		: 'POST',
		width  		: ($(window).width()-($(window).width()/4)), 
		height 		: $(window).height(),
		left  		: ($(window).width()/2),
		scrollbars 	: 1,
		resizable   : 1,  
		param  		:  {
			ViewLayout 	: 'EDIT_FORM',	
			ProductId	: obj.value,
			CustomerId 	: Ext.Cmp('CustomerId').Encrypt()
		}
	}).popup();
  }
}
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

Ext.DOM.hangupCustomer =function(){
	Ext.DOM.initFunc.isDial = false;
	Ext.DOM.initFunc.isRunCall = false;
	Ext.DOM.initFunc.isCancel = false;
	ExtApplet.setHangup();
	return;
} 


</script>