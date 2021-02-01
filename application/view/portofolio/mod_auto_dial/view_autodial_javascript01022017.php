<script>
;(function(criit){ 
	criit.prototype.Money = function(angka){
		return ({
			ToRupiah : function(){
				if(angka!=''){
					var rev     = parseInt(angka, 10).toString().split("").reverse().join("");
					var rev2    = "";
					for(var i = 0; i < rev.length; i++){
						rev2  += rev[i];
						if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
							rev2 += ".";
						}
					}
					return rev2.split("").reverse().join("");
				}
				else{return 0;}
			},
			ToInt : function(){
				if(angka != ''){ return parseInt(angka.replace(/[^\w\s]/gi, '')); }
				else{return 0;}
			},
			ToNumeric : function(){
				if(angka != ''){ return angka.replace(/[^0-9]/gi, ''); }
				else{return 0;}
			},
		});
	}
})(E_ui);

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
var reason = [];
var AgentScript = { };
var Timer = {};
var bolAddress =  0;
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

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */
 Ext.DOM.SetFollowUp = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','SetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
}

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

/* ---------------------------------------------------------------------------------- */

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

Ext.DOM.LoadVerification = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	var Controller = Ext.Cmp('ViewVerification').getValue();
    Ext.Ajax 
	({
		url    : Ext.EventUrl([Controller,'index']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: CustomerId,
			Mode : 'INPUT'
		}
	}).load("tabs-2");
}

Ext.DOM.LoadProductInfo = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	var Controller = Ext.Cmp('ViewProductInfo').getValue();
	var CustomerName = Ext.Cmp('CustomerFirstName').getValue();
	var CustomerDOB = Ext.Cmp('CustomerDOB').getValue();
	var GenderId = Ext.Cmp('GenderId').getValue();
	console.log('Controller', Controller)
    Ext.Ajax 
	({
		url    : Ext.EventUrl([Controller,'index']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: CustomerId,
			CustomerName : CustomerName,
			CustomerDOB : CustomerDOB,
			GenderId	: GenderId,
			Mode : 'INPUT'
		}
	}).load("tabs-3");
}

Ext.DOM.DisabledActivity = function() {
	if( Ext.DOM.initFunc.isCallPhone !=true) {
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true); 
	}
	else {
		if( Ext.Cmp('VerifForm').getValue() != '2' )
		{
			Ext.Cmp('CallStatus').disabled(false);
			Ext.Cmp('CallResult').disabled(false); 
		}
		else{
			Ext.Cmp('CallStatus').disabled(true);
			Ext.Cmp('CallResult').disabled(true); 
		}
	}
}

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
	/* Ext.Ajax ({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdSum/",
		method 	: 'GET',
		param 	: {
			CustomerId : Ext.Cmp('CustomerId').getValue()
		}
	}).load("tabs-2"); */
}  

/* ======================================================================================================================= */

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.getLastCall = function()
 {
	var conds = false;
	 
	if( Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','CheckLastCall']).Apply(),
		method  : 'POST',
		param	: {}	
	}).json().result )
	{ conds = true; }
	
	return conds;
 }
 
Ext.DOM.dialCustomer = function(prm)
{
	
 // if( Ext.DOM.getLastCall() )
 // {
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
		
		/* HANDLE 25 DETIK! */
		// alert(prm);
		if(prm=='LANGSUNG'){
			// alert('1');
			Timer = setTimeout(function(){
				// alert('25');
				Ext.DOM.CheckSessionStatus();
			},25000);
		}
	  }
	  else{
		console.log('on dial');
	 }  
 // }
 // else{
	 // alert('Invalid time to do Call!');
	 // return false;
 // }
 
 
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
	if( Ext.DOM.initFunc.isDial )
	{
		Ext.Cmp('PhoneNumber').disabled(false);
		Ext.DOM.initFunc.isDial = false;
		Ext.DOM.initFunc.isRunCall = false;
		Ext.DOM.initFunc.isCancel = false;
		clearTimeout(Timer);
		ExtApplet.setHangup();
	}
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

 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

 
