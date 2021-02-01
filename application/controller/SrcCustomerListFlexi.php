<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SrcCustomerListFlexi extends EUI_Controller
{
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 function __construct() 
{
	parent::__construct();
	$this->load->model(array('M_SrcCustomerListFlexi', 'M_SetCallResult','M_SetProduct', 'M_SetCampaign','M_SetResultCategory', 'M_Combo', 'M_SysUser', 'M_MgtLockCustomer' ));
	$this->load->helper('EUI_Object');
 }
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */


function ViewAddReferral()
{
	$Data = array( 
		'Customer' => _get_all_request() 
	);
	
	if( is_array($Data) ) {
		$this->load->view('mod_contact_detailspv/view_add_referral_spv',$Data);
	}
}


public function SaveReferral () {
	
	$status_send = 0 ;
	$dataReferral = _get_all_request();
    $successDataSend = 0;

	if ( is_array($dataReferral) ) {
		$this->DataReferral = $dataReferral;
		/**
		 * Send Param data is , nama , product id dan phone number
		 */
		/**
		 	[ProductId] 
            [Name] 
            [PhoneNumber] 
            [CustomerId] 
            [TotalReferral]
        **/
        $this->ProductId     = $this->DataReferral["ProductId"];
        $this->Name          = $this->DataReferral["Name"];
        $this->PhoneNumber   = $this->DataReferral["PhoneNumber"];
        $this->CustomerId    = $this->DataReferral["CustomerId"];
        $this->TotalReferral = $this->DataReferral["TotalReferral"];
        $this->ReferralId 	 = $this->DataReferral["ReferralId"];

        //print_r($this->ProductId) ;
        //print_r($this->ReferralId);
        //return false;
        //echo $this->TotalReferral;
        
        $this->updateCustomerRef = $this->db->query(
        	"UPDATE t_gn_customer a SET a.StatReferral='1' WHERE a.CustomerId='".$this->CustomerId."'"
        );


        for ( $totref = 0 ; $totref < $this->TotalReferral ; $totref++  ) {
        	$successDataSend += 1;
        	//echo $totref;
        	//echo $this->ReferralId[$totref] . "  ";
        	
        	if ( $this->ProductId[$totref] != "" AND $this->PhoneNumber[$totref] != "" AND $this->Name[$totref] ) {
		        	if ( $this->ReferralId[$totref] != "" ) {
		        		$ReferralId = $this->ReferralId[$totref];
		        		$this->db->reset_select();
			        	$this->db->set("ProductId" , $this->ProductId[$totref]);
			        	$this->db->set("Name" , $this->Name[$totref]);
			        	$this->db->set("PhoneNumber" , $this->PhoneNumber[$totref]);
			        	$this->db->set("UpdateById" , _get_session("UserId") );
			        	$this->db->set("DateUpdated" , date("Y-m-d H:i:s") );
			        	$this->db->set("CustomerReferralId" , $totref+1 );
			        	$this->db->where("ReferralId = " . $ReferralId);
			        	$this->db->update("t_gn_referral");
			        	//echo "<pre>" . $this->db->last_query() . "</pre>";
		        	} else {
			        	$this->db->set("ProductId" , $this->ProductId[$totref]);
			        	$this->db->set("Name" , $this->Name[$totref]);
			        	$this->db->set("PhoneNumber" , $this->PhoneNumber[$totref]);
			        	$this->db->set("CustomerId" , $this->CustomerId );
			        	$this->db->set("CustomerReferralId" , $totref+1 );
			        	$this->db->set("CreatedById" , _get_session("UserId") );
			        	$this->db->insert_on_duplicate("t_gn_referral");	
		        	}
        	}



        }
		$status_send = $successDataSend;
	}

	echo $status_send;
}


public function DeleteRefferal () {
	$status_delete = 0;
	$_RefferalId = _get_all_request();
	
	$_RefferalId = new EUI_Object($_RefferalId);
	$ReferralId = $_RefferalId->get_value("ReferralId");
	// check if referral id is not ''
	if ( !empty($ReferralId) ) {
		$this->db->where("ReferralId" , $ReferralId);
		$this->db->delete("t_gn_referral");
		if ( $this->db->affected_rows() > 0 ) {
			$status_delete = 1;
		}
	}

	echo $status_delete;
}
 


public function CekPolicyForm()
{
	$_conds = array('success' => 0 );
	if( $this -> URI->_get_have_post('CustomerId') )
	{
		if( $rows = $this -> {base_class_model($this)} ->_getCekPolicyForm( $this -> URI->_get_post('CustomerId')) )
		{
			$_conds = array('success' => 1 );	
		}
	}
	
	__(json_encode($_conds));
} 
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function getCallResult( $CategoryId = null )
 {
	$_conds = array();
	
	 foreach
	 ( 
		$this ->M_SetCallResult ->_getCallReasonId($CategoryId)  
			as $k  => $call  )
	{
		$_conds[$k] = $call['name'];
	}
	
	return $_conds;
 }

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function setCallResult() 
{
	$_result = array( "setCallResult" => $this -> getCallResult( _get_post('CategoryId') ) );
	 if( is_array($_result)) 
	{
		$this -> load ->view('mod_contact_detailspv/view_call_result_spv',$_result);
	}
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getProductId()
 {
	$_conds = array();
	foreach( $this ->M_SetProduct ->_getProductId()  as $k  => $call ) {
		$_conds[$k] = $call['name'];
	}
	
	return $_conds;
 }
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
 {
	if( $this ->EUI_Session ->_have_get_session('UserId') )
	{
		$param = array();
		
		switch($this->EUI_Session ->_get_session('HandlingType'))
		{
			case USER_MANAGER :
				$param['mgr_id'] = $this ->EUI_Session ->_get_session('UserId');
			break;
			
			case USER_SUPERVISOR :
				$param['spv_id'] = $this ->EUI_Session ->_get_session('UserId');
			break;
			
			case USER_LEADER :
				$param['tl_id'] = $this ->EUI_Session ->_get_session('UserId');
			break;
		}
		
		$this->load ->view('src_customer_listflexi/view_customer_flexi_nav',array(
			'page' => $this->M_SrcCustomerListFlexi->_get_default(),
			'recs' => $this->M_MgtLockCustomer->_getUserRecsource(_get_session('UserId')),
			'callreason' => $this->M_SrcCustomerListFlexi->_getCallReason()
		));
	}	
 }
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			if(STRTOLOWER($keys)=='user')
			{
				$_serialize[$keys] = $this->_getAgentAssign();
			}
			else{
				$_serialize[$keys] = $this ->M_Combo->$method();
			}
		}
	}
	
	return $_serialize;
 } 
 


 function _getAgentAssign()
{
	$_conds = array();
	$Agent = $this -> M_SysUser->_get_user_by_login();
	
	$no=0;
	foreach( $Agent as $k => $rows ) 
	{
		$_conds[$k] = (++$no).' -'. $rows['full_name'];
	}
	
	return $_conds;
} 
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this ->M_SrcCustomerListFlexi ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->M_SrcCustomerListFlexi ->_get_page_number(); // load content data by pages 
		
		// sent to view data 

		// var_dump($_EUI['page']);die();
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('src_customer_listflexi/view_customer_flexi_list',$_EUI);
		}
	}
 }
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public function ContactDetail()
{
	if( !_have_get_session('UserId') ) { return FALSE; }
	 if(  _get_have_post('CustomerId') )
	{
		$var =new EUI_Object( _get_all_request() );
		$out =& get_class_instance(base_class_model($this));
		
		if( $arr_ouput = $out->_getDetailCustomer( $var->get_value('CustomerId') ) )
		{
			$this->load->view('mod_contact_detailspv/view_contact_main_detail_spv', array(
				'Detail' => new EUI_Object( $arr_ouput )
			));
		}
	}
 }	
  
  
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 public function PolicyStatus()
{
	$_conds = array('PolicyReady' => 0 );
	
	if(_get_post('CustomerId'))
	{
		$this->db->select("COUNT(a.PolicyAutoGenId) AS jumlah", FALSE);
		$this->db->from("t_gn_policyautogen a ");
		$this->db->where("a.CustomerId", $this->URI->_get_post('CustomerId'));
		
		if( $rows = $this->db->get()->result_first_assoc() )
		{
			$_conds = array('PolicyReady' => $rows['jumlah'] );	
		}
	}
	
	echo json_encode($_conds);	
 }
 
