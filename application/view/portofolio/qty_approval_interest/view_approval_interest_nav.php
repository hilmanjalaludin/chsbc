<?php echo javascript(); ?>

<script type="text/javascript">

Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
})();
 
 	
/* create object default parameter assigning **/

var datas = 
{
	cust_number 	: '<?php echo _get_exist_session('cust_number');?>', 
	cust_name 		: '<?php echo _get_exist_session('cust_name');?>',
	home_phone  	: '<?php echo _get_exist_session('home_phone');?>',
	office_phone	: '<?php echo _get_exist_session('office_phone');?>', 
	mobile_phone	: '<?php echo _get_exist_session('mobile_phone');?>', 
	campaign_id 	: '<?php echo _get_exist_session('campaign_id');?>', 
	user_id 		: '<?php echo _get_exist_session('user_id');?>', 
	start_date  	: '<?php echo _get_exist_session('start_date');?>', 
	end_date    	: '<?php echo _get_exist_session('end_date');?>', 
	order_by 		: '<?php echo _get_exist_session('order_by');?>',
	type	 		: '<?php echo _get_exist_session('type');?>',
	quality_int_status : '<?php echo _get_exist_session('quality_int_status');?>', 
	category_id 	: '<?php echo _get_exist_session('category_id');?>',
}
		
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record() . " -> Duration :" . _getDuration($this->M_QtyApprovalInterest->getDurationAll($page -> _get_query()));; ?>';
	
	
/* assign navigation filter **/
var navigation = {
	custnav   : Ext.DOM.INDEX +'/QtyApprovalInterest/index/',
	custlist  : Ext.DOM.INDEX +'/QtyApprovalInterest/Content/',
}
		
/* assign show list content **/
		
Ext.EQuery.construct(navigation,datas)
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
			ControllerId : "QtyApprovalInterest" 
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
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('cust_name','input_text long',_get_exist_session('cust_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Home Phone');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('home_phone','input_text long',_get_exist_session('home_phone'));?></div>
		
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Office Phone'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('office_phone','input_text long',_get_exist_session('office_phone'));?></div>
		
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Campaign Name');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('campaign_id','select superlong',Campaign(),_get_exist_session('campaign_id'));?></div>
			
		</div>
	
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Interval'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> 
				<?php echo form()->input('start_date','input_text date',_get_exist_session('start_date'));?><?php echo lang('to');?>
				<?php echo form()->input('end_date','input_text date',_get_exist_session('end_date'));?>
			</div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Mobile Phone'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('mobile_phone','input_text long',_get_exist_session('mobile_phone'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Quality Status');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('quality_int_status','select long',QualityResult(),_get_exist_session('quality_int_status'));?></div>
		
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Agent ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('user_id','select superlong',User(),_get_exist_session('user_id'));?></div>
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Policy Number'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('policy_number','input_text long',_get_exist_session('policy_number'));?></div>
			

			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption center"></div>
			<div class="ui-widget-form-cell text_caption left"> </div>
			

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
	
	
	
	
	