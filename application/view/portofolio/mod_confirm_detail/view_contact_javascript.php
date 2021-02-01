<script>
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
var reason = [];
var AgentScript = { };

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */

Ext.DOM.CallInterest = function(){
return( Ext.Ajax ({
	url : Ext.DOM.INDEX +'/SetCallResult/getEventType/',
	method : 'GET',
	param :{
		CallResultId : Ext.Cmp('CallResult').getValue()
	}
 }).json());	
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

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */
 
 Ext.DOM.UnsetFollowup = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','UnsetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
} 

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */

 
Ext.DOM.PolicyReady = function(){
return( Ext.Ajax ({
	url : Ext.DOM.INDEX +'/SrcCustomerList/PolicyStatus/',
	method : 'GET',
	param :{
		CustomerId : Ext.Cmp('CustomerId').getValue()
	}
 }).json());
} 

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */

 
Ext.DOM.initFunc = 
{ 
	validParam 	: false,
	isCallPhone : false,
	isRunCall 	: false,
	isHangup 	: false,
	isCancel 	: true,
	isSave 		: false,
	isDial	: false	
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.DisabledActivity = function() {
	if( Ext.DOM.initFunc.isCallPhone !=true) {
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(false); 
	}
	else {
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(false); 
	}
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
Ext.DOM.dialCustomer = function()
{
 if( (Ext.DOM.initFunc.isDial==false ) )
 {
	ExtApplet.setData({   
		Phone : Ext.Cmp("CallingNumber").getValue(), 
		CustomerId  : Ext.Cmp("CustomerId").getValue() 
	}).Call();
	
	Ext.DOM.initFunc.isCallPhone = true;
	Ext.DOM.initFunc.isCancel = false;
	window.setTimeout(function(){
		Ext.DOM.DisabledActivity();
		Ext.DOM.initFunc.isRunCall = true;
		Ext.DOM.initFunc.isDial = true;
	},1000);
  }
  else{
	console.log('on dial');
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
	//console.log(document.ctiapplet.getCallSessionKey());
	Ext.DOM.initFunc.isDial = false;
	Ext.DOM.initFunc.isRunCall = false;
	Ext.DOM.initFunc.isCancel = false;
	ExtApplet.setHangup();
	return;
} 
 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.getCallReasultId = function(combo)
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SrcCustomerList/setCallResult/',
		method  : 'GET',
		param  : {
			CategoryId : combo.value
		}	
	}).load("DivCallResultId");	
	
	//Ext.Cmp('create_policy').disabled(true);
	Ext.Cmp('date_call_later').setValue('');
	Ext.Cmp('hour_call_later').setValue('');
	Ext.Cmp('minute_call_later').setValue('');
	Ext.Cmp('date_call_later').disabled(true);
	Ext.Cmp('hour_call_later').disabled(true);
	Ext.Cmp('minute_call_later').disabled(true);
	$('.select-chosen').chosen();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
Ext.DOM.CallSessionId = function(){
	return ( typeof (ExtApplet.getCallSessionId() ) =='undefined' ? 
			'NULL': ExtApplet.getCallSessionId() );
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 Ext.DOM.CekPolicyForm = function(){
	return(
		Ext.Ajax
		({
			url : Ext.DOM.INDEX +'/SrcCustomerList/CekPolicyForm/',
			method : 'POST',
			param :{
				CustomerId : Ext.Cmp('CustomerId').getValue(),
				CallReasonId : Ext.Cmp('CallResult').getValue()
			}
		}).json() );
 }

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 
 
 Ext.DOM.saveActivity =function() 
{
	
 var ActivityCall = [],
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete([
		'QualityStatus','ProductForm','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later',
		'edit_policy_box','CustomerEmail','pending_policy_box'
    ]);
	
 
   ActivityCall['CustomerId']= Ext.Cmp('CustomerId').getValue();
   ActivityCall['CallingNumber'] = Ext.Cmp('CallingNumber').getValue();
   ActivityCall['QualityStatus'] =  Ext.Cmp('QualityStatus').getValue();
   ActivityCall['CallSessionId'] =  0; //Ext.DOM.CallSessionId();
   
// ---------------------------------------------------------
	
	var MustCallData = false;
	var Forbiden = Ext.Cmp('CallResult').getValue(); 	
	 if( Ext.Cmp('QualityStatus').getValue() == window.CONFIG.SUSPEND_SELLING ) 
	{
		if( (Ext.DOM.initFunc.isCallPhone==true ) 
			&& (Ext.DOM.initFunc.isRunCall==false)) {
				MustCallData = true;
		} 
	}
	
	if( (MustCallData == false) 
		&& Ext.Cmp('QualityStatus').getValue() == window.CONFIG.SUSPEND_SELLING )
	{
		Ext.Msg("Theres No Call Activity OR Call Is Running").Info();
		return false;
	}	
	
// ------------ next form --------------------
	
	if( !ActivityForm ){ 
		Ext.Msg('Input form not complete').Info(); 
		return false;
	}
	
// ------------ Event form --------------------
	
	if( (Ext.DOM.CallInterest().event.CallReasonEvent == 1) && 
		(Ext.DOM.PolicyReady().PolicyReady==0))
	{
		Ext.Msg('No Policy Data').Info();
		return false;
	}
	
// -------- if new Status Check 
	
	if( (Forbiden == window.CONFIG.NEW_STATUS) ){
		Ext.Msg("Please select other status").Info();
		return false;
	}		
			 
	Ext.DOM.initFunc.isSave = true;
	Ext.DOM.initFunc.isCallPhone = false;
	Ext.DOM.initFunc.isCancel = true;
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/ModSaveActivity/SaveSuspendActivity/',
		method : 'POST',
		param 	: Ext.Join(new Array (
					Ext.Serialize('frmActivityCall').getElement(),
					Ext.Serialize('frmInfoCustomer').getElement(),
					ActivityCall 
				)).object(),
	ERROR  : function(fn)
	{
		Ext.Util(fn).proc(function(save)
		{
			if( save.success ) {
				Ext.Msg("Save Activity").Success();
				$("#tabs").mytab().tabs("option", "selected", 0);
				Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
			}
			else{
				Ext.Msg("Save Activity").Failed();
			}
		});
	}
 }).post();
 
 // ============= END FUNC =============
}

	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 Ext.DOM.CallHistory = function( obj )
{
   var CustomerId = Ext.Cmp('CustomerId').getValue();
   Ext.Ajax 
   ({
		url    : Ext.EventUrl(['ModCallHistory','PageCallHistory']).Apply(),
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
Ext.DOM.ProdPreview = function( ProductId ){
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdPreview/",
		method 	: 'GET',
		param 	: {
			ProductId 	 : ProductId,
			CustomerId 	 : Ext.Cmp('CustomerId').getValue(),
			CustomerDOB	 : Ext.Cmp('CustomerDOB').getValue(),
			GenderId	 : Ext.Cmp('GenderId').getValue()
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
Ext.DOM.ProdSum = function(){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdSum/",
		method 	: 'GET',
		param 	: {
			CustomerId : Ext.Cmp('CustomerId').getValue()
		}
	}).load("tabs-2");
}  
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
$(document).ready( function()
{
	Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.PageCallRecording({page : 0, orderby : "", type : ""});
	//Ext.DOM.ProdSum();
	//Ext.DOM.ProdPreview(0);
	
	$('#CustomerDOB').datepicker ({
		dateFormat : 'dd-mm-yy',
		changeYear : true, 
		changeMonth : true
	});
	
	
	
	
});

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
Ext.DOM.EeventFromProduct = function(e){
	if( e.value !='' )
	{
		Ext.Window ({
			url 		: Ext.DOM.INDEX+'/ProductForm/index/',	
			method 		: 'POST',
			width  		: (Ext.query(window).width()-(Ext.query(window).width()/4)), 
			height 		: Ext.query(window).height(),
			left  		: (Ext.query(window).width()/2),
			scrollbars 	: 1,
			resizable  : 1,  
			param  		: 
			{
				ViewLayout 	: 'EDIT_FORM',	
				ProductId	: Ext.Cmp(e.id).getValue(),
				CustomerId 	: Ext.Cmp('CustomerId').Encrypt(),
			}
		}).popup();
		
	 /* disabled on user show form data **/
	 
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true);
		Ext.Cmp('ProductForm').disabled(true);
		Ext.Cmp('ButtonUserCancel').disabled(true);
		Ext.Cmp('ButtonUserSave').disabled(true);
	}
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.getEventSale = function(object) 
{
	Ext.Ajax({
		url : Ext.DOM.INDEX +'/SetCallResult/getEventType/',
		method : 'GET',
		param :{
			CallResultId : object.value
		},
		ERROR : function(fn){
			try
			{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success)
				{
					if( typeof(ERR.event)=='object')
					{
						if( ERR.event.CallReasonEvent==1 ){ 
							Ext.Cmp('ProductForm').disabled(false);
						}
						else{
							Ext.Cmp('ProductForm').disabled(true);
							Ext.Cmp('ProductForm').setValue('');
						}
							
						if( ERR.event.CallReasonLater==1){
							Ext.Cmp('date_call_later').disabled(false);
							Ext.Cmp('hour_call_later').disabled(false);
							Ext.Cmp('minute_call_later').disabled(false);
						}
						else{
							Ext.Cmp('date_call_later').setValue('');
							Ext.Cmp('hour_call_later').setValue('');
							Ext.Cmp('minute_call_later').setValue('');
							Ext.Cmp('date_call_later').disabled(true);
							Ext.Cmp('hour_call_later').disabled(true);
							Ext.Cmp('minute_call_later').disabled(true);
						}
					}
				}
				else{
					
				}	
			}
			catch(e){
				Ext.Msg(e).Error();
			}
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
 
Ext.DOM.CancelActivity =function()
{
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	if( (Ext.DOM.initFunc.isCancel==true ) ) 
	{
		Ext.ActiveMenu().Active();
		Ext.DOM.UnsetFollowup( Ext.Cmp('CustomerId').getValue() );
		Ext.ShowMenu(new Array(ControllerId), 
			Ext.System.view_file_name(), {
			time : Ext.Date().getDuration()	
		});
	}	
	else { 
		Ext.Msg('Please Save Activity').Info();
	}	
 }

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.UserWindow = function(){
	Ext.DOM.AdditionalPhone( Ext.Cmp('CustomerId').getValue() );
	return false;
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
  $('.select-chosen').chosen();
  $("#tabs").mytab().tabs();
  $("#tabs").mytab().tabs("option", "selected", 0);
  $("#tabs").mytab().close({}, true);
  
 // --------------------------- test toolbars ------------------------------------------------
  $('#toolbars').extToolbars 
  ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [[],[]],
		extMenu   : [[],[]],
		extIcon   : [['page_white_acrobat'],[]],
		/*
		extTitle  : [['Add Phone'],[]],
		extMenu   : [['Ext.DOM.UserWindow'],[]],
		extIcon   : [['monitor_edit.png'],[]],
		*/
		extText   : true,
		extInput  : true,
		extOption  : [{
			render : 1,
			type   : 'combo',
			header : 'Script ',
			id     : 'v_result_script', 	
			name   : 'v_result_script',
			triger : 'ShowWindowScript',
			width  : 220,
			store  : [Ext.Ajax 
			({
				url   : Ext.EventUrl(new Array('SetProductScript','getScript')).Apply(),
				param : {
					CampaignId : Ext.Cmp('CampaignId').getValue()
				}
			}).json()]
		}]
	});
	
  $('.date').datepicker({dateFormat:'dd-mm-yy', changeMonth: true, changeYear: true });	
  Ext.DOM.DisabledActivity();
  
  // --- disabled image drag ----
  $('img').mousedown(function(e) {  
	e.stopPropagation(); e.preventDefault(); 
	return false; 
  });
  
  
  $('.ui-widget-image-enabled').each(function(){
	  console.log('enabledata');
  });
  
  $('.ui-widget-image-disabled').each(function(){
	$(this).css({"cursor":"not-allowed"});
	$(this).attr('onclick', "javascript:void(0);");
  });
  
  $('.ui-widget-form-disabled').each(function(){
	$(this).css({"cursor":"not-allowed"});  
	$(this).attr('disabled', true);
  });
  
  $('.ui-disabled').each(function(){
		Ext.Cmp( $(this).attr('id')).disabled(true);
	});

  $('.ui-widget-form-enabled').each(function(){
	$(this).attr('disabled', false);
  });
  
   $('.ui-widget-input-disabled').each(function(){
	$(this).css({"cursor":"not-allowed"});    
	$(this).attr('disabled', true);
  });
  
  $('.agent_disabled').each(function(){
	 $(this).attr("disabled", true); 
	
	 if( $(this).prop('tagName') == 'INPUT' ){
		$(this).css({"color" : "silver" });
	 }	
	 if( $(this).prop('tagName') == 'SELECT' ){
		Ext.Cmp( $(this).attr('id') ).disabled(true);
	 } 	
  });
  
  
  
});
</script>