// --------------------------------------------------------------------
/*
 * Aksess 			public 
 */ 
 
 public function SetFollowup()
{
 $arr_response = array('success' => 0 );
 if( !_get_have_post('CustomerId') OR !_have_get_session('UserId') )
 {
	echo json_encode( $arr_response );
	return false;
 }
 
 // -------- set follow up ---------------------------------
 $cond = $this->{base_class_model($this)}->_set_row_update_followup(new EUI_Object( _get_all_request() ));
 if( $cond ){
	$arr_response = array('success' => 1 );	
  }	 
  
  echo json_encode( $arr_response );
	
} 

// --------------------------------------------------------------------
/*
 * Aksess 			public 
 */ 
 
 public function UnsetFollowup()
{
 $arr_response = array('success' => 0 );
 if( !_get_have_post('CustomerId') OR !_have_get_session('UserId') )
 {
	echo json_encode( $arr_response );
	return false;
 }
 
 // -------- set follow up ---------------------------------
 $cond = $this->{base_class_model($this)}->_unset_row_update_followup(new EUI_Object( _get_all_request() ));
 if( $cond ){
	$arr_response = array('success' => 1 );	
  }	 
  
  echo json_encode( $arr_response );
	
} 

function CheckLastCall()
{
	$_conds = array('result'=>0);
	
	$time 	= strtotime(date('H:i:s'));
	$start 	= strtotime(_get_session('StartTime'));
	$end 	= strtotime(_get_session('EndTime'));
	
	if( ($time>$start) && ($time<$end) )
	{
		$_conds = array('result'=>1);
	}
	
	echo json_encode($_conds);
}

