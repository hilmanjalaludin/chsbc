<?php
/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class M_SetCampaign extends EUI_Model
{

/*
 * EUI :: _get_product() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
  private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

/*
 * EUI :: _get_default() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
function __construct()
{
	$this -> load->model('M_SysUser');
}

/*
 * EUI :: _get_default() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function _get_campaign_name()
{
	$datas = array();
	
	$this -> db ->select("a.CampaignId, a.CampaignName");
	$this -> db ->from("t_gn_campaign a ");
	$this -> db ->join("t_lk_outbound_goals b", "a.OutboundGoalsId=b.OutboundGoalsId","LEFT");
	$this -> db ->where("a.CampaignStatusFlag",1);
	$this -> db ->where("Name", "outbound");
	
	#$this -> db ->get(); var_dump( $this->db->last_query() ); die();

	foreach( $this -> db ->get() ->result_assoc() as $rows )
	{
		$datas[$rows['CampaignId']] = $rows['CampaignName'];
	}
	
	return $datas;
}

/*
 * EUI :: _get_default() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function _get_default()
{
// ------------------------------------------------------	
  $out  = new EUI_Object(_get_all_request());

// ------------------------------------------------------
  
  $this->EUI_Page->_setPage(10); 
  $this->EUI_Page->_setSelect("distinct(a.CampaignId)", false);
  $this->EUI_Page->_setFrom("t_gn_campaign a ");
  $this->EUI_Page->_setJoin("t_lk_campaigntype c "," a.CampaignTypeId=c.CampaignTypeId","LEFT");
  $this->EUI_Page->_setJoin("t_lk_cignasystem d "," a.CignaSystemId=d.CignaSystemId","LEFT");
  $this->EUI_Page->_setJoin("t_lk_reuploadreason e "," a.ReUploadReasonId=e.ReUploadReasonId","LEFT", TRUE);
 
 
 // ------------ set filter data ---------------
  
  $this->EUI_Page->_setLikeCache("a.CampaignName", "CampaignName", true);
  $this->EUI_Page->_setAndCache("a.CampaignStatusFlag", "CampaignStatus", true);
  $this->EUI_Page->_setAndCache("a.OutboundGoalsId", "Direction", true);
  $this->EUI_Page->_setAndOrCache("a.CampaignStartDate>='{$out->get_value('StartExpiredDate','StartDate')}'", "StartExpiredDate", true);
  $this->EUI_Page->_setAndOrCache("a.CampaignEndDate>='{$out->get_value('EndExpiredDate','EndDate')}'", "EndExpiredDate", true);
  
  
  return $this->EUI_Page;
}

/*
 * EUI :: _get_content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */		
 
function _get_content()
{
 // ------------------------------------------------------	
  $out  = new EUI_Object(_get_all_request());
  
// ------------------------------------------------------
  
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setArraySelect(array(
		"a.CampaignId As CampaignId" 			=> array("CampaignId", "CampaignId","primary"),
		"a.CampaignNumber As CampaignNumber" 	=> array("CampaignNumber","Campaign Number"),
		"a.CampaignCode As CampaignCode" 		=> array("CampaignCode", "Campaign Code"),
		"a.CampaignName as CampaignName" 		=> array("CampaignName","Campaign Name"),
		"a.CampaignDesc As CampaignDesc" 		=> array("CampaignDesc","Description"),
		"a.CampaignEndDate As CampaignEndDate" 	=> array("CampaignEndDate","Expired Date"),
		//"h.MethodName as DirectMethod" 			=> array("DirectMethod","Direct Method"),
		//"g.ActionName as DirectAction" 			=> array("DirectAction","Direct Action"),
		//"k.CampaignName as AvailCampaignId" 	=> array("AvailCampaignId", "Avail Campaign"),
		"(SELECT count(cs.CustomerId) as jumlah 
			FROM t_gn_customer cs
			WHERE cs.CampaignId=a.CampaignId ) 
		 As DataSize" 							=> array("DataSize", "Data Size"),
		"CASE WHEN(a.CampaignStatusFlag=0) THEN'Not Active' ELSE 'Active' END As CmpStatus" 							=> array("CmpStatus","Status")
	));
	
	$this->EUI_Page->_setFrom("t_gn_campaign a");
	$this->EUI_Page->_setJoin("t_lk_campaigntype c "," a.CampaignTypeId=c.CampaignTypeId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_cignasystem d "," a.CignaSystemId=d.CignaSystemId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_reuploadreason e "," a.ReUploadReasonId=e.ReUploadReasonId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_outbound_goals f "," a.OutboundGoalsId=f.OutboundGoalsId","LEFT");
	$this->EUI_Page->_setJoin("t_lk_direction_action g "," a.DirectAction=g.ActionCode","LEFT");
	$this->EUI_Page->_setJoin("t_lk_direct_method h "," a.DirectMethod=h.MethodCode","LEFT");
	$this->EUI_Page->_setJoin("t_gn_campaign k "," a.AvailCampaignId=k.CampaignId","LEFT", true);
 
 // ------------ set filter data ---------------
  
   $this->EUI_Page->_setLikeCache("a.CampaignName", "CampaignName", true);
   $this->EUI_Page->_setAndCache("a.CampaignStatusFlag", "CampaignStatus", true);
   $this->EUI_Page->_setAndCache("a.OutboundGoalsId", "Direction", true);
   $this->EUI_Page->_setAndOrCache("a.CampaignStartDate>='{$out->get_value('StartExpiredDate','StartDate')}'", "StartExpiredDate", true);
   $this->EUI_Page->_setAndOrCache("a.CampaignEndDate>='{$out->get_value('EndExpiredDate','EndDate')}'", "EndExpiredDate", true);
 
 // --------------- set order  -------------------
 
   if( !_get_have_post('order_by')){
	 $this->EUI_Page->_setOrderBy('a.CampaignId','ASC');
  } else {
	 $this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  }	
	//echo $this->EUI_Page->_getCompiler();
	
	$this->EUI_Page->_setLimit();
}	

