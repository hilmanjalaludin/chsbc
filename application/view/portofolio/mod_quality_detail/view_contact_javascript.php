<?php
echo javascript(array( 
	array('_file' => base_ext_helper() .'/EUI.Media.js', 'eui_'=> version(), 'time'=>time())
));
?>
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

Ext.DOM.PlayRecord = function(id) 
{
	var WinUrl  = new Ext.EventUrl([ "QtyApprovalInterest",  "VoicePlay"]), WinHeight = 100, 
		RecordId = id;
		
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

Ext.DOM.UnsetFollowup = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['QaApprovalList','UnsetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
} 

Ext.DOM.CancelActivity =function()
{
	var ControllerId = Ext.Cmp('ControllerId').getValue();
	Ext.ActiveMenu().Active();
	Ext.DOM.UnsetFollowup( Ext.Cmp('CustomerId').getValue() );
	Ext.ShowMenu(new Array(ControllerId), 
		Ext.System.view_file_name(), {
		time : Ext.Date().getDuration()	
	});
}
 // Ext.DOM.QualityCallHistory CallHistory
Ext.DOM.QualityCallHistory = function( obj )
{
   var CustomerId = Ext.Cmp('CustomerId').getValue();
   Ext.Ajax 
   ({
		url    : Ext.EventUrl(['ModCallHistory','PageCallQualityHistory']).Apply(),
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
			Mode : 'VIEW'
		}
	}).load("tabs-2");
}

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
	}).load('tabs-6');
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
			Mode : 'VIEW'
		}
	}).load("tabs-3");
}

Ext.DOM.saveActivity = function()
{
	var ActivityCall = [],
		ActivityForm = Ext.Serialize('frmActivityCall').Complete([]);
	
	ActivityCall['CustomerId']= Ext.Cmp('CustomerId').getValue();
	
	if( !ActivityForm ){ 
		Ext.Msg('Input form not complete').Info(); }
	else 
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/QaApprovalList/SaveActivity/',
			method 	: 'POST',
			param 	: Ext.Join(new Array( 
				Ext.Serialize('frmActivityCall').getElement(),
				Ext.Serialize('frmInfoCustomer').getElement(),
				ActivityCall 
			)).object(),
			ERROR  	: function(fn){
				Ext.Util(fn).proc(function(save){
					if( save.success ) {
						Ext.Msg("Save Activity").Success();
						Ext.DOM.CancelActivity();
					}
					else{
						Ext.Msg("Save Activity").Failed();
					}
				});
			}
		}).post();
	}
}

Ext.DOM.SaveParam = function(obj)
{
	var ActivityCall = [];
		
		ActivityCall['CustomerId']= Ext.Cmp('CustomerId').getValue();
		ActivityCall['CampaignId']= Ext.Cmp('CampaignId').getValue();
		ActivityCall['ParamCodes']= obj.id;
		ActivityCall['ParamValue']= (obj.checked?1:0);
	
	Ext.Ajax({
		url 	: Ext.DOM.INDEX +'/QaApprovalList/SaveParam/',
		method 	: 'POST',
		param 	: Ext.Join(new Array( 
			ActivityCall 
		)).object(),
		ERROR  	: function(fn){
			Ext.Util(fn).proc(function(save){
				if( save.success ) {
					Ext.DOM.HandleCheckParam();
				}
			});
		}
	}).post();
}

Ext.DOM.HandleCheckParam = function()
{
	var frm = Ext.Serialize('frmApprovalParam').getElement();
	var ctr = 0;
	var trx = 0;
	
	for(var i in frm){
		if(frm[i]=='1'){ctr++;}
		trx++;
	}
	
	if( ctr >= trx ){
		Ext.Cmp('ApproveStatus').setValue(1); // IF VERIFIED
	}
	else{
		Ext.Cmp('ApproveStatus').setValue(2); // IF NOT VERIFIED
	}
}

$(document).ready( function()
{	
	$('.select-chosen').chosen();
    $("#tabs").mytab().tabs({
		selected : 0,
		// disabled : [2,3,4]
		// disabled : [3,4]
	});
	$("#tabs").mytab().close({}, true);
  
 // --------------------------- test toolbars ------------------------------------------------
	$('#toolbars').extToolbars 
	({
		extUrl     : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle   : [['Back']],
		extMenu    : [['CancelActivity']],
		extIcon    : [['door_out.png']],
		extText    : true,
		extInput   : true,
		extOption  : []
	});
	
	$('.date').datepicker({dateFormat:'dd-mm-yy', changeMonth: true, changeYear: true });	
	
	// --- disabled image drag ----
	$('img').mousedown(function(e) {  
		e.stopPropagation(); e.preventDefault(); 
		return false; 
	});
  
	$('.ui-disabled').each(function(){
		Ext.Cmp( $(this).attr("id")).disabled(true); 
	});
	
	// Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.QualityCallHistory({page : 0, orderby : "", type : ""});
	Ext.DOM.PageCallRecording({page : 0, orderby : "", type : ""});
	Ext.DOM.LoadVerification();
	Ext.DOM.LoadProductInfo();
	Ext.DOM.HandleCheckParam();
});
</script>