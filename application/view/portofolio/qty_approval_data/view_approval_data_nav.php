<?php echo javascript(); ?>
<script type="text/javascript">

// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 
 
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */


Ext.DOM.datas = 
{
	category_id_app 		: "<?php echo _get_exist_session('category_id_app');?>",
	cust_approve_status 	: "<?php echo _get_exist_session('cust_approve_status');?>",
	cust_call_result		: "<?php echo _get_exist_session('cust_call_result');?>",
	cust_campaign_id		: "<?php echo _get_exist_session('cust_campaign_id');?>",
	cust_end_date			: "<?php echo _get_exist_session('cust_end_date');?>",
	cust_first_name			: "<?php echo _get_exist_session('cust_first_name');?>",
	cust_number_id			: "<?php echo _get_exist_session('cust_number_id');?>",
	cust_start_date			: "<?php echo _get_exist_session('cust_start_date');?>",
	cust_user_id			: "<?php echo _get_exist_session('cust_user_id');?>",
	order_by 		 		: "<?php echo _get_exist_session('order_by');?>",
	type	 		 		: "<?php echo _get_exist_session('type');?>"
}

// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
		
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record() . " -> Duration :" . _getDuration($this->M_QtyApprovalData->getDurationAll($page -> _get_query()));; ?>';
	
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 Ext.DOM.navigation = 
{
	custnav  : Ext.EventUrl(new Array('QtyApprovalData','index')).Apply(),  
	custlist : Ext.EventUrl(new Array('QtyApprovalData','Content')).Apply()
}
		
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
		
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();

/* function searching customers **/

var validation_check =  function(CustomerId)
	{
		if( CustomerId )
			{
				Ext.File = '../class/class.src.qualitycontrol.php'; 
				Ext.Params = {
					action:'validation_check',
					CustomerId : CustomerId
				}	
				
				return Ext.eJson();	
			} 
 } 
 
/* 
 * @def : memanggil Jquery plug in 
 * -------------------------------
 * @param : public 
 */
 
// --------------------- 
// http://192.168.10.236/bnilifeinsurance/index.php/QtyApprovalData/Content
// ------- 
Ext.DOM.ShowPolicy = function( CustomerId )
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	 
	if( CustomerId == '' ){ 
		Ext.Msg("Please select rows ").Info();  }
	else 
	{	
		Ext.ShowMenu(new Array("QtyApprovalInterest","QualityDetail"), 
			Ext.System.view_file_name(),
		{
			CustomerId 	 : CustomerId,
			ControllerId : "QtyApprovalData" 
		});
	 }
}

 
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 Ext.DOM.RejectPolicy = function()
{
  var CustomerId = Ext.Cmp('CustomerId').getValue();
  if( CustomerId.length > 0 )
 {
	if( !Ext.Msg('Are you sure, to reject this row(s) ?').Confirm() ){
		return false;
	}	
// ----------------------------------------------------------------------------	
// ---------- rejected data ---------------------------------------------------
// ----------------------------------------------------------------------------
	
	 Ext.Ajax
	({
		url 	: Ext.EventUrl(['QtyApprovalData','Rejected']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		},	
		 ERROR 	: function( e )
		{
			Ext.Util(e).proc(function( response )
			{
				if( response.success ){
					Ext.Msg('Rejected Data Sale').Success();
				} else {
					Ext.Msg('Rejected Data Sale').Failed();
				}		
			});
		}
	}).post();
	
 }
 
}
 
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 
 Ext.DOM.searchCustomer = function()
{
 var frmAprvData = Ext.Serialize('frmAprvData');
	$.cookie('selected', 0);
	Ext.EQuery.construct(Ext.DOM.navigation, Ext.Join([frmAprvData.getElement()]).object());
	Ext.EQuery.postContent();	
}
	
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
 	
 Ext.DOM.resetSeacrh = function() 
{
	Ext.Serialize('frmAprvData').Clear();
	Ext.DOM.searchCustomer();
}
	
// ---------------------------------------------------------------------------------------------------------------- 
/* 
 * @ package 	: instance of class  
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * 
 */
$(document).ready( function()
{
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Search'],['Clear'],['Reject'],['Detail']],
		extMenu   : [['searchCustomer'],['resetSeacrh'],['RejectPolicy'],['ShowPolicy']],
		extIcon   : [['zoom.png'],['cancel.png'],['application_form_delete.png'],['zoom_out.png']],
		extText   : true,
		extInput  : false,
		extOption : []
	});
	
	$('.date').datepicker({
		showOn: 'button', buttonImage:  Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, 
		dateFormat:'dd-mm-yy',readonly:true,
		changeYear: true, changeMonth: true
	});
	$('.select').chosen();
});
	
</script>
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="frmAprvData">
  
  <div class="ui-widget-form-table-compact">
	<div class="ui-widget-form-row baris-1">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Customer Name');?></div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('cust_first_name','input_text tolong',_get_exist_session('cust_first_name'));?></div>
		
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Campaign Name');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('cust_campaign_id','select tolong',$CampaignId,_get_exist_session('cust_campaign_id'));?></div>
		
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('User ID');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('cust_user_id','select tolong',$UserId,_get_exist_session('cust_user_id'));?></div>	
	</div>
	
	<div class="ui-widget-form-row baris-2">
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Sales Date');?> </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('cust_start_date','input_text date',_get_exist_session('cust_start_date'));?> 
			<?php echo lang('to');?>
			<?php echo form()->input('cust_end_date','input_text date',_get_exist_session('cust_end_date'));?> 
		</div>
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Call Result');?> </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('cust_call_result','select tolong',$CallResult,_get_exist_session('cust_call_result'));?></div>
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Quality Status');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('cust_approve_status','select tolong',$QtyResult,_get_exist_session('cust_approve_status'));?></div>
	</div>
	
	<div class="ui-widget-form-row baris-2">
		<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Policy Number'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('policy_number','input_text long',_get_exist_session('policy_number'));?></div>
			

			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Supervisor'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('spv_id','select superlong',Leader(),_get_exist_session('spv_id'));?></div>
			
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Quality Staff'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('quality_id','select superlong',QualityAllStaff(),_get_exist_session('quality_id'));?></div>
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
	
	
	
	
	