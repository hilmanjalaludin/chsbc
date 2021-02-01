<?php echo javascript(); ?>
<script type="text/javascript">

Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
}); 
 	
	
Ext.DOM.datas = {
 aprv_cust_name 		: "<?php echo _get_exist_session('aprv_cust_name');?>",
 aprv_customer_number 	: "<?php echo _get_exist_session('aprv_customer_number');?>",
 aprv_end_date			: "<?php echo _get_exist_session('aprv_end_date');?>",
 aprv_start_date		: "<?php echo _get_exist_session('aprv_start_date');?>",
 aprv_user_agent		: "<?php echo _get_exist_session('aprv_user_agent');?>",
 order_by				: "<?php echo _get_exist_session('order_by');?>",
 type					: "<?php echo _get_exist_session('type');?>"
 
}

Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
	
	
/* assign navigation filter **/

var navigation = {
	custnav  : Ext.DOM.INDEX +'/ModApprovePhone/index/',
	custlist : Ext.DOM.INDEX +'/ModApprovePhone/Content/',
}
		
/* assign show list content **/

Ext.EQuery.construct(navigation,datas);
Ext.EQuery.postContentList();

// -----------------------------------------------------------------------------------------------------
/*
 * @ package 	: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */	
 
 Ext.DOM.Search= function()
{
	$.cookie('selected', 0);
	var FrmAprvPhoneList = Ext.Serialize('FrmAprvPhoneList');
	Ext.EQuery.construct(navigation,
		Ext.Join( new Array(FrmAprvPhoneList.getElement()) ).object()
	);
	Ext.EQuery.postContent();
}


// -----------------------------------------------------------------------------------------------------
/*
 * @ package 	: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */	
 
 Ext.DOM.Clear= function(){
	Ext.Serialize('FrmAprvPhoneList').Clear();
	Ext.DOM.Search(); 
 }

 Ext.DOM.Approve= function() {
	var ApprovePhone = $("#ApprovalHistoryId:checked");
	var ValueApprove = $(ApprovePhone).val();
	if ( ValueApprove != "" ) {
		//alert(ValueApprove);
		
		/*
			[ApproveItemId] => 334
            [req_ts_agent] => PRATAMA BUDI SAPUTRA
            [req_ts_dates] => 04-10-2016 11:10:11
            [req_ts_phone] => 02127838200
            [ApprovalStatus] => 1 // Approve
            [CustomerId] => 62996
            [CustomerNumber] => 043-241272
            [CustomerFirstName] => WELLY WELLYEM
            [CustomerDOB] => 09-11-1985
            [CustomerAddressLine3] => 
            [CustomerCity] => 
            [CustomerZipCode] => 
            [CardTypeId] => 
            [GenderId] => 1
            [CustomerAddressLine1] => 
            [CustomerAddressLine2] => 
		*/
		if ( confirm("Are you sure to Approve ? ") ) {			
	 		var getUrlJson = Ext.DOM.INDEX + "/ModApprovePhone/GetDetailJson/";

	 		$.ajax({
	 			url : getUrlJson , 
	 			type : "POST" ,
	 			data : {
 					ApproveId : ValueApprove 
 				} ,  
	 			dataType : "json" ,
	 			success : function (dat) {
	 				/**
	 				 *  'Customers' 	    => $cst->_getDetailCustomer( $CustomerId ),
					 *	'Phones' 			=> $cst->_getPhoneCustomer( $CustomerId ),
					 *	'AddPhone' 			=> $cst->_getApprovalPhoneItems( $CustomerId ),
					 *	'ItemApprove'		=> $obj->_getAllApprovalItems()
	 				 */
	 					//console.log(dat);

	 					var SendToApprove = {
							ApproveItemId : ValueApprove,
							req_ts_agent : dat.ItemApprove.full_name,
							req_ts_dates : dat.ItemApprove.ApprovalCreatedTs,
							req_ts_phone : dat.ItemApprove.ApprovalOldValue,
							ApprovalStatus : 1,
							CustomerId : dat.Customers.CustomerId,
							CustomerNumber : dat.Customers.CustomerNumber,
							CustomerFirstName : dat.Customers.CustomerFirstName,
							CustomerDOB : dat.Customers.CustomerDOB,
							CustomerCity : dat.Customers.CustomerCity,
							CustomerZipCode : dat.Customers.CustomerZipCode,
							CardTypeId : dat.Customers.CardTypeId,
							GenderId : dat.Customers.GenderId,
							CustomerAddressLine1 : dat.Customers.CustomerAddressLine1,
							CustomerAddressLine2 : dat.Customers.CustomerAddressLine1 , 
							CustomerAddressLine3 : dat.Customers.CustomerAddressLine3
						};

						//console.log(SendToApprove);

						var urlSend = Ext.DOM.INDEX + "/ModApprovePhone/ApproveItem/";
						var SendDataApprove = {
							url : urlSend , 
							type : "POST" , 
							dataType : "json" , 
							data : SendToApprove , 
							success : function (data) {
								if ( data.success ) {
									alert("Success Approve!");
								}
							} 
						};
						$.ajax(SendDataApprove);
						// end send 
	 				} 
	 		});
		} 
		
	} else {
		
	}
 }

  
 Ext.DOM.Reject= function() {
	var ApprovePhone = $("#ApprovalHistoryId:checked");
	var ValueApprove = $(ApprovePhone).val();
	if ( ValueApprove != "" ) {
		//alert(ValueApprove);
		
		/*
			[ApproveItemId] => 334
            [req_ts_agent] => PRATAMA BUDI SAPUTRA
            [req_ts_dates] => 04-10-2016 11:10:11
            [req_ts_phone] => 02127838200
            [ApprovalStatus] => 1 // Approve
            [CustomerId] => 62996
            [CustomerNumber] => 043-241272
            [CustomerFirstName] => WELLY WELLYEM
            [CustomerDOB] => 09-11-1985
            [CustomerAddressLine3] => 
            [CustomerCity] => 
            [CustomerZipCode] => 
            [CardTypeId] => 
            [GenderId] => 1
            [CustomerAddressLine1] => 
            [CustomerAddressLine2] => 
		*/
		if ( confirm("Are you sure to Reject ? ") ) {			
	 		var getUrlJson = Ext.DOM.INDEX + "/ModApprovePhone/GetDetailJson/";

	 		$.ajax({
	 			url : getUrlJson , 
	 			type : "POST" ,
	 			data : {
 					ApproveId : ValueApprove 
 				} ,  
	 			dataType : "json" ,
	 			success : function (dat) {
	 				/**
	 				 *  'Customers' 	    => $cst->_getDetailCustomer( $CustomerId ),
					 *	'Phones' 			=> $cst->_getPhoneCustomer( $CustomerId ),
					 *	'AddPhone' 			=> $cst->_getApprovalPhoneItems( $CustomerId ),
					 *	'ItemApprove'		=> $obj->_getAllApprovalItems()
	 				 */
	 					//console.log(dat);

	 					var SendToApprove = {
							ApproveItemId : ValueApprove,
							req_ts_agent : dat.ItemApprove.full_name,
							req_ts_dates : dat.ItemApprove.ApprovalCreatedTs,
							req_ts_phone : dat.ItemApprove.ApprovalOldValue,
							ApprovalStatus : 3,
							CustomerId : dat.Customers.CustomerId,
							CustomerNumber : dat.Customers.CustomerNumber,
							CustomerFirstName : dat.Customers.CustomerFirstName,
							CustomerDOB : dat.Customers.CustomerDOB,
							CustomerCity : dat.Customers.CustomerCity,
							CustomerZipCode : dat.Customers.CustomerZipCode,
							CardTypeId : dat.Customers.CardTypeId,
							GenderId : dat.Customers.GenderId,
							CustomerAddressLine1 : dat.Customers.CustomerAddressLine1,
							CustomerAddressLine2 : dat.Customers.CustomerAddressLine1 , 
							CustomerAddressLine3 : dat.Customers.CustomerAddressLine3
						};

						//console.log(SendToApprove);

						var urlSend = Ext.DOM.INDEX + "/ModApprovePhone/ApproveItem/";
						var SendDataApprove = {
							url : urlSend , 
							type : "POST" , 
							dataType : "json" , 
							data : SendToApprove , 
							success : function (data) {
								if ( data.success ) {
									alert("Success Reject!");
								}
							} 
						};
						$.ajax(SendDataApprove);
						Ext.DOM.Clear();
						// end send 
	 				} 
	 		});
		} 
		
	} else {
		
	}
 }
 