/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_resource_query()
 {
	$res = false;
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') {
		$res = $this -> EUI_Page -> _result();
		if($res) return $res;
	}	
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
   
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function _set_event_update_campaign( $out= null)
{
 
  if( is_null( $out) ) {  return false;  }
  if( !$out->fetch_ready() ){ return false; }
  
  
  $objPro =& get_class_instance('M_SetProduct');
  
// ------------ exist data payment list && data -------------------------------

  $CampaignId  = $out->get_value('CampaignId', 'trim');
  $ProductList = $objPro->_getProductCampaignId($CampaignId);
  $PayTypeList = $objPro->_getCampaignChannel($CampaignId);
  
// ---------------- reset write -----------------------

  $this->db->reset_write();
  $this->db->where("CampaignId", $CampaignId);
  $this->db->set("CampaignCode", $out->get_value('CampaignCode') );
  $this->db->set("CampaignDesc",$out->get_value('CampaignDesc'));
  $this->db->set("CampaignNumber",$out->get_value('CampaignNumber'));
  $this->db->set("CampaignName",$out->get_value('CampaignName'));
  $this->db->set("CampaignStartDate",$out->get_value('StartDate','_getDateEnglish'));
  $this->db->set("CampaignEndDate",$out->get_value('ExpiredDate','_getDateEnglish'));
  $this->db->set("CampaignStatusFlag",$out->get_value('StatusActive'));
  $this->db->set("OutboundGoalsId",$out->get_value('OutboundGoalsId'));
  $this->db->set("DirectMethod",$out->get_value('DirectMethod'));
  $this->db->set("DirectAction",$out->get_value('DirectAction'));
  $this->db->set("AvailCampaignId",$out->get_value('AvailCampaignId'));
  
// -------------- data compacted --------------------------
  
  if(  $this->db->update("t_gn_campaign") ){
	$CampaignId  = $out->get_value('CampaignId', 'trim');
  } 
  
 // echo $this->db->last_query();
  
// --------- insert into t_gn_campaignproduct ---------------------

   if( $CampaignId ) 
   {
	   
	// ------------ delete and insert again -------------------
	   $ListProduct = $out->get_array_value('ListProduct');
	   if( is_array($ListProduct) and count($ListProduct) > 0  ) 
		 foreach( $ListProduct as $k => $ProductId ) 
	  {
		  if( !in_array($ProductId,  $ProductList ) ) 
		 {
			$this->db->reset_write();
			$this->db->set("CampaignId", $CampaignId);
			$this->db->set("ProductId", $ProductId);
			$this->db->insert("t_gn_campaignproduct");
		 }
	  }
		
	// ----------- remove product --------------------
		$Product = $out->get_array_value('ProductId');  
		if( is_array($Product) and count($Product) > 0  ) 
		 foreach( $Product as $k => $ProductId ) 
		{
		    $this->db->reset_write();
			$this->db->where("CampaignId", $CampaignId);
			$this->db->where("ProductId", $ProductId);
			$this->db->delete("t_gn_campaignproduct");
		}
    }
	
// --------- insert into t_gn_campaignpaychannel ---------------------
	if( $CampaignId ) 
	{
	   $PaymentType = $out->get_array_value('ListPaymentChannel');
	   if( is_array($PaymentType) and count($PaymentType) > 0  ) 
		 foreach( $PaymentType as $k => $PaymentTypeId ) 
	  {
		  if( !in_array($PaymentTypeId,  $PayTypeList ) ) 
		 {
			$this->db->reset_write();
			$this->db->set("CampaignId", $CampaignId);
			$this->db->set("PaymentChannelId", $PaymentTypeId);
			$this->db->insert("t_gn_campaignpaychannel");
		 }
	  } 
	  
	  // ----------- remove chanel --------------------
	  
		$Channel = $out->get_array_value('PaymentChannel');  
		if( is_array($Channel) and count($Channel) > 0  ) 
		 foreach( $Channel as $k => $ChannelId ) 
		{
		    $this->db->reset_write();
			$this->db->where("CampaignId", $CampaignId);
			$this->db->where("PaymentChannelId", $ChannelId);
			$this->db->delete("t_gn_campaignpaychannel");
		}
    }
	
// ------------ insert on clampaign ID ---------------------------
	
  if( $CampaignId ) { return TRUE; }
  else {
	  return FALSE;
  } 
	
}

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function _set_event_delete_campaign( $out  = null ) 
{
	if( is_null( $out) ) {  return false;  }
	if( !$out->fetch_ready() ){ return false; }
	
// --------- default callback ---------------------	
	$cond = 0; 
	
	$arr_data = $out->get_array_value('CampaignId');
	if( is_array( $arr_data ) AND count( $arr_data ) > 0 ) 
		foreach( $arr_data as $k => $CampaignId )
	{
		// ---------- delete on product campaign 
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		$this->db->delete("t_gn_campaignproduct");
		
		// ----------- delete chanel 
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		$this->db->delete("t_gn_campaignpaychannel");
		
		// ----------- delete target  
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		$this->db->delete("t_gn_campaign_target");
		
		// delete campaign 
		
		$this->db->reset_write();
		$this->db->where("CampaignId", $CampaignId);
		if( $this->db->delete("t_gn_campaign") ){
			$cond++;	
		}
	}
	return $cond;
} 

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function _set_save_campaign( $out  = null )
{
	if( is_null( $out) ) {  return false;  }
	if( !$out->fetch_ready() ){ return false; }
	
// ---------------- reset write -----------------------

	$CampaignId  = 0;

	$this->db->reset_write();
	$this->db->set("CampaignCode", $out->get_value('CampaignCode') );
	$this->db->set("CampaignDesc",$out->get_value('CampaignDesc'));
	$this->db->set("CampaignNumber",$out->get_value('CampaignNumber'));
	$this->db->set("CampaignName",$out->get_value('CampaignName'));
	$this->db->set("CampaignStartDate",$out->get_value('StartDate','_getDateEnglish'));
	$this->db->set("CampaignEndDate",$out->get_value('ExpiredDate','_getDateEnglish'));
	$this->db->set("CampaignStatusFlag",$out->get_value('StatusActive'));
	$this->db->set("OutboundGoalsId",$out->get_value('OutboundGoalsId'));
	$this->db->set("DirectMethod",$out->get_value('DirectMethod'));
	$this->db->set("DirectAction",$out->get_value('DirectAction'));
	$this->db->set("AvailCampaignId",$out->get_value('AvailCampaignId'));
	
	if( $this->db->insert("t_gn_campaign") ) {
		$CampaignId = $this->db->insert_id();	
	}	
	
// --------- insert into t_gn_campaignproduct ---------------------

   if( $CampaignId ) 
   {
	   $ListProduct = $out->get_array_value('ListProduct');
	   if( is_array($ListProduct) and count($ListProduct) > 0  ) 
		 foreach( $ListProduct as $k => $ProductId ) 
	  {
		 $this->db->reset_write();
		 $this->db->set("CampaignId", $CampaignId);
		 $this->db->set("ProductId", $ProductId);
		 $this->db->insert("t_gn_campaignproduct");
	  } 
	  
    }
	
// --------- insert into t_gn_campaignpaychannel ---------------------
	if( $CampaignId ) 
	{
	   $PaymentType = $out->get_array_value('ListPaymentChannel');
	   if( is_array($PaymentType) and count($PaymentType) > 0  ) 
		 foreach( $PaymentType as $k => $PaymentTypeId ) 
	  {
		 $this->db->reset_write();
		 $this->db->set("CampaignId", $CampaignId);
		 $this->db->set("PaymentChannelId", $PaymentTypeId);
		 $this->db->insert("t_gn_campaignpaychannel");
	  } 
    }
	
// ------------ insert on clampaign ID ---------------------------
	
  if( $CampaignId ) { return true; }
  else {
	  return FALSE;
  } 
  
 } 
 //=========== END SUBMIT ===============>  

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function getTarget($cmp_id='')
 {
 	$this -> db -> select(" * ");
 	$this -> db -> from('t_gn_campaign_target');
 	$this -> db -> where('CampaignId', $cmp_id);
 	$res = array();

 	foreach ($this->db->get() -> result_assoc() as $rows) {
 		$res = $rows;
 	}

 	return $res;
 }
 
 /*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function set_save_event_target($post=array())
 {
 	$_conds = 0;

 	$_conds = $this -> update_target($post);

 	if ($_conds == 0) {	// no cmp target updated, new target
 		$_conds = $this -> save_target($post);
 	}

 	return $_conds;
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function update_target($post=array())
 {
 	$_set = array();
 	$_where = array();

 	$_set['Target1']= $post['target1'];
 	$_set['Target2']= $post['target2'];
 	$_set['Target3']= $post['target3'];
 	$_set['Target4']= $post['target4'];
 	$_set['Target5']= $post['target5'];
 	$_set['Target6']= $post['target6'];
 	$_set['Target7']= $post['target7'];
 	$_set['Target8']= $post['target8'];
 	$_set['Target9']= $post['target9'];
 	$_set['Target10']= $post['target10'];
 	$_set['UpdatedTs']= date("Y-m-d h:i:s");

 	$_where['CampaignId']= $post['CampaignId'];

 	$this -> db -> where($_where);
 	$this -> db -> update('t_gn_campaign_target', $_set);

 	$_ret = $this-> db -> affected_rows();

 	return $_ret;
 }

 /*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function save_target($post=array())		
 {
 	$_set = array();
 	$_where = array();

 	$_set['Target1']= $post['target1'];
 	$_set['Target2']= $post['target2'];
 	$_set['Target3']= $post['target3'];
 	$_set['Target4']= $post['target4'];
 	$_set['Target5']= $post['target5'];
 	$_set['Target6']= $post['target6'];
 	$_set['Target7']= $post['target7'];
 	$_set['Target8']= $post['target8'];
 	$_set['Target9']= $post['target9'];
 	$_set['Target10']= $post['target10'];
 	$_set['UpdatedTs']= date("Y-m-d h:i:s");
 	$_set['CampaignId']= $post['CampaignId'];

	$this -> db -> insert('t_gn_campaign_target', $_set);

	$_ret = $this-> db ->insert_id();

 	return $_ret;
 }
 
 /*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
function _get_size_campaign()
{ 
	$_conds = array();
	
	$sql = " SELECT COUNT(a.CustomerId) as SizeCount, a.CampaignId FROM t_gn_customer a GROUP BY a.CampaignId ";
	$qry = $this->db->query($sql);
	foreach($qry -> result_assoc() as $rows ) {
		$_conds[$rows['CampaignId']] = ( $rows['SizeCount'] ? $rows['SizeCount'] : 0 );	
	}
	
	return $_conds;
}	
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function getAttribute($CampaignId=null )
{
	$_conds = array();
	if( isset($_conds))
	{
		$sql = "SELECT * FROM (`t_gn_campaign`) WHERE `CampaignId` = '$CampaignId'";
		$qry = $this -> db -> query($sql);
		if($qry !=FALSE) 
		{
			$_conds = $qry -> result_first_assoc();
		}	
	}
	
	return $_conds;
}

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _getDataCampaignId($CampaignId = array())
{
	$_conds = array();
	$this -> db -> select
	(
		"a.CustomerNumber, a.CustomerFirstName,
		 a.CustomerLastName, a.CustomerDOB,
		 a.CustomerIdentificationNum, a.CustomerAddressLine1,
		 a.CustomerAddressLine2, a.CustomerAddressLine3,
	     a.CustomerAddressLine4, a.CustomerCity,
		 a.CustomerZipCode, a.CustomerHomePhoneNum,
		 a.CustomerMobilePhoneNum, a.CustomerWorkFaxNum,
		 a.CustomerWorkExtPhoneNum, a.CustomerWorkPhoneNum,
		 a.CustomerFaxNum, a.CustomerEmail,
		 a.CustomerOfficeName, a.CustomerOfficeLine1,
		 a.CustomerOfficeLine2, a.CustomerOfficeLine3,
		 a.CustomerOfficeLine4, a.CustomerOfficeCity,
		 a.CustomerOfficeZipCode,a.CustomerArea,
		 a.CustomerUploadedTs, a.CustomerCcNumber,
		 b.CampaignName"
	);
	
	$this -> db -> from("t_gn_customer a");
	$this -> db -> join("t_gn_campaign b ","a.CampaignId=b.CampaignId","LEFT");
	$this -> db -> where_in("a.CampaignId",$CampaignId);
	
	$i = 0;
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		foreach($rows as $fields => $values ) {
			$_conds[$i][$fields] = $values;
		}	
		$i++;
	}
	
	return $_conds;
}

/*
 * EUI :: _getMethodDirection() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _getMethodDirection()
 {
	$_conds = array();
	
	$this->db->select('a.MethodCode, a.MethodName'); 
	$this->db->from('t_lk_direct_method a');
	$this->db->where('a.MenthodFlags',1);
	
	foreach( $this ->db->get()->result_assoc() as $rows)
	{
		$_conds[$rows['MethodCode']] = $rows['MethodName'];
	}
	
	return $_conds;
	
	
 }
 
/*
 * EUI :: _getMethodDirection() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _getMethodAction()
 {
	$_conds = array();
	
	$this->db->select('a.ActionCode, a.ActionName'); 
	$this->db->from('t_lk_direction_action a');
	$this->db->where('a.ActionFlags',1);
	
	foreach( $this ->db->get()->result_assoc() as $rows)
	{
		$_conds[$rows['ActionCode']] = $rows['ActionName'];
	}
	
	return $_conds;
 }
 
 
 /*
 * EUI :: _getOutboundGoals() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _getCampaignGoals( $OutboundGoalsId = 0 )
 {
	$_conds = array();
	
	$this->db->select('a.CampaignId, a.CampaignName');
	$this->db->from('t_gn_campaign a');
	$this->db->where('a.OutboundGoalsId', $OutboundGoalsId);
	foreach( $this ->db->get()->result_assoc() as $rows)
	{
		$_conds[$rows['CampaignId']] = $rows['CampaignName'];
	}
	
	return $_conds;
	
 }
 

 
/*
 * EUI :: _getDataInbound() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
  
 function _getDataInbound($CampaignId)
 {
	$_counter = 0;
	
	$this -> db -> select('COUNT(a.CustomerId) as Counter ');
	$this -> db -> from('t_gn_customer a');
	$this -> db -> join('t_gn_assignment b ', 'a.CustomerId=b.CustomerId','INNER');
	$this -> db -> where('a.CampaignId',$CampaignId);
	
	if( $rows = $this -> db -> get()->result_first_assoc() )
	{
		$_counter = $rows['Counter'];
	}
	
	return $_counter;
 }
 
/*
 * EUI :: _setManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
private function _getDataByCampaign($post)
{
	$_assign_customer = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_gn_customer a');
	$this ->db ->join('t_gn_assignment b', 'a.CustomerId=b.CustomerId', 'INNER');
	$this ->db ->where('a.CampaignId',$post['InboundCampaignId']);	
	$this ->db ->limit($post['AssignData']);
	
	$i = 0;
	foreach( $this ->db ->get() -> result_assoc() as $rows )
	{
		$_assign_customer[$i] = $rows;
		$i++;
	}
	
	return $_assign_customer;
}
 
/*
 * EUI :: _setManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */ 
