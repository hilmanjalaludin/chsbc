<?php echo javascript(); ?>
<script type="text/javascript">

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
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
	extTitle :[['Add Config'],['Edit Config'],['Delete Config'],['Search']],
	extMenu  :[['AddConfig'],['EditConfig'],['DeleteConfig'],['SearchConfig']],
	extIcon  :[['add.png'],['calendar_edit.png'],['delete.png'],['zoom.png']],
	extText  :true,
	extInput :true,
	extOption: [{
				render	: 3,
				type	: 'text',
				id		: 'KeysConfig', 	
				name	: 'KeysConfig',
				value	: datas.keywords,
				width	: 200
				}]
			});
			
		});
		

		
Ext.EQuery.TotalPage   = '<?php echo (INT)$page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo (INT)$page -> _get_total_record(); ?>';

/* assign navigation filter **/
var navigation = {
	custnav	 : Ext.DOM.INDEX +'/Configuration/index/',
	custlist : Ext.DOM.INDEX +'/Configuration/Content/',
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult


Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.SearchConfig = function(){
	Ext.EQuery.construct(navigation,{
		keywords : Ext.Cmp('KeysConfig').getValue()
	});
	Ext.EQuery.postContent();
}

// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.ClearResult = function() {
	Ext.Cmp('span_top_nav').setText('');
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.AddConfig = function()
{
	if((Ext.Session('HandlingType').getSession() == Ext.DOM.USER_SYSTEM_LEVEL) )
	{
		Ext.Ajax
		({
			url  : Ext.DOM.INDEX +'/Configuration/AddView/',
			method : 'GET',
			param : {
				duration : Ext.Date().getDuration()
			}
		}).load('span_top_nav');
	}
	else{
		Ext.Msg("You Not have aksess for this session").Info();
		return false;
	}	
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.EditConfig = function(){
  var ConfigID = Ext.Cmp('chk_config').getValue();
  
  if((ConfigID.length==1)){
  
	Ext.Ajax({
		url  	: Ext.DOM.INDEX +'/Configuration/EditView/',
		method 	: 'GET', 
		param 	: {
			ConfigID : ConfigID,	
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

Ext.DOM.UpdateConfig = function()
{

	if(Ext.Cmp('ConfigCode').empty() ){ 
		Ext.Msg('Config Code is empty').Info(); }
	else if( Ext.Cmp('ConfigName').empty() ){ 
		Ext.Msg('Config Name is empty').Info();
	}	
	else if(Ext.Cmp('ConfigValue').empty() ){ 
		Ext.Msg('Config Value is empty').Info(); }
	else 
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/Configuration/UpdateConfig/',
			method 	: 'POST',
			param 	: Ext.Join([Ext.Serialize('frmEditConfig').getElement()]).object(),
			ERROR 	: function(fn) {
				Ext.Util(fn).proc(function(save){
					if( save.success){
						Ext.Msg("Update Configuration").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Update Configuration").Failed();
					}
				});
			}
		}).post();
		
	}
}

// Ext.DOM.ClearResult
// Ext.DOM.ClearResult
		
Ext.DOM.DeleteConfig = function()
{	
  if((Ext.Session('HandlingType').getSession() == Ext.DOM.USER_SYSTEM_LEVEL) )
  {
	var ConfigID = Ext.Cmp('chk_config').getValue();
	if( ConfigID!='')
	{
		if( Ext.Msg('Do you want to deleted this rows ').Confirm() )
		{
			Ext.Ajax ({
				url 	: Ext.DOM.INDEX +'/Configuration/Delete/',
				method 	: 'POST',
				param 	: { ConfigID : ConfigID },
				ERROR 	: function(fn)
				{
					try{
						var ERR = JSON.parse(fn.target.responseText);
						if( ERR.success ){
							Ext.Msg("Delete Configuration").Success();
							Ext.EQuery.postContent();
						}
						else{
							Ext.Msg("Delete Configuration ").Failed();
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
 else{ 
	Ext.Msg("You Not have aksess for this session").Info();
	return false;
}

}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult
		
Ext.DOM.SaveConfig=function()
{
	if(Ext.Cmp('ConfigCode').empty() ){ 
		Ext.Msg('Config Code is empty').Info(); }
	else if( Ext.Cmp('ConfigName').empty() ){ 
		Ext.Msg('Config Name is empty').Info();
	}	
	else if(Ext.Cmp('ConfigValue').empty() ){ 
		Ext.Msg('Config Value is empty').Info(); }
	else 
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/Configuration/SaveConfig/',
			method 	: 'POST',
			param 	: Ext.Join([Ext.Serialize('config').getElement()]).object(),
			ERROR 	: function(fn) {
				Ext.Util(fn).proc(function(save){
					if( save.success){
						Ext.Msg("Add Config").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Add Config").Failed();
					}
				});
			}
		}).post();
		
	}	
}
		
	</script>
	
	<!-- start : content -->
	
		<fieldset class="corner">
			<legend class="icon-callresult">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
				<div id="toolbars"></div>
				<div id="span_top_nav"></div>
				<div class="content_table"></div>
				<div id="pager"></div>
				<div id="ViewCmp"></div>
		</fieldset>	
		
	<!-- stop : content -->
	
	
	