// ------------------------------------------------------------------------------------------------
/*
 * @ package 	 _get_page_number // constructor class 
 * -----------------------------------------
 */	
 
  Ext.DOM.ApproveDetail = function( ApprovalHistoryId ) 
 {
	Ext.ShowMenu(new Array('ModApprovePhone', 'Detail'),
		Ext.System.view_file_name(), 
	{
		ApproveId : ApprovalHistoryId,
		ControllerId : 'ModApprovePhone'
	})
 }

/* load jquery **/

 $(document).ready( function()
{
	$('#toolbars').extToolbars 
	({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle : [['Search'],['Clear'],['Approve'],['Reject']],
		extMenu  : [['Search'],['Clear'],['Approve'],['Reject']],
		extIcon  : [['zoom.png'],['zoom_out.png'],['phone.png'],['delete.png']],
		extText  : true,
		extInput : false,
		extOption: [{
				render	: 0,
				type	: 'text',
				id		: 'v_cmp', 	
				name	: 'v_cmp',
				value	: datas.cbFilter,
				width	: 200
			}]
	});
	
	$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
	$('.select').chosen();
});
		
</script>

<?php  
/**
[ApprovalStatus] => 2 // Reject
EUI_Object Object
(
    [arr_val:private] => 
    [arr_rows:protected] => Array
        (
            [ApproveItemId] => 334
            [req_ts_agent] => PRATAMA BUDI SAPUTRA
            [req_ts_dates] => 04-10-2016 11:10:11
            [req_ts_phone] => 02127838200
            [ApprovalStatus] => 1 // Approve
            [CustomerId] => 62996
            [CustomerNumber] => 043-241272
            [CustomerFirstName] => WELLY WELLYEM
            [CustomerDOB] => 09-11-1985
            [CustomerAddressLine3] => 
            [CustomerCity] => 
            [CustomerZipCode] => 
            [CardTypeId] => 
            [GenderId] => 1
            [CustomerAddressLine1] => 
            [CustomerAddressLine2] => 
        )

    [arr_func_arg:protected] => Array
        (
        )

)
**/
?>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-phone"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
 <form name="FrmAprvPhoneList">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('aprv_cust_name','input_text superlong', _get_exist_session('aprv_cust_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('aprv_user_agent','select superlong',User(), _get_exist_session('aprv_user_agent'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Number'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('aprv_customer_number','input_text superlong', _get_exist_session('aprv_customer_number'));?></div>
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Interval'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"> 
				<?php echo form()->input('aprv_start_date','input_text date',_get_exist_session('aprv_start_date'));?><?php echo lang('to');?>
				<?php echo form()->input('aprv_end_date','input_text date',_get_exist_session('aprv_end_date'));?>
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
<!--	
	<div id="toolbars"></div>
	<div class="content_table"></div>
	<div id="pager"></div>
-->
	
</fieldset>	
	
	
	