private function _getAssignByCampaign($CampaignId)
{
	$_assign_data = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_gn_customer a');
	$this ->db ->join('t_gn_assignment b', 'a.CustomerId=b.CustomerId', 'INNER');
	$this ->db ->where('a.CampaignId',$CampaignId);	
	
	$i = 0;
	foreach( $this ->db ->get() -> result_assoc() as $rows )
	{
		$_assign_data[$i] = $rows;
		$i++;
	}
	
	return $_assign_data;
}
 
/*
 * EUI :: _setManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */ 
function _setManageCampaign($post=null)
{

	$_conds = 0;
	
 // define of parameter
	if(!defined('DIRECT')) define('DIRECT',2);
	if(!defined('DUPLICATE')) define('DUPLICATE',1);
	if(!defined('REPLACE')) define('REPLACE',2);
	
  // then process copy data 
	
	if(!is_null($post))
	{
		// method duplicate 
			
			if($post['DirectAction']==DUPLICATE)
			{
				// filtering data 
				
				$_array_filter = array
				(
					'CustomerId', 'UpdatedById','CampaignId','CallReasonId',
					'CallReasonQue','QueueId', 'SellerId','QaProsess',
					'InitDays','CustomerUpdatedTs','AssignId','AssignAdmin',
					'AssignMgr', 'AssignSpv', 'AssignSelerId','AssignDate',
					'AssignMode', 'AssignBlock'
				);
				
				// maping data 
				
				$avail_columns = ARRAY(); $assign_columns = ARRAY();
				$DataCustomers = ARRAY_VALUES(self::_getDataByCampaign($post));
				$nums = 0;
				
				foreach( $DataCustomers as $k => $values ) 
				{
					foreach($values as $fieldname => $fielvalues ) 
					{
						if(!in_array($fieldname, $_array_filter) ) 
						{
							$avail_columns[$nums][$fieldname] = $fielvalues;
						}
						else{
							$assign_columns[$nums][$fieldname] = $fielvalues;
						}
						
						$avail_columns[$nums]['CampaignId'] = $post['OutboundCampaignId'];
					}
					
				/* 
				 * @ def 	: insert to customer data 
				 * -------------------------------------
				 * @ param  : array()
				 * @ aksess : public
				 */	
				 
				 $_UserDetail = array_keys($this ->M_SysUser ->_get_administrator());
				 if( $this ->db->insert('t_gn_customer',$avail_columns[$nums]))
				 {
					$CustomerId = $this ->db->insert_id();
					
					/* insert to assign data  */
						
					if( $this -> db->insert('t_gn_assignment',
							array
							(
								'CustomerId' 	=> $CustomerId, 
								'AssignAdmin' 	=> $_UserDetail[count($_UserDetail)-1],
								'AssignMode' 	=> 'DIS'
							)
						))
					{
						/* insert to log data  */
						if( $this -> db -> insert("t_gn_direct_campaign",
							array
							(
								'CustomerIdNew' 	 => $CustomerId, 
								'DirectCampaignFrom' => $post['InboundCampaignId'], 
								'DirectCampaignTo' 	 => $post['OutboundCampaignId'],  
								'CustomerIdOld' 	 => $assign_columns[$nums]['CustomerId'], 
								'SellerId' 			 => $assign_columns[$nums]['SellerId'],  
								'CallReasonId'		 => $assign_columns[$nums]['CallReasonId'],  
								'CreateByUserId' 	 => $this -> EUI_Session ->_get_session('UserId'),
								'CreateDateTs' 		 => date('Y-m-d H:i:s'),
								'DirectAction' 		 => DUPLICATE,
								'DirectMethode' 	 => DIRECT
							)
						)){
							$_conds++;
						}
					 }
				   }
					$nums++;
				}
				
			}
			
		// method replace 	
			
			if($post['DirectAction']==REPLACE)
			{
				// filtering data 
				
				$_array_filter = array (
					'CustomerId','UpdatedById','CampaignId','CallReasonId',
					'CallReasonQue','QueueId', 'SellerId','QaProsess',
					'InitDays','CustomerUpdatedTs','AssignId','AssignAdmin',
					'AssignMgr', 'AssignSpv', 'AssignSelerId','AssignDate',
					'AssignMode', 'AssignBlock'
				);
				
				// maping data 
				
				$_avc = ARRAY(); 
				$_mls = ARRAY(); 
				$where_avails 	= ARRAY();
				$DataCustomers  = ARRAY_VALUES(self::_getDataByCampaign($post));
				
				
				$_UserDetail = array_keys($this ->M_SysUser ->_get_administrator());
				
				$nums = 0;
				foreach( $DataCustomers as $k => $values ) 
				{
					$_mls['DirectCampaignFrom'] = $post['InboundCampaignId'];
					$_mls['DirectCampaignTo']   = $post['OutboundCampaignId'];
					$_mls['CustomerIdOld']	 	= $values['CustomerId'];
					$_mls['SellerId']			= $values['SellerId'];
					$_mls['CustomerIdNew'] 	 	= $values['CustomerId'];
					$_mls['CallReasonId']		= $values['CallReasonId'];
					$_mls['DirectAction'] 		= REPLACE;
					$_mls['DirectMethode'] 	 	= DIRECT;
					$_mls['CreateByUserId'] 	= $this -> EUI_Session ->_get_session('UserId');
					$_mls['CreateDateTs']		= date('Y-m-d H:i:s');
					
					foreach($values as $fieldname => $fielvalues ) 
					{
						if(!in_array($fieldname, $_array_filter) ) 
						{
							$this->db->set($fieldname,$fielvalues,true);
							$this->db->set('CallReasonId','NULL',FALSE);
							$this->db->set('SellerId','NULL',FALSE);
							$this->db->set('CampaignId', $post['OutboundCampaignId'],FALSE);							
						}
						else 
						{
							if( $fieldname=='CustomerId') {
								$this->db->where($fieldname,$fielvalues,FALSE);
							}
						}
					}
					
					$this -> db -> update('t_gn_customer'); 
					if( $this->db->affected_rows() > 0 )
					{
						$this->db->set('AssignMgr','NULL',FALSE);
						$this->db->set('AssignSpv','NULL',FALSE);
						$this->db->set('AssignSelerId','NULL',FALSE);
						$this->db->set('AssignAdmin',$_UserDetail[count($_UserDetail)-1],FALSE);
						$this->db->set('AssignMode','DIS',TRUE);
						$this->db->set('AssignDate',date('Y-m-d H:i:s'),TRUE);
						$this->db->where('CustomerId',$values['CustomerId']);
						$this->db->update('t_gn_assignment');
						if( $this->db->affected_rows() > 0)
						{
							$_conds++;
							if( $this -> db ->insert('t_gn_direct_campaign', $_mls) )
							{
								$_conds++;
							}
						}
					}	
					
				  $nums++;
				}
				
			}
		
	}
	
	return $nums;
	
}

