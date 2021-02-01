 
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
 
Ext.DOM.V_STATUS_STORE = (function(){ 	
	var arr_reason = Ext.Ajax 
	({ 
		url 	: Ext.EventUrl(['CallReason','ReasonType']).Apply(), 
		method	:'POST', 
		param 	: {
			time : Ext.Date().getDuration()
		} 
	}).json();
	
	return ( typeof(arr_reason)== 'object' ? arr_reason : {});
	
})();
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
 
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
Ext.ActiveMenu().setup({});	

// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
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

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
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

/* load all function library get layout page **/

var pageLayout;
$(document).ready(function() 
{
  ExtApplet = new Ext.ViewPort(document.ctiapplet);
  ExtApplet.setApplet();
 
$('#ribbon').ribbon();
$('.ribbon-section').click(function(){
	$('.ribbon-section').removeClass('ribbon-button-active');
	$(this).addClass("ribbon-button-active");
});

var createLayout = function(){ 
 $("body").css({
	"margin-top" : "0px",
	"padding-top": ( $("#ribbon").height()),
	"background-color": "#FFFFFF",
	"border-bottom": "0px solid #FFFFFF" 
 });
			 
 $("#ribbon").css({ "margin-top" : "-7px"});
 $(".ribbon-tab").css({"height":"70px"});
	
 $("#main_content").css
 ({ 
    "margin-left" : "-4px", "margin-top" : "0px",
	"margin-right" : "-4px", "padding" : "12px",
	"height": ($(window).height()-155)+"px",
	"overflow" : "auto", "background-color": "#FFFFFF" 
 }); 
 
}

//-------------------------------------------------------------------------------------------

createLayout();
$(window).resize( function(){ 
	createLayout();
})		

 $('#toolbars-foot').extToolbars
 ({
	extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle  : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Title(),
	extMenu   : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Menu(),
	extIcon   : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Icon(),
	extText   : true,
	extInput  : true,
	extOption : Ext.ActiveBars(Ext.Session('UserGroup').getSession()).Option()
  });
 
});