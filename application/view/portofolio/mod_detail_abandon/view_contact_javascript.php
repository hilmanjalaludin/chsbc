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
			name    : ScriptId,
			height  : (Ext.Layout(window).Height()),
			width   : (Ext.Layout(window).Width()),
			left    : (Ext.Layout(window).Width()/2),
			top	    : (Ext.Layout(window).Height()/2),
			param   : {
				ScriptId : Ext.BASE64.encode(ScriptId),
				Time	 : Ext.Date().getDuration()
			}
		}).open();
		
	if( ScriptId =='' ) {
		window.close();
	}
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
  
 Ext.DOM.dialCustomer = function()
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
			console.log( errDial );
		}
		
		// then will set its. 
		
		Ext.DOM.initFunc.isCallPhone = true;
		Ext.DOM.initFunc.isCancel = false;
		
		window.setTimeout(function(){
			Ext.DOM.DisabledActivity();
			Ext.DOM.initFunc.isRunCall = true;
			Ext.DOM.initFunc.isDial = true;
		},1000);
		
		
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
		
		try{ ExtApplet.setHangup(); } 
		
		catch( err ){
			console.log( err );
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
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
  
// this will ,window handle return false if not complete 
// data on form submit .
 		
	var ActivityForm = Ext.Serialize('frmActivityCall').Complete( new Array(
		'QualityStatus',	 'CallingNumber', 
		'PhoneNumber',		 'AddPhoneNumber',
		'date_call_later', 	 'hour_call_later',
		'minute_call_later', 'CallDisagree'
    ));
	
// console.log( this.Utils.IsObject( CallEventTriger )  );
// this will ,window handle return false if not complete 
// data on form submit .
 
	if( this.Utils.IsObject( CallEventTriger ) 
		&& CallEventTriger.event.CallReasonLater==1 ) 
	{
		ActivityForm = Ext.Serialize('frmActivityCall').Complete(new Array(
		'QualityStatus','CallingNumber',
		'PhoneNumber','AddPhoneNumber','CallDisagree'
		));
	}
  
 // this will ,window handle return false if not complete 
 // data on form submit .

  
	if( this.Utils.IsObject( CallEventTriger ) 
		&& CallEventTriger.event.CallReasonNoNeed==1 )
	{
		ActivityForm = Ext.Serialize('frmActivityCall').Complete(new Array(
		'QualityStatus','CallingNumber',
		'PhoneNumber','AddPhoneNumber','date_call_later',
		'hour_call_later','minute_call_later'
		));
	}
  
 
var callProtectedUnable = Ext.Cmp('CallResult').getValue(); 
 
// this will ,window handle return false if not complete 
// data on form submit .
 
 if( !ActivityForm ){ 
	Ext.Msg('Input form not complete').Info(); 
	return false;
}

// check data apakah memang menelphon atau hanya submit 
// tapi tidk menelpon ? 


 if( !Ext.DOM.initFunc.isCallPhone 
	&& !Ext.DOM.initFunc.isRunCall )
 {
	Ext.Msg("Theres No Call Activity OR Call Is Running").Info();
	return false;
}

// kemudian lanjut ke process berikutnya .
// yaitu check semua triger VerifForm 
console.log(CallEventTriger);

if( CallEventTriger.event.CallReasonEvent == 1 ){
	if(Ext.Cmp('VerifForm').getValue() != '1') {
		Ext.Msg('Please complete Verification').Info();
		return false;
	}
	if(Ext.Cmp('InputForm').getValue() != '1') {
		Ext.Msg('Please input Product Info').Info();
		return false;
	}
}
			
if( CallEventTriger.event.CallReasonNoMoreFU == 1 ) {
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

// lanjutkan jika benar 

 Ext.DOM.initFunc.isSave = true;
 Ext.DOM.initFunc.isCallPhone = false;
 Ext.DOM.initFunc.isCancel = true;

 // define form to sent post data 
 
 var frmActivityCall = Ext.Serialize('frmActivityCall').Initialize(),
	frmInfoCustomer = Ext.Serialize('frmInfoCustomer').Initialize(),
	frmDataAdditional = {};
				
			
// data push tambahan 
	frmDataAdditional.CustomerId = Ext.Cmp('CustomerId').getValue();
	frmDataAdditional.CallingNumber = Ext.Cmp('CallingNumber').getValue();
	frmDataAdditional.CallSessionId = Ext.DOM.CallSessionId();
	
// define object XMLDocument for triger post data 
// Via Ajax Process on background.

  var protectedDataSubmitHttp = Ext.EventUrl( new Array('ModSaveActivity','SaveActivity'));  
	  Ext.Ajax 
  ({
		url 	: protectedDataSubmitHttp.Apply(),
		method 	: 'POST',
		param  	: Ext.Join( new Array( frmActivityCall, frmInfoCustomer,  
									   frmDataAdditional )).object(),
									   
		success  : function( xhr ){
			Ext.Util( xhr ).proc(function( data ) {
				if( data.success )  {
					// alerting info submit 
					Ext.Msg("Save Activity").Success();
					
					// set focus to first tab 
					$("#tabs").mytab().tabs().tabs("option", "selected", 0);
								
					// on load data process User Activity  && reloading 
					// view after process submit .
								 
					window.EventGetResultData();
					window.EventCallHistory({page : 0, orderby : "", type : ""});
					
					// jika data dengan status ini maka langsung di cancel 
					// dan kembali ke customerlist User .
								
					if( (CallEventTriger.event.CallReasonEvent == 1) ||  
						(CallEventTriger.event.CallReasonNoNeed == 1) || 
						(CallEventTriger.event.CallReasonNoMoreFU == 1) ) {
						Ext.DOM.CancelActivity();
					}
							// end stop force 		 
				}
				
				// jika process submit pada form bernilai  failed  maka 
				// infokan proces berikut.
				
				else{
					Ext.Msg("Save Activity").Failed();
					return false;
				}
				
			});
		}
	}).post();
	
	
	// end function 
	
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
	/* Ext.Ajax ({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdSum/",
		method 	: 'GET',
		param 	: {
			CustomerId : Ext.Cmp('CustomerId').getValue()
		}
	}).load("tabs-2"); */
}  

	
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
  
 
 Ext.DOM.getEventSale = function(object) 
{
	// @reverse data get parent dispostion 	
	window.EventGetParentId(object.value);
	
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
				ro.Cmp('CallDisagree').disabled(false);
			}
			else{
				ro.Cmp('CallDisagree').disabled(true);
				ro.Cmp('CallDisagree').setValue('');
			}
				
			// typeof  "rs.event.CallReasonLater" exits on here 
			// tehn will the set data 
				
			if( rs.event.CallReasonLater == 1 ){
				ro.Cmp('date_call_later').disabled(false);
				ro.Cmp('hour_call_later').disabled(false);
				ro.Cmp('minute_call_later').disabled(false);
			}
			else{
				ro.Cmp('date_call_later').setValue('');
				ro.Cmp('hour_call_later').setValue('');
				ro.Cmp('minute_call_later').setValue('');
				ro.Cmp('date_call_later').disabled(true);
				ro.Cmp('hour_call_later').disabled(true);
				ro.Cmp('minute_call_later').disabled(true);
			}
		}
		// then check data obj
	}); // end procedure .
	
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