function _get_cmp_ref($cmp_id)
{
	$datas = array();
	
	$sql = "select * from t_gn_campaign_ref a
			where a.CampaignId = '".$cmp_id."'";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows()>0)
	{
		$datas = $qry->result_first_assoc();
	}
	
	return $datas;
}

function _getCampaignId()
{
 $_conds = array();
 $sql = " SELECT a.CampaignId, a.CampaignDesc, a.CampaignCode FROM t_gn_campaign a WHERE a.CampaignStatusFlag=1 ";
 $qry = $this -> db -> query($sql);

  // if( !$qry -> EOF() )
	  if($qry->num_rows()>0)
  {
	foreach( $qry -> result_assoc() as $rows )
	{
		$_conds[$rows['CampaignId']] = array
			(
				'name' => $rows['CampaignDesc'], 
				'code' => $rows['CampaignCode'] 
			);
	 }
 }
	
	return $_conds;
}

/*
 * @BAP PDS
 * (F) _set_save_campaign_PdS [save campaign PDS in table]
 */
public function _set_save_campaign_PdS( $out  = null )
{
	#var_dump( $out->get_value('ListCampaignCallPrefarance') ); die();
	if( is_null( $out) ) {  return false;  }
	if( !$out->fetch_ready() ){ return false; }
	
	// ---------------- reset write -----------------------
	$CampaignId  = 0;
	$result 	 = FALSE;
	$this->db->reset_write();
	$this->db->set("CampaignCode", 		$out->get_value('CampaignCode') );
	$this->db->set("CampaignNumber", 	$out->get_value('CampaignNumber'));
	$this->db->set("CampaignName", 		$out->get_value('CampaignName'));
	$this->db->set("CampaignStatusFlag",$out->get_value('StatusActive'));
	$this->db->set("CallFactor", 		$out->get_value('CampaignCallFactor'));
	$this->db->set("CallWait", 			$out->get_value('CampaignCallWait'));
	$this->db->set("CallPreference",	$out->get_value('ListCampaignCallPrefarance'));
	$this->db->set("CallAbandonRate",	str_replace(array(","), ".", $out->get_value('CampaignAbandonRate')));
	$this->db->set("CallLimit",			$out->get_value('CampaignCallLimit'));
	$this->db->set("CallRetryMax",		$out->get_value('CampaignCallRetry'));
	$this->db->set("CallRetryAfter",	$out->get_value('CampaignCallRetryAfter'));
	$this->db->set("AutoACW",			$out->get_value('CampaignAutoAcw'));
	$this->db->set("CallGroup",			$out->get_value('CampaignTMRListBySPV'));
	$this->db->set("CcGroup",			$out->get_value('ListGroupCampaign'));
	$this->db->set("CreatedById", 		_get_session("UserId"));
	$this->db->set("StatusRunning",0);
	$this->db->set("PDSRunningCount",0);
	$this->db->set("CampaignStartDate",$out->get_value('StartDate','_getDateEnglish')." ".$out->get_value('StartTime'));
	$this->db->set("CampaignEndDate",$out->get_value('StartDate','_getDateEnglish')." ".$out->get_value('EndTime'));
	
	// $this->db->set("OutboundGoalsId",$out->get_value('OutboundGoalsId'));
	// $this->db->set("DirectMethod",$out->get_value('DirectMethod'));
	// $this->db->set("DirectAction",$out->get_value('DirectAction'));
	// $this->db->set("AvailCampaignId",$out->get_value('AvailCampaignId'));
	// $this->db->insert("t_gn_campaign_pds");

	// $this->db->insert("t_gn_campaign_pds"); var_dump( $this->db->last_query() ); die();

	if( $this->db->insert("t_gn_campaign_pds") ) {
		$CampaignId = $this->db->insert_id();

		// $this->db->reset_select();
		// $this->db->select('a.*');
		// $this->db->from('cc_agent a');
		// $this->db->join('tms_agent b', 'a.userid = b.id', 'INNER');
		// $this->db->where_in('b.Userid', array_map('intval', explode(",", $out->get_value('ListGroupCampaign')) ));
		// $this->db->where_in('b.Userid', $out->get_value('ListGroupCampaign'));
		// $res = $this->db->get();
		// var_dump( $this->db->last_query() ); die();

		// foreach ($res->result_array() as $value) {
			$this->db->reset_write();
			$this->db->set('CampaignId', (int)@$CampaignId);
			$this->db->set('GroupLeaderId', (int)@$out->get_value('ListGroupCampaign'));
			if($this->db->insert('t_gn_campaign_assignment')){
				
				$UnlistedSPV = array();
				$SPVList = explode(",",$out->get_value('CampaignSpvPds'));
				$CSPVList = $this->get_current_assigned_pds_spv($CampaignId);
				
				if(count($CSPVList)>0){
					$UnlistedSPV = array_diff($CSPVList,$SPVList);
				}
				
				// $SPVList = explode(",",$out->get_value('CampaignSpvPds'));
				// $CSPVList = $this->get_current_assigned_pds_spv($CampaignId);
				// $UnlistedSPV = array_diff($CSPVList,$SPVList);
				
				foreach($SPVList as $UserId => $Id){
					$insertSPVPDS = $this->insert_spv_assignment_pds($CampaignId, $Id);
					if($insertSPVPDS){
						foreach($UnlistedSPV as $Ids => $Id){
							$delUnlisted = $this->delete_unlisted_spv_pds($CampaignId, $Id);
						}
					
						$result = true;
					}
				}
				
				/*$Agent = explode(",",$out->get_value('CampaignTMRListBySPV'));
				foreach($Agent as $Key => $Id){
					$this->db->reset_write();
					$this->db->set('group_id', (int)@$out->get_value('ListGroupCampaign'));
					$this->db->where('UserId', $Id);
					if($this->db->update('tms_agent')){
						$result = true;
					}
				}*/					
			}
		// }
	}
	return $result;
}

