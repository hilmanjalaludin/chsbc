<?php echo javascript(); ?>
<script type="text/javascript">
/*
 ** javscript prototype system
 ** version v.0.1
 */

Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })(); 
 
 
/*
 ** javscript prototype system
 ** version v.0.1
 */ 
 
Ext.DOM.Reason = [];
Ext.DOM.datas  = {}
Ext.DOM.handling = '<?php echo _get_session('HandlingType'); ?>';
Ext.EQuery.TotalPage = <?php echo $page->_get_total_page(); ?>;
Ext.EQuery.TotalRecord 	= <?php echo $page->_get_total_record(); ?>;

/*
 ** javscript prototype system
 ** version v.0.1
 */ 
 
Ext.DOM.datas = 
 {
	src_cust_name 	 	: '<?php echo _get_exist_session('src_cust_name');?>',
	src_gender	 	 	: '<?php echo _get_exist_session('src_gender'); ?>',
	src_campaign_name 	: '<?php echo _get_exist_session('src_campaign_name');?>', 
	src_customer_number : '<?php echo _get_exist_session('src_customer_number');?>',  
	src_customer_city	: '<?php echo _get_exist_session('src_customer_city');?>',
	src_customer_cif	: '<?php echo _get_exist_session('src_customer_cif');?>',
	src_customer_recsource	: '<?php echo _get_exist_session('src_customer_recsource');?>',
	src_value_phone_by	: '<?php echo _get_exist_session('src_value_phone_by');?>',
	src_filter_phone_by	: '<?php echo _get_exist_session('src_filter_phone_by');?>',
	src_call_reason     : '<?php echo _get_exist_session('src_call_reason');?>',
	src_user_id 		: '<?php echo _get_exist_session('src_user_id');?>',
	src_user_agent		: '<?php echo _get_exist_session('src_user_agent');?>',
	src_start_date		: '<?php echo _get_exist_session('src_start_date');?>',
	src_end_date		: '<?php echo _get_exist_session('src_end_date');?>',
	order_by 			: '<?php echo _get_exist_session('order_by');?>',
	type	 			: '<?php echo _get_exist_session('type');?>'
}
			
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 
 
Ext.DOM.navigation = 
{
	custnav  : Ext.DOM.INDEX+'/Expireddata/index/',
	custlist : Ext.DOM.INDEX+'/Expireddata/Content/',
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/ 	
 
Ext.EQuery.construct(navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();


// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
 
 Ext.DOM.SetFollowUp = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['Expireddata','SetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
}

// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
Ext.DOM.searchCustomer = function() {
	var frmFilterBy = Ext.Serialize("FrmCustomerCall").getElement();
	// console.log(frmFilterBy);
	
	Ext.EQuery.construct( navigation, Ext.Join([  
			Ext.Serialize("FrmCustomerCall").getElement() 
		]).object() );
	
	Ext.EQuery.postContent();
}
// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
Ext.DOM.resetSeacrh = function(){
	Ext.Serialize('FrmCustomerCall').Clear();
	Ext.DOM.searchCustomer();
}
		
// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
Ext.DOM.getAge = function( CustomerId ){
	return( Ext.Ajax  ({
				url 	: Ext.EventUrl(new Array('Expireddata', 'get_age') ).Apply(), 
				method 	:'GET',
				param 	: { 
					CustomerId : CustomerId
					// Date  : ( typeof( Date ) !='undefined' ? Date : '' )
				},
			}).json()
		);
}
 
  Ext.DOM.gotoCallCustomer = function( CustomerId )
{
	if( CustomerId!='') 
	{
		var age = Ext.DOM.getAge(CustomerId);
		// start commit 42e3107d 
		//if(age.age>60){
			//alert("Usia Customer lebih/sama dengan 60 tahun");
		//}else{
			// var response = Ext.DOM.SetFollowUp(CustomerId);
			// if( response.success == 1){
				// alert(CustomerId);
				Ext.ActiveMenu().NotActive();
				Ext.ShowMenu( new Array('Expireddata','ContactDetail'), 
				Ext.System.view_file_name(), 
				{
					CustomerId : CustomerId,
					ControllerId : 'Expireddata'
				}); 
			// } else {
				// Ext.Msg('Sorry, Data On Followup by other User ').Info();
			// }
		//}
		// end commit 42e3107d 
	}
	else{ Ext.Msg("No Customers Selected !").Info(); }	
 }

 Ext.DOM.StartDial = function(){
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/CallAutoDial/start_autodial/',
		method 	: 'POST',
		param 	: Ext.Join([  
			Ext.Serialize("FrmCustomerCall").getElement() 
		]).object(),
		ERROR  	: function(fn){
			Ext.Util(fn).proc(function(save){
				if( save.success ) {
						Ext.Ajax
						({
							url 	: Ext.DOM.INDEX +'/CallAutoDial/get_next_data/',
							method 	: 'POST',
							param 	: {
								AutoKey : save.autokey
							},
							ERROR  	: function(fn){
								Ext.Util(fn).proc(function(croot){
									if( croot.result ) {
										var response = Ext.DOM.SetFollowUp(croot.detail.CustomerId);
										Ext.ActiveMenu().NotActive();
										$('#main_content').load( Ext.EventUrl(["CallAutoDial","start_autocall"]).Apply(), {
											CustomerId 	 : croot.detail.CustomerId,
											PhoneNum 	 : croot.detail.AutoDialNum,
											AutoKey 	 : croot.detail.AutoDialKey,
											ControllerId : 'Expireddata'
										}, function( response, status, xhr ) {
											if( status == 'error') { 
												$('#main_content').html(response);	 
											}
										});
									}
								});
							}
						}).post();
				}
				else{
					alert('There\'s no data to be follow up!');
					return false;
				}
			});
		}
	}).post();
 }
 
		

