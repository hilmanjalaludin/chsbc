<script type="text/javascript">

/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
new Clipboard('.btn-clipboard');
var Role = new Ext.Role("CallerIncoming");
	Role.extend([
		{ title: " ", icon :"", event: "" } 
	]);


/**
 * @class  [Register patient]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 window.EventCallOutPaging = function( pager ){
	 // console.log( pager );
	 // check validation data : 
	 if( typeof(pager) == 'undefined' ){
		 pager = { page:0, orderby : '', type : '' }
	 }
	 
	 var render = $('#ui-widget-outbound-callhistory'),
		 accountId = Ext.Cmp('caller_mrn').getValue(),
		 callerId = Ext.Cmp('caller_number').getValue();
	 
	 if( typeof(render) != 'object' ){
		 return false;
	 }
	 
	 // then if true object : 
	 var url = Ext.EventUrl( new Array('Outbound', 'PagingHistory') ).Apply();
	 render.Paging({
		 url : url,
		 
		 // sent data : 
		 param : {
			 Account : accountId,
			 CallerId : callerId
		 },
		 
		 // paging attribute : 
		 paging : {
			orderData : pager.orderby,
			orderType : pager.type,
			orderPage : pager.page	
		 },
		 // handler function : 
		 
		 handler : 'EventCallOutPaging',
		 // @return [html, status, responseType, xmlObject]
		 complete  : function( html, status, response, xhr ){
			 //$(html).css({'height' : '100%'}); 
		 }
	 });
 }
 
 
/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
window.ShowDefaultPageHistory = function( pager ) {	
	if( typeof( pager ) == 'undefined' ){
		pager = {page : 0, orderby : "", type : ""}
	}
	
	var caller_number = Ext.Cmp("caller_number").getValue();
	var caller_mrn = Ext.Cmp("caller_mrn").getValue();
	var caller_project = Ext.Cmp("caller_project").getValue();
	
	
	var render = $('#ui-widget-user-callhistory');
		render
		.Spiner
		({
			url 	: new Array('CallerHistory','ShowDefaultPageHistory'),
			param 	: {
				caller_mrn 		: caller_mrn,	
				caller_number 	: caller_number,
				caller_project 	: caller_project,
			},
			order   : {
				order_type : pager.type,
				order_by   : pager.orderby,
				order_page : pager.page	
			}, 
			handler : 'ShowDefaultPageHistory', 
			complete : function( pager ){
				$('#ui-widget-user-callhistory').css({"height":"99%"});
				$('#ui-widget-user-callhistory').css({"width":"98%"});
			}
		});	
 } 
 
/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 window.PageTicketCaller = function( pager ) {
	 
 if( Ext.Cmp("ui-widget-user-ticket").IsNull() ){
	return false;
  } 
  
  // check validation : 
  if( typeof( pager ) == 'undefined' ){
		pager = {page : 0, orderby : "", type : ""}
  }
  
 // get data : 
	var caller_number 	= Ext.Cmp("caller_number").getValue();
	var ticket_no 		= Ext.Cmp("ticket_no").getValue();
	var caller_project 	= Ext.Cmp("caller_project").getValue();
	
	$('#ui-widget-content-ticket').Spiner({
		url 	: new Array('UserTicket','PageTicketCaller'),
		param 	: {
			caller_number 	: caller_number,
			ticket_no 		: ticket_no,
			caller_project 	: caller_project
		},
		order   : {
			order_type : pager.type,
			order_by   : pager.orderby,
			order_page : pager.page	
		}, 
		handler : 'PageTicketCaller', 
		complete : function( pager ){
			//$('#ui-widget-user-callhistory').css({"height":"99%"});
			//$('#ui-widget-user-callhistory').css({"width":"98%"});
		}
	});	
	
	 
 } 
 
/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.PageSmsHistory = function( obj )
{
  if( Ext.Cmp("ui-widget-user-sms").IsNull() ){
	return false;
  } 
  
  var caller_number = Ext.Cmp("caller_number").getValue();
  var caller_project = Ext.Cmp("caller_project").getValue();
  
  Ext.Ajax
  ({
		url    : Ext.EventUrl(new Array("SMSOutbox", "PageSmsHistory") ).Apply(),
		method : "POST",
		param  : {
			caller_number 	: caller_number,
			ticket_no 		: "",
			caller_project 	: caller_project,
			page 			: obj.page,
			orderby 		: obj.orderby,
			type 			: obj.type
		},
		response : function( r ){
			if(r.explicitOriginalTarget.statusText == 'OK' ) {
				console.log(r.explicitOriginalTarget.statusText);
			}
		} 
	}).load("ui-widget-user-sms");
 } 
 /**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.PageMCU = function( obj )
{
 
 if( Ext.Cmp("ui-widget-user-mcu").IsNull() ){
	return false;
  } 
  
  
 var caller_number = Ext.Cmp("caller_number").getValue();
 var caller_mrn = "";
 var caller_project = Ext.Cmp("caller_project").getValue();
 
	Ext.Progress("onprogress").start();
	Ext.Ajax
	({
		url    : Ext.EventUrl(["Appointment", "PageMcu"]).Apply(),
		method : "POST",
		param  : {
			caller_number 	: caller_number,
			caller_mrn 		: caller_mrn,
			caller_project  : caller_project, 
			orderby 		: obj.orderby,
			page 			: obj.page,
			type 			: obj.type
		}
	}).load("ui-widget-user-mcu");
	Ext.Progress("onprogress").stop();	
 } 
 
/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.PageAppointment = function( obj )
{
	 if( Ext.Cmp("ui-widget-user-apointment").IsNull() ){
	return false;
  } 
  
  
	var caller_number = Ext.Cmp("caller_number").getValue();
	var caller_mrn = "";
	var caller_project = Ext.Cmp("caller_project").getValue();
	 
	
	Ext.Progress("onprogress").start();
	Ext.Ajax
	({
		url    : Ext.EventUrl(["Appointment", "PageRawatJalan"]).Apply(),
		method : "POST",
		param  : {
			caller_number 	: caller_number,
			caller_mrn 		: caller_mrn,
			caller_project	: caller_project,
			orderby 		: obj.orderby,
			page 			: obj.page,
			type 			: obj.type
		}
	}).load("ui-widget-user-apointment");
	Ext.Progress("onprogress").stop();	
 } 
 /**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 Ext.DOM.PageBookingCaller = function( obj )
{
  if( Ext.Cmp("ui-widget-user-booking").IsNull() ){
	return false;
  } 
  
  var caller_number = Ext.Cmp("caller_number").getValue();
  var caller_mrn = Ext.Cmp("caller_mrn").getValue(); 
  var caller_project = Ext.Cmp("caller_project").getValue();
  
	Ext.Progress("onprogress").start();
	Ext.Ajax
	({
		url    : Ext.EventUrl(["Booking", "PageBookingCaller"]).Apply(),
		method : "POST",
		param  : {
			caller_number 	: caller_number,
			caller_mrn 		: caller_mrn,
			caller_project 	: caller_project,
			orderby 		: obj.orderby,
			page 			: obj.page,
			type 			: obj.type
		}
	}).load("ui-widget-user-booking");
	Ext.Progress("onprogress").stop();	
 } 
 
/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 var FindByTicket = function() {
	 window.PageTicketCaller();
 }
 
/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 window.UserLayout = function() 
{	 

// --- start : form : responsive content ---------------------	 
	$('textarea.address').css({"height" : "24px"}); 

	//$("fieldset.ui-widget-fieldset").css({"margin-bottom" : "10px", "padding-bottom": "10px" });
	//$(".ui-widget-user-tabs").css({"background-color": "#FBFEFF", "padding-bottom": "5px"});
	
	$(".ui-widget-user-ticket").css({ "background-color" : "#FBFEFF" });
	$(".ui-widget-user-callhistory").css({"background-color" : "#FBFEFF"});
	$(".ui-widget-user-sms").css({ "background-color" : "#FBFEFF" });
	$(".ui-widget-user-ticket-nav").css({"margin" : "4px 1px 2px 1px", "padding" : "2px -1px 2px 5px"});
	$(".ui-widget-button-link").css({ "margin-top": "8px"});
	//$(".ui-widget-user-ticket-nav").addClass("ui-corner-top ui-state-default");
	$('#caller_number').attr('disabled', false);
	$('.ui-display-none').css({"display":"none" });
	$('.ui-widget-remark').css({ "height" : "60px"});
	
}

/**
 * @class  [@constructor]
 * @param  [type] $CustomerId [description]
 * @return [type]             [description]
 */
 window.inputLayout = function() { }

