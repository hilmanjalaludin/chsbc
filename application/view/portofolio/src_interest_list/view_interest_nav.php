<?php

	require(dirname(__FILE__)."/../sisipan/sessions.php");
	require(dirname(__FILE__)."/../fungsi/global.php");
	require(dirname(__FILE__)."/../class/MYSQLConnect.php");
	require(dirname(__FILE__)."/../class/class.nav.table.php");
	require(dirname(__FILE__)."/../class/class.application.php");
	require(dirname(__FILE__)."/../class/class.query.parameter.php");
	require(dirname(__FILE__).'/../sisipan/parameters.php');
	
	
	SetNoCache();
	
	
/** get all status ***/

	function get_value_status()
	{
		$query = new ParameterQuery();
		if( is_object($query))
		{
			return $query -> ImplodeStatus();
		}
	}
	
/** set general query SQL ****/
	$sql = " select 
				c.CustomerId, c.CampaignId, c.CustomerNumber,
				c.CustomerFirstName, e.CampaignNumber, f.AproveName,
				e.CampaignName,
				b.PolicySalesDate, h.id, h.full_name,
				IF(f.AproveName is null,'Request Confirm', f.AproveName) as  AproveName


				FROM t_gn_policyautogen a
				 left join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
				 left join t_gn_customer c on a.CustomerId=c.CustomerId
				 left join t_gn_assignment d on a.CustomerId=d.CustomerId
				 left join t_gn_campaign e on c.CampaignId=e.CampaignId
				 left join t_lk_aprove_status f on c.CallReasonQue=f.ApproveId
				 left join tms_agent h on d.AssignSelerId=h.UserId ";
				 
	
/** not valid page if not serachc **/

	$NavPages -> setPage(15);
	$NavPages -> query($sql);
	
 /** set filter **/
	$filter =  " AND c.CallReasonId IN(".get_value_status().") 
				 AND d.AssignAdmin is not null 
				 AND d.AssignMgr is not null 
				 AND d.AssignSpv is not null
				 AND ( c.CallReasonQue IS NULL OR c.CallReasonQue='".$db -> Entity -> VerifiedConfirm()."')
				 AND d.AssignBlock=0  ";
				 
	
	if( $db->getSession('handling_type')==3 )			 
		$filter.=" AND d.AssignSpv ='".$db -> getSession('UserId')."' ";
		
	if( $db->getSession('handling_type')==4)
		$filter.=" AND d.AssignSelerId = '".$db->getSession('UserId')."'";
				 

/** filtering session **/
					
	if( $db->havepost('cust_name') ){ 
		$filter.=" AND c.CustomerFirstName LIKE '%".$db->escPost('cust_name')."%'"; 
		$db -> Session -> replace_session('cust_name',$db->escPost('cust_name'));
	}
	else{
		if(!isset($_REQUEST['cust_name'])){
			if($db -> Session -> have_get_session('cust_name') )
			$filter.=" AND c.CustomerFirstName LIKE '%".$db->Session -> get_session('cust_name')."%'"; 
		}
		elseif(isset($_REQUEST['cust_name']) && $_REQUEST['cust_name']==''){
			$db -> Session -> deleted_session('cust_name');	
		}
	}
	
///	**************** ??
	if( $db->havepost('cust_number') ) {
		$filter.=" AND c.CustomerNumber LIKE '%".$db->escPost('cust_number')."%'"; 
		$db -> Session -> replace_session('cust_number',$db->escPost('cust_number'));
	}
	else{
		if(!isset($_REQUEST['cust_number'])){
			if($db -> Session -> have_get_session('cust_number') )
			$filter.=" AND c.CustomerNumber LIKE '%".$db->Session -> get_session('cust_number')."%'"; 
		}
		elseif(isset($_REQUEST['cust_number']) && $_REQUEST['cust_number']==''){
			$db -> Session -> deleted_session('cust_number');	
		}
	}	

