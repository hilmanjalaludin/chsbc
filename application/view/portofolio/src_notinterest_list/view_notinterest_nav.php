<?php

	// require(dirname(__FILE__)."/../sisipan/sessions.php");
	// require(dirname(__FILE__)."/../fungsi/global.php");
	// require(dirname(__FILE__)."/../class/MYSQLConnect.php");
	// require(dirname(__FILE__)."/../class/class.nav.table.php");
	// require(dirname(__FILE__)."/../class/class.application.php");
	// require(dirname(__FILE__).'/../sisipan/parameters.php');
	
	// SetNoCache();
	

// /** set general query SQL ****/

	// $sql = "SELECT 
			// a.CustomerId, a.CustomerFirstName, e.Gender, a.CustomerDOB, c.CardTypeDesc
			// FROM t_gn_customer a
			// INNER JOIN t_gn_assignment b on a.CustomerId=b.CustomerId 
			// LEFT JOIN t_lk_gender e ON a.GenderId=e.GenderId
			// LEFT JOIN t_lk_cardtype c ON a.CardTypeId=c.CardTypeId
			// LEFT JOIN t_gn_campaign d on a.CampaignId=d.CampaignId 
			// LEFT JOIN t_lk_callreason f on a.CallReasonId = f.CallReasonId ";
	
// /** not valid page if not search **/

	// $NavPages -> setPage(10);
	// $NavPages -> query($sql);
	
 // /** set filter **/
 
	// $filter =  " AND b.AssignAdmin is not null 
				 // AND b.AssignMgr is not null 
				 // AND b.AssignSpv is not null
				 // AND a.CallReasonId IN('".$db -> Entity -> NotInterestWithIn()."') 
				 // AND b.AssignBlock=0 
				 // and d.CampaignStatusFlag=1";
				 
// /** custom filtering data **/
	
	// if( $db->getSession('handling_type')==3 )			 
		// $filter.=" AND b.AssignSpv ='".$db -> getSession('UserId')."' ";
		
	// if( $db->getSession('handling_type')==4)
		// $filter.=" AND b.AssignSelerId = '".$db->getSession('UserId')."'";
				 

// /** filtering custname **/
				 
	// if( $db->havepost('cust_name_notnit')) {
		// $filter.=" AND a.CustomerFirstName LIKE '%".$db->escPost('cust_name_notnit')."%'"; 
		// $db -> Session -> replace_session('cust_name_notnit',$db->escPost('cust_name_notnit'));
	// }
	// else{
		// if(!isset($_REQUEST['cust_name_notnit'])){
			// if($db -> Session -> have_get_session('cust_name_notnit') )
			// $filter.=" AND a.CustomerFirstName LIKE '%".$db->Session -> get_session('cust_name_notnit')."%'"; 
		// }
		// elseif(isset($_REQUEST['cust_name_notnit']) && $_REQUEST['cust_name_notnit']==''){
			// $db -> Session -> deleted_session('cust_name_notnit');	
		// }
	// }
	
// /** filtering gender**/

	// if( $db->havepost('gender_notnit') ){
		// $filter.=" AND a.GenderId = '".$db->escPost('gender_notnit')."'"; 
		// $db -> Session -> replace_session('gender_notnit',$db->escPost('gender_notnit'));
	// }
	// else
	// {
		// if(!isset($_REQUEST['gender_notnit'])){
			// if($db -> Session -> have_get_session('gender_notnit') )
			// $filter.=" AND a.GenderId = '".$db->Session -> get_session('gender_notnit')."'"; 
		// }
		// elseif(isset($_REQUEST['gender_notnit']) && $_REQUEST['gender_notnit']==''){
			// $db -> Session -> deleted_session('gender_notnit');	
		// }
	// }
	
/** filtering card_type **/
	
	// if( $db->havepost('card_type_notnit')) {
		// $filter.=" AND c.CardTypeId = '".$db->escPost('card_type_notnit')."'"; 
		// $db -> Session -> replace_session('card_type_notnit',$db->escPost('card_type_notnit'));
	// }
	// else
	// {
		// if(!isset($_REQUEST['card_type_notnit'])){
			// if($db -> Session -> have_get_session('card_type_notnit') )
			// $filter.=" AND c.CardTypeId = '".$db->Session -> get_session('card_type_notnit')."'"; 	
		// }
		// elseif(isset($_REQUEST['card_type_notnit']) && $_REQUEST['card_type_notnit']==''){
			// $db -> Session -> deleted_session('card_type_notnit');	
		// }
	// }
	
/** filtering call_reason **/

	// if( $db->havepost('call_reason_notnit') ){
		// $filter.=" AND a.CallReasonId ='".$db->escPost('call_reason_notnit')."'";
		// $db -> Session -> replace_session('call_reason_notnit',$db->escPost('call_reason_notnit'));
	// }
	// else{
		// if(!isset($_REQUEST['call_reason_notnit'])){
			// if($db -> Session -> have_get_session('call_reason_notnit') )
			// $filter.=" AND a.CallReasonId ='".$db->Session -> get_session('call_reason_notnit')."'";
		// }
		// elseif(isset($_REQUEST['call_reason_notnit']) && $_REQUEST['call_reason_notnit']==''){
			// $db -> Session -> deleted_session('call_reason_notnit');	
		// }
	// }	