// ----------------------------------------------------------------------------------------------

/*
 * @ pack : get all labels -  array header 
 */
 
$(window).bind("resize", function(){ 
	window.UserLayout();
	window.inputLayout();
 });

// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 
 $("#div_menu_user_action").bind("click", function(){
	$(".ui-widget-fieldset").css({ "padding-bottom": "2px", "margin": "5px 2px 5px 2px" });
	window.UserLayout();
 });
 
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 
 Ext.DOM.SelectCatgory = function(obj)
{
 var track_call_code = obj.value;
 
  if( track_call_code !='' ) 
 {
	Ext.Cmp("save_track_code").setValue(track_call_code);
 }	
	// cek its 
	var res = Ext.Ajax({
		url    : Role.action("JsonSubTrack"),
		method : "POST",
		param :{
			track_call_code : track_call_code
		}
	}).json();
	
	
	 Ext.Ajax
	({
		url    : Role.action("CallSubTrack"),
		method : "POST",
		param :{
			track_call_code : track_call_code
		}
	}).load("lbl_caller_sub_tracker");
	
	$('.select').chosen();
	
	// if( res.success == 0 ){
		// Ext.Cmp('caller_sub_track').disabled(true);	
		// $('#isdisabled').removeClass("text_caption");
		// $('#isdisabled').addClass("text_disabled");
	// } else {
		// $('#isdisabled').addClass("text_caption");
		// $('#isdisabled').removeClass("text_disabled");
		// Ext.Cmp('caller_sub_track').disabled(false);
	// }	
	
	Ext.DOM.SelectSubCatgory({value : track_call_code });
	
	
 }
 
 Ext.DOM.ChangeCallerType = function(obj) {
	 
	// var track_call_code = obj.value;
	// if( track_call_code =='706' )	// non customer alias prospek
	// {
		// Ext.Cmp('caller_mrn').setValue( Ext.Cmp('caller_number').getValue() );	// diisi no telp
	// }
	// else {
		// Ext.Cmp('caller_mrn').setValue( Ext.Cmp('caller_mrn_bak').getValue() );	
	// }
 }
 
 
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 var WindowAgentScript = false; 
 var AgentScript = function( code )
{
	var method = {
		check : function(){
			return ( Ext.Ajax({ 
					url 	: Ext.EventUrl(['AgentScript','SelectScriptByCode']).Apply(),
					method 	: 'GET',
					param 	: {
						code : code	
					}
				}).json()
			);
		},
		
		show : function(){
			var WinAgent = new Ext.Window
			({
				name   : 'WinAgent',
				url    : Ext.EventUrl(['AgentScript','ShowScriptByCode']).Apply(),	
				left   : 1,
				top    : 0, 
				width  : 500,
				height : $(window).height(),
				scrollbars: 1,
				resizable: 1,
				param  : {
					code : code
				}
			});
			
			if( this.check().success == 1 ){
				WindowAgentScript = WinAgent.popup();
			} else{
				if( typeof( WindowAgentScript.available  ) =='function' ){
					WindowAgentScript.available().close();
				}	
			}
		}
	}	
	
	return method;
}   
 
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
  
  
 Ext.DOM.SelectSubCatgory = function(obj) 
{
	var Script = new AgentScript( obj.value );
	Script.show();
	
	Ext.Ajax
 ({
	url 	: Ext.DOM.INDEX +"/SubCallTrack/index/",
	method 	: "POST",
	param 	: {
		subtrack : obj.value
	}
  }).load("ui-child-form");
  
  if( obj.value!='' ) 
  {
	 Ext.Cmp("save_track_code").setValue( obj.value );
  }
   
}

// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 Ext.DOM.PageTransaction = function()
{
	PageAppointment({page : 0, orderby : "", type : ""});
	PageMCU({page : 0, orderby : "", type : ""});
	PageBookingCaller({page	: 0, orderby : "", type : ""});
}	

  
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 Ext.DOM.PageHistoryReload = function() {
	window.ShowDefaultPageHistory();
	window.EventCallOutPaging();
	window.PageTicketCaller();
	
	//PageSmsHistory({page : 0, orderby : "", type : ""});
	//PageAppointment({page : 0, orderby : "", type : ""});
	//PageMCU({page : 0, orderby : "", type : ""});
	//PageBookingCaller({page	: 0, orderby : "", type : ""});
	 
}	
// ----------------------------------------------------------------------------------------------
/*
 * @ pack 	 : cek dob realtime of patient 
 * @ method  : procedural 
 */
    
 var Callculator = function(dateString) // mm-dd-yyyy
{
   var dateString = dateString.join('/');	
   var birth = new Date(dateString);
   var curr  = new Date();
   var diff = curr.getTime() - birth.getTime();
   return Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));
}
  
// ----------------------------------------------------------------------------------------------
/*
 * @ pack 	 : cek dob realtime of patient 
 * @ method  : procedural 
 */
 
 Ext.DOM.CallculateAgePatient = function()
{
  $(".spelling").mask("00-00-0000", { placeholder: "__-__-____"});
  $(".spelling").bind("keyup",function(){ if( $(this).val().length == 10 ) 
	{
		var dateString  = $(this).val().split('-');
		var dateAges = Callculator( new Array(dateString[1], dateString[0], dateString[2]));
		 $("#caller_age").val( dateAges );
	}
  }); 
} 
 
