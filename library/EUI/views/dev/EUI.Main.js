Ext.DOM.INDEX = Ext.System.view_page_index();
Ext.DOM.setTimeOutId = 0;
Ext.DOM.setTimerAutoCaller = 0;

// ---------------------------------------------------------------------------------------
/*
 * @ package 	:	jQuery Main Content loading 
 */
window.ShowDefaultApi = function() 
{
  var callsessionid = Ext.System.URL('callsessionid').getValue(); 	
  var callerid  = Ext.System.URL('callerid').getValue();
  var ivrdata  = Ext.System.URL('ivrdata').getValue(); 
  
 	if( callerid ) {
		var msg = Ext.Msg('You have incoming call.\n Do you want to accept call ?').Confirm();
		if( !msg) {
			window.location.replace(Ext.DOM.INDEX)
		} else {
			Ext.ShowMenu("CallerIncoming", "New Call", {	
				callsessionid : callsessionid,	
				callerid :  callerid,
				ivrdata : ivrdata	
			});
		}	
 	} else {
		Ext.ShowMenu('Welcome'); 
 	}	
}

// ---------------------------------------------------------------------------------------
/*
 * @ package 	:	jQuery Main Content loading 
 */
$(document).ready(function()
{
   setupTimers(); // run auto logout
   $.ajaxSetup({ cache: false }); 
   $("#accordion").accordion({ icons: { header: "ui-icon-circle-arrow-e", headerSelected: "ui-icon-circle-arrow-s" },autoHeight : true });
   $("#accordions").accordion({ icons: { header: "ui-icon-circle-arrow-e", headerSelected: "ui-icon-circle-arrow-s" },autoHeight : true });
   
   window.ShowDefaultApi(); 
	
   $('.formPhoneDialog').dialog({
		title		:'Form Additional Phone',
		bgiframe	:true,
		width		:400,
		height		:270,
		autoOpen	:false,
		modal		:true,
		closeOnEscape: false,
   		open: function(event, ui) { $(".ui-dialog-titlebar-close").hide();}
	});
	
	$('.changedRequest').dialog({
		title		:'Form Request to change',
		bgiframe	:true,
		width		:400,
		height		:270,
		autoOpen	:false,
		modal		:true,
		draggable	:true,
		closeOnEscape: false,
   		open: function(event, ui) { $(".ui-dialog-titlebar-close").hide();}
	});	  
	
	var options = {  target:  '#password_confirm', success: showResponse }; 
	$('img').mousedown(function(e) {  
		e.stopPropagation(); e.preventDefault(); 
		return false; 
	});
});

/*
 * @ pack : call (this) EUI_libs Cores  #--------------------------------------------------------------------------------------------------------
 */
;(function(Cores, $) { 
	
 Cores.prototype.ShowMenu = function( controller, title, object ) 
 {
	object = ( typeof( object )=='undefined' 
		? {} : Ext.ArrayObject( object ) 
	);
	
	// ---------- page detail of cookies : $.cookie('selected',0); --->
	
	Ext.System.view_name_url(title);
	try 
	{	
		try 
		{ 
			if(controller=='Logout'){ UserLogOut(); return false; }
			else if(controller=='Password') { Password(); return false; }
			else
			{
					
				if( Ext.DOM.setTimeOutId!=0 ) {
				  clearTimeout(Ext.DOM.setTimeOutId)
				}

				if( Ext.DOM.setTimerAutoCaller!=0 ){
					window.clearTimeout(Ext.DOM.setTimerAutoCaller);
				}	
				// ---------- load page image loading content -------------------------	
				$('#main_content').html("<div class='ui-widget-ajax-spiner'></div>");
				$('#main_content').load( Ext.EventUrl(controller).Apply(), object, 
				  function( response, status, xhr ) {
					if( status == 'error') { 
						$('#main_content').html(response);	 
					}	
				}); 
				
			}	
		} 
		catch(e){
			Ext.Error({log :e, name:'Ext.getWebContent();', lineNumber : e.lineNumber });
		}
	}
	catch(e){
		Ext.Error({log: e, name:'Ext.getWebContent();', lineNumber : e.lineNumber });
	}
 }
})(E_ui,jQuery);