Ext.DOM.CallSessionId = function(){
	return ( typeof (ExtApplet.getCallSessionId() ) =='undefined' ? 
			'NULL': ExtApplet.getCallSessionId() );
}


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
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
 var CallEventTriger = Ext.DOM.CallInterest(),
	 ActivityCall = [],
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete([
		'QualityStatus','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later','CallDisagree'
    ]);
	
  if( CallEventTriger.event.CallReasonLater==1 ){
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete([
		'QualityStatus','CallingNumber',
		'PhoneNumber','AddPhoneNumber','CallDisagree'
    ]);
  }
  
  if( CallEventTriger.event.CallReasonNoNeed==1 ){
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete([
		'QualityStatus','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later'
    ]);
  }
  
  ActivityCall['CustomerId']= Ext.Cmp('CustomerId').getValue();
  ActivityCall['CallingNumber'] = Ext.Cmp('CallingNumber').getValue();
  ActivityCall['CallSessionId'] =  Ext.DOM.CallSessionId();
  ActivityCall['AdressVerif'] =  bolAddress;
 
 if( !ActivityForm ){ 
		Ext.Msg('Input form not complete').Info(); }
	else 
	{
		if( (Ext.DOM.initFunc.isCallPhone==true)
			&& (Ext.DOM.initFunc.isRunCall==false) )
		{
			if( (CallEventTriger.event.CallReasonEvent == 1) )
			{
				if(Ext.Cmp('VerifForm').getValue() != '1')
				{
					// alert(Ext.Cmp('VerifForm').getValue());
					Ext.Msg('Please complete Verification').Info();
					return false;
				}
				
				if(Ext.Cmp('InputForm').getValue() != '1')
				{
					Ext.Msg('Please input Product Info').Info();
					return false;
				}
			}
			
			if( (CallEventTriger.event.CallReasonNoMoreFU == 1) )
			{
				if(Ext.Cmp('VerifForm').getValue() != '2')
				{
					// alert(Ext.Cmp('VerifForm').getValue());
					Ext.Msg('Please select other status').Info();
					return false;
				}
			}
			
			/* else
			{ */
			  var Forbiden = Ext.Cmp('CallResult').getValue(); 
			  if( Forbiden == window.CONFIG.NEW_STATUS){
				Ext.Msg("Please select other status").Info();
				return false;
			  }		
			 
			  // ------------ > handle call < -----------------------------------
			  Ext.DOM.initFunc.isSave = true;
			  Ext.DOM.initFunc.isCallPhone = false;
			  Ext.DOM.initFunc.isCancel = true;
			  Ext.Ajax
			  ({
				 url 	: Ext.DOM.INDEX +'/ModSaveActivity/SaveActivity/',
				 method : 'POST',
				 param 	: Ext.Join(new Array
						( 
							Ext.Serialize('frmActivityCall').getElement(),
							Ext.Serialize('frmInfoCustomer').getElement(),
							ActivityCall 
						)).object(),
				 ERROR  : function(fn)
				 {
						Ext.Util(fn).proc(function(save){
							if( save.success ) {
								Ext.Msg("Save Activity").Success();
								// Ext.DOM.NextCustomer();
							}
							else{
								Ext.Msg("Save Activity").Failed();
							}
						});
					}
			  }).post();
		   // }
		}
		else{
			Ext.Msg("Theres No Call Activity OR Call Is Running").Info();
		}	
	}	
}


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
				ViewLayout 	: 'ADD_FORM',	
				ProductId	: Ext.Cmp(e.id).getValue(),
				CustomerId 	: Ext.Cmp('CustomerId').Encrypt(),
			}
		}).popup();
		
	 /* disabled on user show form data **/
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true);
		// Ext.Cmp('ProductForm').disabled(true);
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
						if( ERR.event.CallReasonNoNeed==1 ){ 
							Ext.Cmp('CallDisagree').disabled(false);
						}
						else{
							Ext.Cmp('CallDisagree').disabled(true);
							Ext.Cmp('CallDisagree').setValue('');
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
 
 Ext.DOM.UserWindow = function(){
	Ext.DOM.AdditionalPhone( Ext.Cmp('CustomerId').getValue() );
	return false;
}


/* ======================================================================================================================= */
/* GAGAL TOTAL */
Ext.DOM.NextPhone = function(){
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	var AutoKey = Ext.Cmp('AutoKey').getValue();
	
	Ext.DOM.UnsetFollowup( Ext.Cmp('CustomerId').getValue() );
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/CallAutoDial/get_next_data/',
		method 	: 'POST',
		param 	: {
			AutoKey : AutoKey,
			CustomerId : CustomerId
		},
		ERROR  	: function(fn){
			Ext.Util(fn).proc(function(croot){
				if( croot.result ) {
					var response = Ext.DOM.SetFollowUp(croot.detail.CustomerId);
					Ext.ActiveMenu().NotActive();
					$('#main_content').load( Ext.EventUrl(["CallAutoDial","start_autocall"]).Apply(), {
						CustomerId 	 : croot.detail.CustomerId,
						PhoneNum 	 : croot.detail.AutoDialNum,
						AutoKey 	 : croot.detail.AutoDialKey,
						ControllerId : 'SrcCustomerList'
					}, function( response, status, xhr ) {
						if( status == 'error') { 
							$('#main_content').html(response);	 
						}
					});
				}
				else{
					Ext.Msg('This is the last number.\nPlease Save Activity').Info();
					return false;
				}
			});
		}
	}).post();
}