// ----------------------------------------------------------------------------------------------
/*
 * @ pack : get all labels -  array header 
 */
 
   $(document).ready(function()
{
   $("#ui-widget-role-tabs").mytab().tabs();
   $("#ui-widget-role-tabs").mytab().tabs("option", "selected", 0);
   $("#ui-widget-role-tabs").mytab().close(function(e){
		if( Ext.Msg('Are you sure?').Confirm() ) {
			Ext.BackHome();
		}
   },true);
   
   $("#ui-widget-call-history").mytab().tabs();
   $("#ui-widget-call-history").mytab().tabs("option", "selected", 0);
   $("#ui-widget-call-history").mytab().close({}, true);	
   $("#ui-widget-call-history").css({"margin-top": "15px"});
   $('.select').chosen();
   
    // --------------------------------------------------------------
	window.UserLayout();
    Ext.DOM.PageHistoryReload();
	Ext.DOM.CallculateAgePatient();
	// ----------- cek dob of patient ---------------------------
	$( ".dob-autocomplete")
	.autocomplete(["Autocomplete", "index"], {
		max : 100,  
		multiple  : false,
		scrollHeight : 300, 
		multipleSeparator : ""
	})
	.result( function( data, row ) {
		 if( typeof(row) ) {
			 
			$(this).val(row[1]); 
			 Ext.Helper.Complete 
			({
				url : Ext.EventUrl([ "CallerIncoming",  "ShowDefaultPatient" ]).Apply(), 
				param  : {  
					where  : 'CustomerMRN',
					values : $(this).val()
				}
			})
			.Field({
				//CustomerEmailAddress1 as caller_mail_address
				
				caller_mrn 			: "CustomerMRN",	
				caller_number 		: "CustomerHomePhone1",
				caller_dob 			: "CustomerDOB",
				caller_pob 			: "CustomerPOB",
				caller_age 			: "CustomerAge",
				caller_name 		: "CustomerFirstName",
				caller_gender 		: "CustomerGender",
				caller_address 		: "CustomerHomeAddress",
				mother_name			: "CustomerMotherName",
				caller_email   		: "CustomerEmailAddress1",
				caller_contact_name : "CustomerCp",
				caller_other_phone 	: "CustomerHomePhone2",
				caller_product_name : "CustomerProduct",
				caller_status 		: "CustomerStatus"
				
				
			});
			Ext.DOM.PageHistoryReload();
			
			//Ext.DOM.PageHistoryReload();// reload---------->
		}
	});	
	
	// display auto complete by name patient
	
	$( ".caller-displaytable")
	.autocomplete(["Autocomplete", "index"], {
		max : 100,  
		multiple  : false,
		scrollHeight : 300, 
		multipleSeparator : ""
	})
	.result( function( data, row ) {
		if( typeof(row) ) {	 
			$(this).val(row[1]); 
			 Ext.Helper.Complete 
			({
				url : Ext.EventUrl([ "CallerIncoming",  "ShowDefaultPatient" ]).Apply(), 
				param  : {  
					where : 'CustomerMasterId',
					values : $(this).val()
				}
			})
			.Field({
				caller_mrn : "CustomerMRN",	
				caller_number : "CustomerHomePhone1",	
				caller_dob : "CustomerDOB",
				caller_pob 			: "CustomerPOB",
				caller_age : "CustomerAge",
				caller_name : "CustomerFirstName",
				caller_gender : "CustomerGender",
				caller_address 	: "CustomerHomeAddress",
				caller_email   : "CustomerEmailAddress1",
				caller_contact_name :  "CustomerCp",
				mother_name			: "CustomerMotherName",
				caller_other_phone 	: "CustomerHomePhone2",
				caller_product_name : "CustomerProduct",
				caller_status :"CustomerStatus"
			});
			
			Ext.DOM.PageHistoryReload();
			//Ext.DOM.Ext.DOM.PageTransaction();// reload---------->
		}
	});	
	
// display auto complete by name MRN
	
	$( ".mrn-autocomplete")
	.autocomplete(["Autocomplete", "index"], {
		max : 100,  
		multiple  : false,
		scrollHeight : 300, 
		multipleSeparator : ""
	})
	.result( function( data, row ) {
		 if( typeof(row) ) {
			 
			$(this).val(row[1]); 
			 Ext.Helper.Complete 
			({
				url : Ext.EventUrl([ "CallerIncoming",  "ShowDefaultPatient" ]).Apply(), 
				param  : {  
					where : 'CustomerMRN',
					values : $(this).val()
				}
			})
			.Field({
				caller_mrn : "CustomerMRN",	
				// caller_number : "CustomerHomePhone1",	
				caller_dob : "CustomerDOB",
				caller_pob 			: "CustomerPOB",
				caller_age : "CustomerAge",
				caller_name : "CustomerFirstName",
				caller_gender : "CustomerGender",
				caller_address 	: "CustomerHomeAddress",
				caller_email   : "CustomerEmailAddress1",
				caller_contact_name :  "CustomerCp",
				mother_name			: "CustomerMotherName",
				caller_other_phone 	: "CustomerMobilePhone1",
				caller_product_name : "CustomerProduct",
				caller_status :"CustomerStatus"
			});
			
			Ext.DOM.PageHistoryReload();
			
			//Ext.DOM.Ext.DOM.PageTransaction();// reload---------->
		}
	});		
	
	
 });
 
