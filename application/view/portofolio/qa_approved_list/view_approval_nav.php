<?php echo javascript(); ?>
<script type="text/javascript">
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
})();

Ext.DOM.Reason = [];
Ext.DOM.datas  = {}
Ext.DOM.handling = '<?php echo _get_session('HandlingType'); ?>';
Ext.EQuery.TotalPage = <?php echo $page->_get_total_page(); ?>;
Ext.EQuery.TotalRecord 	= <?php echo $page->_get_total_record(); ?>;

Ext.DOM.datas = 
{
	src_cust_name 	 	: '<?php echo _get_exist_session('src_cust_name');?>',
	src_gender	 	 	: '<?php echo _get_exist_session('src_gender'); ?>',
	src_campaign_name 	: '<?php echo _get_exist_session('src_campaign_name');?>', 
	src_customer_number : '<?php echo _get_exist_session('src_customer_number');?>',  
	src_customer_city	: '<?php echo _get_exist_session('src_customer_city');?>',
	src_customer_cif	: '<?php echo _get_exist_session('src_customer_cif');?>',
	src_customer_recsource	: '<?php echo _get_exist_session('src_customer_recsource');?>',
	
	src_user_id 		: '<?php echo _get_exist_session('src_user_id');?>',
	src_user_agent		: '<?php echo _get_exist_session('src_user_agent');?>',
	src_start_date		: '<?php echo _get_exist_session('src_start_date');?>',
	src_end_date		: '<?php echo _get_exist_session('src_end_date');?>',
	order_by 			: '<?php echo _get_exist_session('order_by');?>',
	type	 			: '<?php echo _get_exist_session('type');?>'
}

Ext.DOM.navigation = 
{
	custnav  : Ext.DOM.INDEX+'/QaApprovedList/index/',
	custlist : Ext.DOM.INDEX+'/QaApprovedList/Content/',
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 	
 
Ext.EQuery.construct(navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();

Ext.DOM.SetFollowUp = function(CustomerId)
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['QaApprovedList','SetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
}

Ext.DOM.gotoDetailQA = function(CustomerId)
{
	if( CustomerId!='') 
	{
		var response = Ext.DOM.SetFollowUp(CustomerId);
		
			// Ext.ActiveMenu().NotActive();
			Ext.ShowMenu( new Array('QaApprovedList','ContactDetail'), 
			Ext.System.view_file_name(), 
			{
				CustomerId : CustomerId,
				ControllerId : 'QaApprovedList'
			}); 
		
	}
	else{ Ext.Msg("No Customers Selected !").Info(); }	
}

$(function()
{
	$('#toolbars').extToolbars({
			extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
			extTitle : [['Search'],['Clear']],
			extMenu  : [['searchCustomer'],['resetSeacrh']],
			extIcon  : [['zoom.png'],['cancel.png']],
			extText  :true,
			extInput :false,
			extOption:[{
				render : 4,
				type   : 'combo',
				header : 'Call Reason ',
				id     : 'v_result_customers', 	
				name   : 'v_result_customers',
				triger : '',
				store  : []
			}]
	});
			
	$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
	$('.select').chosen();
});
</script>

<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmCustomerCall">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('src_customer_recsource','input_text tolong',  _get_exist_session('src_customer_recsource'));?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form() -> input('src_cust_name','input_text tolong', _get_exist_session('src_cust_name'));?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Gender');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form() -> combo('src_gender', 'select tolong', Gender(), _get_exist_session('src_gender')) ?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form() -> combo('src_user_agent','select tolong',User(), _get_exist_session('src_user_agent'));?></div>
				
			</div>
			
			<div class="ui-widget-form-row baris-2">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('src_campaign_name','select tolong', Campaign(), _get_exist_session('src_campaign_name'));?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Approval Status'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('src_approve_status','select tolong', QualityReason(), _get_exist_session('src_call_reason'));?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Interval'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell text_caption left"> 
					<?php echo form()->input('src_start_date','input_text date',_get_exist_session('src_start_date'));?><?php echo lang('to');?>
					<?php echo form()->input('src_end_date','input_text date',_get_exist_session('src_end_date'));?>
				</div>
			</div>
			
		</div>
	</form>
</div>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	
		
	<!-- stop : content -->