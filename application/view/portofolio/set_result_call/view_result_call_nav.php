<?php echo javascript(); ?>
<script type="text/javascript">

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
var datas = {
	order_by : '<?php echo _get_post('order_by');?>',
	type	 : '<?php echo _get_post('type');?>',
	keywords : '<?php echo _get_post('keywords');?>',
	
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
$(function(){
$('#toolbars').extToolbars({
    extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle :[['Enable'],['Disable'] ,['Add'],['Edit'],['Delete'],['Search'],['Clear']],
	extMenu  :[['EnableCallResult'],['DisableCallResult'],['AddCallResult'],['EditResult'],['DeleteResult'],['SearchCallResult'],['Clear']],
	extIcon  :[['accept.png'],['cancel.png'], ['add.png'],['calendar_edit.png'],['delete.png'],['zoom.png'],['zoom_out.png']],
	extText  :true,
	extInput :true,
	extOption: [{
				render	: 5,
				type	: 'text',
				id		: 'KeysCallResult', 	
				name	: 'KeysCallResult',
				value	: datas.keywords,
				width	: 200
				}]
			});
			
		});
		

		
Ext.EQuery.TotalPage   = '<?php echo (INT)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (INT)$page -> _get_total_record(); ?>';

/* assign navigation filter **/
var navigation = {
	custnav	 : Ext.DOM.INDEX +'/SetCallResult/index/',
	custlist : Ext.DOM.INDEX +'/SetCallResult/Content/',
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult


Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.SearchCallResult = function(){
	Ext.EQuery.construct(navigation,{
		keywords : Ext.Cmp('KeysCallResult').getValue()
	});
	Ext.EQuery.postContent();
}

Ext.DOM.Clear = function() {
	Ext.Cmp("KeysCallResult").setValue("");
	new Ext.DOM.SearchCallResult();
}

// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.ClearResult = function() {
	Ext.Cmp('span_top_nav').setText('');
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.AddCallResult = function()
{
	Ext.Ajax
	({
		url  : Ext.DOM.INDEX +'/SetCallResult/AddView/',
		method : 'GET',
		param : {
			duration : Ext.Date().getDuration()
		}
	}).load('span_top_nav');
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.EditResult = function(){
  var CallReasonId = Ext.Cmp('chk_result').getValue();
  
  if((CallReasonId.length==1)){
  
	Ext.Ajax({
		url  	: Ext.DOM.INDEX +'/SetCallResult/EditView/',
		method 	: 'GET', 
		param 	: {
			CallReasonId : CallReasonId,	
			duration : Ext.Date().getDuration()
		}
	}).load('span_top_nav');
	
  }
  else {
	Ext.Msg("Please select rows ").Info();
  }
  
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.DisableCallResult=function()
{
  var CallResultId = Ext.Cmp('chk_result').getValue();
  if( CallResultId!='')
  {
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetCallResult/SetActive/',
		method 	: 'POST',
		param 	: { 
			CallResultId : CallResultId, 
			Active		 : 0,
		},
		ERROR 	: function(fn)
		{
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Disable Call Result").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Disable Call Result ").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
  }
  else{ Ext.Msg("Please select a row!").Info(); }
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.EnableCallResult=function(){

 var CallResultId = Ext.Cmp('chk_result').getValue();
 if( CallResultId!=''){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/SetCallResult/SetActive/',
		method 	: 'POST',
		param 	: { 
			CallResultId : CallResultId, 
			Active		 :1,
		},
		ERROR 	: function(fn)
		{
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Enable Call Result").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Enable Call Result ").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
 }
 else{ Ext.Msg("Please select a row!").Info(); }
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.UpdateCallResult = function()
{
	var CallReasonId			= Ext.Cmp('CallReasonId').getValue(),
		CallReasonCategoryId	= Ext.Cmp('CallReasonCategoryId').getValue(), 
		CallReasonLevel			= Ext.Cmp('CallReasonLevel').getValue(), 
		CallReasonCode			= Ext.Cmp('CallReasonCode').getValue(), 
		CallReasonDesc			= Ext.Cmp('CallReasonDesc').getValue(), 
		CallReasonStatusFlag	= Ext.Cmp('CallReasonStatusFlag').getValue(), 
		CallReasonContactedFlag	= Ext.Cmp('CallReasonContactedFlag').getValue(), 
		CallReasonEvent			= Ext.Cmp('CallReasonEvent').getValue(), 
		CallReasonLater			= Ext.Cmp('CallReasonLater').getValue(), 
		CallReasonOrder			= Ext.Cmp('CallReasonOrder').getValue(), 
		CallReasonNoNeed		= Ext.Cmp('CallReasonNoNeed').getValue();
		
	if(Ext.Cmp('CallReasonCode').empty() ){ 
		Ext.Msg('Call Result ID').Info(); }
	else if( Ext.Cmp('CallReasonDesc').empty() ){ 
		Ext.Msg('Call Result Name').Info();
	}	
	else if(Ext.Cmp('CallReasonCategoryId').empty() ){ 
		Ext.Msg('Call Result Category').Info(); }
	else 
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/SetCallResult/UpdateCallResult/',
			method 	: 'POST',
			param 	: { 
				CallReasonId : CallReasonId,
				CallReasonCategoryId : CallReasonCategoryId,
				CallReasonLevel : CallReasonLevel, 
				CallReasonCode : CallReasonCode, 
				CallReasonDesc : CallReasonDesc, 
				CallReasonStatusFlag : CallReasonStatusFlag, 
				CallReasonContactedFlag	: CallReasonContactedFlag, 
				CallReasonEvent : CallReasonEvent, 
				CallReasonLater : CallReasonLater, 
				CallReasonOrder : CallReasonOrder, 
				CallReasonNoNeed : CallReasonNoNeed
			},
			ERROR 	: function(fn)
			{
				try{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Update Call Result").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Update Call Result ").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
		
	}
}

// Ext.DOM.ClearResult
// Ext.DOM.ClearResult
		
Ext.DOM.DeleteResult = function()
{	
	var CallResultId = Ext.Cmp('chk_result').getValue();
	if( CallResultId!='')
	{
		if( Ext.Msg('Do you want to deleted this rows ').Confirm() )
		{
			Ext.Ajax ({
				url 	: Ext.DOM.INDEX +'/SetCallResult/Delete/',
				method 	: 'POST',
				param 	: { CallResultId : CallResultId },
				ERROR 	: function(fn)
				{
					try{
						var ERR = JSON.parse(fn.target.responseText);
						if( ERR.success ){
							Ext.Msg("Delete Call Result").Success();
							Ext.EQuery.postContent();
						}
						else{
							Ext.Msg("Delete Call Result ").Failed();
						}
					}
					catch(e){
						Ext.Msg(e).Error();
					}
				}
			}).post();
		}	
 }
 else{ Ext.Msg("Please select a row!").Info(); }
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult
		
Ext.DOM.SaveResult=function()
{
	var CallReasonCategoryId	= Ext.Cmp('CallReasonCategoryId').getValue(), 
		CallReasonLevel			= Ext.Cmp('CallReasonLevel').getValue(), 
		CallReasonCode			= Ext.Cmp('CallReasonCode').getValue(), 
		CallReasonDesc			= Ext.Cmp('CallReasonDesc').getValue(), 
		CallReasonStatusFlag	= Ext.Cmp('CallReasonStatusFlag').getValue(), 
		CallReasonContactedFlag	= Ext.Cmp('CallReasonContactedFlag').getValue(), 
		CallReasonEvent			= Ext.Cmp('CallReasonEvent').getValue(), 
		CallReasonLater			= Ext.Cmp('CallReasonLater').getValue(), 
		CallReasonOrder			= Ext.Cmp('CallReasonOrder').getValue(), 
		CallReasonNoNeed		= Ext.Cmp('CallReasonNoNeed').getValue();
		
	if(Ext.Cmp('CallReasonCode').empty() ){ 
		Ext.Msg('Call Result ID').Info(); }
	else if( Ext.Cmp('CallReasonDesc').empty() ){ 
		Ext.Msg('Call Result Name').Info();
	}	
	else if(Ext.Cmp('CallReasonCategoryId').empty() ){ 
		Ext.Msg('Call Result Category').Info(); }
	else 
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/SetCallResult/SaveCallResult/',
			method 	: 'POST',
			param 	: { 
				CallReasonCategoryId : CallReasonCategoryId,
				CallReasonLevel : CallReasonLevel, 
				CallReasonCode : CallReasonCode, 
				CallReasonDesc : CallReasonDesc, 
				CallReasonStatusFlag : CallReasonStatusFlag, 
				CallReasonContactedFlag	: CallReasonContactedFlag, 
				CallReasonEvent : CallReasonEvent, 
				CallReasonLater : CallReasonLater, 
				CallReasonOrder : CallReasonOrder, 
				CallReasonNoNeed : CallReasonNoNeed
			},
			ERROR 	: function(fn)
			{
				try{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Save Call Result").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Save Call Result ").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
		
	}	
}
		
	</script>
	
	<!-- start : content -->
	
		<fieldset class="corner">
			<?php echo form()->legend(lang(""), "fa-gear"); ?>
				<div id="toolbars"></div>
				<div id="span_top_nav"></div>
				<div class="content_table"></div>
				<div id="pager"></div>
				<div id="ViewCmp"></div>
		</fieldset>	
		
	<!-- stop : content -->
	
	
	