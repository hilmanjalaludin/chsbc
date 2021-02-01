<?php echo javascript(); ?>
	
  <script type="text/javascript">
	/* create object **/
	 var Reason = []
	 var datas  = {}


Ext.document('document').ready( function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 }); 
 
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;
		
	
	/* catch of requeet accep browser **/
	
		datas = {
			cust_number : '<?php echo $this ->URI ->_get_post('cust_number');?>',
			cust_name 	: '<?php echo $this ->URI ->_get_post('cust_name');?>',
			cust_dob 	: '<?php echo $this ->URI ->_get_post('cust_dob');?>', 
			home_phone  : '<?php echo $this ->URI ->_get_post('home_phone');?>',
			office_phone: '<?php echo $this ->URI ->_get_post('office_phone');?>',
			mobile_phone: '<?php echo $this ->URI ->_get_post('mobile_phone');?>', 
			campaign_id : '<?php echo $this ->URI ->_get_post('V_CMP');?>', 
			call_result : '<?php echo $this ->URI ->_get_post('call_result');?>', 
			user_id 	: '<?php echo $this ->URI ->_get_post('user_id');?>'
		}
			
	/* assign navigation filter **/
		
		var navigation = {
		custnav	 : Ext.DOM.INDEX +'/SrcCustomerPolis/index/',
		custlist : Ext.DOM.INDEX +'/SrcCustomerPolis/Content/'
		}
		
	/* assign show list content **/
		
		Ext.EQuery.construct(navigation,datas)
		Ext.EQuery.postContentList();
		
	/* creete object javaclass **/
	
		// doJava.File = '../class/class.src.customers.php' 
		
		// var defaultPanel = function(){
			// if( doJava.destroy() ){
				// doJava.Method = 'POST',
				// doJava.Params = { 
					// action		:'tpl_onready', cust_number : datas.cust_number,
					// cust_name 	: datas.cust_name, cust_dob 	: datas.cust_dob, 
					// home_phone  : datas.home_phone, office_phone: datas.office_phone,
					// mobile_phone: datas.mobile_phone,  campaign_id : datas.campaign_id, 
					// call_result : datas.call_result,  user_id 	: datas.user_id
				// }
				// doJava.Load('span_top_nav');	
			// }
		// } 
		
		// doJava.onReady(
			// evt=function(){ 
			  // defaultPanel();
			// },
		  // evt()
		// )
		
		
	
	/* function searching customers **/
	
		var searchCustomer = function(){
			var cust_number  = doJava.dom('cust_number').value; 
			var cust_name 	 = doJava.dom('cust_name').value;
			var cust_dob 	 = doJava.dom('cust_dob').value;
			var home_phone   = doJava.dom('home_phone').value;
			var office_phone = doJava.dom('office_phone').value;
			var mobile_phone = doJava.dom('mobile_phone').value;
			var campaign_id  = doJava.dom('campaign_id').value;
			var call_result  = doJava.dom('call_result').value;
			var user_id 	 = doJava.dom('user_id').value;	
			
				datas = {
					cust_number : cust_number,
					cust_name 	: cust_name,
					cust_dob 	: cust_dob, 
					home_phone  : home_phone,
					office_phone: office_phone,
					mobile_phone: mobile_phone, 
					campaign_id : campaign_id, 
					call_result : call_result, 
					user_id 	: user_id
				}
				
		    if( campaign_id!=''){  		
				Ext.EQuery.construct(navigation,datas)
				Ext.EQuery.postContent()
			}
			else{
				alert('Please Select Campaign!');
			}
		}
		
	/* function clear searching form **/	
		
		var resetSeacrh = function(){
			if( doJava.destroy() ){
				doJava.init = [
								['cust_number'], ['cust_name'],
								['cust_dob'], ['home_phone'],
								['office_phone'], ['mobile_phone'],
								['campaign_id'], ['call_result'],
								['user_id']
							  ]
				doJava.setValue('');	
			}
		}
  /* edit policy **/
	var editPolicy = function(){
		var arrCallRows  = doJava.checkedValue('chk_cust_call');
		var arrCountRows = arrCallRows.split(','); 
			if( arrCallRows!='')
			{	
				if( arrCountRows.length == 1 )
				{
						arrCallRows = arrCountRows[0].split('_'); 
						
						if( (arrCallRows[2]==16) || (arrCallRows[2]==17))
						{
							doJava.Params = {
								action		:'create_policy',
								campaignid	:(arrCallRows[1]?arrCallRows[1]:''),
								customerid	:(arrCallRows[0]?arrCallRows[0]:''),
								callstatus	:(arrCallRows[2]=='16'?'401':'402')
							}
							
							doJava.winew.winconfig={
								location	: 'frm.edit.policy.php?'+doJava.ArrVal(),
								width		: $(window).width(),
								height		: $(window).height(),
								windowName	: 'windowName1',
								resizable	: false, 
								menubar		: false, 
								scrollbars	: true, 
								status		: false, 
								toolbar		: false
							};
							doJava.winew.open();  
			
						}
						else{ alert('Please Select other status!'); return false;}
					}
					else{ alert("Select One Customers !"); return false;}
					
			}
			else{ alert("No Customers Selected !"); return false;}	
	}
		
 /* go to call contact detail customers **/
 
		var gotoCallCustomer = function(){
			var arrCallRows  = doJava.checkedValue('chk_cust_call');
			var arrCountRows = arrCallRows.split(','); 
				if( arrCallRows!='')
				{	
					if( arrCountRows.length == 1 )
					{
						arrCallRows = arrCountRows[0].split('_'); 
						
						if( (arrCallRows[2]!='16') &&  (arrCallRows[2]!='17'))
						{
							var el_menu = doJava.dom('src_menu');
								el_menu.href='javascript:void(0);';
								el_menu.style.color='#dddddd';
							
							Ext.EQuery.contactDetail(arrCallRows[0],arrCallRows[1])
						}
						else{
							alert('Please Select other status!');
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
		
	
	/* memanggil Jquery plug in */
	
		$(function(){
			
			$('#toolbars').extToolbars({
				extUrl   :Ext.DOM.LIBRARY+'/gambar/icon',
				extTitle :[['Search'],['Edit Policy'],['Clear']],
				extMenu  :[['searchCustomer'],['editPolicy'],['resetSeacrh']],
				extIcon  :[['zoom.png'],['calendar_edit.png'], ['cancel.png']],
				extText  :true,
				extInput :true,
				extOption:[{
						render : 4,
						type   : 'combo',
						header : 'Call Reason ',
						id     : 'v_result_customers', 	
						name   : 'v_result_customers',
						triger : '',
						store  : Reason
					}]
			});
			
			$('#cust_dob').datepicker({showOn: 'button', buttonImage: '../gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',readonly:true});
		});
		
		
	</script>
	
	
<!-- start : content -->
<fieldset class="corner">
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span></legend>	
	<div id="span_top_nav" class="box-shadow" style="padding-bottom:4px;margin-top:2px;margin-bottom:8px;" >
		<table cellpadding="8px;">
			<tr>
				<td class="text_caption"> Customer Name</td>
				<td><?php echo form() -> input('cust_name','input_text long', $this-> URI -> _get_post('cust_name'));?></td>
				<td class="text_caption"> Gender</td>
				<td><?php echo form() -> combo('gender', 'select long', ( isset($GenderId)? $GenderId : null), $this-> URI -> _get_post('gender')) ?></td>
				<td class="text_caption"> Product Name</td>
				<td><?php echo form() -> combo('product_id','select long',(isset($ProductId)? $ProductId: null), $this-> URI -> _get_post('product_id'));?></td>			
			</tr>
			<tr>
				<td class="text_caption"> Card Type</td>
				<td><?php echo form() -> combo('card_type', 'select long', (isset($CardType)?$CardType:null), $this-> URI -> _get_post('card_type')) ?> </td>
				<td class="text_caption"> Call Reason</td>
				<td><?php echo form() -> combo('call_reason','select auto', (isset($CallResult)?$CallResult:null), $this-> URI -> _get_post('call_reason'));?></td>
				<td class="text_caption"> Campaign Name</td>
				<td><?php echo form() -> combo('campaign_name','select long', (isset($CampaignId)?$CampaignId:null), $this-> URI -> _get_post('campaign_name'));?></td>
			</tr>
		</table>
	</div>
	<div id="toolbars"></div>
	<div id="customer_panel" class="box-shadow" style="background-color:#FFFFFF;">
		<div class="content_table"></div>
		<div id="pager"></div>
	`</div>
</fieldset>	
		
	<!-- stop : content -->
	
	
	
	
	