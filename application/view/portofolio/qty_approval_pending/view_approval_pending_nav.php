<?php echo javascript(); ?>
<script type="text/javascript">
Ext.document('document').ready( function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 }); 
 	
/* create object default parameter assigning **/

var datas = 
{
	cust_number : '<?php echo ( _have_get_session('cust_number') ? _get_session('cust_number') :_get_post('cust_number'));?>', 
	cust_name 	: '<?php echo ( _have_get_session('cust_name') ? _get_session('cust_name') : _get_post('cust_name'));?>', 
	home_phone  : '<?php echo ( _have_get_session('home_phone') ? _get_session('home_phone') : _get_post('home_phone'));?>', 
	office_phone: '<?php echo ( _have_get_session('office_phone') ? _get_session('office_phone') : _get_post('office_phone'));?>', 
	mobile_phone: '<?php echo ( _have_get_session('mobile_phone') ? _get_session('mobile_phone') : _get_post('mobile_phone'));?>',
	campaign_id : '<?php echo ( _have_get_session('campaign_id') ? _get_session('campaign_id') : _get_post('campaign_id'));?>', 
	call_result : '<?php echo ( _have_get_session('call_result') ? _get_session('call_result') : _get_post('call_result'));?>', 
	user_id 	: '<?php echo ( _have_get_session('user_id') ? _get_session('user_id') : _get_post('user_id'));?>', 
	start_date  : '<?php echo ( _have_get_session('start_date') ? _get_session('start_date') : _get_post('start_date'));?>',
	end_date    : '<?php echo ( _have_get_session('end_date') ? _get_session('end_date') : _get_post('end_date'));?>', 
	order_by 	: '<?php echo ( _have_get_session('order_by') ? _get_session('order_by') : _get_post('order_by'));?>', 
	type	 	: '<?php echo ( _have_get_session('type') ? _get_session('type') : _get_post('type'));?>',
	category_id : '<?php echo ( _have_get_session('category_id') ? _get_session('category_id') : _get_post('category_id'));?>'
}
		
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
	
	
/* assign navigation filter **/
var navigation = {
	custnav : Ext.DOM.INDEX +'/QtyApprovalPending/index/',
	custlist : Ext.DOM.INDEX +'/QtyApprovalPending/Content/',
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
	
/* function searching customers **/
	
var searchCustomer = function()
{
	Ext.EQuery.construct( navigation ,{
		cust_number  : Ext.Cmp('cust_number').getValue(),
		cust_name 	 : Ext.Cmp('cust_name').getValue(),
		home_phone   : Ext.Cmp('home_phone').getValue(),
		office_phone : Ext.Cmp('office_phone').getValue(),
		mobile_phone : Ext.Cmp('mobile_phone').getValue(),
		campaign_id  : Ext.Cmp('campaign_id').getValue(),
		call_result  : Ext.Cmp('call_result').getValue(),
		user_id 	 : Ext.Cmp('user_id').getValue(),
		start_date 	 : Ext.Cmp('start_date').getValue(),
		end_date 	 : Ext.Cmp('end_date').getValue(),
		category_id  : Ext.Cmp('category_id').getValue(),
	});
	
	Ext.EQuery.postContent();
}
	
/* function approve all customer*/
var approveAll = function()
{			
		var cust_id  = Ext.checkedValue('chk_cust_call');
		if( cust_id!='')
		{
			var confirmasi_status = Ext.dom('confirmasi_status').value;
			if( confirmasi_status!='' )
			{
				if( confirm('Do you want to confirm this Customers ? '))
				{
					Ext.File = '../class/class.src.qualitycontrol.php'; 
					Ext.Method = 'POST'
					Ext.Params = { 
						action : 'approve_all',
						status : confirmasi_status,
						cust_id : cust_id
					}
					
					var error = Ext.eJson();
					if( error.result){
						alert('Success, Auto Confirm ..!');
						Ext.EQuery.postContent();
					}
					else{
						alert('Failed, Auto Confirm ..!');
					}
				}
			}
			else{
				alert('Please select a confirm status!'); 
				return false;
			}	
		}
		else{
				alert("No Customers Selected !");
				return false;
			}
	}
		
/* function clear searching form **/	
		
var resetSeacrh = function()
{
	Ext.Cmp('cust_number').setValue('');
	Ext.Cmp('cust_name').setValue('');
	Ext.Cmp('home_phone').setValue('');
	Ext.Cmp('office_phone').setValue('');
	Ext.Cmp('mobile_phone').setValue('');
	Ext.Cmp('campaign_id').setValue('');
	Ext.Cmp('call_result').setValue('');
	Ext.Cmp('user_id').setValue('');
	Ext.Cmp('start_date').setValue('');
	Ext.Cmp('end_date').setValue('');
	Ext.Cmp('category_id').setValue('');
}
  
 /* go to call contact detail customers **/
 
var showPolicy = function()
		{
			var arrCallRows  = Ext.checkedValue('chk_cust_call');
			var arrCountRows = arrCallRows.split(','); 
				if( arrCallRows!='')
				{	
					if( arrCountRows.length == 1 )
					{
						var error_code = validation_check(arrCountRows[0]);
						if( error_code.result==0 || error_code.result==1) 
						{
							Ext.File = 'dta_qc_detail.php';
							Ext.Params = { CustomerId : arrCountRows[0] }
							Ext.EQuery.Content();
						}
						else{ 
							alert('Sorry , Data in Qa Process. Please select other Customers !');
							return false 
						}
					}
					else{
						alert("Select One Customers !")
						return false;
					}
					
				}else{
					alert("No Customers Selected !");
					return false;
				}	
		}
		
/* get confirm by json methode **/
	
	Ext.getConfirmStatus = function()
	{
		Ext.File = '../class/class.src.qualitycontrol.php'; 
		Ext.Params = {
			action:'get_confirm',
		}
		return Ext.eJson();
	} 	
		
	
	/* memanggil Jquery plug in */
	
		$(function(){
			$('#toolbars').extToolbars({
				extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
				extTitle :[['Search'],['Show Policy'],['Clear'],[],[],['Approve All']],
				extMenu  :[['searchCustomer'],['showPolicy'],['resetSeacrh'],[],[],['approveAll']],
				extIcon  :[['zoom.png'],['pencil_go.png'],['cancel.png'],[],[],['vcard_edit.png']],
				extText  :true,
				extInput :true,
				extOption:[
					{
					  render : 3,
					  type	 : 'label',
					  id	 : 'label_confirm',
					  name	 : 'label_confirm',
					  label	 : '<span style="color:#707ba6;"># Confirm Status</span>',
					  
					},{
						render : 4,
						type   : 'combo',
						id     : 'confirmasi_status', 	
						name   : 'confirmasi_status',
						triger : '',
						store  : [] // Ext.getConfirmStatus()
					}]
			});
			$('#start_date,#end_date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',readonly:true});
		});
		
		
