<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
var OUTBOUND = 2;
 
var datas={
	OutboundGoalId : '<?php echo _get_post('OutboundGoalId');?>',
	order_by : '<?php echo _get_post('order_by');?>',
	type : 	'<?php echo _get_post('type');?>',
}

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

var OutboundGoals = ( function(){
	var ERR = ( Ext.Ajax({
		url 	: Ext.DOM.INDEX +'/MgtAssignment/OutboundGoals/',
		method 	: 'GET',
		param 	: {
			duration  : Ext.Date().getDuration()
		}
		
	}).json());
	
	return ERR;
})(); 
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.EQuery.showrecord=false;
Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;

/**
 ** javscript prototype system
 ** version v.0.1
 **/
		
var navigation = {
	custnav	 : Ext.DOM.INDEX +'/MgtAssignment/index/',
	custlist : Ext.DOM.INDEX +'/MgtAssignment/Content/',
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

// function cek avability campaign 

Ext.DOM.CampaignType = function( CampaignId ){
	var INBOUND = ( Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/MgtAssignment/CampaignType',
		method 	: 'POST',
		param 	: {
			CampaignId : CampaignId
		}	
	}).json());
	
	return INBOUND;
}


		
/**
 ** javscript prototype system
 ** version v.0.1
 **/

 Ext.DOM.distributeAmount = function()
 {
	var CampaignNumber = Ext.Cmp('chk_cmp').getValue();
	if( CampaignNumber!='' )
	{
		if( CampaignNumber.length==1 ){
		
			if( (Ext.DOM.CampaignType(CampaignNumber).type == OUTBOUND) ){
				Ext.Ajax
				({ 
					url : Ext.DOM.INDEX +'/MgtAssignment/getAssignContent', 
					method : 'GET', 
					param :{ CampaignId : CampaignNumber } 
				}).load('main_content');
			}	
			else{
				Ext.Msg("Distribute Avalaible for Outbound Only ").Info();
			}
		}
		else {
			Ext.Msg('Please select one rows').Error();
			return false;
		}
	}
	else
	{
		Ext.Msg('Please select a rows').Info();
		return false;
	}	
}

Ext.DOM.getAgentData =function(){
	var CampaignNumber = Ext.Cmp('chk_cmp').getValue();
	if( CampaignNumber!='' )
	{
		if( CampaignNumber.length==1 ){
			if( (Ext.DOM.CampaignType(CampaignNumber).type == OUTBOUND) ){
				Ext.Ajax ({ 
					url : Ext.DOM.INDEX +'/MgtAssignment/ViewAgentData', 
					method : 'GET', 
					param :{ CampaignId : CampaignNumber } 
				}).load('main_content');
			}	
			else{
				Ext.Msg("Get Agent Data Avalaible for Outbound Only ").Info();
			}	
		}
		else {
			Ext.Msg('Please select one rows').Error();
			return false;
		}
	}
	else
	{
		Ext.Msg('Please select a rows').Info();
		return false;
	}
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.ShowByCallType = function(OutboundGoalId){
	Ext.EQuery.construct(navigation,{
		OutboundGoalId : OutboundGoalId
	});
	Ext.EQuery.postContent();
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 	
Ext.query(function(){
	Ext.query('#toolbars').extToolbars
	({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Distribute'],['Get Agent Data'],[]],
		extMenu  :[['distributeAmount'],['getAgentData'],[]],
		extIcon  :[['door_in.png'],['group.png'],[]],
		extText  :true,
		extInput :true,
		extOption:[{
				render	: 2,
				header	: '# Call Type',	
				type 	: 'combo',
				name 	: 'OutboundGoalId',
				id	 	: 'OutboundGoalId',
				triger 	: 'ShowByCallType',
				value	: datas.OutboundGoalId,
				width	: 180,
				store   : [OutboundGoals]
		}]
	});
});
</script>
<!-- start : content -->
<fieldset class="corner">
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
	<div id="toolbars"></div>
	<div class="content_table"></div>
	<div id="pager"></div>
	<div id="span_top_nav"></div>
</fieldset>	