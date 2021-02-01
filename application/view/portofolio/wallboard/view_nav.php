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
	custnav	: Ext.DOM.INDEX+'/Wallboard/index',
	custlist: Ext.DOM.INDEX+'/Wallboard/Content'
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

var daily_target = Ext.Cmp('daily_today').getValue(),
	mtd_h1 = Ext.Cmp('mtd_h1').getValue(),
	month_target = Ext.Cmp('month_target').getValue();
	product = Ext.Cmp('product').getValue();

	
	
	
	if( Ext.Cmp('daily_today').empty()) { 
		Ext.Cmp('daily_today').setFocus(); 
		return false; 
	}
	else if( Ext.Cmp('mtd_h1').empty()){ 
		Ext.Cmp('mtd_h1').setFocus(); 
		return false; 
	}	
	else if( Ext.Cmp('month_target').empty()){ 
		Ext.Cmp('month_target').setFocus(); 
		return false; 
	}	
	else if( Ext.Cmp('product').empty()){ 
		Ext.Cmp('product').setFocus(); 
		return false; 
	}
	else
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/Wallboard/SaveAdd',
			method 	: 'POST',
			param 	: {
				daily_today: daily_target,
				mtd_h1 :mtd_h1,
				month_target : month_target,
				product :product
			},
			ERROR : function(e){
				var ERR = JSON.parse( e.target.responseText);
				console.log('ERR',ERR.success)
				if( ERR.success==1 ){
					alert('Success, Add WallBoard');
					Ext.EQuery.postContent();	
				}
				else{
					alert('Failed, Add WallBoard');
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
		url 	: Ext.DOM.INDEX+'/Wallboard/AddTpl',
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
	var daily_target = Ext.Cmp('daily_today').getValue(),
	mtd_h1 = Ext.Cmp('mtd_h1').getValue(),
	month_target = Ext.Cmp('month_target').getValue();
	product = Ext.Cmp('product').getValue();
	id=Ext.Cmp('id').getValue();

	
	
	
	if( Ext.Cmp('daily_today').empty()) { 
		Ext.Cmp('daily_today').setFocus(); 
		return false; 
	}
	else if( Ext.Cmp('mtd_h1').empty()){ 
		Ext.Cmp('mtd_h1').setFocus(); 
		return false; 
	}	
	else if( Ext.Cmp('month_target').empty()){ 
		Ext.Cmp('month_target').setFocus(); 
		return false; 
	}	
	else if( Ext.Cmp('product').empty()){ 
		Ext.Cmp('product').setFocus(); 
		return false; 
	}
	else {
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/Wallboard/Update',
			method 	: 'POST',
			param 	: {
				daily_today: daily_target,
				mtd_h1 :mtd_h1,
				month_target : month_target,
				product :product,
				id:id
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
 var id = Ext.Cmp('cmp_check_list').getChecked(); 
 console.log(id);
	if( Ext.Cmp('cmp_check_list').empty()!=true){
		if( id.length==1 )
		{
			Ext.Ajax({ 
				url		: Ext.DOM.INDEX+'/Wallboard/EditTpl',
				method  : 'post',
				param 	: {
					id : id,
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
		url 	: Ext.DOM.INDEX+'/Wallboard/Delete',
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
		extTitle :[['Add'],['Edit'],[],['Search']],
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