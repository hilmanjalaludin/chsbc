 Ext.DOM.ExtApplet 				 	= null;
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 Ext.Session().getStore();

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
Ext.DOM.INDEX = Ext.System.view_page_index();

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.URL = Ext.System.view_app_url(); 

 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.LIBRARY = Ext.System.view_library_url();
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.SYSTEM = Ext.System.view_sytem_url();


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 Ext.DOM.V_STATUS_STORE = (  function(){ 	
	var arr_reason = Ext.Ajax ({ 
		url 	: Ext.EventUrl(['CallReason','ReasonType']).Apply(), 
		method	:'POST', 
		param 	: {
			time : Ext.Date().getDuration()
		} 
	}).json();
	return ( typeof(arr_reason)== 'object' ? arr_reason : {});
	
})();


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 CTI.init( Ext.Session('HandlingType').getSession(), Ext.Session('HandlingType').getSession() )

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload = function(){
	CTI.prepareCTIClient();
	CTI.disableAllButton();
 };

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onUnload =  function(){
	 CTI.prepareDisconnect(); //document.ctiapplet.ctiDisconnect();
 };
 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.ActiveMenu().setup([
	{id:'SrcCustomerList', name:'SrcCustomerList',title: 'Customer Followup'},
	{id:'MgtCustomerInbound', name:'MgtCustomerInbound',title: 'Call Inbound'},
	{id:'ModDashboard',name:'ModDashboard',title: 'Agent Dashboard'}
]);


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
$(function(){ 

ExtApplet = new Ext.ViewPort(document.ctiapplet);
ExtApplet.setApplet();
Ext.Timer('time_counter').Active(1000);

// handle active menu 
 $("#nav-menu li a.menu-li").click(function (e) {
	e.preventDefault();
	$('#nav-menu li a.menu-li').addClass("hover-active").not(this).removeClass("hover-active");	
});
 $(" ul.submenu li.child").click(function (e) {
	e.preventDefault();
	$(' ul.submenu li.child').addClass("hover-activew").not(this).removeClass('hover-activew');	
});	


// create layout 
var createLayout = function() {					   
	var 
		h  = $(window).height(),
		m  = $(window).height(),
		lw = $('#accordion').width(),
		w  = $(window).width(),
		ch = $(window).height();
		h  = h-90;
		m  = m-90;	
		
		$('body').css({overflow : 'hidden'});	
		
		aw = w-(lw+10);
		ch = ch-(h-70);
		
		$('.content').css({'background' : "url("+Ext.DOM.LIBRARY+"/gambar/next.gif) no-repeat 0 0"});
		$('#main_content').css
		({
			'height' : ($(window).height()-130),
			"overflow-y":'auto',
			"background" : "url("+ Ext.DOM.LIBRARY+"/gambar/hilight.png) repeat-x 0 bottom", 
			"overflow-x" : "hidden", 
			"border" : "0px solid #000",
			"margin-top" : "-10px",
			"margin-bottom" : "-2px",
			"padding-top" : "5px",
			'padding-left' : '5px',
			'padding-right': '5px',
			'width':aw
		});
		
		//$('.chat').css({height:ch});
	}
		
createLayout();   				   
$(window).resize(function(){ createLayout(); });
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
$('#toolbars-foot').extToolbars
  ({
	 extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
	 extTitle  : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Title(),
	 extMenu   : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Menu(),
	 extIcon   : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Icon(),
	 extText   : true,
	 extInput  : true,
	 extOption : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Option()
 });
});