/*
 ** javscript prototype system
 ** version v.0.1
 */ 
$(function()
{
	// extTitle : [['Search'],['Clear'],['Start Dial']],
	// extMenu  : [['searchCustomer'],['resetSeacrh'],['StartDial']],
	// extIcon  : [['zoom.png'],['cancel.png'],['table_refresh.png']],
	$('#toolbars').extToolbars({
			extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
			extTitle : [['Search'],['Clear']],
			extMenu  : [['searchCustomer'],['resetSeacrh']],
			extIcon  : [['zoom.png'],['cancel.png']],
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
			
	$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
	$('.select').chosen();
});
		
		
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
<div id="result_content_add" class="ui-widget-panel-form" > 
	<form name="FrmCustomerCall">
		<div class="ui-widget-form-table-compact" style="margin:0 10px;">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell" style="vertical-align:top;">
					<div class="ui-widget-form-table-compact">
						<div class="ui-widget-form-row baris-1">
							<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell left"><?php echo form() -> input('src_cust_name','input_text long', _get_exist_session('src_cust_name'));?></div>
							
							<div class="ui-widget-form-cell text_caption"><?php echo lang('Gender');?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell left"><?php echo form() -> combo('src_gender', 'select long', Gender(), _get_exist_session('src_gender')) ?></div>
							
							<div class="ui-widget-form-cell text_caption"><?php echo lang('Agent ID');?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell left"><?php echo form() -> combo('src_user_agent','select long',User(), _get_exist_session('src_user_agent'));?></div>
						</div>
						<div class="ui-widget-form-row baris-1">
							<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('src_campaign_name','select long', Campaign(), _get_exist_session('src_campaign_name'));?></div>
							
							<div class="ui-widget-form-cell text_caption"><?php echo lang(array('City'));?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('src_customer_city','input_text long',  _get_exist_session('src_customer_city'));?></div>
							
							<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Interval'));?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell text_caption left"> 
								<?php echo form()->input('src_start_date','input_text date',_get_exist_session('src_start_date'));?><?php echo lang('to');?>
								<?php echo form()->input('src_end_date','input_text date',_get_exist_session('src_end_date'));?>
							</div>
						</div>
						<div class="ui-widget-form-row baris-1">
							<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Phone'));?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('src_value_phone_by','input_text long',  _get_exist_session('src_value_phone_by'));?></div>
						
							<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Mobile Phone'));?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form() -> input('src_filter_phone_by','input_text long',  _get_exist_session('src_filter_phone_by'));?></div>
						</div>
					</div>
				</div>
				<div class="ui-widget-form-cell" style="vertical-align:top;">
					<div class="ui-widget-form-table-compact">
						<div class="ui-widget-form-row baris-1">
							<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Recsource'));?></div>
							<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
							<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;"><?php echo form() -> listcombo('src_customer_recsource','select long',  $recs, explode(',',_get_exist_session('src_customer_recsource')) );?></div>
							
							<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Call Result'));?></div>
							<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
							<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;"><?php echo form() -> listcombo('src_call_reason','select long', $callreason, explode(',',_get_exist_session('src_call_reason')) );?></div>
						</div>
					</div>
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
	
	
	
	
	