<?php echo javascript(); ?>
<script type="text/javascript">
/* create object **/


Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 


 
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

Ext.DOM.datas =  {
	clbk_cust_name 	 	 : '<?php echo _get_exist_session('clbk_cust_name');?>',
	clbk_customer_number : '<?php echo _get_exist_session('clbk_customer_number');?>',
	clbk_call_city		 : '<?php echo _get_exist_session('clbk_call_city');?>',
	clbk_value_phone_by  : '<?php echo _get_exist_session('clbk_value_phone_by');?>',
	clbk_filter_phone_by : '<?php echo _get_exist_session('clbk_filter_phone_by');?>',
	clbk_gender	 	 	 : '<?php echo _get_exist_session('clbk_gender'); ?>',
	clbk_campaign_name 	 : '<?php echo _get_exist_session('clbk_campaign_name');?>', 
	clbk_call_reason     : '<?php echo _get_exist_session('clbk_call_reason');?>',
	clbk_user_id 		 : '<?php echo _get_exist_session('clbk_user_id');?>',
	clbk_user_agent		 : '<?php echo _get_exist_session('clbk_user_agent');?>',
	clbk_start_date		 : '<?php echo _get_exist_session('clbk_start_date');?>',
	clbk_end_date		 : '<?php echo _get_exist_session('clbk_end_date');?>',
	order_by 			 : '<?php echo _get_exist_session('order_by');?>',
	type	 			 : '<?php echo _get_exist_session('type');?>'
}
			
		
Ext.DOM.navigation = {
	custnav	 : Ext.DOM.INDEX +'/SrcAppoinmentFlexi/index/',
	custlist : Ext.DOM.INDEX +'/SrcAppoinmentFlexi/Content/'
}
		

Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();

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

Ext.DOM.searchCustomer = function() 
{
	$.cookie('selected',0)
	Ext.EQuery.construct( navigation, Ext.Join([  
			Ext.Serialize("FrmCustomerClbk").getElement() 
		]).object() );
	
	Ext.EQuery.postContent();
}
		

Ext.DOM.resetSeacrh = function() {
	Ext.Serialize('FrmCustomerClbk').Clear();
	Ext.DOM.searchCustomer();
}

Ext.DOM.SetAppointment = function( AppoinmentId ) 
{
	return ( Ext.Ajax ({
		    // url 	: Ext.EventUrl(['SrcAppoinment','Update']).Apply(),  
		    url 	: Ext.EventUrl(['SrcAppoinmentFlexi','UpdateNew']).Apply(),  
		    method  : 'POST',
		    param 	: { 
				AppoinmentId : AppoinmentId 
		   }
		}).json() );
} 

Ext.DOM.DetailCustomer = function( AppoinmentId )
{
	console.log("## DetailCustomer");
 	var Data = Ext.DOM.SetAppointment( AppoinmentId );
	if( Data.CustomerId )
	{
		Ext.ActiveMenu().NotActive();
		Ext.DOM.SetFollowUp(Data.CustomerId);
		Ext.ShowMenu( new Array('SrcCustomerList','ContactDetail'), 
			Ext.System.view_file_name(), 
		{
			CustomerId : Data.CustomerId,
			// ControllerId : 'SrcAppoinment'
			ControllerId : 'SrcAppoinmentFlexi'
		});
	} 
	else{ 
		Ext.Msg("No Customers Selected !").Info(); 
	}	
}
 

$(document).ready(  function(){
	 $('#toolbars').extToolbars({
		 extUrl   :Ext.DOM.LIBRARY+'/gambar/icon',
		 extTitle :[['Search'],['Clear']],
		 extMenu  :[['searchCustomer'],['resetSeacrh']],
		 extIcon  :[['zoom.png'],['cancel.png']],
		 extText  :true,
		 extInput :true,
		 extOption:[]
	 });
			
 	$('.date').datepicker({ changeYear: true, changeMonth:true, showOn: 'button',  buttonImage: Ext.Image('calendar.gif'),  buttonImageOnly: true,  dateFormat:'dd-mm-yy',readonly:true});
 	$('.select').chosen();	
 
});
		
</script>
<!-- start : content -->
<fieldset class="corner">

<?php echo form()->legend(lang(""), "fa-calendar"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmCustomerClbk">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('CIF'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('clbk_customer_number','input_text tolong', _get_exist_session('clbk_customer_number'));?></div> 
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('City'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('clbk_call_city','input_text tolong',  _get_exist_session('clbk_call_city'));?></div>
				
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('clbk_user_agent','select tolong',User(), _get_exist_session('clbk_user_agent'));?></div>
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('clbk_cust_name','input_text tolong', _get_exist_session('clbk_cust_name'));?></div>
			
			<!-- <div class="ui-widget-form-cell text_caption"><?php #echo lang(array('Campaign Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php #echo form() -> combo('clbk_campaign_name','select tolong', Campaign(), _get_exist_session('clbk_campaign_name'));?></div> -->
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Try Call<br>Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> 
				<?php echo form()->input('clbk_start_date','input_text date',_get_exist_session('clbk_start_date'));?><?php echo lang('to');?>
				<?php echo form()->input('clbk_end_date','input_text date',_get_exist_session('clbk_end_date'));?>
			</div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Phone Value');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('clbk_value_phone_by','input_text tolong',_get_exist_session('clbk_value_phone_by'));?></div>
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Result'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('clbk_call_reason','select tolong', CallResultThinking(), _get_exist_session('clbk_call_reason'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Gender');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('clbk_gender', 'select tolong', Gender(), _get_exist_session('clbk_gender')) ?></div>

			<div class="ui-widget-form-cell text_caption"><?php echo lang('Phone By');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('clbk_filter_phone_by','select tolong',SelectFilterBy(), _get_exist_session('clbk_filter_phone_by'));?></div>
			
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
	
	
	
	
	