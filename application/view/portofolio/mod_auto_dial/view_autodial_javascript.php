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
var checkDialTimer = 25000;
var checkDialAutomatic = false;

//-------------------------------------------------------------------------------------- 
/*  
 * @ pack 			reset on followup data  
 *
 */
Ext.DOM.CheckAddress = function(param){
	var nonaktif={  '1' : 'BtnVerifAddressN',
					'2' : 'BtnVerifAddressY' };
	bolAddress = param;
	$("#"+nonaktif[param]).hide();
}
 

 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.protectUiDisabled = function( cond )
{
	var idData = '', options = false; 
	if( cond ){
		options = true;
	}
	// jika option bernilai benar maka panggil fungsi ini 
	// untuk mendisabled semua attribute
	 $('.ui-data-disabled').each( function(){
		 var idData = $(this).attr('id');
		 if( idData ) {
			 Ext.Cmp(idData).disabled( options );
		 }
	 });
 } 
 
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
Ext.DOM.CallInterest = function()
{
	var callDispositionID = Ext.Cmp('CallResult').getValue(), 
		row = Ext.Json("SetCallResult/getEventType", {	
			  CallResultId  : ( callDispositionID  ? callDispositionID : 0 ) 
		}).dataItem();
		
		
// if status data progrees to subject data process 
// by security XML 
	
	if( !row.success ){  
		return false;  
	}
	return row;
 
}

 
/** 
Ext.DOM.CallInterest = function(){
return( Ext.Ajax ({
	url : Ext.DOM.INDEX +'/SetCallResult/getEventType/',
	method : 'GET',
	param :{
		CallResultId : Ext.Cmp('CallResult').getValue()
	}
 }).json());	
}**/