///	**************** ??
	
	if( $db->havepost('campaign_id') ){
		$filter.=" AND c.CampaignId =".$db->escPost('campaign_id');	
		$db -> Session -> replace_session('campaign_id',$db->escPost('campaign_id'));
	}
	else{
		if(!isset($_REQUEST['campaign_id'])){
			if($db -> Session -> have_get_session('campaign_id') )
			$filter.=" AND c.CampaignId ='".$db->Session -> get_session('campaign_id')."'";	
		}
		elseif(isset($_REQUEST['campaign_id']) && $_REQUEST['campaign_id']==''){
			$db -> Session -> deleted_session('campaign_id');	
		}
	}
	
// src category id session 
	
	if( $db->havepost('category_id') ){
		$filter.=" AND e.CategoryId =".$db->escPost('category_id');	
		$db -> Session -> replace_session('category_id',$db->escPost('category_id'));
	}
	else{
		if(!isset($_REQUEST['category_id'])){
			if($db -> Session -> have_get_session('category_id') )
			$filter.=" AND e.CategoryId ='".$db->Session -> get_session('category_id')."'";	
		}
		elseif(isset($_REQUEST['category_id']) && $_REQUEST['category_id']==''){
			$db -> Session -> deleted_session('category_id');	
		}
	}	
	
	
	
///	**************** ??
	

	if( $db->havepost('start_date') && $db->havepost('end_date') ){
		$filter .= " AND date(b.PolicySalesDate) >= '".$db->formatDateEng($_REQUEST['start_date'])."' 
					 AND date(b.PolicySalesDate) <= '".$db->formatDateEng($_REQUEST['end_date'])."' "; 
		$db -> Session -> replace_session('start_date',$db->escPost('start_date'));
		$db -> Session -> replace_session('end_date',$db->escPost('end_date'));
		
	}
	else{
		if(!isset($_REQUEST['start_date']) && !isset($_REQUEST['end_date']) ){
			if($db -> Session -> have_get_session('start_date') && $db -> Session -> have_get_session('end_date') )
			{
				$filter .= " AND date(b.PolicySalesDate) >= '".$db -> formatDateEng( $db -> Session -> get_session('start_date'))."' 
							 AND date(b.PolicySalesDate) <= '".$db -> formatDateEng( $db -> Session -> get_session('end_date'))."' "; 
			}
		}
		elseif(isset($_REQUEST['start_date']) && ($_REQUEST['start_date']=='') 
			&& (isset($_REQUEST['end_date'])) && ($_REQUEST['end_date']) )
		{
			$db -> Session -> deleted_session('start_date');	
			$db -> Session -> deleted_session('end_date');	
		}
	}
	
///	**************** ??
	
	if($db->havepost('user_id')){
		$filter.=" AND d.AssignSelerId = '".$db->escPost('user_id')."'";
		$db -> Session -> replace_session('user_id',$db->escPost('user_id'));
	}
	else{
		if(!isset($_REQUEST['user_id'])){
			if($db -> Session -> have_get_session('user_id') )
			$filter.=" AND d.AssignSelerId ='".$db->Session -> get_session('user_id')."'";	
		}
		elseif(isset($_REQUEST['user_id']) && $_REQUEST['user_id']==''){
			$db -> Session -> deleted_session('user_id');	
		}
	}	
///	**************** ??		

    if( $db->havepost('call_result'))
	{ 
		$filter .=" AND c.CallReasonId ='".$db->escPost('call_result')."'"; 
		$db -> Session -> replace_session('call_result',$db->escPost('call_result'));
	}
	else{
		if(!isset($_REQUEST['call_result'])){
			if($db -> Session -> have_get_session('call_result') )
			$filter.=" AND c.CallReasonId ='".$db->Session -> get_session('call_result')."'";	
		}
		elseif(isset($_REQUEST['call_result']) && $_REQUEST['call_result']==''){
			$db -> Session -> deleted_session('call_result');	
		}
	}
	
	$NavPages -> setWhere($filter);
	
	
?>

	<script type="text/javascript"  src="<?php echo $app->basePath();?>pustaka/jquery/plugins/aqPaging.js"></script>
	<script type="text/javascript"  src="<?php echo $app->basePath();?>pustaka/jquery/plugins/extToolbars.js?versi=1.0"></script>
	<script type="text/javascript"  src="<?php echo $app->basePath();?>js/extendsJQuery.js?versi=1.0"></script>
	<script type="text/javascript"  src="<?php echo $app->basePath();?>js/javaclass.js?versi=1.0"></script>
  	<script type="text/javascript">
	
