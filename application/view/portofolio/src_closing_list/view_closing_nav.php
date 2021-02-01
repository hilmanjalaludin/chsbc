<?php echo javascript(); ?>

<script type="text/javascript">
	
var Reason = [];
Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText("Sales Submited");
 }); 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.DOM.datas = {
	cust_name 		 : '<?php echo _get_exist_session('cust_name');?>',
	gender	 		 : '<?php echo _get_exist_session('gender');?>',
	card_type 		 : '<?php echo _get_exist_session('card_type');?>',
	order_by 		 : '<?php echo _get_exist_session('order_by');?>',
	type	 		 : '<?php echo _get_exist_session('type');?>',
	user_id 		 : '<?php echo _get_exist_session('user_id');?>',
	verify_status 	 : '<?php echo _get_exist_session('verify_status');?>',
	start_call_date  : '<?php echo _get_exist_session('start_call_date');?>',
	end_call_date 	 : '<?php echo _get_exist_session('end_call_date');?>',
	start_sales_date : '<?php echo _get_exist_session('start_sales_date');?>',
	end_sales_date   : '<?php echo _get_exist_session('end_sales_date');?>',
	user_agent 		 : '<?php echo _get_exist_session('user_agent');?>'
}
			
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 	
Ext.DOM.navigation = 
{
	custnav	 : Ext.EventUrl( new Array('SrcCustomerClosing','index')).Apply(),  
	custlist : Ext.EventUrl( new Array('SrcCustomerClosing','Content')).Apply()  
}
		
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 Ext.DOM.SetSuspendUp = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerClosing','SuspendType']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 Ext.DOM.SetFollowUp = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','SetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.DOM.searchCustomer = function() 
{
var FrmCustomerCall = Ext.Serialize("FrmCustomerCall").getElement();
	console.log( FrmCustomerCall );
	$.cookie('selected', 0);
	Ext.EQuery.construct( navigation, Ext.Join([FrmCustomerCall]).object() );
	
	Ext.EQuery.postContent();
}
	
	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.DOM.resetSeacrh = function(){
	Ext.Serialize('FrmCustomerCall').Clear();
	Ext.DOM.searchCustomer();
}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 Ext.DOM.SetEventCallData = function( CustomerId )
{
	return false;
	
	if( CustomerId!='') 
	{
		if( !Ext.Msg("Are you sure").Confirm() ){
			return false;
		}
		
		var response = Ext.DOM.SetFollowUp(CustomerId);
		 if( response.success == 1) 
		{
			Ext.ActiveMenu().NotActive();
			Ext.ShowMenu( new Array('SrcCustomerClosing','ContactDetail'), 
				Ext.System.view_file_name(), 
			{
				CustomerId : CustomerId,
				ControllerId : 'SrcCustomerClosing'
			}); 
		} else {
			Ext.Msg('Sorry, Data On Followup by other User ').Info();
		}	
	}
	else{ Ext.Msg("No Customers Selected !").Info(); }	
 }
		

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 	
 $(document).ready( function()
{
	$('#toolbars').extToolbars({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Search'],['Clear']],
		extMenu   : [['searchCustomer'],['resetSeacrh']],
		extIcon   : [['zoom.png'],['cancel.png']],
		extText   : true,
		extInput  : false,
		extOption : []
	});
	
	$('.select').chosen();
	$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
});	
		
</script>
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-print"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmCustomerCall">
	 <div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Customer Name');?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('cust_name','input_text tolong',_get_exist_session('cust_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Campaign Name');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('campaign_id','select tolong',CampaignId(), _get_exist_session('campaign_id'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Sales Date');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('start_sales_date','input_text date', _get_exist_session('start_sales_date'));?> - <?php echo form()->input('end_sales_date','input_text date', _get_exist_session('end_sales_date'));?></div>
		</div>
			
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Quality Status');?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('verify_status','select tolong',QualityResult(), _get_exist_session('verify_status'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('user_agent','select tolong', User(), _get_exist_session('UserId'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call','Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('start_call_date','input_text date', _get_exist_session('start_call_date'));?> - <?php echo form()->input('end_call_date','input_text date', _get_exist_session('end_call_date'));?></div>
		
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