window.UnsetFollowup = function( CustomerId ) {
	var data = Ext.Ajax ({
		url 	: Ext.EventUrl(['SrcCustomerList','UnsetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
} 

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
window.SetFollowUp = function( CustomerId ) {
	var data = Ext.Ajax ({
		url 	: Ext.EventUrl(['SrcCustomerList','SetFollowup']).Apply(),
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

// -----------------------------------------------------------------------------------------------------------------------------------
/* 
 * @ Method .............. : jQuery
 * @ pack ................ : wellcome on eui first page 
 * @ param ............... : testing all 
 */
 
 window.EventCallHistory = function( obj )
{
    var CustomerId = Ext.Cmp('CustomerId').getValue();
	 $('#tabs-1').Spiner
	({
		url 	: Ext.EventUrl( new Array('ModCallHistory','PageCallHistory')).Apply(),
		param 	: {
			CustomerId : CustomerId 
		},
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		},
		handler  : 'EventCallHistory',
		complete : function( obj ){
			$(obj).css({"height":"100%","padding-bottom" : "50px" });
		}
		
	});
	 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 Ext.DOM.LoadVerification = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue(), 
		Controller = Ext.Cmp('ViewVerification').getValue();
	
// check apakaha ref data campaignya ada jika tidak 
// data keluarkan alert.
	
	if( Controller == ''){
		$('#tabs-2').html("no ref data form.");	
		return false;
	}
	
	// push data wil ajax loader performance 
	
	var protectedAjaxUrl = Ext.EventUrl( new Array(Controller,'index') );
	$('#tabs-2').load( protectedAjaxUrl.Apply(), {	CustomerId 	: CustomerId,
													Mode : 'INPUT' }, 
	function( response, status, xhr ){
		console.log( xhr.status );
	});
}

 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
Ext.DOM.LoadProductInfo = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue(),
		Controller = Ext.Cmp('ViewProductInfo').getValue(),
		CustomerName = Ext.Cmp('CustomerFirstName').getValue(),
		CustomerDOB = Ext.Cmp('CustomerDOB').getValue(),
		GenderId = Ext.Cmp('GenderId').getValue();
		
// cek apakah controllers tersedia jika tidak keluarkan
// execption condition .
		
	if( Controller == ''){
		$('#tabs-3').html("no ref data form.");	
		return false;
	}
	
// push data wil ajax loader performance 
	
	var protectedAjaxUrl = Ext.EventUrl( new Array(Controller,'index') );
	$('#tabs-3').load( protectedAjaxUrl.Apply(), {	CustomerId 	 : CustomerId,
													CustomerName : CustomerName,
													CustomerDOB  : CustomerDOB,
													GenderId	 : GenderId,
													Mode 		 : 'INPUT' }, 
	function( response, status, xhr ){
		console.log( xhr.status );
	});
	
}

 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
Ext.DOM.DisabledActivity = function() {
	var protectedData  = new Array('CallStatus','CallResult');
	var protectCallData  = new Array('CallStatus');
	
	if( Ext.DOM.initFunc.isCallPhone == false) {
		$(protectedData).each(function(item, protectedID ){
			Ext.Cmp( protectedID ).disabled(true);	
		});
	}
	else {
		if( Ext.Cmp('VerifForm').getValue() != '2' ) {
			$(protectedData).each(function(item, protectedID ){
				Ext.Cmp( protectedID ).disabled(false);	
			});
		}
		else{
			$(protectedData).each(function(item, protectedID ){
				Ext.Cmp( protectedID ).disabled(true);	
			});
		}
	}
	
	// protectCallData -- // protectCallData -
	$(protectCallData).each(function(item, protectID){
		Ext.Cmp(protectID).disabled(true);
	});
}

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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
	
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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
 

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
Ext.DOM.CheckSessionStatus = function()
{
	var CallSession =  Ext.DOM.CallSessionId(),
		CallCurentStatus = document.ctiapplet.getCallStatus();
	
	
	// debugger data proces on background .
	
	console.log( window.sprintf("callsession : %s\n", CallSession ));
	console.log( window.sprintf("CallCurentStatus : %s\n", CallCurentStatus ));
	
	
	// jika call setlah di dial 25 detik statusnya masih 
	// tidak connected maka telpon akan di hangup 
	// dan lanjut ke no berikutnya .
	
	
	if(CallSession!='NULL') 
	{
		var cond = 0;
		$([ '2','4' ]).each( function( item, CallStatus ){
			if( CallStatus == CallCurentStatus  ){
				cond++; 
			}	
		});
		
		if( cond > 0 ){
			return false;
		}	
		
		// hangup call on current call 
		
		Ext.DOM.hangupCustomer();
		window.setTimeout(function(){
			Ext.DOM.NextPhone();
		},2000);
	} 
	// jika callsession is nulll 
	else{	
		return false;
	}		
}
 
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 Ext.DOM.dialCustomer = function( conditionStr )
{
	// get on styleSheets button-max on run call 
	window.protectedDialButton( true );
	
	if( Ext.DOM.initFunc.isDial == false ) 
	{
		
		var protectCallingData = Ext.Cmp("CallingNumber").getValue(),
			protectCustomerID = Ext.Cmp("CustomerId").getValue();
			
			console.log( window.sprintf("callling number to : %s\n", protectCallingData ) );
		
		// applet object check data if exist 
		
		try {  ExtApplet.setData( {Phone : protectCallingData,  
								   CustomerId : protectCustomerID} ).Call(); } 
		catch( errDial ){
			console.log(errDial);
		}
		
		// then will set its. 
		
		Ext.DOM.initFunc.isCallPhone = true;
		Ext.DOM.initFunc.isCancel = false;
		
		window.setTimeout(function(){
			Ext.DOM.DisabledActivity();
			Ext.DOM.initFunc.isRunCall = true;
			Ext.DOM.initFunc.isDial = true;
		},1000);
		
		// handle selama 25 detik , untuk meneruskan 
		// call process 
		
		if( conditionStr.localeCompare('directcall') == 0 ){
			
			// masukan variable khusus untuk timer time out 
			// untuk di clear di tiap processs data 
			
			Ext.DOM.setTimerAutoCaller = window.setTimeout( function() { 
				Ext.DOM.CheckSessionStatus(); 
			},checkDialTimer);
		}
		
	  }
	  else{
		console.log('Dial Customer Running...\n');
		return false;
	 }  
	 
}

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
	Ext.DOM.hangupCustomer =function()
{
	
	// hangup active if status Call Is OK 
	window.protectedDialButton( false );
	if( Ext.DOM.initFunc.isDial == true ) {
		
		Ext.Cmp('PhoneNumber').disabled(false);
		Ext.DOM.initFunc.isDial = false;
		Ext.DOM.initFunc.isRunCall = false;
		Ext.DOM.initFunc.isCancel = false;
		
	// clear interval on looping data by time on call 
		if( Ext.DOM.setTimerAutoCaller ){
			window.clearTimeout(Ext.DOM.setTimerAutoCaller);
		}
		
		// try exec process on debugger loger javascript 
		// method with execption process 
		// kick end .
		
		try{ 
			ExtApplet.setHangup(); 
		} 
		catch( errHangup ){
			console.log( errHangup );
		}
		
		// return object with false;
		return false;
	} 
	
	// tidak ada process telephony maka abaikan 
	// action hangup.
	
	else {
		console.log( "No Dial Customer Running!");
		return false;
	}
	
} 

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 window.EventGetResultData = function()
{
	var protectedData = Ext.EventUrl( new Array('SetCallResult','UpdateResultData')),
		callDispositionID = Ext.Cmp('CallResult').getValue(),
		callCustomerID = Ext.Cmp('CustomerId').getValue();
		
	 $("#ui-disposition-result").loader
	({
		url 	: protectedData.Apply(),
		method 	: 'GET',
		param 	: {
			callDispositionID : callDispositionID,
			callCustomerID : callCustomerID,
		},
		
		complete : function( dispositionHtml ){
			$(dispositionHtml).css({ height : "100%" });
			// handle ketika load lemote disabled dulu sampe process OK 
			// kalau udah ke load baru enable lagi .
			
			Ext.Cmp('ButtonUserSave').disabled(false);
			
			$('.select-chosen').chosen();
		}
		
	});
}
 
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */ 
 
Ext.DOM.getCallReasultId = function(combo) 
{
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


/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 Ext.DOM.saveActivity =function() 
{
	
 this.Utils = new Ext.Util( { });
  
// this will ,window handle return false if not complete 
// data on form submit .
	
  var CallEventTriger = Ext.DOM.CallInterest();
//  console.log(CallEventTriger);
// this will ,window handle return false if not complete 
// data on form submit .
 
 var  ActivityForm = Ext.Serialize('frmActivityCall').Complete( new Array(
		'QualityStatus','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later','CallDisagree'
    ));
	
	
// console.log( this.Utils.IsObject( CallEventTriger )  );
// this will ,window handle return false if not complete 
// data on form submit .
 
 if( this.Utils.IsObject( CallEventTriger ) 
	 && CallEventTriger.event.CallReasonLater==1 )  {
     ActivityForm = Ext.Serialize('frmActivityCall').Complete(  new Array(
					'QualityStatus','CallingNumber',
					'PhoneNumber','AddPhoneNumber',
					'CallDisagree' ));
  }
  
 	
// console.log( this.Utils.IsObject( CallEventTriger )  );
// this will ,window handle return false if not complete 
// data on form submit .
 
 
  if( this.Utils.IsObject( CallEventTriger ) 
	 && CallEventTriger.event.CallReasonNoNeed==1 )  {
	 ActivityForm = Ext.Serialize('frmActivityCall').Complete(  new Array(
					'QualityStatus','CallingNumber',
					'PhoneNumber','AddPhoneNumber','date_call_later',
					'hour_call_later','minute_call_later' ));
  }
  
  
  	
// this will ,window handle return false if not complete 
// data on form submit .

  var callProtectedUnable = Ext.Cmp('CallResult').getValue();  
  
 if( !ActivityForm ){ 
	Ext.Msg('Input form not complete').Info(); 
	return false;
 }
 
 // check data apakah memang menelphon atau hanya submit 
 // tapi tidk menelpon ? 
  
  if( !Ext.DOM.initFunc.isCallPhone 
	&& Ext.DOM.initFunc.isRunCall )  {
	Ext.Msg("Theres No Call Activity OR Call Is Running").Info();	
	return false;	
  }
 

// kemudian lanjut ke process berikutnya .
// yaitu check semua triger VerifForm 
// console.log(CallEventTriger);

 if( this.Utils.IsObject( CallEventTriger ) 
	&& CallEventTriger.event.CallReasonEvent == 1 )
 {
	if(Ext.Cmp('VerifForm').getValue() != '1') {
		Ext.Msg('Please complete Verification').Info();
		return false;
	}
	if(Ext.Cmp('InputForm').getValue() != '1') {
		Ext.Msg('Please input Product Info').Info();
		return false;
	}
 }
			
// cek lagi 			
 if( this.Utils.IsObject( CallEventTriger ) 
	&& CallEventTriger.event.CallReasonNoMoreFU == 1 ) {
	if(Ext.Cmp('VerifForm').getValue() != '2') {
		Ext.Msg('Please select other status').Info();
		return false;
	}
}
			
// jika status  sebelumnya NEW kemudian di simpan kembali 
// NEW maka Akan dilakukan penolakan .

 if( callProtectedUnable == window.CONFIG.NEW_STATUS){
	Ext.Msg("Please select other status").Info();
	return false;
 }	
 
// lanjutkan ke step berikut - nya 
 Ext.DOM.initFunc.isSave = true;
 Ext.DOM.initFunc.isCallPhone = false;
 Ext.DOM.initFunc.isCancel = true;

 // push data by ajax redirect IT 
			  
 var frmActivityCall = Ext.Serialize('frmActivityCall').Initialize(),
	 frmInfoCustomer = Ext.Serialize('frmInfoCustomer').Initialize(),
	 frmDataAdditional = {};
				  
	// push data additional / tambahan dari object window 
	// browser oleh activity user .
				 
	 frmDataAdditional.CustomerId 	 = Ext.Cmp('CustomerId').getValue();
	 frmDataAdditional.CallingNumber = Ext.Cmp('CallingNumber').getValue();
	 frmDataAdditional.CallSessionId = Ext.DOM.CallSessionId();
	 frmDataAdditional.AdressVerif 	 = bolAddress;
				 
	// dan berikut process update via Ajax  
	// disabled button save sampai process load status selesai.
	Ext.Cmp('ButtonUserSave').disabled(true);
			  
	var protectedPasData = Ext.EventUrl( new Array('ModSaveActivity','SaveActivity'));
		Ext.Ajax  
		({
			url 	: protectedPasData.Apply(), 
			method  : 'POST',
			param   : Ext.Join( new Array( frmActivityCall,  frmInfoCustomer,  
										   frmDataAdditional )).object(),
			success : function( xhr) 
			{
				Ext.Util( xhr ).proc(function( data ){
					if( data.success ) {
						Ext.Msg("Save Activity").Success();
						window.EventGetResultData();
						window.EventCallHistory({page : 0, orderby : "", type : ""});
					}
					// cek failed karena data disabled atau bukan 
					// jika ya keluarkan alert yang berbeda 	
					else {
						if( data.disabled == 1 ){
							Ext.Msg("Sorry, Customer has been disabled.\nPlease select other Customer").Failed();
							window.protectUiDisabled( true );  } 
						else {
							Ext.Msg("Save Activity").Failed(); }
						return false;
					}
				});
			}
			
		}).post();
		
	// END ==>	
}


/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  window.EventGetDisagreeId = function( dispositionID )
 {
	 if( !dispositionID ){ 
		return false; 
	}	
// get on html object data by loader spiner like this .
// on library spiner data object 

	var protectedUrlData = Ext.EventUrl( new Array('SetCallResult', 'DisagreeDataId')),
		disCampaignId = Ext.Cmp("CampaignId").getValue();
		
	 $('#ui-disagree-data').loader
	({
		url   : protectedUrlData.Apply(),
		param : {
			dispositionID : dispositionID,
			disCampaignId : disCampaignId 
		},
		complete : function( obj ){
			$(obj).css({ height : "100%"});
			$('.select-chosen').chosen();
		}
	});
 } 
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  
 window.EventGetParentId = function( dispositionID )
{	
	if( !dispositionID ){ 
		return false; 
	}	
// get on html object data by loader spiner like this .
// on library spiner data object 

	var protectedUrlData = Ext.EventUrl( new Array('SetCallResult', 'DispositionParent')),
		callCustomerID = Ext.Cmp('CustomerId').getValue();
		
	 $('#ui-disposition-parent').loader
	({
		url   : protectedUrlData.Apply(),
		param : {
			dispositionID : dispositionID,
			callCustomerID : callCustomerID 
		},
		complete : function( obj ){
			$(obj).css({ height : "100%"});
			$('.select-chosen').chosen();
			
			// then will disabled on this ID 
			// like this 
			Ext.Cmp('CallStatus').disabled(true);
		}
	});
}
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 
 Ext.DOM.getEventSale = function(object) 
{
	//console.log(object);
	// @reverse data get parent dispostion 	
	window.EventGetParentId(object.value);
	window.EventGetDisagreeId( object.value );
	// on get json data URL then will return on data 
	// json type 
	
	var row = Ext.Json("SetCallResult/getEventType", {
			CallResultId : object.value
		});
	
	row.dataItemEach(function( rs, xh, ro ){
		if( rs.success && typeof( rs.event ) == 'object' ){
			// rs.event.CallReasonNoNeed then will get soon 
			// Ok Bluer Sip .
			
			if( rs.event.CallReasonNoNeed == 1 ){ 
				Ext.Cmp('CallDisagree').disabled(false);
			}
			else{
				Ext.Cmp('CallDisagree').disabled(true);
				Ext.Cmp('CallDisagree').setValue('');
			}
				
			// typeof  "rs.event.CallReasonLater" exits on here 
			// tehn will the set data 
				
			if( rs.event.CallReasonLater == 1 ){
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
		// then check data obj
	}); // end procedure .
	
}

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

 
 Ext.DOM.UserWindow = function(){
	Ext.DOM.AdditionalPhone( Ext.Cmp('CustomerId').getValue() );
	return false;
}

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

Ext.DOM.NextPhone = function(){

// define variable yang ada di sini untuk 
// mempermudah process.
 
  var stdClassData  = new Ext.AutoCall('', {}), 
	  CustomerId = Ext.Cmp('CustomerId').getValue(),
	  CurrentPhoneNum = Ext.Cmp('CallingNumber').getValue(), 
	  NextPhoneNum = 0;
		
		
// Ext.Cmp('CallingNumber').setValue(Ext.Cmp('PhoneNumber').getValue());
// cek apakah Customer Itu ada atau kosong jik kosong 
// kembalikan nilai false.
		
	if( !CustomerId ){
		console.log( "customer not valid" );	
	}
	
	
// get next phone from this customer Data .
// jika nilai balikan  =  false maka dipastikan no yang di dial sudah berakhir disini .

	NextPhoneNum = stdClassData.Utils.NextNum(CustomerId, CurrentPhoneNum);
	if( !NextPhoneNum ){
		console.log('row data call automatic number end of field\n');
		Ext.Msg('This is the last number.\nPlease Save Activity').Info();
		return false;
	}
	
// jika tidak bernilai false maka lanjutkan ke nomor telpon berikutnya 
// dengan methode yang sama ambil di stream buffer data .
	
	Ext.Cmp('CallingNumber').setValue(NextPhoneNum);
	Ext.Cmp('PhoneNumber').setValue(NextPhoneNum);
	Ext.DOM.dialCustomer('Automatic');
}
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 Ext.DOM.NextCustomer = function()
{

// tidak Boleh melakuan Next Customer jika belum selesai 
// di call semua
	
console.log( window.sprintf("Call phone number Index :%s\n",  window.Stream.CallID));


// jika tekan tombol next periksa apakah data sudah di save !

if( Ext.DOM.initFunc.isCancel == false ){
	Ext.Msg('Please Save Activity').Info();
	return false;
} 
 
//if( !window.Stream.callDisposition ) {
// pastikan data yang sedang di followup sudah tidak menelpon 
// lagi jangan next jika telepony masih jalan .
	
var stdCls  = new Ext.AutoCall('', {}),
	CustId  = Ext.Cmp('CustomerId').getValue(),
	StdObj  = new stdCls.Utils.Next( CustId );
	
 if( typeof ( StdObj ) == 'object' 
	&& typeof( StdObj.Value ) == 'function')  {
			
		// unset dulu untuk membuat flags = 0 
		window.UnsetFollowup( CustId );
		
		try {
			var nextID = StdObj.Value(), //stdCls.Utils.FirstNum(CustId, 0);
			     protectedSucess = window.SetFollowUp( nextID );
			
			if( typeof( protectedSucess ) !='object' ){
				return false;
			}
			// lanjut bro dan set data berikut INI .
			console.log( 'Next call customer ID ');	
			Ext.ActiveMenu().NotActive();
			Ext.ShowMenu( new Array('CallAutoDial','start_autocall'), 
			Ext.System.view_file_name(), {
				CustomerId 	  : StdObj.Value(),
				PhoneNum	  : stdCls.Utils.FirstNum(CustId, 0),	
				ControllerId  : StdObj.Triger()
			}); 
		} catch( Err ){
			console.log( Err );
		}	
	}
//}
 
}
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  Ext.DOM.EndSession = function()
{
	
// blank_page
// end callsession adalah process force exit dari process telephone ke 
// customer list lagi dan ulang kembali process dial .

 if( Ext.DOM.initFunc.isCancel == false  ){
	Ext.Msg('Please Save Activity').Info();
	return false;
 }
 
 if( !window.confirm('Are you sure?') ){
	return false;
 }

// panggil fungsi exit dari contact Detail .
   Ext.DOM.CancelActivity();

}


/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
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
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
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
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
 Ext.DOM.LoadAddPhone = function() 
{
	var protectedData = Ext.EventUrl( new Array('ModSaveActivity','LoadAddPhone')),
		CustomerId 	= Ext.Cmp('CustomerId').getValue();
		
	$('#DivAddPhone').loader({
		url 	: protectedData.Apply(),
		method  : 'GET',
		param   : {
			CustomerId 	: CustomerId
		},
		complete : function( protectedHtml ){
			$(protectedHtml).css({ "height" : "100%"});
			$('.select-chosen').chosen();
		}
	});
	
	
}
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

window.protectedDialButton = function( cond ){
	if( cond  ){
		$('.dial').attr("disabled", true);
		$('.hangup').attr("disabled", false);
	} else {
		$('.dial').attr("disabled", false);
		$('.hangup').attr("disabled", true);
	}
}  

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
$(document).ready( function()
{
	$('.select-chosen').chosen();
	$("#tabs").mytab().tabs({ selected : 0, disabled : [3,4] });
	$("#tabs").mytab().close({}, true);
	
	// this my layout 
	$('.ui-nav-customize').css({
		'margin-left' : '0px'	
	});
	$('.btn-max').css({
		'width' : '98%'
	})
	
 //  test toolbars ------------------------------------------------
	$('#toolbars').extToolbars 
	({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Next Customer'],['End Session'],['Add Phone'],['Add Referral'],[]],
		extMenu   : [['NextCustomer'],['EndSession'],['Ext.DOM.UserWindow'],['Ext.DOM.AddReferral'],[]],
		extIcon   : [['group_go.png'],['telephone_delete.png'],['telephone_add.png'],['group_add.png'],[]],
		extText   : true,
		extInput  : true,
		extOption  : [{
			render : 4,
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
	window.EventCallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.LoadVerification();
	Ext.DOM.LoadProductInfo();
	
	
	// reload data call result by User Triger on here.
	 //window.EventUpdateResultData();
	
	
// customize button-max on detail .
	$('.ui-button-max').css({
			'width' : '46%'
		});
	
  // --- disabled image drag ----
	$('img').mousedown(function(e) {  
		e.stopPropagation(); e.preventDefault(); 
		return false; 
	});
	
	//verifaddress tambahan buat ipenk
	$(".verifyaddress").click(function () {
		var value_insert = $(this).attr("valver");
		if ( value_insert != '' ) {
			if ( value_insert == '1' ) {
				$(".AddressNo").hide();
				$(".AddressYes").show();
			} else if ( value_insert == '2' ) {
				$(".AddressYes").hide();
				$(".AddressNo").show();
			}
			$(".AddressVerif").val(value_insert);
		}
		
		//alert(value_insert);
	});
  
	$('.ui-disabled').each(function(){
		Ext.Cmp( $(this).attr("id")).disabled(true); 
	});
	
// data yang di disabled tidak bisa di followup lagi Exit saja ya .
	var callUiDisable = Ext.Cmp('callUiDisable').getValue();
	if( callUiDisable == 1 ){
		  window.protectUiDisabled(true);
		  return false;
	  }
	
	/* LANGSUNG DIAL, KRIIIIIIIIIIIIIIING!!! */
	
	var callDialCustomerStatus = Ext.Cmp('CallResult').getValue(),
		callDialCustomerNumber = Ext.Cmp('PhoneNumber').getValue(),
		callDialAutomaticStart = Ext.Cmp('dialAutomatic').getValue();
		
	// console.log(callDialAutomaticStart);
	// callDialCustomerStatus 
	// if empty "callDialAutomaticStart" thie manual call 
	
	if( callDialAutomaticStart == '') {
		window.checkDialAutomatic = false;
		console.log("Manual Dial Customer Data!");
	}else {
		window.checkDialAutomatic = true;
		console.log("Automatic Dial Customer Data!");
		
		// then if condition set on here .
		// if( callDialCustomerStatus  == 1 ) kalau yang lama . 
		
		// langsung dial hanya untuk status data NEW 
		
		if( callDialCustomerStatus  == 1 ) {
			alert('Automatic');
			Ext.Cmp('CallingNumber').setValue( callDialCustomerNumber );
			dialCustomer('Automatic');
		}
	}
	 
});

</script>