/* create object default parameter assigning **/

	var datas = {
			cust_number : '<?php echo ($db -> Session -> have_get_session('cust_number')?$db->Session->get_session('cust_number'):$db -> escPost('cust_number'));?>', 
			cust_name 	: '<?php echo ($db -> Session -> have_get_session('cust_name')?$db->Session->get_session('cust_name'):$db -> escPost('cust_name'));?>', 
			home_phone  : '<?php echo ($db -> Session -> have_get_session('home_phone')?$db->Session->get_session('home_phone'):$db -> escPost('home_phone'));?>', 
			office_phone: '<?php echo ($db -> Session -> have_get_session('office_phone')?$db->Session->get_session('office_phone'):$db -> escPost('office_phone'));?>', 
			mobile_phone: '<?php echo ($db -> Session -> have_get_session('mobile_phone')?$db->Session->get_session('mobile_phone'):$db -> escPost('mobile_phone'));?>',
			campaign_id : '<?php echo ($db -> Session -> have_get_session('campaign_id')?$db->Session->get_session('campaign_id'):$db -> escPost('campaign_id'));?>', 
			call_result : '<?php echo ($db -> Session -> have_get_session('call_result')?$db->Session->get_session('call_result'):$db -> escPost('call_result'));?>', 
			user_id 	: '<?php echo ($db -> Session -> have_get_session('user_id')?$db->Session->get_session('user_id'):$db -> escPost('user_id'));?>', 
			start_date  : '<?php echo ($db -> Session -> have_get_session('start_date')?$db->Session->get_session('start_date'):$db -> escPost('start_date'));?>',
			end_date    : '<?php echo ($db -> Session -> have_get_session('end_date')?$db->Session->get_session('end_date'):$db -> escPost('end_date'));?>', 
			order_by 	: '<?php echo ($db -> Session -> have_get_session('order_by')?$db->Session->get_session('order_by'):$db -> escPost('order_by'));?>', 
			type	 	: '<?php echo ($db -> Session -> have_get_session('type')?$db->Session->get_session('type'):$db -> escPost('type'));?>',
			category_id : '<?php echo ($db -> Session -> have_get_session('category_id')?$db->Session->get_session('category_id'):$db -> escPost('category_id'));?>'
		}
		
		extendsJQuery.totalPage = <?php echo $NavPages ->getTotPages(); ?>;
		extendsJQuery.totalRecord = <?php echo $NavPages ->getTotRows(); ?>;
	
	
/* assign navigation filter **/
		
		var navigation = {
			custnav:'dta_qc_nav.php',
			custlist:'dta_qc_list.php'
		}
		
/* assign show list content **/
		
		extendsJQuery.construct(navigation,datas)
		extendsJQuery.postContentList();
		
/* creete object javaclass **/

		var defaultPanel = function(){
			doJava.File = '../class/class.src.qualitycontrol.php'; 
			if( doJava.destroy() ){
				doJava.Method = 'POST',
				doJava.Params = { 
					action		 :'tpl_onready', cust_number : datas.cust_number,
					cust_name 	 : datas.cust_name, home_phone   : datas.home_phone, 
					office_phone: datas.office_phone, mobile_phone : datas.mobile_phone,  
					campaign_id : datas.campaign_id,  call_result  : datas.call_result,  
					user_id 	: datas.user_id, start_date   : datas.start_date,
					end_date	 : datas.end_date, category_id : datas.category_id
				}
				doJava.Load('span_top_nav');	
			}
		}

		
/* function searching customers **/
	
		doJava.onReady(
			evt=function(){ 
			  defaultPanel();
			},
		  evt()
		)
		
/* function searching customers **/

		var validation_check =  function(CustomerId)
		{
			if( CustomerId )
			{
				doJava.File = '../class/class.src.qualitycontrol.php'; 
				doJava.Params = {
					action:'validation_check',
					CustomerId : CustomerId
				}	
				
				return doJava.eJson();	
			} 
		} 
	
