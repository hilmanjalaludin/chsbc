<?php 
/*
 * E.U.I 
 *
 * subject	: view_core_nav ( files )
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
echo javascript();
?>

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
 
var datas={
	cbFilter : '<?php echo $this ->URI->_get_post('cbFilter');?>'
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

/**
 ** javscript prototype system
 ** version v.0.1
 **/
Ext.DOM.navigation = {
	custnav	: Ext.DOM.INDEX+'/SetCores/index',
	custlist: Ext.DOM.INDEX+'/SetCores/Content'
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
		
Ext.EQuery.construct(Ext.DOM.navigation,datas)
Ext.EQuery.postContentList();
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.viewCampaign = function(){
	datas = { cbFilter : Ext.Cmp('v_cmp').getValue() }
	Ext.EQuery.construct(navigation,datas)
	Ext.EQuery.postContent();
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
Ext.DOM.SaveNewGroupMenu = function()
{

var text_cmp_id = Ext.Cmp('text_cmp_id').getValue(),
	text_cmp_name = Ext.Cmp('text_cmp_name').getValue(),
	select_cmp_status = Ext.Cmp('select_cmp_status').getValue();
	
	if( Ext.Cmp('text_cmp_id').empty()) { 
		Ext.Cmp('text_cmp_id').setFocus(); 
		return false; 
	}
	else if( Ext.Cmp('text_cmp_name').empty()){ 
		Ext.Cmp('text_cmp_name').setFocus(); 
		return false; 
	}	
	else if( Ext.Cmp('select_cmp_status').empty()){ 
		Ext.Cmp('select_cmp_status').setFocus(); 
		return false; 
	}
	else
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SetCores/SaveAdd',
			method 	: 'POST',
			param 	: {
				text_cmp_id	: Ext.Cmp('text_cmp_id').getValue(),
				text_cmp_name : Ext.Cmp('text_cmp_name').getValue(),
				select_cmp_status : Ext.Cmp('select_cmp_status').getValue()
			},
			ERROR : function(e){
				var ERR = JSON.parse( e.target.responseText);
				if( ERR.success ){
					alert('Success, Add Campaign Core');
					Ext.EQuery.postContent();	
				}
				else{
					alert('Failed, Add Campaign Core');
				}
			}
		}).post();
	}
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.addCampaign = function()
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+'/SetCores/AddTpl',
		method 	: 'GET',
		param 	: {
			time : Ext.Date().getDuration()	
		}
	}).load('panel-content');
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.RenderValueCampaign=function(InputText)
{
	Ext.Cmp('text_cmp_name').setValue(InputText.value.toUpperCase());
	InputText.value = InputText.value.toUpperCase();
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 Ext.DOM.UpdateCores = function()
 {
	if( Ext.Cmp('ECampaignGroupCode').empty() )
	{  
		Ext.Cmp('ECampaignGroupCode').setFocus(); }	
	else if( Ext.Cmp('ECampaignGroupName').empty())
	{ 
		Ext.Cmp('ECampaignGroupName').setFocus();  
		return false; }
	else if( Ext.Cmp('ECampaignGroupStatusFlag').empty())
	{
		Ext.Cmp('ECampaignGroupStatusFlag').setFocus(); 
		return false; }
	else {
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/SetCores/Update',
			method 	: 'POST',
			param 	: {
				CampaignGroupId : Ext.Cmp('ECampaignGroupId').getValue(),
				CampaignGroupCode : Ext.Cmp('ECampaignGroupCode').getValue(),
				CampaignGroupName : Ext.Cmp('ECampaignGroupName').getValue(),
				CampaignGroupStatusFlag : Ext.Cmp('ECampaignGroupStatusFlag').getValue()
			},
			ERROR : function(e){
				var ERR = JSON.parse(e.target.responseText);
				if( ERR.success ){
					alert("Success, Update Campaign Cores !")
					Ext.EQuery.postContent();	
				}
				else{
					alert("Failed, Update Campaign Cores !")
				}
			}
		}).post();	
	}
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.EditCampaignCore = function()
{	
 var CampaignCoreId = Ext.Cmp('cmp_check_list').getChecked(); 
	if( Ext.Cmp('cmp_check_list').empty()!=true){
		if( CampaignCoreId.length==1 )
		{
			Ext.Ajax({ 
				url		: Ext.DOM.INDEX+'/SetCores/EditTpl',
				method  : 'GET',
				param 	: {
					CoreId : CampaignCoreId,
					time : Ext.Date().getDuration()
				}
			}).load("panel-content");
		}
	}	
}


	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
	
Ext.DOM.Delete = function()
{
 var CoreList = Ext.Cmp('cmp_check_list').getChecked();
 if( CoreList!='' )
 {
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+'/SetCores/Delete',
		method 	: 'POST',
		param 	: {
			text_cmp_id	: CoreList,
		},
		ERROR : function(e){
			var ERR = JSON.parse( e.target.responseText);
			if( ERR.success )
			{
				alert('Success, Delete Campaign Core');
				Ext.EQuery.postContent();	
			}
			else{
				alert('Failed, Add Campaign Core');
			}
		}
	}).post();
 }
}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
$(function()
{
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Add Campaign Core'],['Edit Campaign Core'],[],['Search']],
		extMenu  :[['addCampaign'],['EditCampaignCore'], [],['viewCampaign']],
		extIcon  :[['add.png'],['table_edit.png'],[],['zoom.png']],
		extText  :true,
		extInput :true,
		extOption:[{
					render	: 2,
					type	: 'text',
					id		: 'v_cmp', 	
					name	: 'v_cmp',
					value	: Ext.DOM.datas.cbFilter,
					width	: 200
				}]
	});
});
</script>
<fieldset class="corner" >
 <legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span> </legend>		
 <div id="toolbars"></div>
  <div id="panel-content"></div>
	<div class="content_table"></div>
	<div id="pager"></div>
	<div id="dialogCmp"></div>
</fieldset>	
<?php
// END OF FILE 
?>