Ext.DOM.NextCustomer = function(){
	if( (Ext.DOM.initFunc.isCancel==true ) ) 
	{
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		var AutoKey = Ext.Cmp('AutoKey').getValue();
		
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CallAutoDial/set_next_customer/',
			method 	: 'POST',
			param 	: {
				CustomerId : CustomerId,
				AutoKey : AutoKey,
			},
			ERROR  	: function(fn){
				Ext.Util(fn).proc(function(save){
					Ext.DOM.UnsetFollowup( Ext.Cmp('CustomerId').getValue() );
					Ext.Ajax
					({
						url 	: Ext.DOM.INDEX +'/CallAutoDial/get_next_data/',
						method 	: 'POST',
						param 	: {
							AutoKey : AutoKey
						},
						ERROR  	: function(fn){
							Ext.Util(fn).proc(function(croot){
								if( croot.result ) {
									var response = Ext.DOM.SetFollowUp(croot.detail.CustomerId);
									Ext.ActiveMenu().NotActive();
									$('#main_content').load( Ext.EventUrl(["CallAutoDial","start_autocall"]).Apply(), {
										CustomerId 	 : croot.detail.CustomerId,
										PhoneNum 	 : croot.detail.AutoDialNum,
										AutoKey 	 : croot.detail.AutoDialKey,
										ControllerId : 'SrcCustomerList'
									}, function( response, status, xhr ) {
										if( status == 'error') { 
											$('#main_content').html(response);	 
										}
									});
								}
								else{
									Ext.Msg('This is the last data.\nThank You').Info();
									Ext.DOM.CancelActivity();
								}
							});
						}
					}).post();
				});
			}
		}).post();
	}
	else { 
		Ext.Msg('Please Save Activity').Info();
	}
}
/* END OF GAGAL TOTAL */

Ext.DOM.EndSession = function(){
	// blank_page
	if( (Ext.DOM.initFunc.isCancel==true ) ) 
	{
		if(confirm('Are you sure?')){
			Ext.DOM.CancelActivity();
		}
		else{
			return false;
		}
	}
	else { 
		Ext.Msg('Please Save Activity').Info();
	}
}

Ext.DOM.CheckSessionStatus = function()
{
	var CallSession = Ext.DOM.CallSessionId();
	
	if(CallSession!='NULL')
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CallAutoDial/get_session_status/',
			method 	: 'POST',
			param 	: {
				CallSession : CallSession,
			},
			ERROR  	: function(fn){
				Ext.Util(fn).proc(function(save){
					if(save.success){
						Ext.DOM.hangupCustomer();
						window.setTimeout(function(){
							Ext.DOM.NextPhone();
						},2000);
					}
					else{
						return false;
					}
				});
			}
		}).post();
	}
	else{
		return false;
	}
}


