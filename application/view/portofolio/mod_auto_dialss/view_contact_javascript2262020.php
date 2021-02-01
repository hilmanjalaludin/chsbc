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
var AgentScript = {};
var firstProd = false; 
var secondProd = false; 
var customerIdXcell;

var Timer = {};
var bolAddress =  0;
var checkDialTimer = 25000;
var checkDialAutomatic = false;
var myVar;

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
	if(firstProd == true){
		var callDispositionID = Ext.Cmp('CallResult').getValue(), 
			row = Ext.Json("SetCallResult/getEventType", {	
				  CallResultId  : ( callDispositionID  ? callDispositionID : 0 ) 
			}).dataItem();
		
		// if status data progrees to subject data process 
		// by security XML
		if( !row.success ){  
			return false; 
		}
	}
	else if(firstProd == false){
		var callDispositionID = Ext.Cmp('CallResult_2nd').getValue(), 
			row = Ext.Json("SetCallResult/getEventType", {	
				  CallResultId  : ( callDispositionID  ? callDispositionID : 0 ) 
			}).dataItem();
		
		if( !row.success ){  
			return false; 
		}
	}
	
	return row;
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
	isDial		: false	
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

	var protectedData  = new Array('CallResult','CallResult');
		$(protectedData).each(function(item, protectedID ){
		Ext.Cmp( protectedID ).disabled(true);	
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
Ext.DOM.dialCustomer = function( conditionStr=0 )
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
		Ext.DOM.initFunc.isCancel    = false;
		
		window.setTimeout(function(){
			Ext.DOM.DisabledActivity();
			
			if( Ext.Cmp('CampaignId').getValue() == "5") {
				var protectedData  = new Array('CallResult','CallResult');
					$(protectedData).each(function(item, protectedID ){
					Ext.Cmp( protectedID ).disabled(false);	
				});
			}

			Ext.DOM.initFunc.isRunCall = true;
			Ext.DOM.initFunc.isDial    = true;
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
		console.log('## Dial Customer Running...\n');
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
	/*asli 6122019*/
	// var protectedData  = new Array('CallResult','CallResult');
	// $(protectedData).each(function(item, protectedID ){
	// 	Ext.Cmp( protectedID ).disabled(false);	
	// });

	/*Edit Rangga 
	var callres=Ext.Cmp('CallResult').getValue();
	if(callres=='9'){
		var protectedData  = new Array('CallResult','CallResult');
		$(protectedData).each(function(item, protectedID ){
			Ext.Cmp( protectedID ).disabled(true);	
		});
	}else{
		var protectedData  = new Array('CallResult','CallResult');
		$(protectedData).each(function(item, protectedID ){
			Ext.Cmp( protectedID ).disabled(false);	
		})
	}

	end rangga*/
	
	// hangup active if status Call Is OK 
	window.protectedDialButton( false );
	Ext.DOM.initFunc.isCallPhone= false;
	Ext.DOM.initFunc.isRunCall  = false;
	// if( Ext.DOM.initFunc.isDial == true ) {
		
		Ext.Cmp('PhoneNumber').disabled(false);
		Ext.DOM.initFunc.isDial     = false;
		Ext.DOM.initFunc.isRunCall  = false;
		Ext.DOM.initFunc.isCancel   = false;
		Ext.DOM.initFunc.isCallPhone= false;
		Ext.DOM.initFunc.isRunCall  = false;
		
		// clear interval on looping data by time on call 
		if( Ext.DOM.setTimerAutoCaller ){
			window.clearTimeout(Ext.DOM.setTimerAutoCaller);
		}
		
		// try exec process on debugger loger javascript 
		// method with execption process 
		// kick end .
		try{
			console.log("## HangUp"); 
			ExtApplet.setHangup(); 
		} catch( err ){
			console.log( "No Dial Customer Running!");
			console.log( err );
		}

		//edit rangga 12122019
		var callres=Ext.Cmp('CallResult').getValue();
		if(callres=='9'){
			var protectedData  = new Array('CallResult','CallResult');
			$(protectedData).each(function(item, protectedID ){
				Ext.Cmp( protectedID ).disabled(true);	
			});
			Ext.Cmp('btnDialCustomer').disabled(true);
		}else{
			var protectedData  = new Array('CallResult','CallResult');
			$(protectedData).each(function(item, protectedID ){
				Ext.Cmp( protectedID ).disabled(false);	
			})
		}
		
		// return object with false;
		return false;
	// } 
	
	// tidak ada process telephony maka abaikan 
	// action hangup.
	
	// else {
	// 	console.log( "No Dial Customer Running!");
	// 	return false;
	// }
	
} 

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.DOM.getCallReasultId = function(combo)
{
	Ext.Ajax({
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
	var callSessionDataId =  ( typeof (ExtApplet.getCallSessionId() ) =='undefined' ?  'NULL': ExtApplet.getCallSessionId() );
	if( !callSessionDataId ){
		return 0;
	}
	return callSessionDataId;
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
var value_2nd='';
Ext.DOM.saveActivity =function(val_2nd=''){
	value_2nd = val_2nd;
	console.log("## saveActivity");

 	customerIdXcell = $("#CustomerId").val();
 	Ext.DOM.initFunc.isCancel = true;
 	var product_to_2nd        = true;

	if(firstProd){
		this.Utils = new Ext.Util({ });
		
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
  
 
		var callProtectedUnable = Ext.Cmp('CallResult').getValue(); 
		// console.log('call Result',callProtectedUnable);
 
		// this will ,window handle return false if not complete 
		// data on form submit .
		

		//edit irul
		//  if( !ActivityForm ){ 
		// 	Ext.Msg('Input form not complete').Info(); 
		// 	return false;
		// }
		//tutup edit irul

		// this will ,window handle return false if not complete 
		// data on form submit .

		if( this.Utils.IsObject( CallEventTriger ) && CallEventTriger.event.CallReasonLater==1 ){
			ActivityForm = Ext.Serialize('frmActivityCall').Complete(new Array(
			'QualityStatus','CallingNumber',
			'PhoneNumber','AddPhoneNumber','CallDisagree'
			));
		}
	  
		// this will ,window handle return false if not complete 
		// data on form submit .

		if( this.Utils.IsObject( CallEventTriger ) && CallEventTriger.event.CallReasonNoNeed==1 ){
			ActivityForm = Ext.Serialize('frmActivityCall').Complete(new Array(
			'QualityStatus','CallingNumber',
			'PhoneNumber','AddPhoneNumber','date_call_later',
			'hour_call_later','minute_call_later'
			));
		}


		var callProtectedUnable = Ext.Cmp('CallResult').getValue(); 
		// console.log('call Result',callProtectedUnable);
		
		// this will ,window handle return false if not complete 
		// data on form submit .
		
		//edit irul
		// if( !ActivityForm ){ 
		// 	Ext.Msg('Input form not complete').Info(); 
		// 	return false;
		// }
		//tutup edit irul

		// check data apakah memang menelphon atau hanya submit 
		// tapi tidk menelpon ? 
		console.log( "## isCallPhone"+Ext.DOM.initFunc.isCallPhone );
		console.log( "## isRunCall"+Ext.DOM.initFunc.isRunCall );

		// if( !Ext.DOM.initFunc.isCallPhone && !Ext.DOM.initFunc.isRunCall ){
		/*if( Ext.DOM.initFunc.isCallPhone && Ext.DOM.initFunc.isRunCall ){
			console.log("## Theres No Call Activity OR Call Is Running");
			Ext.Msg("Theres No Call Activity OR Call Is Running").Info();
			return false;
		}
		*/


		// kemudian lanjut ke process berikutnya .
		// yaitu check semua triger VerifForm 
		// console.log(CallEventTriger);
		if( CallEventTriger.event.CallReasonEvent == 1 ){
			//edit irul
			// if(Ext.Cmp('VerifForm').getValue() != '1') {
			// 	Ext.Msg('Please complete Verification').Info();
			// 	return false;
			// }
			//tutup edit irul

			// edit hilman and andi 11-05-2020
			if(Ext.Cmp('InputForm').getValue() != '1') {
				Ext.Msg('Please input Product Info').Info();
				return false;
			}
			// edit hilman and andi 11-05-2020
		}

		//edit irul
		var CampaignId = Ext.Cmp('CampaignId').getValue();
		if (CampaignId == '6' || CampaignId == '5' || CampaignId == '9' || CampaignId == '1012') {
			if (Ext.Cmp('CallResult').getValue() == '13' && Ext.Cmp('InputCDD').getValue() != '1') {
				Ext.Msg('Please input CDD').Info();
				return false;
			}
		}
		//tutup edit irul

		//edit irul
		var call_remarks = $('#call_remarks').val();
		if (call_remarks == '' && CampaignId != '9') {
			alert('Notes is not empty');
			return false;
		}

		//edit rangga 51219
		// if (Ext.Cmp('CallResult').getValue() == '8') {
		// 	if (Ext.Cmp('CallDisagree').getValue() == '' || Ext.Cmp('CallDisagree').getValue() == null || Ext.Cmp('CallDisagree').getValue() == undefined) {
		// 		alert('Disagree Reason is empty');
		// 		return false;
		// 	}

		// }

		
		//edit rangga51219
		if(Ext.Cmp('CampaignId').getValue() != '9'){
			if (Ext.Cmp('CallResult').getValue() == '8') {
				if (Ext.Cmp('CallDisagree').getValue() == '' || Ext.Cmp('CallDisagree').getValue() == null || Ext.Cmp('CallDisagree').getValue() == undefined) {
					alert('Disagree Reason is empty');
					return false;
				}
			}
		}


		if (Ext.Cmp('CallResult').getValue() != '9') {
			if( CallEventTriger.event.CallReasonNoMoreFU == 1 ) {
				if(Ext.Cmp('VerifForm').getValue() != '2') {
					Ext.Msg('Please select other status').Info();
					return false;
				}
			}
		}
		//tutup edit irul
				
		// jika status  sebelumnya NEW kemudian di simpan kembali 
		// NEW maka Akan dilakukan penolakan .
		if( callProtectedUnable == window.CONFIG.NEW_STATUS){
			Ext.Msg("Please select other status").Info();
			return false;
		}

		Ext.DOM.initFunc.isSave      = true;
		Ext.DOM.initFunc.isCallPhone = false;
		Ext.DOM.initFunc.isCancel    = true;
	 
		var frmActivityCall = Ext.Serialize('frmActivityCall').Initialize(),
			frmInfoCustomer = Ext.Serialize('frmInfoCustomer').Initialize(),
			frmDataAdditional = {};

		// data push tambahan 
		frmDataAdditional.CustomerId = Ext.Cmp('CustomerId').getValue();
		frmDataAdditional.CallingNumber = Ext.Cmp('CallingNumber').getValue();
		frmDataAdditional.CallSessionId = Ext.DOM.CallSessionId();
		frmDataAdditional.FirstProductFlag = firstProd;
		frmDataAdditional.CampaignIdCip = $("#CampaignId").val();
		
		// define object XMLDocument for triger post data 
		// Via Ajax Process on background.  
		Ext.Cmp('ButtonUserSave').disabled(true);

		// console.log('A',frmActivityCall,'B',frmInfoCustomer,'C',frmDataAdditional);
		// console.log('param',Ext.Join( new Array( frmActivityCall, frmInfoCustomer, frmDataAdditional )).object());
		var protectedDataSubmitHttp = Ext.EventUrl( new Array('ModSaveActivity','SaveActivity'));  
		Ext.Ajax({
			url 	: protectedDataSubmitHttp.Apply(),
			method 	: 'POST',
			param  	: Ext.Join( new Array( frmActivityCall, frmInfoCustomer, frmDataAdditional )).object(),
			success  : function( xhr ){
				Ext.Util( xhr ).proc(function( data ){
					// console.log('condition',data);
					if( data.success ){
						// alerting info submit 
						Ext.Msg("Save Activity").Success();
						$('#ButtonUserCancel').prop('disabled', false);
						// set focus to first tab 
						$("#tabs").mytab().tabs().tabs("option", "selected", 0);
									
						// on load data process User Activity  && reloading 
						// view after process submit .
						window.EventGetResultData();
						window.EventCallHistory({page : 0, orderby : "", type : ""});
						window.EventCallHistorySecondProduct({page : 0, orderby : "", type : ""});
						
						// jika data dengan status ini maka langsung di cancel 
						// dan kembali ke customerlist User .
						// if( (CallEventTriger.event.CallReasonEvent == 1) || (CallEventTriger.event.CallReasonNoNeed == 1) || (CallEventTriger.event.CallReasonNoMoreFU == 1) ){
							// Ext.DOM.CancelActivity();
						// }
						
						// 8 = Disagree
						var str = $("#AgentStatus").text(); str = str.replace(/"/gi, "");
						var agent_status = str.replace(/\s/g, '');
						console.log("## AgentStatus "+agent_status);
						console.log("## callProtectedUnable "+callProtectedUnable);

						if( callProtectedUnable==8 ){
							if( Ext.Cmp("CampaignId").getValue() == 5 || Ext.Cmp("CampaignId").getValue() == 9 ) {
								console.log("## Status Reason Disagree "+callProtectedUnable);
								var togle = Ext.DOM.getToSecondProducts(callProtectedUnable, Ext.Cmp("CampaignId").getValue());
								// $('#ButtonUserCancel').prop('disabled', true);
								product_to_2nd  = togle;
							}else{
								//************************** SECTION NEXT CUSTOMER
							// Jika Bukan product ke 2,
							if( val_2nd != '2nd') {
								var str = $("#AgentStatus").text(); str = str.replace(/"/gi, "");
								var agent_status = str.replace(/\s/g, '');
								var CallResult   = parseInt(Ext.Cmp('CallResult').getValue());
								
								// SELAIN 5=XCELL || 9=FLEXI, langsung next customer CALL
								if( Ext.Cmp("CampaignId").getValue() != 5 || Ext.Cmp("CampaignId").getValue() != 9 ) {
									// jika Status seleain NEW, next customer
									if( CallResult == 0 )
									{
										alert("Empty Call Result");
										return false; return false;
									}

									if( agent_status === "Ready" || agent_status === "Acw" ) {
										Ext.DOM.UnsetFollowup(Ext.Cmp('CustomerId').getValue());
										console.log("## CALL IN PRODUCT ONE AND STATUS "+agent_status);
										CTI.setLabelReady();
										myVar = window.setTimeout( function() {
											try{
												console.log("## HangUp"); 
												ExtApplet.setHangup(); 
											} catch( err ){
												console.log( "No Dial Customer Running!");
												console.log( err );
											}
											Ext.DOM.NextCustomer();
										},3000);
									} 
								}

								// JIKA CAMPAIGN 5=PIL XCELL
								if( Ext.Cmp("CampaignId").getValue() == 5) {
									console.log("## product_to_2nd "+product_to_2nd );
									// JIKA GK ADA PRODUCT KE-2 DAN STATUS BUKAN PILIH NEW, CALL NEXT CUSTOMER
									if( product_to_2nd == false  &&  CallResult != "0" && CallResult != 1) {
										product_to_2nd = true;
										if( agent_status === "Ready" || agent_status === "Acw" ) {
											Ext.DOM.UnsetFollowup(Ext.Cmp('CustomerId').getValue());
											console.log("## CALL IN PRODUCT ONE AND STATUS "+agent_status);
											CTI.setLabelReady();
											myVar = window.setTimeout( function() {
												// Ext.DOM.hangupCustomer();
												try{
													console.log("## HangUp"); 
													ExtApplet.setHangup(); 
												} catch( err ){
													console.log( "No Dial Customer Running!");
													console.log( err );
												}
												Ext.DOM.NextCustomer();
											},3000);
										}
									}	
								} else {console.log("## ADA PRODUCT_2ND");}
								
							}
							//*********************** End SECTION NEXT CUSTOMER
							}
						} else {
							console.log("## Status Reason "+callProtectedUnable);
							console.log("## val_2nd "+val_2nd);
							//************************** SECTION NEXT CUSTOMER
							// Jika Bukan product ke 2,
							if( val_2nd != '2nd') {
								var str = $("#AgentStatus").text(); str = str.replace(/"/gi, "");
								var agent_status = str.replace(/\s/g, '');
								var CallResult   = parseInt(Ext.Cmp('CallResult').getValue());
								
								// SELAIN 5=XCELL || 9=FLEXI, langsung next customer CALL
								if( Ext.Cmp("CampaignId").getValue() != 5 || Ext.Cmp("CampaignId").getValue() != 9 ) {
									// jika Status seleain NEW, next customer
									if( CallResult == 0 )
									{
										alert("Empty Call Result");
										return false; return false;
									}

									if( agent_status === "Ready" || agent_status === "Acw" ) {
										Ext.DOM.UnsetFollowup(Ext.Cmp('CustomerId').getValue());
										console.log("## CALL IN PRODUCT ONE AND STATUS "+agent_status);
										CTI.setLabelReady();
										myVar = window.setTimeout( function() {
											try{
												console.log("## HangUp"); 
												ExtApplet.setHangup(); 
											} catch( err ){
												console.log( "No Dial Customer Running!");
												console.log( err );
											}
											Ext.DOM.NextCustomer();
										},3000);
									} 
								}

								// JIKA CAMPAIGN 5=PIL XCELL
								if( Ext.Cmp("CampaignId").getValue() == 5) {
									console.log("## product_to_2nd "+product_to_2nd );
									// JIKA GK ADA PRODUCT KE-2 DAN STATUS BUKAN PILIH NEW, CALL NEXT CUSTOMER
									if( product_to_2nd == false  &&  CallResult != "0" && CallResult != 1) {
										product_to_2nd = true;
										if( agent_status === "Ready" || agent_status === "Acw" ) {
											Ext.DOM.UnsetFollowup(Ext.Cmp('CustomerId').getValue());
											console.log("## CALL IN PRODUCT ONE AND STATUS "+agent_status);
											CTI.setLabelReady();
											myVar = window.setTimeout( function() {
												// Ext.DOM.hangupCustomer();
												try{
													console.log("## HangUp"); 
													ExtApplet.setHangup(); 
												} catch( err ){
													console.log( "No Dial Customer Running!");
													console.log( err );
												}
												Ext.DOM.NextCustomer();
											},3000);
										}
									}	
								} else {console.log("## ADA PRODUCT_2ND");}
								
							}
							//*********************** End SECTION NEXT CUSTOMER
							/*if( agent_status === "Ready" || agent_status === "Acw" ) {
								console.log("## CALL IN PRODUCT ONE");
								CTI.setLabelReady();
								myVar = window.setTimeout( function() {
									Ext.DOM.NextCustomer();
								},3000);
							}*/
						}
						
						if( togle==false ){
							if( (CallEventTriger.event.CallReasonEvent == 1) || (CallEventTriger.event.CallReasonNoNeed == 1) || (CallEventTriger.event.CallReasonNoMoreFU == 1) ){
								// Ext.DOM.CancelActivity();
								console.log( "## CancelActivity");
							}
						} else {
							
							// Next Customer, CALL Setelah 3 Detik
							console.log('## ELSE togle'+togle);
							/*if( agent_status === "Ready" || agent_status === "Acw" ) {
								console.log("## CALL IN PRODUCT ONE");
								CTI.setLabelReady();
								myVar = window.setTimeout( function() {
									Ext.DOM.NextCustomer();
								},3000);
							} else {
								Ext.DOM.initFunc.isCancel = true;
							}*/

							// End Next Customer CALL Setelah 3 Detik
							
						}
					}
					// cek failed karena data disabled atau bukan 
					// jika ya keluarkan alert yang berbeda 	
					else {
						if( data.disabled == 1 ){
							console.log("## data.disabled ",data.disabled);
							Ext.Msg("Sorry, Customer has been disabled.\nPlease select other Customer").Failed();
							window.protectUiDisabled( true );
						} 
						else {
							// alert('gagal');
							// console.log('Teslog',Ext.Msg("Save Activity").Failed());
							Ext.Msg("Save Activity").Failed(); 
						}
						return false;
					}
				});
			}
		}).post();
		
	} else {
		//edit rangga 51219
		if(Ext.Cmp('CampaignId_2nd').getValue() == '9'){
			// alert('halo');return false;
			if (Ext.Cmp('CallResult_2nd').getValue() == '8' ) {
				if (Ext.Cmp('CallDisagree_2nd').getValue() == '' || Ext.Cmp('CallDisagree_2nd').getValue() == null || Ext.Cmp('CallDisagree_2nd').getValue() == undefined) {
					alert('Disagree Reason is empty');
					return false;
				}

			}
		}
		Ext.DOM.saveActivitySecondProduct();
	}
}

Ext.DOM.saveActivitySecondProduct = function() {
	console.log("## saveActivitySecondProduct");

	this.Utils = new Ext.Util({ });
	var CallEventTriger = Ext.DOM.CallInterest();
	var ActivityForm = Ext.Serialize('frmActivityCall_2nd').Complete( new Array(
		'QualityStatus_2nd', 'CallingNumber_2nd', 'PhoneNumber_2nd', 'AddPhoneNumber_2nd', 'date_call_later_2nd', 'hour_call_later_2nd', 'minute_call_later_2nd', 'CallDisagree_2nd'
	));
	
	if( this.Utils.IsObject( CallEventTriger ) && CallEventTriger.event.CallReasonLater==1 ){
		ActivityForm = Ext.Serialize('frmActivityCall_2nd').Complete(new Array(
			'QualityStatus_2nd','CallingNumber_2nd', 'PhoneNumber_2nd','AddPhoneNumber_2nd','CallDisagree_2nd'
		));
	}
	
	var callProtectedUnable = Ext.Cmp('CallResult_2nd').getValue(); 

	if( CallEventTriger.event.CallReasonEvent == 1 ){

		//edit irul
		// if(Ext.Cmp('VerifForm').getValue() != '1') {
		// 	Ext.Msg('Please complete Verification').Info();
		// 	return false;
		// }
		//tutup edit irul

        //edit hilman andi 5-11-2020  
		if(Ext.Cmp('InputForm_2nd').getValue() != '1') {
			Ext.Msg('Please input Product Info').Info();
			return false;
		}
        //edit hilman andi 5-11-2020
		
		if( !Ext.DOM.initFunc.isCallPhone && !Ext.DOM.initFunc.isRunCall ){
			Ext.Msg("Theres No Call Activity OR Call Is Running").Info();
			return false;
		}
	}
			
	// jika status  sebelumnya NEW kemudian di simpan kembali 
	// NEW maka Akan dilakukan penolakan .

	//edit irul
	if( callProtectedUnable == window.CONFIG.NEW_STATUS){
		Ext.Msg("Please select other status").Info();
		return false;
	}	

	//tutup edit irul
	if( CallEventTriger.event.CallReasonEvent == 1 ){
		//edit irul
		// if(Ext.Cmp('VerifForm').getValue() != '1') {
		// 	Ext.Msg('Please complete Verification').Info();
		// 	return false;
		// }
		//tutup edit irul
		if(Ext.Cmp('InputForm_2nd').getValue() != '1') {
			Ext.Msg('Please input Product Info 2nd Product').Info();
			return false;
		}
	}

	//edit irul
	var CampaignId = Ext.Cmp('CampaignId_2nd').getValue();
	if (CampaignId == '6' || CampaignId == '5' || CampaignId == '9') {
		if (Ext.Cmp('CallResult_2nd').getValue() == '13' && Ext.Cmp('InputCDD_2nd').getValue() != '1') {
			Ext.Msg('Please input CDD').Info();
			return false;
		}
	}
	//tutup edit irul
	var call_remarks = $('#call_remarks_2nd').val();
	if (call_remarks == '' && CampaignId == '9') {
		alert('Notes is not empty');
		return false;
	}
	if (Ext.Cmp('CallResult_2nd').getValue() != '9') {
		if( CallEventTriger.event.CallReasonNoMoreFU == 1 ) {
			if(Ext.Cmp('VerifForm_2nd').getValue() != '2') {
				Ext.Msg('Please select other status').Info();
				return false;
			}
		}
	}

	if( callProtectedUnable == window.CONFIG.NEW_STATUS){
		Ext.Msg("Please select other status").Info();
		return false;
	}

	Ext.DOM.initFunc.isSave = true;
	Ext.DOM.initFunc.isCallPhone = false;
	Ext.DOM.initFunc.isCancel = true;
 
	var frmActivityCall = Ext.Serialize('frmActivityCall_2nd').Initialize(),
		frmInfoCustomer = Ext.Serialize('frmInfoCustomer_2nd').Initialize(),
		frmDataAdditional = {};

	// data push tambahan 
	frmDataAdditional.CustomerId = Ext.Cmp('CustomerId_2nd').getValue();
	frmDataAdditional.CallingNumber = Ext.Cmp('CallingNumber').getValue();
	frmDataAdditional.CallSessionId = Ext.DOM.CallSessionId();
	frmDataAdditional.FirstProductFlag = firstProd;
	
	// define object XMLDocument for triger post data 
	// Via Ajax Process on background.  
	Ext.Cmp('ButtonUserSave').disabled(true);

	// console.log('A',frmActivityCall,'B',frmInfoCustomer,'C',frmDataAdditional);
	// console.log('param',Ext.Join( new Array( frmActivityCall, frmInfoCustomer, frmDataAdditional )).object());
	
	var protectedDataSubmitHttp = Ext.EventUrl( new Array('ModSaveActivity','SaveActivity'));  
	Ext.Ajax({
		url 	: protectedDataSubmitHttp.Apply(),
		method 	: 'POST',
		param  	: Ext.Join( new Array( frmActivityCall, frmInfoCustomer, frmDataAdditional,{'customerIdXcell':customerIdXcell} )).object(),
		success  : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				// console.log('condition',data);
				if( data.success ){
					// alerting info submit 
					Ext.Msg("Save Activity").Success();
					$('#ButtonUserCancel2nd').prop('disabled', false);
					// set focus to first tab 
					$("#tabs").mytab().tabs().tabs("option", "selected", 0);
					
					// alert(Ext.Cmp("CampaignId_2nd").getValue());
					// on load data process User Activity  && reloading 
					// view after process submit .
					window.EventGetResultData();
					window.EventCallHistory({page : 0, orderby : "", type : ""});
					window.EventCallHistorySecondProduct({page : 0, orderby : "", type : ""});
					
					// 8 = Disagree | 83 = Hanya Tertarik PIL
					if(callProtectedUnable==8 && Ext.Cmp("CallDisagree_2nd").getValue()==83) {
						var togle = Ext.DOM.getToSecondProducts(callProtectedUnable,Ext.Cmp("CampaignId_2nd").getValue());
					} else {
						// Next Customer CALL Setelah 3 Detik
						// ****************** SECTION NEXT CUSTOMER
						// JIKA PRODUCT KE-2,
						if( value_2nd == '2nd') {
							var CallResult = parseInt(Ext.Cmp("CallDisagree_2nd").getValue());
							if( CallResult == 0 )
							{
								alert("Empty Call Result");
								return false; return false;
							}

							// NOTE  83: UNTUK PRODUCT KE 2 STATUS 83=[HANYA TERTARIK PIL]. TIDAK NEXT CUSTOMER CALL, KMBALI KE MAIN PRODUCT
							// NOTE !83: CALL NEXT CUSTOMER
							if( CallResult != 83 ) {
								var str = $("#AgentStatus").text(); str = str.replace(/"/gi, "");
								var agent_status = str.replace(/\s/g, '');
								if( agent_status === "Ready" || agent_status === "Acw" ) {
									Ext.DOM.UnsetFollowup(Ext.Cmp('CustomerId').getValue());
									console.log("## CALL IN PRODUCT TWO AND STATUS "+agent_status);
									CTI.setLabelReady();
									myVar = window.setTimeout( function() {
										try{
											console.log("## HangUp"); 
											ExtApplet.setHangup(); 
										}catch( err ){
											console.log( "No Dial Customer Running!");
											console.log( err );
										}
										Ext.DOM.NextCustomer();
									},3000);
								}
							}
						}
						// ********************* End SECTION NEXT CUSTOMER
					}

					// jika data dengan status ini maka langsung di cancel 
					// dan kembali ke customerlist User
					if(togle==false){
						if( (CallEventTriger.event.CallReasonEvent == 1) || (CallEventTriger.event.CallReasonNoNeed == 1) || (CallEventTriger.event.CallReasonNoMoreFU == 1) ){
							// Ext.DOM.CancelActivity();
						}
					}
				}
				// cek failed karena data disabled atau bukan 
				// jika ya keluarkan alert yang berbeda 	
				else {
					if( data.disabled == 1 ){
						Ext.Msg("Sorry, Customer has been disabled.\nPlease select other Customer").Failed();
						window.protectUiDisabled( true );
					} 
					else {
						// alert('gagal');
						// console.log('Teslog',Ext.Msg("Save Activity").Failed());
						Ext.Msg("Save Activity").Failed(); 
					}
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

 /*
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.DOM.getEventSale = function(object) 
{
	// @reverse data get parent dispostion 	
	window.EventGetParentId(object.value);
	window.EventGetDisagreeId(object.value);
	// on get json data URL then will return on data 
	// json type 
	if(secondProd == true && Ext.Cmp("CampaignId_2nd").getValue()==9){
		// Ext.DOM.getToSecondProduct(object.value,Ext.Cmp("CampaignId_2nd").getValue());
	}
	
	var row = Ext.Json("SetCallResult/getEventType", {
			CallResultId : object.value
		});
	
	row.dataItemEach(function( rs, xh, ro ){
		if( rs.success && typeof( rs.event ) == 'object' ){
			// rs.event.CallReasonNoNeed then will get soon 
			// Ok Bluer Sip .
			
			if( rs.event.CallReasonNoNeed == 1 ){ 
				Ext.Cmp('CallDisagree').disabled(false);
				Ext.Cmp('CallDisagree_2nd').disabled(false);
			}
			else{
				Ext.Cmp('CallDisagree').disabled(true);
				Ext.Cmp('CallDisagree_2nd').disabled(true);
				Ext.Cmp('CallDisagree').setValue('');
				Ext.Cmp('CallDisagree_2nd').setValue('');
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

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */ 
Ext.DOM.CancelActivity =function()
{
	console.log("## clearTimeout");
	clearTimeout(myVar);

	// if( !Ext.DOM.initFunc.isCallPhone && !Ext.DOM.initFunc.isRunCall ){
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	if( Ext.DOM.initFunc.isCancel == true )  {
		
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
	
 	if( typeof ( StdObj ) == 'object' && typeof( StdObj.Value ) == 'function')  {
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
 
}

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
	
	// console.log("Verification :"+Controller);
	// check apakaha ref data campaignya ada jika tidak 
	// data keluarkan alert.
	if( Controller == ''){
		$('#tabs-2').html("no ref data form.");	
		return false;
	}
	
	var CustomerId_2nd = Ext.Cmp('CustomerId_2nd').getValue(), 
		Controller_2nd = Ext.Cmp('ViewVerification_2nd').getValue();
		
	if( Controller == ''){
		$('#tabs_second-2').html("no ref data form.");	
		return false;
	}
	
	// push data wil ajax loader performance 
	
	var protectedAjaxUrl = Ext.EventUrl( new Array(Controller,'index') );
	$('#tabs-2').load( protectedAjaxUrl.Apply(), {	CustomerId 	: CustomerId,
													Mode : 'INPUT' }, 
	function( response, status, xhr ){
		// console.log( xhr.status );
	});
	// console.log();
	var protectedAjaxUrlSecond = Ext.EventUrl( new Array(Controller_2nd,'loadSecondVerification') );
	$('#tabs_second-2').load( protectedAjaxUrlSecond.Apply(), { CustomerId : CustomerId_2nd, Mode : 'INPUT' },
		function( response, status, xhr ){ console.log( xhr.status );}
	);
}

// edit rangga cdd
Ext.DOM.LoadCdd = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue(), 
		Controller = Ext.Cmp('ViewCdd').getValue();
	
		// console.log('##cus',Controller_2nd);
		// console.log('##cus',CustomerId_2nd);
		// check apakaha ref data campaignya ada jika tidak 
		// data keluarkan alert.
	if( Controller == ''){
		$('#tabs-7').html("no ref data form.");	
		return false;
	}
	// push data wil ajax loader performance 
	var protectedAjaxUrl = Ext.EventUrl( new Array(Controller,'index') );
	$('#tabs-7').load( protectedAjaxUrl.Apply(), {	CustomerId 	: CustomerId, Mode : 'INPUT' }, 
		function( response, status, xhr ){
			// console.log( xhr.status );
		});
	var CustomerId_2nd = Ext.Cmp('CustomerId_2nd').getValue();
	var Controller_2nd = Ext.Cmp('ViewCdd_2nd').getValue();
	
	// if(secondProd){
		if( Controller_2nd == ''){
			$('#tabs_second-7').html("no ref data form.");	
			return false;
		}
			var protectedAjaxUrlSecond = Ext.EventUrl( new Array(Controller_2nd,'cddSecondProduct') );
			$('#tabs_second-7').load( protectedAjaxUrlSecond.Apply(), {	CustomerId 	: CustomerId_2nd, Mode : 'INPUT' }, 
				function( response, status, xhr ){
					// console.log( xhr.status );
				});
	// }
}

 /*
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.DOM.LoadProductInfo = function(){

	// jika pake load biasa jquery gak ke oad jadinya suka Error 
	// diganti di sini ya .	
	var CustomerId = Ext.Cmp('CustomerId').getValue(),
		Controller = Ext.Cmp('ViewProductInfo').getValue(),
		CustomerName = Ext.Cmp('CustomerFirstName').getValue(),
		CustomerDOB = Ext.Cmp('CustomerDOB').getValue(),
		GenderId = Ext.Cmp('GenderId').getValue();
		
	// cek apakah controllers tersedia jika tidak keluarkan
	// execption condition .
	// console.log(Controller);
	if( Controller == ''){
		$('#tabs-3').html("no ref data form.");
		return false;
	}
	
	// push data wil ajax loader performance 
	var protectedAjaxUrl = Ext.EventUrl( new Array(Controller,'index') );
	// console.log("##DEBUG");
	// console.log(protectedAjaxUrl);
	$('#tabs-3').load( protectedAjaxUrl.Apply(), {	CustomerId 	 : CustomerId,
													CustomerName : CustomerName,
													CustomerDOB  : CustomerDOB,
													GenderId	 : GenderId,
													Mode 		 : 'INPUT' }, 
	function( response, status, xhr ){
		console.log( xhr.status );
	});
	

	var CustomerId_2nd = Ext.Cmp('CustomerId_2nd').getValue(),
		Controller_2nd = Ext.Cmp('ViewProductInfo_2nd').getValue(),
		CustomerName_2nd = Ext.Cmp('CustomerFirstName_2nd').getValue(),
		CustomerDOB_2nd = Ext.Cmp('CustomerDOB_2nd').getValue(),
		GenderId_2nd = Ext.Cmp('GenderId_2n').getValue();
	if(Controller_2nd == ''){
		$('#tabs_second-3').html("no ref data form.");
		return false;
	}
	// console.log("ConstrollerFlexi"+Controller_2nd); return false; exit();
	var protectedAjaxUrlforSecondProduct = Ext.EventUrl( new Array(Controller_2nd,'index') );
	$('#tabs_second-3').load( protectedAjaxUrlforSecondProduct.Apply(), {
		CustomerId 	 : CustomerId_2nd,
		CustomerName : CustomerName_2nd,
		CustomerDOB  : CustomerDOB_2nd,
		GenderId	 : GenderId_2nd,
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
Ext.DOM.AddReferral = function( )
{	
  	var CustomerId = Ext.Cmp('CustomerId').getValue();
 	$('#WindowUserDialog').html("<div class='ui-widget-ajax-spiner'></div>");	
  	$("#WindowUserDialog").dialog({
		title		: 'Add Referral',
		bgiframe	: true, 
		autoOpen	: false,
		cache		: false, 
		height		: 500,
		width 		: 920,
		close		: function(event, ui) {  $(this).empty();    $(this).remove(); }, 
	  	modal 		: true 
	}).load(Ext.DOM.INDEX+"/SrcCustomerList/ViewAddReferral/?CustomerId="+CustomerId+"&time="+ Ext.Date().getDuration(), function(response,status, xhr){
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
window.EventGetDisagreeId = function( dispositionID )
{
	if( !dispositionID ){ 
		return false; 
	}

	if(firstProd){
		var CampaignIds = Ext.Cmp('CampaignId').getValue();
	}else{
		var CampaignIds = Ext.Cmp('CampaignId_2nd').getValue();
	}
	console.log(CampaignIds);
	// get on html object data by loader spiner like this .
	// on library spiner data object 

	var protectedUrlData = Ext.EventUrl( new Array('SetCallResult', 'DisagreeDataId')),
		disCampaignId = CampaignIds;
	
	if(firstProd){
		var selector = "#ui-disagree-data";
	}else{
		var selector = "#ui-disagree-data2nd";
	}
	// console.log(selector);
	$(selector).loader({
		url   : protectedUrlData.Apply(),
		param : {
			dispositionID : dispositionID,
			disCampaignId : disCampaignId 
		},
		complete : function( obj ){
			$(obj).css({ height : "100%"});
			if (dispositionID == 8) {
			
				$('#CallDisagree').attr('style','width:350px')

			}
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
	
	if(firstProd){
		var CustomerIds = Ext.Cmp('CustomerId').getValue();
		var CampaignId = null;
	}else{
		var CustomerIds = Ext.Cmp('CustomerId_2nd').getValue();
		var CampaignId = Ext.Cmp('CampaignId_2nd').getValue();
	}
	// get on html object data by loader spiner like this .
	// on library spiner data object 

	var protectedUrlData = Ext.EventUrl( new Array('SetCallResult', 'DispositionParent')),
		callCustomerID = CustomerIds;
	
	if(firstProd){
		var selector = "#ui-disposition-parent";
	}else{
		var selector = "#ui-disposition-parent2nd";
	}
	console.log(selector);
	$(selector).loader({
		url   : protectedUrlData.Apply(),
		param : {
			dispositionID : dispositionID,
			callCustomerID : callCustomerID,
			campaignId : CampaignId
		},
		complete : function( obj ){
			$(obj).css({ height : "100%"});
			$('.select-chosen').chosen();
			
			// then will disabled on this ID 
			// like this 
			if(firstProd){
				Ext.Cmp('CallStatus').disabled(true);
			}else{
				Ext.Cmp('CallStatus_2nd').disabled(true);
			}
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
	var protectedData = Ext.EventUrl( new Array('SetCallResult','UpdateResultData'));
	if(firstProd){
		var callDispositionID = Ext.Cmp('CallResult').getValue(),
			callCustomerID = Ext.Cmp('CustomerId').getValue();
	}else{
		var callDispositionID = Ext.Cmp('CallResult_2nd').getValue(),
			callCustomerID = Ext.Cmp('CustomerId_2nd').getValue();
	}
		
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
 
window.EventCallHistorySecondProduct = function( obj )
{
    var CustomerId = Ext.Cmp('CustomerId_2nd').getValue();
	 $('#tabs_second-1').Spiner
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
		handler  : 'EventCallHistorySecondProduct',
		complete : function( obj ){
			$(obj).css({"height":"100%","padding-bottom" : "50px" });
		}
		
	});
}
 
	
/*
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
Ext.DOM.Toggling = function(first, second){
	if(first==true){
		firstProd = first;
		$("#first_product").show();
		$('#CallDisagree').attr('style','display:none');
		$('#ButtonUserCancel').prop('disabled', true);
	}else{
		firstProd = first;
		$("#first_product").hide();
	}

	if(second==true){
		secondProd = second;
		$("#second_product").show();
		$('#ButtonUserCancel2nd').prop('disabled', true);
	}else{
		secondProd = second;
		$("#second_product").hide();
	}
}

Ext.DOM.getToSecondProducts = function(disagreeid = null,campaignid = null)
{
	console.log("## (F) getToSecondProducts");
	if( Ext.Cmp('SecondProduct').getValue() ){

		if(campaignid == 5) {
			console.log("## Go to Second Product!");
			go_to_second = "go_to_second_product";
			
			$("<div>Go to Second Product!</div>").dialog({
				closeOnEscape: false,
				open: function(event, ui) {
					 $(".ui-dialog-titlebar-close").hide();
					 $(".ui-dialog-titlebar-close").focus();
				},
				buttons: {
					'OK': function () {
						Ext.DOM.Toggling(false,true);
						$(this).dialog("close");
						return true;
					}
				},
				modal:true
			});

		// }else if(campaignid == 9 && disagreeid == 8){
		// sementara dibypass disagree reasonnya
		// campaignid 9 = FLEXI
		
		} else if(campaignid == 9 ){
			console.log("## Go to Main Product!");
			alert("Go to Main Product!");
			Ext.DOM.Toggling(true,false);
			return true;
		}
	} else{
		console.log("## No SecondProduct ");
		return false;
	}
}

$(document).ready( function() {
	var go_to_second = "";

	//edit irul
	$("#CallResult option[value='9']").remove();
	$("#CallResult_2nd option[value='9']").remove();
	//tutup edit irul
  	console.log("## Automatic Dial");
  	console.log("## myVar"+myVar);

  	Ext.DOM.Toggling(true,false);
  	$('.select-chosen').chosen();  
  	//edit rangga tabs
  	console.log('## verstatcuy',<?php echo $ver_res_stat?>)
  	console.log('## cddstatcuy',<?php echo $cdd_stat?>)
  	$("#tabs").mytab().tabs({ selected : 0});
  	$("#tabs").mytab().close({}, true);
  	//$("#tabs_second").mytab().tabs({ selected : 0 ,disabled:[2,3]});
  	$("#tabs_second").mytab().tabs({ selected : 0});
  	$("#tabs_second").mytab().close({}, true);
  	$('#ButtonUserCancel').prop('disabled', true);
  
 	// this my layout 
	$('.ui-nav-customize').css({'margin-left' : '0px'});
	$('.btn-max').css({'width' : '98%'});
 
  	$('#toolbars').extToolbars ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		// extTitle  : [['Next Customer'],['End Session'],['Add Phone'],['Add Referral']],
		// extMenu   : [['NextCustomer'],['EndSession'],['Ext.DOM.UserWindow'],['Ext.DOM.AddReferral']],
		// extIcon   : [['group_go.png'],['telephone_delete.png'],['telephone_add.png'],['group_add.png']],
		
		extTitle  : [['End Session'],['Add Phone'],['Add Referral']],
		extMenu   : [['EndSession'],['Ext.DOM.UserWindow'],['Ext.DOM.AddReferral']],
		extIcon   : [['telephone_delete.png'],['telephone_add.png'],['group_add.png']],
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
	
	$('#toolbars2').extToolbars ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [[],['Add Referral'],['Add Phone']],
		extMenu   : [[],['Ext.DOM.AddReferral'],['Ext.DOM.UserWindow']],
		extIcon   : [['page_white_acrobat.png'],['group_add.png'],['telephone_add.png']],
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
	
	
  	// set by time out
	Ext.DOM.DisabledActivity();
	window.EventCallHistory({page : 0, orderby : "", type : ""});
	window.EventCallHistorySecondProduct({page : 0, orderby : "", type : ""});
	Ext.DOM.LoadVerification();
	Ext.DOM.LoadCdd();
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
  
  	// data yang di disabled tidak bisa di followup lagi Exit saja ya .
  	var callUiDisable = Ext.Cmp('callUiDisable').getValue();
  	if( callUiDisable == 1 ){
		// window.protectUiDisabled(true);
  	}

   	/* LANGSUNG DIAL, KRIIIIIIIIIIIIIIING!!! */
	var callDialCustomerStatus = Ext.Cmp('CallResult').getValue(),
		callDialCustomerNumber = Ext.Cmp('PhoneNumber').getValue(),
		callDialAutomaticStart = Ext.Cmp('dialAutomatic').getValue();

	if( callDialAutomaticStart == '') {
		window.checkDialAutomatic = false;
		console.log("Manual Dial Customer Data!");
	} else {
		window.checkDialAutomatic = true;
		console.log("Automatic Dial Customer Data!");
		// then if condition set on here .
		// if( callDialCustomerStatus  == 1 ) kalau yang lama . 
		// langsung dial hanya untuk status data NEW 

		// if( callDialCustomerStatus  == 1 ) {
		var status_auto_dial = ['1','2','5','6','7','8'];
		if( status_auto_dial.indexOf(callDialCustomerStatus) >= 0 ) {
			console.log("## Automatic Dial");
			Ext.Cmp('CallingNumber').setValue( callDialCustomerNumber );
			
			// Next Customer CALL Setelah 3 Detik
			var str = $("#AgentStatus").text(); str = str.replace(/"/gi, "");
			var agent_status = str.replace(/\s/g, '');
			console.log( "## status"+agent_status );
			if( agent_status == "Ready") {
				console.log( "## CALL CLIK START DIAL");
				if( Ext.Cmp('CampaignId').getValue() == "5") {
					var protectedData  = new Array('CallResult','CallResult');
						$(protectedData).each(function(item, protectedID ){
						Ext.Cmp( protectedID ).disabled(false);	
					});
				}
				dialCustomer('Automatic');

			} else {
				alert("Agent Status Not Ready"); return false;
			}
			// End Next Customer CALL Setelah 3 Detik
		}
	}
  
});

$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});

</script>
