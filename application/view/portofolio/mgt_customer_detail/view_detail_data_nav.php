<?php echo javascript(); ?>
<script type="text/javascript">

Ext.document('document').ready( function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 }); 
 
/* create object **/
	
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
		
/* catch of requeet accep browser **/

var Reason 		= [],
	datas  		=  { keywords  : '<?php echo _get_post('keywords');?>' },
	navigation	= {
		custnav	 : Ext.DOM.INDEX +'/MgtDetailData/index/',
		custlist : Ext.DOM.INDEX +'/MgtDetailData/Content/',
	};
		
/* assign show list content **/

Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();
	
 var gotoDetailCustomer = function(){
	var arrCallRows  = Ext.Cmp('chk_cust_call').getValue();
	if( arrCallRows!='')
	{	
		if( arrCallRows.length == 1 ) {
			Ext.Ajax
			({
				url    : Ext.DOM.INDEX +'/MgtDetailData/DetailContent/',
				method : 'GET',
				param  : {
					ControllId : Ext.DOM.INDEX +'/MgtDetailData/index/',
					CustomerId : arrCallRows
				}
			}).load('main_content');
		}
		else{
			alert("Select a customer!")
			return false;
		}
					
	}
	else{
		alert("No customer has been selected!");
		return false;
	}	
}

Ext.DOM.searchCustomer = function()
{
	Ext.EQuery.construct(navigation,{
		keywords : Ext.Cmp('v_result_customers').getValue()
	})
	Ext.EQuery.postContent();
}
	
Ext.DOM.resetSeacrh = function(){
	Ext.Cmp('v_result_customers').setValue('');
}	
	
/* memanggil Jquery plug in */
$(function(){

	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['* Keywords'],['Search'],['Customer Detail'],['Clear']],
		extMenu   : [[],['searchCustomer'],['gotoDetailCustomer'],['resetSeacrh']],
		extIcon   : [[],['zoom.png'],['user_go.png'],['cancel.png']],
		extText   : true,
		extInput  : true,
		extOption : [{
			render : 1,
			type   : 'text',
			value  : datas.keywords,
			width  : 250, 		
			id     : 'v_result_customers', 	
			name   : 'v_result_customers'
		}]
	});
	
	$('#cust_dob').datepicker({showOn: 'button', buttonImage: '../gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',readonly:true});
});
		
		
	</script>
	
<!-- start : content -->
<fieldset class="corner">
	<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span></legend>	
	<div id="span_top_nav"></div>
	<div id="toolbars"></div>
	<div id="customer_panel" class="box-shadow">
		<div class="content_table" ></div>
		<div id="pager"></div>
	</div>
</fieldset>	