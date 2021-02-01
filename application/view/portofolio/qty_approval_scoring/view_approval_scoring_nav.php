<?php echo javascript(); ?>
<script type="text/javascript">

Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 
 	
// -------------------------------------------------------------------------	
/* create object default parameter assigning **/


var qty_start_date_elm = $("#qty_start_date").val();
var qty_end_date_elm = $("#qty_end_date").val();

var datas =  {
	qty_cust_number :'<?php echo _get_exist_session('qty_cust_number');?>', 
	qty_cust_name 	:'<?php echo _get_exist_session('qty_cust_name');?>',  
	qty_home_phone  :'<?php echo _get_exist_session('qty_home_phone');?>',  
	qty_office_phone:'<?php echo _get_exist_session('qty_office_phone');?>',  
	qty_mobile_phone:'<?php echo _get_exist_session('qty_mobile_phone');?>',  
	qty_campaign_id :'<?php echo _get_exist_session('qty_campaign_id');?>',  
	qty_call_result :'<?php echo _get_exist_session('qty_call_result');?>',  
	qty_user_id 	:'<?php echo _get_exist_session('qty_user_id');?>',  
	qty_start_date  : qty_start_date_elm , 
	qty_end_date    : qty_end_date_elm , 
	order_by 		:'<?php echo _get_exist_session('order_by');?>',  
	type	 		:'<?php echo _get_exist_session('type');?>',
	qty_status_scoring : '<?php echo _get_exist_session('qty_status_scoring'); ?>'
	
}
		
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

	
// ----------------------------------------------------------------------------------------	
/* assign navigation filter **/

var navigation = 
{
	custnav : Ext.DOM.INDEX +'/QtyScoring/index/',
	custlist : Ext.DOM.INDEX +'/QtyScoring/Content/',
}

// --------------------------------------------------------------------------------------------------		
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
	$.cookie('selected', 0);
	var frmQtyListScore = Ext.Serialize('frmQtyListScore').getElement();
		Ext.EQuery.construct( navigation, Ext.Join(new Array(frmQtyListScore) ).object());
		Ext.EQuery.postContent();
}
	
/* 
 * @def : memanggil Jquery plug in 
 * -------------------------------
 * @param : public 
 */
 
 Ext.DOM.resetSeacrh = function() 
{
	Ext.Serialize('frmQtyListScore').Clear();
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
			ControllerId : "QtyScoring" 
		});
	 }
}



/* 
 * @def : memanggil Jquery plug in 
 * -------------------------------
 * @param : public 
 */
 
  Ext.document().ready(function()
 {
   Ext.query('#toolbars').extToolbars 
	({
		extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle :[['Search'],['Clear']],
		extMenu  :[['searchCustomer'],['resetSeacrh']],
		extIcon  :[['zoom.png'],['cancel.png']],
		extText  :true,
		extInput :false,
		extOption:[]
	});
	
	$('.date').datepicker({
			changeYear: true, changeMonth:true,
			showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',readonly:true});
	$('.select').chosen();
});	
</script>

<!-- start : content -->

<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-user"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
<form name="frmQtyListScore">
<div class="ui-widget-form-table-compact">
	<div class="ui-widget-form-row baris-1">
	
		<div class="ui-widget-form-cell text_caption"> Campaign</div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->combo('qty_campaign_id','select long',Campaign(),_get_exist_session('qty_campaign_id'));?></div>
		
		<div class="ui-widget-form-cell text_caption"> Home Phone</div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"> <?php echo form()->input('qty_home_phone','input_text long',_get_exist_session('qty_home_phone'));?></div>
		
		<div class="ui-widget-form-cell text_caption"> Call Result </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->combo('qty_call_result','select long',CallResult(),_get_exist_session('qty_call_result'));?></div>
	</div>
	<div class="ui-widget-form-row baris-2">
		<div class="ui-widget-form-cell text_caption"> Customer Name </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->input('qty_cust_name','input_text long',_get_exist_session('qty_cust_name'));?></div>
		
		<div class="ui-widget-form-cell text_caption"> Office Phone </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->input('qty_office_phone','input_text long',_get_exist_session('qty_office_phone'));?></div>
		<div class="ui-widget-form-cell text_caption"> Agent ID </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->combo('qty_user_id','select long',User(),_get_exist_session('qty_user_id'));?></div>
		
	</div>
	<div class="ui-widget-form-row baris-3">
	
		<?php 
		$qty_start_date = date( "d-m-Y" );
		$qty_end_date = date( "d-m-Y" );
		if ( _get_session("qty_start_date") != '' && _get_session("qty_end_date") != '' ) {
			$qty_start_date = _get_exist_session("qty_start_date");
			$qty_end_date = _get_exist_session("qty_end_date");
		}
		
		?>
		<div class="ui-widget-form-cell text_caption"> Interval </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left">  <?php echo form()->input('qty_start_date','input_text date',$qty_start_date);?> <?php echo form()->input('qty_end_date','input_text date',$qty_end_date);?> </div>
		
		<div class="ui-widget-form-cell text_caption"> Mobile Phone </div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->input('qty_mobile_phone','input_text long',_get_exist_session('qty_mobile_phone'));?></div>

	
		<div class="ui-widget-form-cell text_caption">Status Scoring</div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"> <?php echo form()->combo('qty_status_scoring','select long',array("Yes" => "Yes" , "No" => "No"),_get_exist_session('qty_status_scoring'));?></div>
		
		
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
	
	
	
	
	