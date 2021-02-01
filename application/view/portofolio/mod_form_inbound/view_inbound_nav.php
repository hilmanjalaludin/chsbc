<?php echo javascript(); ?>
<script type="text/javascript">

 
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
Ext.DOM.Reason 		= [];
Ext.DOM.datas  	 	= {}
Ext.DOM.handling 	= '<?php echo $this -> EUI_Session -> _get_session('HandlingType'); ?>';
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
Ext.DOM.datas = 
 {
	cust_name 	 	: '<?php echo _get_exist_session('cust_name');?>',
	gender	 	 	: '<?php echo _get_exist_session('gender'); ?>',
	card_type 	 	: '<?php echo _get_exist_session('card_type');?>',
	campaign_name 	: '<?php echo _get_exist_session('campaign_name');?>', 
	call_reason     : '<?php echo _get_exist_session('call_reason');?>',
	user_id 		: '<?php echo _get_exist_session('user_id');?>',
	order_by 		: '<?php echo _get_exist_session('order_by');?>',
	type	 		: '<?php echo _get_exist_session('type');?>',
	product_id		: '<?php echo _get_exist_session('product_id');?>'
}
			
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
Ext.DOM.navigation = 
{
	custnav  : Ext.DOM.INDEX+'/ModFormInbound/Inbound/',
	custlist : Ext.DOM.INDEX+'/ModFormInbound/Content/',
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 	
 
Ext.EQuery.construct(navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();

/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
var searchCustomer = function()
{

 var cust_name 	  = Ext.Cmp('cust_name').getValue();
 var gender	 	  = Ext.Cmp('gender').getValue();
 var card_type 	  = Ext.Cmp('card_type').getValue();
 var campaign_name = Ext.Cmp('campaign_name').getValue();
 var call_reason	  = Ext.Cmp('call_reason').getValue();
 var product_id	  = Ext.Cmp('product_id').getValue();
	
	datas = {
		cust_name : cust_name,
		gender : gender,
		card_type : card_type,
		campaign_name : campaign_name,
		call_reason	  : call_reason,
		product_id	: product_id	
			
	}
				
	Ext.EQuery.construct(navigation,datas)
	Ext.EQuery.postContent()
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
Ext.DOM.resetSeacrh = function() 
{

	if( doJava.destroy())
	{
		doJava.init = [['cust_name'],['gender'],['card_type'],['campaign_name'],['call_reason'],['product_id']]
		doJava.setValue('');	
	}
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
 Ext.DOM.gotoCallCustomer = function()
 {
	var CustomerId  = Ext.Cmp('CustomerId').getChecked();
	if( CustomerId!='')
	{	
		if( CustomerId.length == 1 ) {
			Ext.EQuery.Ajax
			({
				url 	: Ext.DOM.INDEX +'/SrcCustomerList/ContactDetail/',
				method  : 'GET',
				param 	: {
					CustomerId : CustomerId,
					ControllerId : Ext.DOM.INDEX +'/ModFormInbound/Inbound',
				}
			});
		}
		else{ Ext.Msg("Select One Customers !").Info(); }			
	}
	else{ Ext.Msg("No Customers Selected !").Info(); }	
 }
		
Ext.DOM.FormInbound = function()
{
	Ext.EQuery.Ajax
	({
		url : Ext.DOM.INDEX+'/ModFormInbound/index/',
		method : 'GET',
		param :{
			act:'new-call',
		}
	});
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
		$(function(){
			$('#toolbars').extToolbars({
				extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
				extTitle : [['Search'],['Go to Call '],['Clear'],['Inbound Form']],
				extMenu  : [['searchCustomer'],['gotoCallCustomer'],['resetSeacrh'],['FormInbound']],
				extIcon  : [['zoom.png'],['telephone_go.png'],['cancel.png'],['app.png']],
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
			
			$('#cust_dob').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY + '/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',readonly:true});
		});
		
		
	</script>
<!-- start : content -->
<fieldset class="corner">
<legend class="icon-customers">&nbsp;&nbsp;Call List</legend>	
 <div id="result_content_add" class="box-shadow" style="padding-bottom:4px;margin-top:2px;margin-bottom:8px;">
	<table cellpadding="8px;">
		<tr>
			<td class="text_caption"> Customer Name</td>
			<td><?php echo form() -> input('cust_name','input_text long', $this-> URI -> _get_post('cust_name'));?></td>
			<td class="text_caption"> Gender</td>
			<td><?php echo form() -> combo('gender', 'select long', (isset($GenderId) ? $GenderId : null), $this-> URI -> _get_post('gender')) ?></td>
			<td class="text_caption"> Product Name</td>
			<td><?php echo form() -> combo('product_id','select long',(isset($ProductId)? $ProductId :null ), $this-> URI -> _get_post('product_id'));?></td>			
		</tr>
		<tr>
			<td class="text_caption"> Card Type</td>
			<td><?php echo form() -> combo('card_type', 'select long',(isset($CardType)?$CardType :null ) , $this-> URI -> _get_post('card_type')) ?> </td>
			<td class="text_caption"> Call Reason</td>
			<td><?php echo form() -> combo('call_reason','select auto', (isset($CallResult)?$CallResult :null ) , $this-> URI -> _get_post('call_reason'));?></td>
			<td class="text_caption"> Campaign Name</td>
			<td><?php echo form() -> combo('campaign_name','select long', (isset($CampaignId)? $CampaignId:null), $this-> URI -> _get_post('campaign_name'));?></td>
		</tr>
	</table>
</div>
<div id="toolbars"></div>
<div id="customer_panel" class="box-shadow" style="background-color:#FFFFFF;">
<div class="content_table" ></div>
<div id="pager"></div>
</div>
</fieldset>	
		
	<!-- stop : content -->
	
	
	
	
	