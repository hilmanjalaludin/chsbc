 
 Ext.DOM.ExtApplet 				 	= null;
 // ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 Ext.Session().getStore();
 
 // ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 Ext.DOM.INDEX = Ext.System.view_page_index();
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
Ext.DOM.URL = Ext.System.view_app_url(); 
 
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
Ext.DOM.LIBRARY = Ext.System.view_library_url();

// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
Ext.DOM.SYSTEM = Ext.System.view_sytem_url();

// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
Ext.DOM.V_STATUS_STORE = {};
Ext.DOM.V_PRODUCT_SCRIPT = {};
Ext.DOM.V_USER_CHAT_GROUP = {};
 
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
function ValueStatusStore(){
	var arr_reason = Ext.Ajax({ url : Ext.EventUrl(['CallReason','ReasonType']).Apply(), method	:'POST', param 	: { time : Ext.Date().getDuration()}}).json();	
	return ( typeof(arr_reason)== 'object' ? arr_reason : {});
} 

// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
function ValueScriptStore(){ 	
	var ObjectXls = new Ext.Ajax({ url : Ext.EventUrl( new Array('SetProductScript','getScript')).Apply(), param : { }});
	return ( typeof( ObjectXls.json() ) == 'object' ?  ObjectXls.json() : {});
	
};


function ValueChatStore(){ 	
	var arr = {};
	return arr;
};


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
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 CTI.init( Ext.Session('HandlingType').getSession(), Ext.Session('HandlingType').getSession() )
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 Ext.DOM.onload = function(){
	CTI.prepareCTIClient();
	CTI.disableAllButton();
 };
 
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 Ext.DOM.onUnload =  function(){
	
	 CTI.prepareDisconnect(); //document.ctiapplet.ctiDisconnect();
 };
 
/* 
 * render of cti documemts
 * author < omens >
 */
 
Ext.ActiveMenu().setup({});	

/* 
 * load all function library get layout page 
 */

 Ext.DOM.SMSNotification = function() {
  if( !Ext.Cmp("notification_bar_counter").IsNull() )
 {	
	$("#notification_bar_counter").notifyomen().init();
	window.setInterval(function(){
		$("#notification_bar_counter").notifyomen().callback( Ext.Ajax ({
			url 	: Ext.EventUrl(["SMSInbox", "Counter"]).Apply(),
			method 	: 'GET',
			param  	: {
				read : 0 
			}
		}).json() );
	},Ext.DOM.CONFIG.TIMER_LOOK_SMS);		
 }	
}



// ---------------------------------------------------------------------------

/* Modul 			launce timer call reminder data User All Agent  
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 Ext.DOM.NotifyInformation = function() 
{
 if( !Ext.Cmp("notification_bar_warning").IsNull() ) {	
	$("#notification_bar_warning").notifyomen().init();
	  window.setInterval(function() {
		$("#notification_bar_warning").notifyomen().callback( Ext.Ajax ({
			url 	: Ext.EventUrl(["QtyApprovalInterest", "Interested"]).Apply(),
			method 	: 'GET',
			param  	: {
					read : 0 
				}
			}).json() );
	 },5000);		
   }	
}


/* 
 * load all function library get layout page 
 */

 Ext.DOM.SMSBalance = function() 
{
  if( !Ext.Cmp("sms-content-balance").IsNull() )
 {	
	var ServerMessage = new Array("Rp. ", 0);
	
	window.setInterval(function() 
	{
		var SMSServer = ( Ext.Ajax
		({ 
			url 	: Ext.EventUrl(["SMSServer", "Balance"]).Apply(),
			method 	: 'GET',
			param  	: {
				time : Ext.Date().getDuration() 
			}	
		}).json() ) ;
		
		if( SMSServer.balance != 0 ){
			ServerMessage = new Array("Rp. ", SMSServer.balance);
			Ext.Cmp("sms-content-balance").setText(ServerMessage.join(' '));
		}
	},Ext.DOM.CONFIG.TIMER_LOOK_BALANCE);	
	Ext.Cmp("sms-content-balance").setText(ServerMessage.join(' '));
 }	
}


var pageLayout;

//--------------------------------------------------

var createLayout = function() 
{ 
 $("#main_content").css 
 ({ 
	"height": ($(window).innerHeight() - ($('.nav').innerHeight() + $('.ui-bottom-widget-navigation-bars').height()+ 16 )),
	"width" : '99%',
	"border" :"0px solid #000000", 
	"margin-left" : "3px",
	"margin-right" : "-5px",
	"margin-top" : "-29px",
	"float"		: "left",
	"display" : "table-cell",
	"overflow" : "auto",
	"padding" : "12px 5px 5px 5px"
 }); 
}

//--------------------------------------------------

$(document).ready(function() 
{
 
 ExtApplet = new Ext.ViewPort(document.ctiapplet);
 ExtApplet.setApplet();
 
 // -- loader of storage data  ---- 
 
 if( Object.keys( Ext.DOM.V_STATUS_STORE ).length == 0  ){
	Ext.DOM.V_STATUS_STORE = ValueStatusStore();
 }
 
 if( Object.keys( Ext.DOM.V_PRODUCT_SCRIPT ).length == 0  ){
	 Ext.DOM.V_PRODUCT_SCRIPT = ValueScriptStore();
 }
 
 
 if( Object.keys( Ext.DOM.V_USER_CHAT_GROUP ).length == 0  ){
	 Ext.DOM.V_USER_CHAT_GROUP = ValueChatStore();
 }
 
 // --- layout on here 
 createLayout();
 $('#toolbars-foot').extToolbars({
		 extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		 extTitle  : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Title(),
		 extMenu   : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Menu(),
		 extIcon   : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Icon(),
		 extText   : true,
		 extInput  : true,
		 extOption : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Option()
	 });
	
	// ----------------------------------------------------------------	 
	// -------- on selector select by filter aggreagat	 -------------
	// ---------------------------------------------------------------
	Ext.DOM.SMSNotification();
	Ext.DOM.SMSBalance();
	Ext.DOM.NotifyInformation();
});

$(window).resize( function(){ 
	createLayout();
})		
