<script>
var V_SCRIPT = {};

// ==================> 


// ---------------------------------------------------------------------------------------
/* 
 * @ param : roleback 
 */
 
 Ext.DOM.RoleBack =function() 
{	
 if( Ext.Msg('Are you sure?').Confirm() )
 {	
	var ControllerId = Ext.Cmp('ControllerId').getValue();
		Ext.ShowMenu(new Array(ControllerId, 'index'),
			Ext.System.view_file_name(),
		{
			time : Ext.Date().getDuration()
		});
  }
	
}

// ---------------------------------------------------------------------------------------
/* 
 * @ param : roleback 
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
 
// -----------------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 * -----------------------------------------------------------------------
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
 

// -----------------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 * -----------------------------------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 Ext.DOM.Submit = function() 
{
  var frmApprovalUser = Ext.Serialize('frmApprovalUser');
  var frmInfoCustomer = Ext.Serialize('frmInfoCustomer');
  if(!frmApprovalUser.Required(new Array('req_ts_phone','ApprovalStatus')) ){
	Ext.Msg('Input form not completed').Info();
	return false;
 }	
 
// ---------- next process ------------------------------
	Ext.Ajax
({
	url 	: Ext.EventUrl(new Array('ModApprovePhone','ApproveItem')).Apply(),
	method  : 'POST',
	param   : Ext.Join(new Array(
				frmApprovalUser.getElement(),
				frmInfoCustomer.getElement())
			).object(),
			
	ERROR   : function(e){
		 Ext.Util(e).proc(function(response)
		{
			if( response.success ){
				Ext.Msg("Approve rows data").Success();
				Ext.Cmp("ApprovalStatus").disabled(true);
				Ext.Cmp("btnSubmit").disabled(true);
				Ext.DOM.CallHistory({orderby: '' , type : '', page : ''});
				return false;
			}	
			else{
				Ext.Msg("Approve rows data").Failed();
				return false;
			}
		});
	}
 }).post();
 
}  

// -----------------------------------------------------------------------
/* 
 * @ def : toolbars on navigation 
 * -----------------------------------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
$(document).ready(function()
{
 
  $('#ui-content-tab-data').mytab().tabs();
  $('#ui-content-tab-data').mytab().tabs("option", "selected", 0);
  $('#ui-content-tab-data').css({'background-color':'#FFFFFF'});
  $('#ui-widget-content-detail').css({'background-color':'#FFFFFF'});
  $("#ui-content-tab-data").mytab().close(function() { Ext.DOM.RoleBack(); },true);
 
// --------------------------------------------------------------------------------- 
  $("#ui-content-tabs-history").mytab().tabs(); 
  $('#ui-content-tabs-history').mytab().tabs("option", "selected", 0);
  $("#ui-content-tabs-history").mytab().close({},true);
  
 // ------------------------------------------------------------------------------------------- 
  $('.select').chosen();
   $('.cell-disabled').each(function(){ Ext.Cmp($(this).attr('id')).disabled(true); });
  //$('.date').datepicker({  dateFormat : 'yy-mm-dd',  changeYear : true,  changeMonth : true  });
 
 
  
  Ext.DOM.CallHistory({orderby: '' , type : '', page : ''});
  Ext.DOM.PageCallRecording({orderby: '' , type : '', page : ''});
  

});


</script>