function insert_spv_assignment_pds($CampaignId = null, $SPVId = null){
	$this->db->reset_write();
	// $this->db->set('CampaignAssignId', 0);
	$this->db->set('CampaignId', (int)@$CampaignId);
	$this->db->set('GroupLeaderId', (int)@$SPVId);
	// $this->db->insert('t_gn_spv_assignment_pds');
	// var_dump( $this->db->last_query() ); die();
	if($this->db->insert('t_gn_spv_assignment_pds')){
		// var_dump( $this->db->last_query() ); die();
		return true;
	}
	
	return false;
}

function get_current_assigned_pds_spv($CampaignId=null){
	
	$spvlist = array();
	if($CampaignId){
		$this->db->select("a.GroupLeaderId");
		$this->db->from("t_gn_spv_assignment_pds a ");
		$this->db->where("a.CampaignId",$CampaignId);

		// $this -> db ->get(); var_dump( $this->db->last_query() ); die();
		foreach( $this->db->get()->result_assoc() as $rows )
		{
			$spvlist[$rows['GroupLeaderId']] = $rows['GroupLeaderId'];
		}
	}
	
	return $spvlist;
}

function delete_unlisted_spv_pds($CampaignId = null, $SPVId = null){
	$this->db->reset_write();
	$this->db->where("CampaignId", $CampaignId);
	$this->db->where("GroupLeaderId", $SPVId);
	$this->db->delete("t_gn_spv_assignment_pds");
}
/*
 * @BAP
 * (F)_get_default_pds description]
 */
