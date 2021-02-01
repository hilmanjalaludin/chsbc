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
 
var status_campaign = '<?php echo $this -> URI -> _get_post("status_campaign"); ?>';

 

/**
 ** javscript prototype system
 ** version v.0.1
 **/		
 
var datas=
{ 
	status_campaign	: status_campaign,
	order_by  : '<?php echo $this -> URI -> _get_post('order_by');?>',
	type : '<?php echo $this -> URI -> _get_post('type');?>'
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 $(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['ManageLink']],
		extMenu  :[['Manage']],
		extIcon  :[['table_gear.png']],
		extText  :true
	});	
});


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
 
var navigation = {
	custnav	 : Ext.DOM.INDEX+'/SetCmpAssignCmp/index/',
	custlist : Ext.DOM.INDEX+'/SetCmpAssignCmp/Content/',
}
		
/* 
 * assign show list content 
 * @ EQuery jequery modul
 */

Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

/* 
 * @ assign show list content 
 * @ extends jequery modul
 */

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.getMethod = function(combo){
	if(combo.value==1)
	{
		Ext.Cmp('DirectAction').disabled(false);
		Ext.Cmp('AvailCampaignId').disabled(false);
	}
	else{
		Ext.Cmp('DirectAction').setValue('');
		Ext.Cmp('AvailCampaignId').setValue('');
		Ext.Cmp('DirectAction').disabled(true);
		Ext.Cmp('AvailCampaignId').disabled(true);
	}
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.getDirect = function(combo)
{
	if(combo.value==1){
		Ext.Cmp('DirectMethod').disabled(false);
		Ext.Cmp('DirectAction').disabled(false);
		Ext.Cmp('AvailCampaignId').disabled(false);
	}
	else{
		Ext.Cmp('DirectMethod').setValue('');
		Ext.Cmp('DirectAction').setValue('');
		Ext.Cmp('AvailCampaignId').setValue('');
		Ext.Cmp('DirectMethod').disabled(true);
		Ext.Cmp('DirectAction').disabled(true);
		Ext.Cmp('AvailCampaignId').disabled(true);
	}	
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.Manage = function(){
	Ext.Ajax
	({
		url		: Ext.DOM.INDEX+'/SetCmpAssignCmp/Manage/',
		method  : 'GET',
		param	: { }
		
	}).load("span_top_nav");
}
		
	
/* 
 * @ assign show list content 
 * @ extends jequery modul
 */
		
Ext.DOM.cbMoveOn = function()
{
	Ext.options ({ 
		fo : Ext.Cmp('ProductId').getElementId(),
		to : Ext.Cmp('ListProduct').getElementId() 
	}).move();
}


Ext.DOM.ShowRowData = function()
{
 var CampaignId = Ext.Cmp('check_list_cmp').getValue();
 if( CampaignId!='' )
	{
		Ext.Window
		({
			url : Ext.DOM.INDEX +'/SetCmpAssignCmp/View/',
			param :{
				CampaignId : CampaignId
			}	
		}).newtab();
	}
	else{
		Ext.Msg('Please Select Campaign').Info();
	}	
}

// cbRemoveOn
	
Ext.DOM.cbRemoveOn = function()
{
	Ext.options
	({
		fo : Ext.Cmp('ListProduct').getElementId(),
		to : Ext.Cmp('ProductId').getElementId() 
	}).move();
}

//cbEvent 
		
Ext.DOM.cbEvent = function(opt)
{
	if( opt!='' && opt==1){
		doJava.dom('cmp_upload_reason').disabled=false;
	}
	else{
		doJava.dom('cmp_upload_reason').disabled=true;
	}
}
// viewCampaign
		
Ext.DOM.viewCampaign = function(){
	var status_campaign = Ext.Cmp('combo_filter_campaign').getValue();
	if( status_campaign )
	{
		datas = { status_campaign: status_campaign }
		Ext.EQuery.construct(navigation,datas)
		Ext.EQuery.postContent();
	}	
}
		
//cancel
		
Ext.DOM.cancel = function(){
	Ext.Cmp('span_top_nav').setText('');
}

// EditData
		
Ext.DOM.EditData = function()
{
  var CampaignId = Ext.Cmp('check_list_cmp').getChecked();
  if( CampaignId.length==1) {
	if( CampaignId.length==1) {
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/SetCmpAssignCmp/EditTpl/',
			method  : 'GET',
			param   : {
				CampaignId : CampaignId
			}
		}).load('span_top_nav');
	}
	else
		alert('Please Select One Rows !');
  }
  else 
		alert('Please Select Rows !')
}	
	
	
 // SetUpdate 
 
Ext.DOM.SetUpdate = function(){
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetCmpAssignCmp/Update/',
		method 	: 'POST',
		param 	: {
			CampaignId 		: Ext.Cmp("CampaignId").getValue(),
			CampaignName 	: Ext.Cmp("CampaignName").getValue(),
			ExpiredDate 	: Ext.Cmp("ExpiredDate").getValue(),
			CategoryId 		: Ext.Cmp("CategoryId").getValue(),
			StatusActive 	: Ext.Cmp("StatusActive").getValue(),
			OutboundGoalsId : Ext.Cmp("OutboundGoalsId").getValue(),
			DirectMethod	: Ext.Cmp("DirectMethod").getValue(),
			DirectAction	: Ext.Cmp("DirectAction").getValue(), 
			AvailCampaignId : Ext.Cmp("AvailCampaignId").getValue()
			
		},
		ERROR : function(fn){
			try
			{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Update Campaign").Success();
					Ext.EQuery.postContent();
				}	
				else{
					Ext.Msg("Update Campaign").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
		
	}).post();
 }
	
/* save on campaign to upload **/

Ext.DOM.SaveAsg = function()
{	
	alert(Ext.Cmp('PhoneNo').getValue());
	return false;
	var param=[];
		param['SelectProductId'] = Ext.Cmp('ListProduct').getValue();
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+'/SetCmpAssignCmp/SaveCampaign',
		method 	: 'POST',
		param 	: Ext.Join([param,Ext.Serialize('frm_add_campaign').getElement()]).object(),
		ERROR : function(e){
			var ERR = JSON.parse( e.target.responseText);
			if( ERR.success ) {
				alert("Suceeded, Adding Campaign"); 
				Ext.EQuery.postContent();
			}
			else {
				alert("Failed, Adding Campaign");
				return false;
			}
		}
			
	}).post()
}
</script>
	
	<!-- start : content -->
	
		<fieldset class="corner">
			<legend class="icon-campaign">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
				<div id="toolbars"></div>
				<div id="span_top_nav" ></div>
					<div class="box-shadow" style="background-color:#FFFFFF;margin-top:10px;">	
						<div class="content_table"></div>
						<div id="pager"></div>
						<div id="ViewCmp"></div>
					</div>	
		</fieldset>	
		
	<!-- stop : content -->