/* function searching customers **/
	
		var searchCustomer = function()
		{
			var start_date   = doJava.dom('start_date').value;
			var end_date     = doJava.dom('end_date').value;
			var cust_number  = doJava.dom('cust_number').value; 
			var cust_name 	 = doJava.dom('cust_name').value;
			var home_phone   = doJava.dom('home_phone').value;
			var office_phone = doJava.dom('office_phone').value;
			var mobile_phone = doJava.dom('mobile_phone').value;
			var campaign_id  = doJava.dom('campaign_id').value;
			var call_result  = doJava.dom('call_result').value;
			var user_id 	 = doJava.dom('user_id').value;
			var category_id  = doJava.dom('category_id').value;
				datas = {
					cust_number : cust_number,
					cust_name 	: cust_name,
					home_phone  : home_phone,
					office_phone: office_phone,
					mobile_phone: mobile_phone, 
					campaign_id : campaign_id, 
					call_result : call_result, 
					user_id 	: user_id,
					start_date 	: start_date,
					end_date 	: end_date,
					category_id : category_id
				}
				
			extendsJQuery.construct(navigation,datas)
			extendsJQuery.postContent()
		}
	
/* function approve all customer*/

	var approveAll = function(){			
		var cust_id  = doJava.checkedValue('chk_cust_call');
		if( cust_id!='')
		{
			var confirmasi_status = doJava.dom('confirmasi_status').value;
			if( confirmasi_status!='' )
			{
				if( confirm('Do you want to confirm this Customers ? '))
				{
					doJava.File = '../class/class.src.qualitycontrol.php'; 
					doJava.Method = 'POST'
					doJava.Params = { 
						action : 'approve_all',
						status : confirmasi_status,
						cust_id : cust_id
					}
					
					var error = doJava.eJson();
					if( error.result){
						alert('Success, Auto Confirm ..!');
						//extendsJQuery.construct(navigation,datas);
						extendsJQuery.postContent();
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
		
		var resetSeacrh = function(){
			if( doJava.destroy() ){
				doJava.init = [
								['cust_number'], ['cust_name'],['home_phone'],
								['office_phone'], ['mobile_phone'],
								['campaign_id'], ['call_result'],
								['user_id'],['start_date'],['end_date'],['category_id']
							  ]
				doJava.setValue('');	
			}
		}
  
 /* go to call contact detail customers **/
 
		var showPolicy = function()
		{
			var arrCallRows  = doJava.checkedValue('chk_cust_call');
			var arrCountRows = arrCallRows.split(','); 
				if( arrCallRows!='')
				{	
					if( arrCountRows.length == 1 )
					{
						var error_code = validation_check(arrCountRows[0]);
						if( error_code.result==0 || error_code.result==1) 
						{
							doJava.File = 'dta_qc_detail.php';
							doJava.Params = { CustomerId : arrCountRows[0] }
							extendsJQuery.Content();
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
	
	doJava.getConfirmStatus = function()
	{
		this.File = '../class/class.src.qualitycontrol.php'; 
		this.Params = {
			action:'get_confirm',
		}
		return this.eJson();
	} 	
		
	
	/* memanggil Jquery plug in */
	
		$(function(){
			$('#toolbars').extToolbars({
				extUrl   :'../gambar/icon',
				extTitle :[['Search'],['Show Policy '],['Clear'],[],[],['Approve All']],
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
						store  : [doJava.getConfirmStatus()]
					}]
			});
			$('#start_date,#end_date').datepicker({showOn: 'button', buttonImage: '../gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',readonly:true});
		});
		
		
	</script>
	
	
	
	<!-- start : content -->
	
		<fieldset class="corner">
			<legend class="icon-customers">&nbsp;&nbsp;Approval Interest </legend>	
				<div id="span_top_nav"></div>
				<div id="toolbars"></div>
				<div id="customer_panel" class="box-shadow" style="background-color:#FFFFFF;">
					<div class="content_table" ></div>
					<div id="pager"></div>
				</div>
				
		</fieldset>	
		
	<!-- stop : content -->
	
	
	
	
	