function _get_default_pds()
{
	$out  = new EUI_Object(_get_all_request());
  	$this->EUI_Page->_setPage(10); 
  	$this->EUI_Page->_setSelect("distinct(a.CampaignId)", false);
  	$this->EUI_Page->_setFrom("t_gn_campaign_pds a ");
  	// $this->EUI_Page->_setJoin("t_lk_campaigntype c "," a.CampaignTypeId=c.CampaignTypeId","LEFT");
  	// $this->EUI_Page->_setJoin("t_lk_cignasystem d "," a.CignaSystemId=d.CignaSystemId","LEFT");
  	// $this->EUI_Page->_setJoin("t_lk_reuploadreason e "," a.ReUploadReasonId=e.ReUploadReasonId","LEFT", TRUE);
 
 	// ------------ set filter data ---------------
  	// $this->EUI_Page->_setLikeCache("a.CampaignName", "CampaignName", true);
  	// $this->EUI_Page->_setAndCache("a.CampaignStatusFlag", "CampaignStatus", true);
  	// $this->EUI_Page->_setAndCache("a.OutboundGoalsId", "Direction", true);
  	// $this->EUI_Page->_setAndOrCache("a.CampaignStartDate>='{$out->get_value('StartExpiredDate','StartDate')}'", "StartExpiredDate", true);
  	// $this->EUI_Page->_setAndOrCache("a.CampaignEndDate>='{$out->get_value('EndExpiredDate','EndDate')}'", "EndExpiredDate", true);

  	// echo $this->EUI_Page->_getCompiler();
  
  	return $this->EUI_Page;
}

/*
 * @BAP
 * (F) _get_resource_query_pds description]
 */
function _get_resource_query_pds()
{
	$res = false;
	self::_get_content_pds();
	if( $this->EUI_Page->_get_query()!='') {
		$res = $this->EUI_Page->_result();
		if($res) return $res;
	}	
}

/*
 * @BAP
 * (F) _get_page_number_pds description]
 */
function _get_page_number_pds()
{
	if( $this->EUI_Page->_get_query()!='' )
	{
		return $this->EUI_Page->_getNo();
	}	
}

/*
 * @BAP
 * (F) _get_content_pds description]
 */
function _get_content_pds()
{
	$out  = new EUI_Object(_get_all_request());
	$this->EUI_Page->_postPage(_get_post('v_page'));
	$this->EUI_Page->_setPage(10);
	$this->EUI_Page->_setArraySelect(array(
		"a.CampaignId As CampaignId" 			=> array("CampaignId", "CampaignId","primary"),
		"a.CampaignName as CampaignName" 		=> array("CampaignName","Campaign Name"),
		"CASE WHEN(a.StatusRunning=1) THEN 'RUNNING' WHEN(a.StatusRunning=2) THEN 'PAUSED'  ELSE 'STOP' END As StatusPds"	=> array("StatusPds","Status PDS"),
		"CASE WHEN(a.CampaignStatusFlag=0) THEN'Not Active' ELSE 'Active' END As CmpStatus"									=> array("CmpStatus","Status"),
		"(SELECT COUNT(distinct cust.CustomerId) FROM t_gn_customer_pds c
		left join t_gn_customer cust on c.CustomerId = cust.CustomerId
		WHERE c.CampaignId = a.CampaignId and cust.Flag_Pds = 1 ) AS TotalData" => array("TotalData","Jumlah Data"),
		"concat(b.Id,' - ', b.full_name) as CreatedBy" => array("CreatedBy","Created By")
		// "a.CampaignCode As CampaignCode" 		=> array("CampaignCode", "Campaign Code"),
		// "a.CampaignNumber As CampaignNumber" 	=> array("CampaignNumber","Campaign Number"),
		/*"a.CampaignEndDate As CampaignEndDate" 	=> array("CampaignEndDate","Expired Date"),*/
		/*"(SELECT count(cs.CustomerId) as jumlah 
			FROM t_gn_customer cs
			WHERE cs.CampaignId=a.CampaignId ) 
		 As DataSize" 							=> array("DataSize", "Data Size"),*/
		// "a.CampaignDesc As CampaignDesc" 		=> array("CampaignDesc","Description"),
	));
	
	$this->EUI_Page->_setFrom("t_gn_campaign_pds a");
	$this->EUI_Page->_setJoin("tms_agent b "," a.CreatedById=b.UserId","LEFT");
	// $this->EUI_Page->_setJoin("t_lk_campaigntype c "," a.CampaignTypeId=c.CampaignTypeId","LEFT");
	// $this->EUI_Page->_setJoin("t_lk_cignasystem d "," a.CignaSystemId=d.CignaSystemId","LEFT");
	// $this->EUI_Page->_setJoin("t_lk_reuploadreason e "," a.ReUploadReasonId=e.ReUploadReasonId","LEFT");
	// $this->EUI_Page->_setJoin("t_lk_outbound_goals f "," a.OutboundGoalsId=f.OutboundGoalsId","LEFT");
	// $this->EUI_Page->_setJoin("t_lk_direction_action g "," a.DirectAction=g.ActionCode","LEFT");
	// $this->EUI_Page->_setJoin("t_lk_direct_method h "," a.DirectMethod=h.MethodCode","LEFT");
	// $this->EUI_Page->_setJoin("t_gn_campaign k "," a.AvailCampaignId=k.CampaignId","LEFT", true);
 
 	// ------------ set filter data ---------------
    // $this->EUI_Page->_setLikeCache("a.CampaignName", "CampaignName", true);
    // $this->EUI_Page->_setAndCache("a.CampaignStatusFlag", "CampaignStatus", true);
    // $this->EUI_Page->_setAndCache("a.OutboundGoalsId", "Direction", true);
    // $this->EUI_Page->_setAndOrCache("a.CampaignStartDate>='{$out->get_value('StartExpiredDate','StartDate')}'", "StartExpiredDate", true);
    // $this->EUI_Page->_setAndOrCache("a.CampaignEndDate>='{$out->get_value('EndExpiredDate','EndDate')}'", "EndExpiredDate", true);
 
 	// --------------- set order  -------------------
   	if( !_get_have_post('order_by')){
   		$this->EUI_Page->_setOrderBy('a.CampaignId','ASC');
  	} else {
  		$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
  	}	
	// echo $this->EUI_Page->_getCompiler(); die();
	
	$this->EUI_Page->_setLimit();
}

/*
 * @BAP
 * (F)_getcheckStatusPds
 * 
 * @param  Object $out
 * @return Array  $result
 */
function _getcheckStatusPds($out)
{
	$result = array();
	$this->db->where('CampaignId', $out->get_value('CampaignId'));
	$res = $this->db->get('t_gn_campaign_pds');
	if( $res->num_rows() > 0 ) {
		$result = $res->row_array();
	}
	return $result;
}

/*
 * @BAP
 * (F) _setStatusPds
 *
 * @param Object $out
 */
 
function getPDSRunnnigCount($out){
	$this->db->reset_select();
	$this->db->select('a.PDSRunningCount');
	$this->db->from('t_gn_campaign_pds a');
	$this->db->where('a.CampaignId', $out->get_value('CampaignId'));
	$res = $this->db->get();

	if( $res->num_rows() > 0 ) {
		foreach ($res->result_array() as $rows) {
			if($rows['PDSRunningCount']){
				$getPDSRunnnigCount = $rows['PDSRunningCount'];
			}
		}
	}
	
	if($getPDSRunnnigCount){
		return $getPDSRunnnigCount;
	}else{
		return 0;
	}
}

