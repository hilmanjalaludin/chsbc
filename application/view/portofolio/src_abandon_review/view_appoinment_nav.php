<?php echo javascript(); ?>
<script type="text/javascript">
/* create object **/


Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 

// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 

Ext.DOM.datas =  {
	clbk_cust_name 	 	 : '<?php echo _get_exist_session('clbk_cust_name');?>',
	clbk_customer_number : '<?php echo _get_exist_session('clbk_customer_number');?>',
	clbk_call_city		 : '<?php echo _get_exist_session('clbk_call_city');?>',
	clbk_value_phone_by  : '<?php echo _get_exist_session('clbk_value_phone_by');?>',
	clbk_filter_phone_by : '<?php echo _get_exist_session('clbk_filter_phone_by');?>',
	clbk_gender	 	 	 : '<?php echo _get_exist_session('clbk_gender'); ?>',
	clbk_campaign_name 	 : '<?php echo _get_exist_session('clbk_campaign_name');?>', 
	src_customerabd_keyword	: '<?php echo _get_exist_session('src_customerabd_keyword');?>',
	src_customerabd_recsource	: '<?php echo _get_exist_session('src_customerabd_recsource');?>',
	
	clbk_recsources_name : '<?php echo _get_exist_session('clbk_recsources_name');?>',
	clbk_call_reason     : '<?php echo _get_exist_session('clbk_call_reason');?>',
	clbk_user_id 		 : '<?php echo _get_exist_session('clbk_user_id');?>',
	clbk_user_agent		 : '<?php echo _get_exist_session('clbk_user_agent');?>',
	clbk_start_date		 : '<?php echo _get_exist_session('clbk_start_date');?>',
	clbk_end_date		 : '<?php echo _get_exist_session('clbk_end_date');?>',
	order_by 			 : '<?php echo _get_exist_session('order_by');?>',
	type	 			 : '<?php echo _get_exist_session('type');?>'
}
			
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
		
Ext.DOM.navigation = {
	custnav	 : Ext.DOM.INDEX +'/AbandonReview/index/',
	custlist : Ext.DOM.INDEX +'/AbandonReview/Content/'
}
		
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
window.EventRecscource = function(){
	
// key data untuk process filter process 
	
	var windowDataUri = Ext.EventUrl( new Array('AbandonReview/FilterRecData') ),
		windowDataKeyword = Ext.Cmp('src_customerabd_keyword').getValue(),
		windowDataRecsource = Ext.Cmp('src_customerabd_recsource').getValue();
		

// pake loader jquery aja : 		
	 $('#filter-recsource-div').loader ({
		url 	: windowDataUri.Apply(),
		method 	: 'POST',
		param 	: {
			keyword : windowDataKeyword,
			recsource : windowDataRecsource
		},
		complete : function( html ){
			$(html).find('.cz-autocomplete').chosen();
		}	
	});
}

Ext.DOM.load_Recsource_pull_src = function(obj){	
	$("#src_customerabd_recsource").toogle({url:'AbandonReview/filtered_recsource', param:{time : Ext.Date().getDuration()}, elval:['clbk_campaign_name','src_customerabd_keyword']});
};
 
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();
// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
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
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 

Ext.DOM.searchCustomer = function() 
{
	$.cookie('selected',0)
	Ext.EQuery.construct( navigation, Ext.Join([  
			Ext.Serialize("FrmCustomerClbk").getElement() 
		]).object() );
	
	Ext.EQuery.postContent();
}
		
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
	
Ext.DOM.resetSeacrh = function() {
	Ext.Serialize('FrmCustomerClbk').Clear();
	Ext.DOM.searchCustomer();
}
	
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
 Ext.DOM.SetAppointment = function( AppoinmentId ) 
{
	return ( Ext.Ajax ({
		    url 	: Ext.EventUrl(['SrcAppoinment','Update']).Apply(),  
		    method  : 'POST',
		    param 	: { 
				AppoinmentId : AppoinmentId 
		   }
		}).json() );
} 

// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
 Ext.DOM.DetailCustomer = function( CustomerId )
{	
	if( CustomerId )
	{
		Ext.ActiveMenu().NotActive();
		Ext.ShowMenu( new Array('DetailAbandon','ContactDetail'), 
			Ext.System.view_file_name(), 
		{
			CustomerId : CustomerId,
			ControllerId : 'AbandonReview'
		});
	} 
	else{ 
		Ext.Msg("No Customers Selected !").Info(); 
	}	
 }
 
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
  Ext.DOM.resetAbandon = function () {
 	var CustomerIdData = $("#CustomerId:checked").map(function () {
 		return $(this).val();
 	}).get();

 	if ( typeof(CustomerIdData) == "object" ) {

 		 
 		var urlSend = Ext.EventUrl(['AbandonReview','ResetAbandonCheckList']).Apply();
 		var sendData = {
 			url : urlSend , 
 			dataType : "json" , 
 			data : { CustomerId : CustomerIdData } , 
 			type : "POST" , 
 			success : function (data) {
 				alert("Total Data : "+data.total+" \n Success : "+data.success+" ");
				Ext.DOM.resetSeacrh(); 	
				console.log(data);			
 			}
 		};

 		if ( confirm("Are you sure to reset?") ) {
	 		$.ajax(sendData);
 		}


 		return false;
 	}

 	


 }
 
$(document).ready(  function(){
$('#toolbars').extToolbars
 ({
	 extUrl   :Ext.DOM.LIBRARY+'/gambar/icon',
	 extTitle :[['Search'],['Clear'],["Reset Abandon"]],
	 extMenu  :[['searchCustomer'],['resetSeacrh'],['resetAbandon']],
	 extIcon  :[['zoom.png'],['cancel.png'],['key_delete.png']],
	 extText  :true,
	 extInput :true,
	 extOption:[]
 });
			
 $('.date').datepicker({ changeYear: true, changeMonth:true, showOn: 'button',  buttonImage: Ext.Image('calendar.gif'),  buttonImageOnly: true,  dateFormat:'dd-mm-yy',readonly:true});
 $('.select').chosen();	
 $("#src_customerabd_recsource").toogle({url:'AbandonReview/filtered_recsource', param:{time : Ext.Date().getDuration()}, elval:['clbk_campaign_name','src_customerabd_keyword']});
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
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('clbk_campaign_name','select tolong', Campaign(), _get_exist_session('clbk_campaign_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Phone By');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('clbk_filter_phone_by','select tolong',SelectFilterBy(), _get_exist_session('clbk_filter_phone_by'));?></div>
			
			
			<!-- d iv class="ui-widget-form-row baris-1" --->
   
								<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Keyword Recsource'));?></div>
								<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
								<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;">
									<?php echo form()->input('src_customerabd_keyword','input_text long', _get_exist_session('src_customerabd_keyword')  );?>
								</div>
								
								<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;">
									<a href="javascript:void(0);" onclick="Ext.DOM.load_Recsource_pull_src();"> <i class="fa search">&nbsp;</i>&nbsp;</a>
								</div>
			<!-- /di v -->
			
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Result'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('clbk_call_reason','select tolong', CallResult(), _get_exist_session('clbk_call_reason'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Gender');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('clbk_gender', 'select tolong', Gender(), _get_exist_session('clbk_gender')) ?></div>

			<div class="ui-widget-form-cell text_caption"><?php echo lang('Phone Value');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('clbk_value_phone_by','input_text tolong',_get_exist_session('clbk_value_phone_by'));?></div>
			
			<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Recsource'));?></div>
								<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
								<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;" id="filter-recsource-div">
									<?php //echo form()->combo('src_customerabd_recsource','select long cz-autocomplete', Recsource(), get_cokie_array('src_customerabd_recsource'), null, array('multiple'=>'multiple' ) );?>
									<?php echo form()->combo('src_customerabd_recsource','long');?>
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
	
	
	
	
	