</script>
<!-- start : content -->
<fieldset class="corner">
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span></legend>	

<?php

//print_r($_SESSION);
/*
	$this -> getCampaignAssigment()
	$this -> _get_lk_category()
	$this->getResultStatus()
	$this->getUserList()
*/

?>
<div id="span_top_nav">
<div id="result_content_add" class="box-shadow" style="padding-bottom:4px;margin-top:2px;margin-bottom:8px;">
<table cellpadding="3px;">
	<tr>
		<td class="text_caption"> Customer ID</td>
		<td><?php echo form() ->input('cust_number','input_text long',_get_exist_session('cust_number'));?></td>
		<td class="text_caption"> Home Phone</td>
		<td><?php echo form() ->input('home_phone','input_text',_get_exist_session('home_phone'));?></td>
		<td class="text_caption"> Campaign</td>
		<td><?php echo form() ->combo('campaign_id','select long',null,_get_exist_session('campaign_id'));?></td>
		<td class="text_caption"> Product Name</td>
		<td><?php echo form() ->combo('category_id','select long',null,_get_exist_session('category_id'));?></td>
	</tr>
	<tr>
		<td class="text_caption"> Customer Name </td>
		<td><?php echo form() ->input('cust_name','input_text long',_get_exist_session('cust_name'));?></td>
		<td class="text_caption"> Office Phone </td>
		<td><?php echo form() ->input('office_phone','input_text long',_get_exist_session('office_phone'));?></td>
		<td class="text_caption"> Call Result </td>
		<td><?php echo form() ->combo('call_result','select long',null,_get_exist_session('call_result'));?></td>
	</tr>
	<tr>
		<td class="text_caption"> Interval </td>
		<td>
			<?php echo form() ->input('start_date','input_text box',_get_exist_session('start_date'));?>
			<?php echo form() ->input('end_date','input_text box',_get_exist_session('end_date'));?>
		</td>
		<td class="text_caption"> Mobile Phone </td>
		<td><?php echo form() ->input('mobile_phone','input_text long',_get_exist_session('mobile_phone'));?></td>
		<td class="text_caption"> User ID </td>
		<td><?php echo form() ->combo('user_id','select long',null,_get_exist_session('user_id'));?></td>
	</tr>
		</table>
	</div>
 </div>
 <div id="toolbars"></div>
 <div id="customer_panel" class="box-shadow" style="background-color:#FFFFFF;">
	<div class="content_table" ></div>
	<div id="pager"></div>
 </div>
</fieldset>	
		
	<!-- stop : content -->
	
	
	
	
	