function _setStatusPds($out){
	$CustomerId = array();
	$getPDSRunnnigCount = $this->getPDSRunnnigCount($out);
	$PDSCampaign = $this->_getDataCampaignPds($out);
	$sukses = false;
	$this->db->reset_write();
	$this->db->set('StatusRunning', $out->get_value('Status'));
	if($out->get_value('Status')==1){
		$this->db->set('PDSRunningCount',  $getPDSRunnnigCount+=1); //($getPDSRunnnigCount>0 ? $getPDSRunnnigCount+=1 : $getPDSRunnnigCount));
	}
	$this->db->where('CampaignId', $out->get_value('CampaignId') );
	// $this->db->update('t_gn_campaign_pds', $object);
	// var_dump( $this->db->last_query() ); die();
	
	if($this->db->update('t_gn_campaign_pds', $object)){
		$sukses = true;
		if($out->get_value('Status')==0){
			// var_dump( $PDSCampaign ); die();
			$this->db->reset_select();
			$this->db->select('a.CustomerId');
			$this->db->from('t_gn_customer_pds a');
			$this->db->where('a.CampaignId', $out->get_value('CampaignId'));
			$res = $this->db->get();

			if( $res->num_rows() > 0 ) {
				foreach ($res->result_array() as $rows) {
					// $this->setPdsCustomerFlag($rows['CustomerId']);
					// $this->_DeleteCustomerPds($rows['CustomerId'],$out->get_value('CampaignId'));
					// $this->ClearCcGroupOnTmsAgent($PDSCampaign['CcGroup']);
					// $this->ClearCcGroupOnCcAgent($PDSCampaign['CcGroup']);
				}
			}
		}
	}
	
	return $sukses;
}

/*	_ClearCmpPds();
	kondisi:
		1. Jika user ingin membatalkan data yang baru saja diassign;
		2. Meng Cancel(Kembalikan Data dari PDS ke Mode Normal) untuk data yang belum terDial setelah STOP manual;
	Note:
		1. Assignment Session 202001010101
*/
	function _ClearCmpPds($out){
		$CustomerId = array();
		$PDSCampaign = $this->_getDataCampaignPds($out);
		// echo $PDSCampaign['CcGroup']; exit();
		$this->db->reset_select();
		$this->db->select('a.CustomerId, a.DialStatus,a.CustomerMobilePhoneNum,a.CustomerHomePhoneNum,a.CustomerWorkPhoneNum,a.CampaignId,a.LastCallStatusId,a.AssignSession');
		$this->db->from('t_gn_customer_pds a');
		$this->db->where('a.CampaignId', $out->get_value('CampaignId'));
		$res = $this->db->get();
// var_dump( $this->db->last_query() ); die();
		if( $res->num_rows() > 0 ) {
			foreach ($res->result_array() as $rows) {
				if($rows['CustomerId']){
					$CustomerId[$rows['CustomerId']]['CustomerId'] = $rows['CustomerId'];
					$CustomerId[$rows['CustomerId']]['DialStatus'] = $rows['DialStatus'];
					$CustomerId[$rows['CustomerId']]['CustomerMobilePhoneNum'] = $rows['CustomerMobilePhoneNum'];
					$CustomerId[$rows['CustomerId']]['CustomerHomePhoneNum'] = $rows['CustomerHomePhoneNum'];
					$CustomerId[$rows['CustomerId']]['CustomerWorkPhoneNum'] = $rows['CustomerWorkPhoneNum'];
					$CustomerId[$rows['CustomerId']]['CampaignId'] = $rows['CampaignId'];
					$CustomerId[$rows['CustomerId']]['LastCallStatusId'] = $rows['LastCallStatusId'];
					$CustomerId[$rows['CustomerId']]['AssignSession'] = $rows['AssignSession'];
				}
			}
		}
		print_r($CustomerId);
		$action = 0;
		if(is_array($CustomerId)){
			foreach($CustomerId as $key => $Custid){
				if($this->setPdsCustomerFlag($Custid['CustomerId'])){
					// echo 'Dial Status =>';
					// echo $Custid['DialStatus']; exit();
					if($Custid['DialStatus']==0 OR $Custid['DialStatus']==1){
						// if($this->_ClearCustomerPds($Custid,$out->get_value('CampaignId'))){
						if($this->_DeleteCustomerPds($Custid,$out->get_value('CampaignId'))){
							
							// $this->ClearCcGroupOnTmsAgent($PDSCampaign['CcGroup']);
						}
					}
					$action++;
				}
			}
		}
		
		if($action){
			return true;
		}else{
			return false;
		}
	}

function _ClearAgentPds($out){
	$action = false;
	$PDSCampaign = $this->_getDataCampaignPds($out);
	$tmsagent	= $this->ClearCcGroupOnTmsAgent($PDSCampaign['CcGroup']);
	$ccagent	= $this->ClearCcGroupOnCcAgent($PDSCampaign['CcGroup']);
	if($tmsagent && $ccagent){
		$action = true;
	}
	
	return $action;
}

function ClearCcGroupOnTmsAgent($CcGroup){
	$this->db->reset_write();
	$this->db->set('group_id', 1);
	$this->db->where('group_id', $CcGroup );
	if($this->db->update('tms_agent')){
		return true;
	}
}

function ClearCcGroupOnCcAgent($CcGroup){
	$this->db->reset_write();
	$this->db->set('agent_group', 1);
	$this->db->where('agent_group', $CcGroup );
	if($this->db->update('cc_agent')){
		return true;
	}
}

function setPdsCustomerFlag($CustomerId){
	$this->db->reset_write();
	$this->db->set('Flag_Pds', 0);
	$this->db->set('Flag_Followup', 0);
	$this->db->where('CustomerId', $CustomerId );
	// $this->db->update('t_gn_customer');
	if($this->db->update('t_gn_customer')){
		return true;
	}
}

function _ClearCustomerPds($CustomerId,$CampaignId){
	$this->db->reset_write();
	$this->db->set('CampaignId', 0);
	$this->db->set('FlagPds', 0);
	$this->db->where('CustomerId', $CustomerId );
	$this->db->where('CampaignId', $CampaignId );
	
	if($this->db->update('t_gn_customer_pds')){
		return true;
	}
}

function _DeleteCustomerPds($logdata,$CampaignId){
	$this->db->reset_write();

	$this->db->where('CustomerId', $logdata['CustomerId']);
	$this->db->where('CampaignId', $CampaignId);
	$this->db->where_in('DialStatus', array(0,1));
	
	if($this->db->delete('t_gn_customer_pds')){
		$this->_ClearPdsLog($logdata);
		return true;
	}
}

public function _ClearPdsLog($logdata=null){
	$i=0;
	if(is_array($logdata)){
		$this->db->reset_write();
		// $this->db->set("Id", $logdata->);
		$this->db->set("CustomerId", $logdata['CustomerId']);
		$this->db->set("CampaignId", $logdata['CampaignId']);
		$this->db->set("CurSellerId", 0);
		$this->db->set("CancelById", _get_session('UserId'));
		$this->db->set("CancelDate", date("Y-m-d h:i:s"));
		$this->db->set("CustomerMobilePhoneNum", $logdata['CustomerMobilePhoneNum']);
		$this->db->set("CustomerHomePhoneNum", $logdata['CustomerHomePhoneNum']);
		$this->db->set("CustomerWorkPhoneNum", $logdata['CustomerWorkPhoneNum']);
		$this->db->set("DialStatus", $logdata['DialStatus']);
		$this->db->set("LastCallStatusId", $logdata['LastCallStatusId']);
		$this->db->set("AssignSession", $logdata['AssignSession']);
		
		$this->db->insert("t_gn_customer_pds_cancel");
		if($this->db->insert_id()){
			// $i++;
		}
	}
}