// --------------------------------------------------------------
 
/* 
 * Methode : UpdateUserMenu 
 */
  
 Ext.DOM.FindByPhone = function(obj) {
	Ext.Progress("onprogress").start();
	setTimeout(function(){
		Ext.Progress("onprogress").stop();
	},5000)
	
	
}	


// --------------------------------------------------------------
 
/* 
 * Methode : UpdateUserMenu 
 */
 
 Ext.DOM.FindByMRN = function() {
	Ext.Msg(Ext.Cmp("caller_mrn").getValue()).Info();
}	

// -------------------------------------------------------------- 
 /* 
  * Methode : cancel UI 
  */
  
 Ext.DOM.CancelCaller = function()
{
	if( Ext.Msg('Are you sure?').Confirm() )
	{
		Ext.Serialize("frmCallIncoming").Clear();
		Ext.ShowMenu("CallerHistory","Call History");
	}
}	

// --------------------------------------------------------------
/* 
 * Methode : Ext.DOM.CallEventTriger 
 *
 */
 Ext.DOM.CallEventTriger = function( response )
{
	$("#submit_caller_new").attr("disabled", "true");
	$("#submit_caller_new").css({"color" : "#DDDDDD"});
	
	var obj_callback = {},
	obj_callback = ( typeof ( response.modul )== 'object' ? response.modul : '' );
	if( typeof( obj_callback ) == 'object' ) 
	{
		if( obj_callback.event ==0 ){
			Ext.ShowMenu("CallerHistory","Call History"); } 
		else if( obj_callback.event == 1 ){ 
			Ext.ShowMenu(obj_callback.trigger, obj_callback.title, obj_callback ); } 
		else if( obj_callback.event == 2 ){
			this[obj_callback.trigger].apply(this, new Array(obj_callback) );
		}
	}
} 