Ext.DOM.AddReferral = function( )
{	
  
  var CustomerId = Ext.Cmp('CustomerId').getValue();
  $('#WindowUserDialog').html("<div class='ui-widget-ajax-spiner'></div>");	
  $("#WindowUserDialog").dialog 
 ({
	title		: 'Add Referral',
	bgiframe	: true, 
	autoOpen	: false,
	cache		: false, 
	height		: 500,
	width 		: 920,
	close		: function(event, ui) {  $(this).empty();    $(this).remove(); }, 
  	modal 		: true 
}).load(Ext.DOM.INDEX+"/SrcCustomerList/ViewAddReferral/?CustomerId="+CustomerId+"&time="+ Ext.Date().getDuration(), 
	function(response,status, xhr){
		if( status =='success'){ console.log('complete'); }}).dialog('open');
}  


Ext.DOM.CancelActivity = function()
{
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	if( (Ext.DOM.initFunc.isCancel==true ) ) 
	{
		Ext.DOM.ClearListAuto();
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

Ext.DOM.ClearListAuto = function()
{
	var AutoKey = Ext.Cmp('AutoKey').getValue();
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/CallAutoDial/clear_session/',
		method 	: 'POST',
		param 	: {
			AutoKey : AutoKey,
		},
		ERROR  	: function(fn){
			Ext.Util(fn).proc(function(save){
				
			});
		}
	}).post();
}

Ext.DOM.LoadAddPhone = function()
{
	Ext.Ajax 
	({
		url    : Ext.EventUrl(['ModSaveActivity','LoadAddPhone']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: Ext.Cmp('CustomerId').getValue()
		}
	}).load("DivAddPhone");
	$('.select-chosen').chosen();
}

$(document).ready( function()
{
	$('.select-chosen').chosen();
  
	$("#tabs").mytab().tabs({
		selected : 0,
	    //disabled : [1,2,3,4]
	  disabled : [3,4]
	});
  // $("#tabs").mytab().tabs().tabs("option", "selected", 0);
	$("#tabs").mytab().close({}, true);
 // --------------------------- test toolbars ------------------------------------------------
	$('#toolbars').extToolbars 
	({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		/* extTitle  : [['Next Phone'],['Next Customer'],['End Session'],[],[]],
		extMenu   : [['NextPhone'],['NextCustomer'],['EndSession'],[],[]],
		extIcon   : [['telephone_go.png'],['group_go.png'],['phone_delete.png'],['page_white_acrobat.png'],[]], */
		extTitle  : [['Next Customer'],['End Session'],['Add Referral'],[],[],['Add Phone']],
		extMenu   : [['NextCustomer'],['EndSession'],['Ext.DOM.AddReferral'],[],[],['Ext.DOM.UserWindow']],
		extIcon   : [['group_go.png'],['phone_delete.png'],['page_white_acrobat.png'],['monitor_edit.png'],[],['monitor_edit.png']],
		// extTitle  : [['Add Phone'],[]],
		// extMenu   : [['Ext.DOM.UserWindow'],[]],
		// extIcon   : [['monitor_edit.png'],[]],
		
		extText   : true,
		extInput  : true,
		extOption  : [{
			render : 3,
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
	
	Ext.DOM.DisabledActivity();
	Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.LoadVerification();
	Ext.DOM.LoadProductInfo();
	
  // --- disabled image drag ----
	$('img').mousedown(function(e) {  
		e.stopPropagation(); e.preventDefault(); 
		return false; 
	});
  
	$('.ui-disabled').each(function(){
		Ext.Cmp( $(this).attr("id")).disabled(true); 
	});
	
	/* LANGSUNG DIAL, KRIIIIIIIIIIIIIIING!!! */
	if(Ext.Cmp('CallResult').getValue()==1){
		Ext.Cmp('CallingNumber').setValue(Ext.Cmp('PhoneNumber').getValue());
		dialCustomer('LANGSUNG');
	}
	/* END OF LANGSUNG DIAL, KRIIIIIIIIIIIIIIING!!! */
});
</script>