// ---------------------------------------------------------------------------------------
/*
 * @ package 	: jQuery Bugs( jQuery-ui.js - Line 7287 )
 *				  Untuk menghindari dialog yang di close lewat icon (X)
 *				  yang terkadang tidak di destroy dengan benar maka untuk
 *				  membuat dialog sebaik-nya di simpan dalam function 
 *		
 * ---------------------------------------------------------------------------------------- 
 */
function showResponse(responseText) {
	$("#password_confirm").dialog({ 
		bgiframe: true, modal: true,
		buttons: {	 Ok: function() { $(this).dialog('close'); } }
	});
 } 	


// ---------------------------------------------------------------------------------------
/*
 * @ package 	: jQuery Bugs( jQuery-ui.js - Line 7287 )
 *				  Untuk menghindari dialog yang di close lewat icon (X)
 *				  yang terkadang tidak di destroy dengan benar maka untuk
 *				  membuat dialog sebaik-nya di simpan dalam function 
 *		
 * ---------------------------------------------------------------------------------------- 
 */
Ext.DOM.AdditionalPhone = function( CustomerId )
{
  $('#WindowUserDialog').html("<div class='ui-widget-ajax-spiner'></div>");	
  $("#WindowUserDialog").dialog 
  ({
	title		: 'Submit Phone Number',
	bgiframe	: true, 
	autoOpen	: false,
	cache		: false, 
	height		: 210,
	width 		: 350,
	close		: function(event, ui) {  $(this).empty();    $(this).remove(); }, 
  	modal 		: true,
	buttons 	: {
		'Submit' : function(){
			if(!Ext.Serialize('frmAddsubmit').Complete() ){
				Ext.Msg("Input form not completed!").Info();
				return false;	
			}	
		
			Ext.Ajax ({
					url 	: Ext.DOM.INDEX +'/ModApprovePhone/SavePhone/', method  : 'POST',
					param	: { 	
							CustomerId : Ext.Cmp('AddCustomerId').getValue(), 
							PhoneAddType : Ext.Cmp('PhoneSelectTypeId').getValue(), 
							PhoneAddDesc :Ext.Cmp('PhoneSelectTypeId').getText(),
							PhoneAddTypeValue : Ext.Cmp('PhoneAddTypeValueId').getValue() 
					},
					ERROR 	: function(e){
						Ext.Util(e).proc(function(submit){
							if(submit.success ){
								Ext.Msg("Request Submit Phone ").Success();
							}
							else{
								Ext.Msg("Request Submit Phone ").Failed();
							}		
						});
					}
			 }).post();
		}
	}	
}).load(Ext.DOM.INDEX+"/ModApprovePhone/ViewAddPhone/?CustomerId="+CustomerId+"&time="+ Ext.Date().getDuration(), 
	function(response,status, xhr){
		if( status =='success'){ console.log('complete'); }}).dialog('open');

}  

// ---------------------------------------------------------------------------------------
/*
 * @ package 	: jQuery Bugs( jQuery-ui.js - Line 7287 )
 *				  Untuk menghindari dialog yang di close lewat icon (X)
 *				  yang terkadang tidak di destroy dengan benar maka untuk
 *				  membuat dialog sebaik-nya di simpan dalam function 
 *		
 * ---------------------------------------------------------------------------------------- 
 */
var Password = function()
{
	$("#pass").dialog
	({
  			bgiframe: true,
  			autoOpen: false,
  			height: 210,
			width:350,
  			modal: true,
  			buttons: {
  				'Update': function()
				{
					Ext.Ajax({
						url : Ext.DOM.INDEX+'/Auth/UpdatePassword',
						method :'POST',
						param : {
							curr_password   : Ext.Cmp('curr_password').getValue(),
							new_password    : Ext.Cmp('new_password').getValue(),
							re_new_password : Ext.Cmp('re_new_password').getValue()
						},
						ERROR : function( e ){
							Ext.Util(e).proc(function(update){
								if( update.success ){
									alert("Success, Update Yours Password");
									Ext.query(this).dialog('close');
								}
								else{
									alert("Failed, Update Yours Password");
								}
							});
						}
					}).post()
  				},
  				Cancel: function() {
  					$(this).dialog('close');
  				}
  			}
  	}).dialog('open');
 } 

