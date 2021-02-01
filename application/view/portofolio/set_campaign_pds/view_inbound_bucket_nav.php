<?php  __(javascript()); ?>
<script type="text/javascript"> 

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
var VAR_POST_REASON = ( function(object){
	var data = {} 
	if( typeof(object)=='object' )for( var i in object ){
		data[i] = object[i];
	}
	return data;
	
})(<?php __(json_encode($CallReasonId));?>)


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
var Title = "Manage Data Of <b> <?php __($Campaign['CampaignName']); ?> </b> "; 
 
Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText(Title); 
})();

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.EQuery.TotalPage   = '<?php __((INT)$page); ?>';
Ext.EQuery.TotalRecord = '<?php __((INT)$record); ?>';

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
var totals_pages 	= Ext.EQuery.TotalPage;
var totals_records 	= Ext.EQuery.TotalRecord;


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	
var datas = { 
	CampaignId 	 : '<?php echo _get_post('CampaignId');?>',
	Compare		 : '<?php echo _get_post('Compare');?>',
	keywords 	 : '<?php echo _get_post('keywords');?>',
	order_by 	 : '<?php echo _get_post('order_by');?>',
	type	 	 : '<?php echo _get_post('type');?>',
	start_date 	 : '<?php echo _get_post('start_date');?>',
	end_date 	 : '<?php echo _get_post('end_date');?>',
	assign_data  : '<?php echo _get_post('assign_data');?>',
	CallReasonId : '<?php echo _get_post('CallReasonId');?>',
	
	
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	
var getListCampaign = ( function() {
  return ( 
	Ext.Ajax({
			url : Ext.DOM.INDEX +'/MgtBucket/getCampaignName/',
			method :'GET',
			param :{
				action:'get_campaign'
			}
		}).json()
	)
})(); 

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.getListATM = ( function() {
  return ( 
	Ext.Ajax({
			url : Ext.DOM.INDEX +'/MgtBucket/getATMName/',
			method :'GET',
			param :{
				action:'getATMName'
			}
		}).json()
	)
})(); 

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	
$(function(){
	$('#toolbars').extToolbars
	({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Back'],[], ['Find'],['By CheckList'],['By Amount'],[]],
		extMenu  :[['backtohome'],[],['FindBucket'],['Ext.DOM.Process'],['Ext.DOM.ProcessAmount'],[]],
		extIcon  :[['house.png'],[], ['find.png'],['drive_disk.png'],['drive_disk.png'],[]],		
		extText  :true,
		extInput :true,
		extOption:[{
			type   : 'label',
			id	   : 'processID',
			name   : 'processID',
			label  : '<span style="color:#DDDDDD;">-</span>',
			render : 5	
		},{
			type   : 'text',
			label : 'Keyword : ',
			id	   : 'keywords',
			name   : 'keywords',
			value  : datas.keywords, 
			render : 2	
		},{
			type   : 'combo',
			render : 1,
			store  :[VAR_POST_REASON],
			value  : '',
			id	   : 'CallReasonId',
			name   : 'CallReasonId',
			value  : datas.CallReasonId		
			
		}]
	});
			
	//$('#start_date,#end_date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy'});	
});


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	 
Ext.DOM.ProcessAmount = function() {
 Ext.Ajax 
 ({
	url 	: Ext.DOM.INDEX+'/ManageInboundOutbound/SaveByAmount/',
	method 	: 'POST',
	param 	: {
		JumlahData 			: Ext.Cmp('JumlahData').getValue(), 
		Compare 			: Ext.Cmp('Fields').getValue(),
		AssignData 			: Ext.Cmp('AssignData').getValue(),
		CampaignId 			: Ext.Cmp('CampaignId').getValue(),
		UserPrivileges 		: Ext.Cmp('UserPrivileges').getValue(),
		UserId  		 	: Ext.Cmp('UserId').getValue(),
		OutboundCampaignId 	: Ext.Cmp('OutboundCampaignId').getValue(),
		CallReasonId		: Ext.Cmp('CallReasonId').getValue()
	},
	ERROR: function(e){
		Ext.Util(e).proc(function(items){
			if( items.success==1){
				Ext.Msg("Distribute Data ").Success();
				Ext.DOM.PageAjaxScript();
			}
			else{
				Ext.Msg("Distribute Data ").Failed();
			}
		});
	}	
		
}).post();	
}
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	
Ext.DOM.Process = function() {
	Ext.Ajax 
	({
		url 	: Ext.DOM.INDEX+'/ManageInboundOutbound/SaveByChecked/',
		method 	: 'POST',
		param 	: {
			UserId : Ext.Cmp('UserId').getValue(),
			CustomerId : Ext.Cmp('CustomerId').getValue(),
			JumlahData : Ext.Cmp('JumlahData').getValue(), 
			AssignData : Ext.Cmp('AssignData').getValue(),
			CampaignId : Ext.Cmp('CampaignId').getValue(),
			UserPrivileges : Ext.Cmp('UserPrivileges').getValue(),
			OutboundCampaignId : Ext.Cmp('OutboundCampaignId').getValue()
		},
		ERROR: function(e){
			Ext.Util(e).proc(function(items){
				if( items.success==1){
					Ext.Msg("Distribute Data ").Success();
					Ext.DOM.PageAjaxScript();
				}
				else{
					Ext.Msg("Distribute Data ").Failed();
				}
			});
		}	
		
	}).post();	
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.DOM.backtohome = function()
{
	if( confirm('Do you want to back campaign setup ?')){
		Ext.Ajax({ url : Ext.DOM.INDEX+'/SetCampaign/', method :'GET', param : {}}).load("main_content");
	}
	else
		return false;
}


	
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 		
Ext.DOM.navigation = 
{
	custnav	 : Ext.DOM.INDEX+'/ManageInboundOutbound/index/',
	custlist : Ext.DOM.INDEX+'/ManageInboundOutbound/content/'
}


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.EQuery.construct(Ext.DOM.navigation,datas)
 Ext.EQuery.postContentList();

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.PageAjaxScript  = function()
 {
	Ext.Cmp("processID").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='10px;'> <span style='color:red;'>Please Wait...</span>");
	Ext.EQuery.construct( navigation, {
		'Compare' : Ext.Cmp('Fields').getValue(),
		'CampaignId' : Ext.Cmp('CampaignId').getValue()	,
		'keywords' : Ext.Cmp('keywords').getValue(),
		'CallReasonId' : Ext.Cmp('CallReasonId').getValue()
		
	});
		Ext.EQuery.postContent();
 }
 

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.Cmp('sButtonCompare').listener
({
	onclick : function(e){ Ext.DOM.PageAjaxScript(); } 
}); 

Ext.Cmp('UserPrivileges').listener
({
	onChange : function(e)
	{
		Ext.Ajax 
		({ 
			url 	: Ext.DOM.INDEX+'/ManageInboundOutbound/getUserByPrivileges/',
			method 	: 'GET',
			param 	: {
				PrivilegeId : this.value
			}	
		}).load('UserAvailable');
	}
});
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.FindBucket = function()
{
	Ext.EQuery.construct( Ext.DOM.navigation, 
	{
		keywords 	 : Ext.Cmp('keywords').getValue(),	
		CampaignId 	 : Ext.Cmp('CampaignId').getValue(),
		Compare		 : Ext.Cmp('Fields').getValue(),
		CallReasonId : Ext.Cmp('CallReasonId').getValue()
	});
	Ext.EQuery.postContent();
}		
			
</script>	
<fieldset class="corner">
	<legend class="icon-campaign">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
	<div class="box-shadow" style="border:1px solid #ddd;margin-bottom:8px;margin-top:8px;margin-right:5px;margin-left:5px;">
		<form name="frmInboundBucket">
		<input type="hidden" name="CampaignId" id="CampaignId" value="<?php echo _get_post('CampaignId');?>">
		<table style="margin:3px;" border=0>
			<tr>
				<td valign="top" class='text_caption' rowspan=5>Compare Field : </td >
				<td valign="top" rowspan=5><?php __(form()->listCombo('Fields',null,$field,explode(',', _get_post('Compare'))));?></td>
				<td valign="top" class='text_caption bottom'>Jumlah Data : </td >
				<td valign="top"><?php __(form()->input('JumlahData','select long',$record) );?></td>
			</tr>	
			<tr>
				<td valign="top" class='text_caption bottom'>Assign Data : </td >
				<td valign="top"><?php __(form()->input('AssignData','select long',0) );?></td>
			</tr>	
			<tr>
				<td valign="top" class='text_caption bottom'>Outbound Campaign : </td >
				<td valign="top"><?php __(form()->combo('OutboundCampaignId','select',$Outbound, $Campaign['AvailCampaignId'] ) );?></td>
			</tr>	
			<tr>
				<td valign="top" class='text_caption bottom'>User Privileges : </td >
				<td valign="top"><?php __(form()->combo('UserPrivileges','select long',$Privileges));?></td>
			</tr>
			
			<tr>
				<td valign="top" class='text_caption'>User : </td >
				<td valign="top">
					<span id="UserAvailable">
						<?php __(form()->combo('UserId','input_text long',array() ));?>
					</span>
					</td>
			</tr>
			<tr>
				<td valign="top" class='text_caption '>&nbsp;</td >
				<td valign="top" ><?php __(form()->button('sButtonCompare','assign button','&nbsp;Compare'));?></td>
			</tr>
		</table>
		</form>
	</div>
	<div id="toolbars"></div>
	<div class="box-shadow" style="background-color:#FFFFFF;margin-top:10px;">	
		<div class="content_table" id="content_table"></div>
		<div id="pager"></div>
	</div>	
</fieldset>