function get_reject_status()
{
	$_conds = array('RESULT'=>1,'STATUS'=>1);
	
	$sql = "select 
				CallReasonCategoryId as RESULT,
				CallReasonId as STATUS
			from t_lk_callreason
			where CallReasonNoMoreFU=1";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows()>0)
	{
		$_conds = $qry->result_first_assoc();
	}
	
	echo json_encode($_conds);
}

public function get_age()
{
	$_conds = array('age' => 0 );
	$dob = 0;
	
	if(_get_post('CustomerId'))
	{
		$this->db->select("CustomerDOB AS dob", FALSE);
		$this->db->from("t_gn_customer a ");
		$this->db->where("a.CustomerId", $this->URI->_get_post('CustomerId'));
		
		if( $rows = $this->db->get()->result_first_assoc() )
		{
			$dob = $rows['dob'];	
		}
	}
	
	$newDate = date("Y-m-d", strtotime($dob));
	$years = 0;
		$arr_selector = _getDateDiff( date('Y-m-d'), $newDate);
		// print_r($arr_selector);
		if( is_array( $arr_selector ) AND isset($arr_selector['months_total']) AND isset($arr_selector['days_total'])){
				$Month = (int)$arr_selector['months_total'];
				$Day = (int)$arr_selector['days_total'];
				$years = $arr_selector['years'];
				if( $years == 0 ){
					if( $Month >=6 ){
						$float_value = ($Month/12);
						$years = number_format($float_value, 2);	
					}else{
						$years = 0;
					}	
				}
				else{
					if( $arr_selector['months']>0 || $arr_selector['days']>0 )
					{
						$years+=1;
					}
					
					// return array(
						// 'Age' => $years,
						// 'years'  => $arr_selector['years'],
						// 'months' => $arr_selector['months'],
						// 'days' 	 => $arr_selector['days'],
					// );
				}

			$_conds = array('age' => $years );
			// echo $years;
		}
		// $_conds = array('age' => 0 );
	
	echo json_encode($_conds);
 }

function FilterRecData(){
	
// definition array result 	
	$result_dates = date('Y-m-d');
	$result_array = array();
	
// reset select if multiple select 	

	$this->db->reset_select();
	$this->db->select("a.Recsource as Recsource", false);
	$this->db->from("t_gn_customer a");
	$this->db->where(sprintf("a.expired_date >= '%s' ", $result_dates), '', false);
	
	// filter by keyword OK 
	$keywords = UR()->fields('keyword');
	
	// jika data berupa array lihat ini.
	if( is_array($keywords) ) 
	 foreach( $keywords  as $key => $value ){
		$this->db->or_like("a.Recsource", trim($value));
	}
	$this->db->group_by('a.Recsource ');
	
// $this->db->print_out(); 
// get data source process OK 	
	
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Recsource']] = $row['Recsource'];
	}
	
// kembalikan ke nilai data JSON untuk di process di client Server.	
	$result_value = array();
	if( is_array( UR()->fields('recsource')) ) 
	foreach( UR()->fields('recsource') as $key => $val ){
		$result_value[$val] = $val; 	
	}
// result dropdown entitas.	
	printf("%s", form()->combo('src_customerspv_recsource', 'select long cz-autocomplete', $result_array, $result_value, null, array('multiple'=>'multiple' ) ) );
	return false;
}

public function filtered_recsource()
{
	
	if( _get_session('UserId') )
	{
		$recsource = array();
		$out = new EUI_Object(_get_all_request() );
		$campaign = null;
		$islike = null;
		$istext = null;
		$isfield = null;
		// echo "<pre>";
		// print_r($out);
		// echo "</pre>";
		if( _get_have_post('campaign_name') )
		{
			$campaign = $out->get_array_value('campaign_name');
			
		}
		
		if( _get_have_post('trans_from_campaign_id') )
		{
			$campaign = $out->get_array_value('trans_from_campaign_id');
			$islike = $out->get_value('trans_field_filter1');
			$istext = $out->get_value('trans_field_text1');
			$isfield = $out->get_value('trans_field_value1');
		}
		
		if( _get_have_post('pull_from_campaign_id') )
		{
			$campaign = $out->get_array_value('pull_from_campaign_id');
			$islike = $out->get_value('pull_field_filter1');
			$istext = $out->get_value('pull_field_text1');
			$isfield = $out->get_value('pull_field_value1');
		}
		
		if( _get_have_post('src_campaign_name') )
		{
			$campaign = $out->get_array_value('src_campaign_name');
			$istext = $out->get_value('src_customerspv_keyword');
		}
		
		if( $campaign ) 
		{
			$recsource = Recsource(array(
					'CampaignId'=> $campaign,
					'islike'=> "LIKE",
					'istext'=>$istext,
					'isfield'=>"b.Recsource"
					
				));
		}
		else
		{
			$recsource = Recsource();
		}
		
		// echo "<pre>";
		// print_r($recsource);
		// echo "</pre>";
		
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select tolong",$recsource, first($OnSelect));
		}	
		else if( $out->get_value('type') == 'listboxes' ) 
		{
			
			echo form()->listCombo($out->get_value('id'),"select tolong", $recsource,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
			
		}
	}
	

}
 // ============================= END CLASS ===================================
 
}
?>