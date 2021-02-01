<?php echo javascript(); ?>

<script type="text/javascript">

Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
})();
 
 	
/* create object default parameter assigning **/

var datas = 
{
	cfm_quality_int_status : '<?php echo _get_exist_session('cfm_quality_int_status');?>', 
	cfm_cust_number 	: '<?php echo _get_exist_session('cfm_cust_number');?>', 
	cfm_cust_name 		: '<?php echo _get_exist_session('cfm_cust_name');?>',
	cfm_home_phone  	: '<?php echo _get_exist_session('cfm_home_phone');?>',
	cfm_office_phone	: '<?php echo _get_exist_session('cfm_office_phone');?>', 
	cfm_mobile_phone	: '<?php echo _get_exist_session('cfm_mobile_phone');?>', 
	cfm_campaign_id 	: '<?php echo _get_exist_session('cfm_campaign_id');?>', 
	cfm_user_id 		: '<?php echo _get_exist_session('cfm_user_id');?>', 
	cfm_start_date  	: '<?php echo _get_exist_session('cfm_start_date');?>', 
	cfm_end_date    	: '<?php echo _get_exist_session('cfm_end_date');?>', 
	cfm_category_id 	: '<?php echo _get_exist_session('cfm_category_id');?>',
	cfm_order_by 		: '<?php echo _get_exist_session('order_by');?>',
	type	 			: '<?php echo _get_exist_session('type');?>'
}
		
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

	
	
/* assign navigation filter **/
var navigation = {
	custnav   : Ext.EventUrl(new Array('QtyApprovalConfirm','index')).Apply(), 
	custlist  : Ext.EventUrl(new Array('QtyApprovalConfirm','Content')).Apply()
}
		
/* assign show list content **/
		
Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

/* 
 * @def : memanggil Jquery plug in 
 * -------------------------------
 * @param : public 
 */
 
Ext.DOM.searchCustomer = function()
{
	Ext.EQuery.construct( navigation, Ext.Join([  
			Ext.Serialize("FrmQtyInterest").getElement() 
		]).object()
	); 
	Ext.EQuery.postContent();
}
	
//------------------------------------------------------
 
Ext.DOM.resetSearch = function() 
{
	Ext.Serialize('FrmQtyInterest').Clear();
	Ext.DOM.searchCustomer();
}
  
/* 
 * @def : memanggil Jquery plug in 
 * -------------------------------
 * @param : public 
 */
 
Ext.DOM.showPolicy = function( CustomerId )
{
	if( CustomerId == '' ){ Ext.Msg("Please select rows ").Info();  }
	else 
	{	
		Ext.ShowMenu(new Array("QtyApprovalInterest","QualityDetail"), 
			Ext.System.view_file_name(),
		{
			CustomerId 	 : CustomerId,
			ControllerId : "QtyApprovalConfirm" 
		});
	 }
}
/* 
 * @def : memanggil Jquery plug in 
 * -------------------------------
 * @param : public 
 */
 
 $(document).ready( function(){
   $('#toolbars').extToolbars  ({
		extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle :[['Search'],['Clear']],
		extMenu  :[['searchCustomer'],['resetSearch']],
		extIcon  :[['zoom.png'],['cancel.png']],
		extText  :true,
		extInput :false,
		extOption:[]
	});
	$('.select').chosen();
	$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
});	
</script>

<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-user"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
<form name="FrmQtyInterest">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer','Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('cfm_cust_name','input_text long',_get_exist_session('cfm_cust_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Home Phone');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('cfm_home_phone','input_text long',_get_exist_session('cfm_home_phone'));?></div>
		
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Office Phone'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('cfm_office_phone','input_text long',_get_exist_session('cfm_office_phone'));?></div>
		
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Campaign Name');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('cfm_campaign_id','select superlong',Campaign(),_get_exist_session('cfm_campaign_id'));?></div>
			
		</div>
	
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Interval'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> 
				<?php echo form()->input('cfm_start_date','input_text date',_get_exist_session('cfm_start_date'));?><?php echo lang('to');?>
				<?php echo form()->input('cfm_end_date','input_text date',_get_exist_session('cfm_end_date'));?>
			</div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Mobile Phone'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('cfm_mobile_phone','input_text long',_get_exist_session('cfm_mobile_phone'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Quality Status');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('cfm_quality_int_status','select long',QualityResult(),_get_exist_session('cfm_quality_int_status'));?></div>
		
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Agent ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('cfm_user_id','select superlong',User(),_get_exist_session('cfm_user_id'));?></div>
			
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
	
	
	
	
	