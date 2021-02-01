<?php echo javascript(); ?>
<script type="text/javascript">
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })(); 
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
Ext.DOM.Reason = [];
Ext.DOM.datas  = {}
Ext.DOM.handling = '<?php echo _get_session('HandlingType'); ?>';
Ext.EQuery.TotalPage = <?php echo $page->_get_total_page(); ?>;
Ext.EQuery.TotalRecord 	= <?php echo $page->_get_total_record(); ?>;
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 //src_customer_recsource	FFXLJKT_0617A0,FFXLJKT_0617A0G
 
Ext.DOM.datas = 
 {
	src_cust_name 	 		: '<?php echo _get_exist_session('src_cust_name');?>',
	src_gender	 	 		: '<?php echo _get_exist_session('src_gender'); ?>',
	src_campaign_name 		: '<?php echo _get_exist_session('src_campaign_name');?>', 
	src_customer_number 	: '<?php echo _get_exist_session('src_customer_number');?>',  
	src_customer_city		: '<?php echo _get_exist_session('src_customer_city');?>',
	src_customer_cif		: '<?php echo _get_exist_session('src_customer_cif');?>',
	src_customer_keyword	: '<?php echo _get_exist_session('src_customer_keyword');?>',
	src_customer_recsource	: '<?php echo _get_exist_session('src_customer_recsource');?>',
	src_value_phone_by		: '<?php echo _get_exist_session('src_value_phone_by');?>',
	src_filter_phone_by		: '<?php echo _get_exist_session('src_filter_phone_by');?>',
	src_call_reason     	: '<?php echo _get_exist_session('src_call_reason');?>',
	src_user_id 			: '<?php echo _get_exist_session('src_user_id');?>',
	src_user_agent			: '<?php echo _get_exist_session('src_user_agent');?>',
	src_start_date			: '<?php echo _get_exist_session('src_start_date');?>',
	src_end_date			: '<?php echo _get_exist_session('src_end_date');?>',
	order_by 				: '<?php echo _get_exist_session('order_by');?>',
	type	 				: '<?php echo _get_exist_session('type');?>',
	src_param_rcs	 		: '<?php echo _get_exist_session('src_param_name');?>',
	// dis_field_value1		: '<?php echo _get_exist_session('dis_field_value1');?>',
	// dis_field_filter1		: '<?php echo _get_exist_session('dis_field_filter1');?>',
	// dis_field_text1			: '<?php echo _get_exist_session('dis_field_text1');?>'
}
			
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
Ext.DOM.navigation = 
{
	custnav  : Ext.DOM.INDEX+'/SrcCustomerList/index/',
	custlist : Ext.DOM.INDEX+'/SrcCustomerList/Content/',
}
		
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
Ext.EQuery.construct(navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();

// Ext.DOM.paramsrc = function() 
// {
// 	var frmFilterBy = Ext.Serialize("FrmCustomerCall").getElement();
// 	// alert(frmFilterBy['src_param_name']);
// 	$('#src_customer_recsource').toogle 
// 	({ 
// 		url : 'SrcCustomerList/parameter_recsource',
// 		param :  {
// 			time : Ext.Date().getDuration()
// 		},
// 		elval:['src_param_name']
// 	});
// }

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

// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
Ext.DOM.searchCustomer = function() {
	
	var frmFilterBy = Ext.Serialize("FrmCustomerCall").getElement();
	// console.log(frmFilterBy);
	Ext.Progress("load_images_id").start();	
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
	Ext.Progress("load_images_id").start();	
	Ext.DOM.searchCustomer();
}
		
// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
Ext.DOM.getAge = function( CustomerId ){
	return( Ext.Ajax  ({
				url 	: Ext.EventUrl(new Array('SrcCustomerList', 'get_age') ).Apply(), 
				method 	:'GET',
				param 	: { 
					CustomerId : CustomerId
					// Date  : ( typeof( Date ) !='undefined' ? Date : '' )
				},
			}).json()
		);
}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
window.EventDialData = function( CustomerId ) {
	// cek data CustomerId apakah ada ?
	//console.log("deactive this method must be diffrent data ");
	//return false;
	if( CustomerId =='') {
		 Ext.Msg("No Customers Selected !").Info();
		 return false;
	}

	var cek_status_auto_dial = Ext.DOM.cekStatusNoAutoDial(CustomerId);
	if( cek_status_auto_dial.success == "1" ) {
		Ext.Msg('Sorry, Data No Preview ').Info();
		return false;
	}

	// set follow up jika tidak success 	
	var response = Ext.DOM.SetFollowUp(CustomerId);
	if( !response.success ) {
		Ext.Msg('Sorry, Data On Followup by other User ').Info();
		return false;
	}

	// jika success buka detail customer.
	Ext.ActiveMenu().NotActive();
	Ext.ShowMenu( new Array('SrcCustomerList','ContactDetail'), 
	Ext.System.view_file_name(), {
		CustomerId : CustomerId,
		ControllerId : 'SrcCustomerList'
	}); 
}


 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

window.EventAutoStartCall = function() {
	Ext.DOM.datas.limit = 20;
	Ext.DOM.datas.pager = 0;
	Ext.AutoCall({Event : 'SrcCustomerList'}, 
				 {param : Ext.DOM.datas}).Utils.Init();
	
} 

 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 
Ext.DOM.StartDial = function()
{
	// Next Customer CALL Setelah 3 Detik
	var str = $("#AgentStatus").text(); str = str.replace(/"/gi, "");
	var agent_status = str.replace(/\s/g, '');
	if( agent_status != "Ready") {
		alert("Agent Status Not Ready"); return false;
	}

	Ext.Progress("load_images_id").start();	
	window.EventAutoStartCall();

	var stdCls  = new Ext.AutoCall('', {}),
		CustomerId = stdCls.Utils.FirstId(),
		PhoneNum = stdCls.Utils.FirstNum(0,0);
		
	if( !CustomerId ){
		Ext.Msg("row selected is empty!").Info();
		Ext.Progress("load_images_id").stop();	
		return false;	
	}	

	// set follow update 
	var protectedSucess = window.SetFollowUp( CustomerId );
	if( !protectedSucess.success ){
		Ext.Progress("load_images_id").stop();	
		return false;
	}
	console.log( "## CALL CLIK START DIAL");
 	// set data on here like this folowup set 
	Ext.ActiveMenu().NotActive();
	Ext.ShowMenu( new Array('CallAutoDial','start_autocall'), 
	Ext.System.view_file_name(), {
		CustomerId 	 : CustomerId,
		PhoneNum 	 : PhoneNum,
		ControllerId : 'SrcCustomerList'	
	});
	
}

Ext.DOM.ComboPhone = function(){
	// alert('okaay')

}
 
// Ext.DOM.load_Recsource_pull_src = function(obj)
//  {
// 	$('#src_customer_recsource').toogle 
// 	({ 
// 		url : 'SrcCustomerList/filtered_recsource',
// 		param :  {
// 			time : Ext.Date().getDuration()
// 		},
// 		elval:['src_campaign_name','src_customer_keyword']
// 	});
	
// };

Ext.DOM.cekStatusNoAutoDial = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','cekStatusNoAutoDial']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();

	console.log("### cekStatusNoAutoDial");
	console.log(data);
	
	return ( typeof ( data ) == 'object' ? data : {});
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
// $("#src_customer_recsource").toogle({url:'SrcCustomerList/filtered_recsource', param:{time : Ext.Date().getDuration()}, elval:['src_campaign_name','src_customer_keyword']}); 
$(document).ready( function() {
	$('#toolbars').extToolbars({
			extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
			extTitle : [['Search'],['Clear'],['Set Up Phone : '],['Start Dial'],[]],
			extMenu  : [['searchCustomer'],['resetSeacrh'],['ComboPhone'],['StartDial'],[]],
			extIcon  : [['zoom.png'],['cancel.png'],['telephone_go.png'],['telephone_go.png'],[]],
			extText  :true,
			extInput :true,
			extOption:[{
				render : 3,
				type   : 'label',
				label :  '',
				id     : 'load_images_id', 	
				name   : 'load_images_id'
			}]
	});

	$('#ComboPhone').append('<select name="" id="combo"><option>Pilih Setup Phone</option><option value="1">Mobile Phone</option><option value="2">Home</option><option value="3">Office</option><option value="4">Mobile Phone & Home</option><option value="5">Mobile Phone & Office</option></select>')
			
	$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
	$('.select').chosen();
	// $("#src_customer_recsource").toogle({url:'SrcCustomerList/filtered_recsource', param:{time : Ext.Date().getDuration()}, elval:['src_campaign_name','src_customer_keyword']});
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
							<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Call Result'));?></div>
							<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
							<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;">
							<?php echo form()->combo('src_call_reason','select long', CallResultNotInterestBadlead(), 
												get_cokie_array('src_call_reason'), null, array('multiple'=>'multiple' ) );?></div>
						</div>
						
					</div>
					<!-- <div class="ui-widget-form-table-compact">
						<div class="ui-widget-form-row baris-1">	
							<div class="ui-widget-form-cell text_caption"><?php echo lang("Filter 1");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo("dis_field_value1", "select xselect long", FieldValue());?></div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo("dis_field_filter1", "select xselect box", FilterValue(), NULL,NULL, array("style" => "width:100px;"));?></div>
							<div class="ui-widget-form-cell text_caption left"><?php echo form()->textarea("dis_field_text1", "textarea long", NULL, NULL, array('style' => "height:22px;"));?></div> 
						</div>
					</div> -->
				</div>
				
				<?php 
				// if (_get_session('HandlingType') != 4) {
				?>
				
				<div class="ui-widget-form-cell" style="vertical-align:top;">
					<div class="ui-widget-form-table-compact">
						<!-- <div class="ui-widget-form-row baris-1">
							<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Recsource'));?></div>
							<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
							<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;">
							<?php echo form()->input('src_customer_keyword','input_text long', _get_exist_session('src_customer_keyword')  );?>
							</div>
							
							<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;">
								<a href="javascript:void(0);" onclick="Ext.DOM.load_Recsource_pull_src();"> <i class="fa search">&nbsp;</i>&nbsp;</a>
							</div>
							
							
						</div> -->
						
						<div class="ui-widget-form-row baris-1">
							<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang(array('Recsource'));?></div>
							<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
							<div class="ui-widget-form-cell text_caption left" style="vertical-align:top;" id="filter-recsource-div">
								<?php #echo form()->combo('src_customer_recsource','select long cz-autocomplete', Recsource(), get_cokie_array('src_customer_recsource'), null, array('multiple'=>'multiple' ) );?>
								<?php #echo form()->combo('src_customer_recsource','select long', Recsource(), get_cokie_array('src_customer_recsource'));?>
								<?php echo form()->input('src_customer_recsource','input_text long', _get_exist_session('src_customer_recsource')  );?>
							</div>
							 
						</div>
					</div>
				</div>
				<?php
				// }?>
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
	
	
	
	
	