/*
  @BAP
  (F) _get_campaign_name_pds
  
  @return array $datas
 */
function _get_campaign_name_pds()
{
	$datas = array();
	$this->db->select("a.CampaignId, a.CampaignName");
	$this->db->from("t_gn_campaign_pds a ");
	$this->db->where("a.CampaignStatusFlag",1);

	if(_get_session('HandlingType')==USER_LEADER ){
		$this->db->where("a.CreatedById", _get_session("UserId"));
	}
	if(_get_session('HandlingType')==USER_ADMIN ){
		$this->db->where("a.CreatedById", _get_session("UserId"));
	}
	
	#$this -> db ->get(); var_dump( $this->db->last_query() ); die();
	foreach( $this->db->get()->result_assoc() as $rows )
	{
		$datas[$rows['CampaignId']] = $rows['CampaignName'];
	}
	return $datas;
}

/*
 * @BAP
 * (F) _getDataCampaignPds
 * 
 * @param  Object $out
 * @return Array  $result
 */
function _getDataCampaignPds($out)
{
	$result = array();
	$this->db->reset_select();
	$this->db->where('CampaignId', $out->get_value('CampaignId'));
	$res = $this->db->get('t_gn_campaign_pds', 1);

	if( $res->num_rows() > 0 ) {
		$result = $res->row_array();		
	}
	return $result;
	
	$this->db->select('a.*');
		$this->db->from('t_gn_campaign_pds a');
		$this->db->join('t_gn_campaign_assignment b', 'a.CampaignId = b.CampaignId', 'left');
		$this->db->where_in('b.Userid', array_map('intval', explode(",", $out->get_value('ListGroupCampaign')) ));
		$res = $this->db->get();
}

/*
 * @BAP
 * (F) _getGroupCampaignPds
 * 
 * @param  Object 	$out
 * @return Array  	$result
 */
function _getGroupCampaignPds_old($out)
{
	$result = array();

	$this->db->reset_select();
	$this->db->select('b.id, b.userid');
	$this->db->from('t_gn_campaign_assignment a');
	$this->db->join('cc_agent b', 'a.GroupLeaderId = b.id', 'INNER');
	$this->db->where('a.CampaignId', $out->get_value('CampaignId'));
	$res = $this->db->get();
	// var_dump( $this->db->last_query() ); die();
	if( $res->num_rows() > 0 ) {
		foreach ($res->result_array() as $rows) {
			$result[$rows['id']] = $rows['userid'];
		}
	}
	return $result;
}

function _getGroupCampaignPds($out)
{
	$result = array();

	$this->db->reset_select();
	$this->db->select('b.id, b.userid');
	$this->db->from('t_gn_campaign_assignment a');
	$this->db->join('tms_agent c', 'a.GroupLeaderId = c.group_id', 'INNER');
	$this->db->join('cc_agent b', 'c.id = b.userid', 'INNER');
	$this->db->where('a.CampaignId', $out->get_value('CampaignId'));
	$res = $this->db->get();
	// var_dump( $this->db->last_query() ); die();
	if( $res->num_rows() > 0 ) {
		foreach ($res->result_array() as $rows) {
			$result[$rows['id']] = $rows['userid'];
		}
	}
	return $result;
}

/*
 * @BAP
 * (F) _set_event_update_campaign_pds [save Update campaign PDS in table]
 *
 * @param  Object $out
 */
public function _set_event_update_campaign_pds( $out  = null )
{
	if( is_null( $out) ) {  return false;  }
	if( !$out->fetch_ready() ){ return false; }
	
	// ---------------- reset write -----------------------
	$CampaignId  = 0;
	// $result 	 = FALSE;
	$this->db->reset_write();
	$this->db->set("CampaignCode", 		$out->get_value('CampaignCode') );
	$this->db->set("CampaignDesc", 		$out->get_value('CampaignDesc'));
	$this->db->set("CampaignNumber", 	$out->get_value('CampaignNumber'));
	$this->db->set("CampaignName", 		$out->get_value('CampaignName'));
	$this->db->set("CampaignStatusFlag",$out->get_value('StatusActive'));
	$this->db->set("CallFactor", 		$out->get_value('CampaignCallFactor'));
	$this->db->set("CallWait", 			$out->get_value('CampaignCallWait'));
	$this->db->set("CallPreference",	$out->get_value('ListCampaignCallPrefarance'));
	$this->db->set("CallAbandonRate",	str_replace(array(","), ".", $out->get_value('CampaignAbandonRate')));
	$this->db->set("CallLimit",			$out->get_value('CampaignCallLimit'));
	$this->db->set("CallRetryMax",		$out->get_value('CampaignCallRetry'));
	$this->db->set("CallRetryAfter",	$out->get_value('CampaignCallRetryAfter'));
	$this->db->set("AutoACW",			$out->get_value('CampaignAutoAcw'));
	$this->db->set("CallGroup",			$out->get_value('ListGroupCampaign'));
	$this->db->set("CcGroup",			$out->get_value('ListGroupCampaign'));
	$this->db->set("CreatedById", 		_get_session("UserId"));
	// $this->db->set("StatusRunning",0);
	$this->db->set("CampaignStartDate",	$out->get_value('StartDate','_getDateEnglish')." ".$out->get_value('StartTime'));
	$this->db->set("CampaignEndDate",	$out->get_value('StartDate','_getDateEnglish')." ".$out->get_value('EndTime'));
	// $this->db->set("CampaignStartDate",$out->get_value('StartDate','_getDateEnglish'));
	// $this->db->set("CampaignEndDate",$out->get_value('ExpiredDate','_getDateEnglish'));
	$this->db->where('CampaignId', $out->get_value('CampaignId'));
	// $this->db->update("t_gn_campaign_pds");
	// var_dump( $this->db->last_query() ); die();
	if( $this->db->update("t_gn_campaign_pds") ) {
		$this->db->set("GroupLeaderId",$out->get_value('ListGroupCampaign'));
		$this->db->where('CampaignId', $out->get_value('CampaignId'));
		$this->db->update("t_gn_campaign_assignment");
	
		$UnlistedSPV = array();
		$SPVList = explode(",",$out->get_value('CampaignSpvPds'));
		$CSPVList = $this->get_current_assigned_pds_spv($out->get_value('CampaignId'));
		
		if(count($CSPVList)>0){
			$UnlistedSPV = array_diff($CSPVList,$SPVList);
		}
		
		$result = 0;
		foreach($SPVList as $UserId => $Id){
			$insertSPVPDS = $this->insert_spv_assignment_pds($out->get_value('CampaignId'), $Id);
			if($insertSPVPDS){
				if(count($UnlistedSPV)>0){
					foreach($UnlistedSPV as $Ids => $Id){
						$delUnlisted = $this->delete_unlisted_spv_pds($out->get_value('CampaignId'), $Id);
					}
				}
				
				$result++;
			}
		}
	}
	
	if($result){
		return true;
	}
	
	// return $result;
}

 
}

?>