// --------------------------------------------------------------
/* 
 * Methode : UpdateUserMenu 
 *
 */
 
 Ext.DOM.SaveCaller  = function( )
{
  var formRequired = {};	 
  var arr_param = new Array();
  var frmCallIncoming  = Ext.Serialize("frmCallIncoming");
  
  // set callerTrack: 
  var callerTracker = Ext.Cmp('caller_tracker').getValue();
  var callerType = Ext.Cmp("caller_type").getValue();
  
// check category Kode : 
  
 var Kondition = true;
 
 if( Ext.Cmp( 'save_track_code').empty()) {
	formRequired['caller_tracker'] = 'caller_tracker';
	Kondition = frmCallIncoming.Required(Object.keys(formRequired));
	if( !Kondition ){
		Ext.Msg(Lang.Label('select_or_category')).Info();
		return false;
	}
 }
 
 if( callerTracker == Ext.DOM.CONFIG.LOOK_APPOINTMENT_CODE  
 && Ext.Cmp("caller_sub_track").empty() ) {
	 
	formRequired['caller_sub_track'] = 'caller_sub_track';
	Kondition = frmCallIncoming.Required(Object.keys(formRequired));
	if( !Kondition){
		Ext.Msg(Lang.Label('select_sub_category')).Info();	
		return false;
	}
 }
 // checked callerType 
 
  if( callerType == '' ) {	  
		Ext.Msg(Lang.Label('select_caller_type')).Info();
		formRequired['caller_type'] = 'caller_type';
		Kondition = frmCallIncoming.Required(Object.keys(formRequired));
		if( !Kondition ){
			Ext.Msg('Please select Caller Type').Info();
			return false;
		}
   }
  
 
 // jika category complain : 
 if( callerTracker == Ext.DOM.CONFIG.LOOK_COMPLAINT_CODE ) {
	 formRequired['caller_name'] = 'caller_name';
	 formRequired['caller_address'] = 'caller_address';
	 formRequired['caller_remark'] = 'caller_remark';
	
	//console.log(formRequired);
	 Kondition = frmCallIncoming.Required(Object.keys(formRequired));
	 if( !Kondition ){
		Ext.Msg('Please input form required for Ticketing').Info();
		return false;
	 }
 } 
 
 
 
 // jika pilih ticketing : 
 if( !callerType.localeCompare('702') ){
	formRequired['caller_mrn'] = 'caller_mrn';
	formRequired['caller_dob'] = 'caller_dob';
	formRequired['caller_name'] = 'caller_name';
	formRequired['caller_address'] = 'caller_address';
	formRequired['caller_remark'] = 'caller_remark';
		
	Kondition = frmCallIncoming.Required(Object.keys(formRequired));
	if( !Kondition ){
		Ext.Msg('Please input form required for customer').Info();
		return false;	
	 }
 }
  

 if( Ext.Cmp('caller_tracker').getValue() == Ext.DOM.CONFIG.LOOK_APPOINTMENT_CODE  
	&& Ext.Cmp("caller_mrn").empty() )
 {
	
	formRequired['caller_mrn'] = 'caller_mrn';
	
	Kondition = frmCallIncoming.Required(Object.keys(formRequired)); 
	if( !Kondition ){
		Ext.Msg(Lang.Label('info_empty_mrn')).Info();
		return false;
	}
 }	
 
 if( Ext.Cmp('caller_tracker').getValue() == Ext.DOM.CONFIG.LOOK_APPOINTMENT_CODE  
	&& Ext.Cmp("caller_mrn").getValue().length < 3 )
 {
	
	formRequired['caller_mrn'] = 'caller_mrn';
	Kondition = frmCallIncoming.Required(Object.keys(formRequired)); 
	if( !Kondition ){
		Ext.Msg(Lang.Label('info_empty_mrn')).Info();
		return false;
	}
 }	
 
// next step: 

  formRequired['caller_number'] = 'caller_number';
  if( !Ext.Cmp("caller_sub_track").empty()) {	
	
	// validation all :
	if( !Ext.Cmp("sub_track_spcl").IsNull() && Ext.Cmp("sub_track_spcl").empty() ) {
		formRequired['sub_track_spcl'] = 'sub_track_spcl';
	}
	
	// validation all :	
	if( !Ext.Cmp("sub_track_doctor").IsNull() && Ext.Cmp("sub_track_doctor").empty()) {
		formRequired['sub_track_doctor'] = 'sub_track_doctor';
	}	
	
	// validation all :
	if( !Ext.Cmp("sub_track_date").IsNull() ) 
		formRequired['sub_track_date'] = 'sub_track_date';
 }
 
 // then will exceptions : 
  var Kondition  = Ext.Serialize('frmCallIncoming')
				  .Required(Object.keys(formRequired));
				  
 if( !Kondition ){
	 return false;
 }				


// jika procedure process unput selesai : 
 
 	 Ext.Ajax ({
		url	    : Role.action("SaveCaller"),
		method  : 'POST',
		param   : Ext.Join( new Array( frmCallIncoming.Data() )).object(), 
		success : function( xhr  ){
			
			// process on client JS : 
			Ext.Util( xhr ).proc(function(callback) {
				
				// if object and status "true":
				
				if( typeof(callback) == 'object' 
				 && callback.success == 1 ) 
				{
					Ext.Cmp('caller_mrn').setValue( callback.modul.caller_mrn);
					Ext.Msg({'Add' : Ext.System.view_file_name() }).Success();
					Ext.DOM.PageHistoryReload();
					
					if( Ext.Cmp('save_track_code').getValue() == Ext.DOM.CONFIG.LOOK_COMPLAINT_CODE ){
						Ext.DOM.CallEventTriger( callback ); 
						return true;
					} 
					else  {
						Ext.Cmp('caller_sub_track').setValue(0);
						Ext.DOM.SelectSubCatgory(Ext.Cmp('caller_sub_track').getElementId());
						return false;
					}
					return true;	
				} 
				else {
					var cmdMessageText = window.sprintf("%s.\nPlease check form required", Ext.System.view_file_name());
					Ext.Msg({'Add' : cmdMessageText }).Failed();
					return false;
				}
			});
		}
	}).post();
	
} 
</script>