Ext.DOM.TESTING = function()
{
	alert('okaaay');
	$("#tabs").mytab().tabs().tabs("option", "disabled", []);
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
			$('.select-chosen').chosen();
		}
		
	});
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


 Ext.DOM.OpenBlock = function()
 {
	var CustomerId 	= Ext.Cmp('CustomerId').getValue();
	var CustomerId  = parseInt(CustomerId);

	if ( CustomerId != 0 ) {
		if ( confirm("Do you want to reset this Customer?") ) {
		
			var protectedDataSubmitHttp = Ext.EventUrl( new Array('AbandonReview','ResetAbandon'));  
			  Ext.Ajax 
		  ({
				url 	: protectedDataSubmitHttp.Apply(),
				method 	: 'POST',
				param  	: { CustomerId : CustomerId },
				success  : function( xhr ){
					Ext.Util( xhr ).proc(function( data ) {
						if ( data.success == '1' ) {
							alert("Information, Success Reset Customer !");
						} else {
							alert("Information, Failed Reset Customer !");
						}
					});
				}
			}).post();

		}


	} else {
		alert("Customer not found!");
	}
	
 }


 Ext.DOM.BackMenu =function () {
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	Ext.ActiveMenu().Active();
	Ext.ShowMenu(new Array(ControllerId), 
		Ext.System.view_file_name(), {
		time : Ext.Date().getDuration()	
	});
 }
 
 
	
/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  
$(document).ready( function() {
	
  $('.select-chosen').chosen();  
  $("#tabs").mytab().tabs({ selected : 0,	  disabled : [3,4] });
  $("#tabs").mytab().close({}, true);
  
 // test toolbars 
 
 // test toolbars 
 
  $('#toolbars').extToolbars ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Reset Abandon'],['Back']],
		extMenu   : [['OpenBlock'],['BackMenu']],
		extIcon   : [['key_delete.png'],['cancel.png']],
		
		// extTitle  : [['Add Phone'],[]],
		// extMenu   : [['Ext.DOM.UserWindow'],[]],
		// extIcon   : [['monitor_edit.png'],[]],
		
		extText   : true,
		extInput  : true,
		extOption  : []
	});
  
	
  $('.date').datepicker({dateFormat:'dd-mm-yy', changeMonth: true, changeYear: true });
	
	window.EventCallHistory({page : 0, orderby : "", type : ""});
  
  Ext.DOM.DisabledActivity();
  Ext.DOM.LoadVerification();
  Ext.DOM.LoadProductInfo();
 
  
  // --- disabled image drag ----
  
  // customize button-max on detail .
  $('.btn-max').css({ 'width' : '98%' })
  $('.ui-button-max').css({ 'width' : '46%' });
  //$('#CustomerDOB').datepicker ({  dateFormat : 'dd-mm-yy', changeYear : true,  changeMonth : true });
 
		
  $('img').mousedown(function(e) {  
	e.stopPropagation(); e.preventDefault(); 
	return false; 
  });
  
  $('.ui-disabled').each(function(){
	 Ext.Cmp( $(this).attr("id")).disabled(true); 
  });
});
</script>