// ---------------------------------------------------------------------------------------
/*
 * @ package 	: jQuery Bugs( jQuery-ui.js - Line 7287 )
 *				  Untuk menghindari dialog yang di close lewat icon (X)
 *				  yang terkadang tidak di destroy dengan benar maka untuk
 *				  membuat dialog sebaik-nya di simpan dalam function 
 *		
 * ---------------------------------------------------------------------------------------- 
 */
 if( typeof('ChangeMyPassword') !='function' ){ Ext.DOM.ChangeMyPassword = function(){
		new Ext.DOM.Password();
	}
 }
  
// ---------------------------------------------------------------------------------------
/*
 * @ package 	: jQuery Bugs( jQuery-ui.js - Line 7287 )
 *				  Untuk menghindari dialog yang di close lewat icon (X)
 *				  yang terkadang tidak di destroy dengan benar maka untuk
 *				  membuat dialog sebaik-nya di simpan dalam function 
 *		
 * ---------------------------------------------------------------------------------------- 
 */
Ext.DOM.UserLogOut = function() {	
	$("#logout").dialog 
	({
		bgiframe	: true,
		autoOpen	: false,
		resizable	: false,
		height		: 140,
		modal		: true,
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		 },
		buttons: {
				'Logout': function() {
					document.location= Ext.DOM.INDEX+'/Auth/logout/?login=(false)';
					},
				Cancel: function() {
					$(this).dialog('close');
				}
			 }
			 
	}).dialog('open');
}


/*Section Logout Auto 10 minute*/
// var timeoutInMiliseconds = 600000;
var timeoutInMiliseconds = 950000;
var timeoutId; 
function startTimer() { 
	//console.log("## time "+timeoutInMiliseconds);
	console.log("## startTimer");
    timeoutId = window.setTimeout(doInactive, timeoutInMiliseconds);
}
 
function doInactive() {
	console.log("## Logout Auto"); 
	console.log($("#idCallStatus").text());
	
	clearTimeout(timeoutId);
	var str = $("#idCallStatus").text(); str = str.replace(/"/gi, "");
	var call_status = str.replace(/\s/g, '');

	if( call_status == "Idle") {
		document.location = Ext.DOM.INDEX+'/Auth/logout/?login=(false)';
	}
}

function resetTimer() { 
	// console.log("## resetTimer");
    window.clearTimeout(timeoutId);
    clearTimeout(timeoutId);
    startTimer();
}

function setupTimers () {
    document.addEventListener("mousemove",resetTimer,false);
    document.addEventListener("mousedown",resetTimer,false);
    document.addEventListener("keypress",resetTimer,false);
    document.addEventListener("touchmove",resetTimer,false);
    startTimer();
}
/*End Section Logout Auto 10 minute*/


/* write log to data **/
 
;(function( $ ){ 
 var KEY_USER_OPTION = false;
 $.onload = ( function(event)
 {
	Ext.Ajax
	({ 
		url 	: Ext.EventUrl(["Auth","Refresh"]).Apply(),
		method 	:'GET',
		param   :{
			time : Ext.Date().getDuration()
		},
		ERROR : function( e ){
			Ext.Util(e).proc(function(response){
				if( response.success ){ 
					console.log('refresh load ok');
				}
			});
		}
		
	}).post();
 })( $ );
 
/* 
 *  -- handle of F5 on keydown Keyboard  -----------------------------------------
 *  --  user cannot refresh on Button F5  ------------------------------------------
 */

 $.document.onkeydown = function( e ){
	if ((e.which || e.keyCode) == 116) e.preventDefault();
 };

})( window ); 

// ======================== END CLASS ======================================================
 
 