// /** filtering campaign_name **/

	// if($db->havepost('campaign_name_notnit')){
		// $filter.=" AND a.CampaignId ='".$db->escPost('campaign_name_notnit')."'";	
		// $db -> Session -> replace_session('campaign_name_notnit',$db->escPost('campaign_name_notnit'));		
	// }
	// else{
		// if(!isset($_REQUEST['campaign_name_notnit'])){
			// if($db -> Session -> have_get_session('campaign_name_notnit') )
			// $filter.=" AND a.CampaignId ='".$db -> Session -> get_session('campaign_name_notnit')."'";	
		// }
		// elseif(isset($_REQUEST['campaign_name_notnit']) && $_REQUEST['campaign_name_notnit']==''){
			// $db -> Session -> deleted_session('campaign_name_notnit');	
		// }
	// }
	
   // $NavPages -> setWhere($filter);
	//echo $NavPages -> query;
echo javascript();	
?>
<script type="text/javascript">
/* create object **/
Ext.document('document').ready( function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 }); 
 
var Reason = [];

Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

/* catch of requeet accep browser **/
	
var datas = 
{
	cust_name_notnit	 : '<?php echo _get_exist_session('cust_name_notnit');?>',
	gender_notnit		 : '<?php echo _get_exist_session('gender_notnit'); ?>',
	card_type_notnit	 : '<?php echo _get_exist_session('card_type_notnit');?>',
	campaign_name_notnit : '<?php echo _get_exist_session('campaign_name_notnit');?>', 
	call_reason_notnit	 : '<?php echo _get_exist_session('call_reason_notnit');?>',
	user_id_notnit		 : '<?php echo _get_exist_session('user_id_notnit');?>',
	order_by			 : '<?php echo _get_exist_session('order_by');?>',
	type				 : '<?php echo _get_exist_session('type');?>'
}
			
/* assign navigation filter **/

var navigation = {
	custnav  : Ext.DOM.INDEX+'/SrcNotInterest/index/',
	custlist : Ext.DOM.INDEX+'/SrcNotInterest/Content/',
}
		
/* assign show list content **/
		
Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();
		
/* function searching customers **/
	
var searchCustomer = function() {
	Ext.EQuery.construct(navigation,{
		cust_name_notnit	 : Ext.Cmp('cust_name').getValue(),
		gender_notnit		 : Ext.Cmp('gender').getValue(),
		card_type_notnit	 : Ext.Cmp('card_type').getValue(),
		campaign_name_notnit : Ext.Cmp('campaign_name').getValue(),
		call_reason_notnit	 : Ext.Cmp('call_reason').getValue()
	})
	Ext.EQuery.postContent()
}
		
/* function clear searching form **/	

var resetSeacrh = function(){
	Ext.Cmp('cust_name').setValue('');
	Ext.Cmp('gender').setValue('');
	Ext.Cmp('card_type').setValue('');
	Ext.Cmp('campaign_name').setValue('');
	Ext.Cmp('call_reason').setValue();
}
	
 /* go to call contact detail customers **/
	var gotoCallCustomer = function()
		{
			var arrCallRows  = doJava.checkedValue('chk_cust_call');
			var arrCountRows = arrCallRows.split(','); 
				if( arrCallRows!='')
				{	
					if( arrCountRows.length == 1 )
					{
						arrCallRows = arrCountRows[0].split('_'); 
						
						if( (arrCallRows[2]!='16') &&  (arrCallRows[2]!='17'))
						{
							class_active.NotActive(); 
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
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Search'],['Go to Call '],['Clear']],
		extMenu   : [['searchCustomer'],['gotoCallCustomer'],['resetSeacrh']],
		extIcon   : [['zoom.png'],['telephone_go.png'],['cancel.png']],
		extText   : true,
		extInput  : false,
		extOption : [{
				render : 4,
				type   : 'combo',
				header : 'Call Reason ',
				id     : 'v_result_customers', 	
				name   : 'v_result_customers',
				triger : '',
				store  : []
				}]
	});
});
</script>

<fieldset class="corner">
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span></legend>	
<div id="span_top_nav">
	<div id="result_content_add" class="box-shadow" style="padding-bottom:4px;margin-top:2px;margin-bottom:8px;">
		<table cellpadding="3px;">
		<tr>
			<td class="text_caption"> Customer Name</td>
			<td><?php echo form() -> input('cust_name','input_text long', _get_exist_session('cust_name_notnit'));?></td>
			<td class="text_caption"> Gender</td>
			<td><?php echo form() -> combo('gender', 'select long', $GenderId, _get_exist_session('gender_notnit'));?></td>
			<td class="text_caption"> Card Type</td>
			<td><?php echo form() -> combo('card_type', 'select long', $CardType, _get_exist_session('card_type_notnit'));?> </td>
		</tr>
		<tr>
			<td class="text_caption"> Campaign Name</td>
			<td><?php echo form() -> combo('campaign_name','select long',$CampaignId, _get_exist_session('campaign_name_notnit'));?></td>
			<td class="text_caption"> Call Reason</td>
			<td><?php echo form() -> combo('call_reason','select long', $CallResult, _get_exist_session('call_reason_notnit'));?></td>
			<td class="text_caption">&nbsp;</td>
			<td>&nbsp;</td>
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