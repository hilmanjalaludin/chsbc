<?php

class M_VoiceMail extends EUI_Model
{

var $_arrs_labels_voice = null;
var $_arrs_labels_customer = null;
var $_outbound_goals = 1;


public function M_VoiceMail()
{
	$this->_arrs_labels_voice = array
	(
		'anumber' 		=> array( 'label'=>'From Number', 	'name'=>'anumber',		 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')), 
		'bnumber' 		=> array( 'label'=>'Destination', 	'name'=>'bnumber',		 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')),
		'start_time' 	=> array( 'label'=>'Call Date',   	'name'=>'start_time',	 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')), 
		'duration' 		=> array( 'label'=>'Duration', 		'name'=>'duration',		 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')),
		'file_voc_size' => array( 'label'=>'File Size', 	'name'=>'file_voc_size', 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')),
		'file_voc_type' => array( 'label'=>'File Type', 	'name'=>'file_voc_type', 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')),
		'file_voc_loc'  => array( 'label'=>'File Location', 'name'=>'file_voc_loc',  'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;')),
		'file_voc_name' => array( 'label'=>'File Name', 	'name'=>'file_voc_name', 'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:250px;'))
	);
	
	
	$this->_arrs_labels_customer = array
	(
		'CustomerFirstName' 		=> array( 'label'=>'Customer Name', 		'name'=>'CustomerFirstName',		 	'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')), 
		'CustomerDOB' 				=> array( 'label'=>'DOB', 					'name'=>'CustomerDOB',		 			'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')),
		//'CustomerAddressLine1' 		=> array( 'label'=>'Address Line 1',   	'name'=>'CustomerAddressLine1',	 		'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')), 
		//'CustomerAddressLine2' 		=> array( 'label'=>'Address Line 2',   	'name'=>'CustomerAddressLine3',	 		'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')), 
		//'CustomerAddressLine3' 		=> array( 'label'=>'Address Line 3',   	'name'=>'CustomerAddressLine3',	 		'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')), 
		//'CustomerCity' 				=> array( 'label'=>'City', 				'name'=>'CustomerCity',		 			'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')),
		//'CustomerZipCode' 			=> array( 'label'=>'Zip Code', 			'name'=>'CustomerZipCode', 				'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')),
		'CustomerHomePhoneNum' 		=> array( 'label'=>'Home Phone ', 			'name'=>'CustomerHomePhoneNum', 		'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')),
		'CustomerMobilePhoneNum'  	=> array( 'label'=>'Mobile Phone', 			'name'=>'CustomerMobilePhoneNum',  		'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')),
		'CustomerWorkPhoneNum' 		=> array( 'label'=>'Office Phone', 			'name'=>'CustomerWorkPhoneNum', 		'type' => 'input', 'style' => 'input_text long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;')),
		'GenderId' 					=> array( 'label'=>'Gender ', 				'name'=>'GenderId', 					'type' => 'combo', 'style' => 'select long', 'user_call_func' => null, 'extra' => array('style' => 'width:220px;'))
		
	);
	
}

/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 	
public function getCampaignGoals()
{
	$arrs_goals = $this->M_SetCampaign->_getCampaignGoals( $this->_outbound_goals);
	if( !$arrs_goals ) 
		return array();
	else
		return $arrs_goals;
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_default()
{

 // set pages 
 
 $this->EUI_Page->_setPage(10); 
 $this->EUI_Page->_setSelect("a.*");
 $this->EUI_Page->_setFrom("ivr_voice_mail a"); 
 
// filter

  if( $this -> URI->_get_have_post('agent_ext') ){
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));
  }	

  if( $this -> URI->_get_have_post('agent_id') ){
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
  }

  if( $this -> URI->_get_have_post('agent_group') ){
		$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
  }

 if( $this -> URI->_get_have_post('start_time') )
 {
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
 }
 

 if($this -> EUI_Page -> _get_query() ) {
	return $this -> EUI_Page;
 }

}

/**
 *
 *
 *
 */
 
public  function _get_content()
{

 $this->EUI_Page->_postPage((INT)$this -> URI -> _get_post('v_page'));
 $this->EUI_Page->_setPage(10); 
 $this->EUI_Page->_setSelect("a.*, b.CallReasonId, b.CustomerUploadedTs, c.CallReasonDesc");
 $this->EUI_Page->_setFrom("ivr_voice_mail a"); 
 $this->EUI_Page->_setJoin("t_gn_customer b "," a.assignment_data=b.CustomerId","LEFT"); 
 $this->EUI_Page->_setJoin("t_lk_callreason c "," b.CallReasonId=c.CallReasonId","LEFT", TRUE); 
 

// filter

  if( $this -> URI->_get_have_post('agent_ext') ){
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));
  }	

  if( $this -> URI->_get_have_post('agent_id') ){
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
  }

  if( $this -> URI->_get_have_post('agent_group') ){
		$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
  }

 if( $this -> URI->_get_have_post('start_time') )
 {
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
	$this->EUI_Page->_setAnd("a.agent_ext", $this -> URI->_get_post('agent_ext'));	
 }
 
  
  if( !$this -> URI ->_get_have_post('order_by') ) {
	$this->EUI_Page->_setOrderBy('a.start_time', 'DESC'); 
  }
  else{
	  $this -> EUI_Page -> _setOrderBy($this -> URI ->_get_post('order_by'),$this -> URI ->_get_post('type')); 
  }
 
 $this -> EUI_Page ->_setLimit();
}

/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
 {
	self::_get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
 
 /*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function Serialize()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((strtolower($keys)!='serialize') AND (strtolower($keys)!='instance') 
			AND (strtolower($keys)!='nstruct') AND (strtolower($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 }

 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 
public function VoiceData( $VoiceId = 0 )
{
	$this->db->select('a.*, c.CampaignId');
	$this->db->from("ivr_voice_mail a");
	$this->db->join('t_lk_campaign_did b ',' a.bnumber=b.DIDDirection','LEFT');
	$this->db->join('t_gn_campaign_transaction c ','b.Id=c.DIDCampaign', 'LEFT');
	$this->db->where("a.id", $VoiceId);
	
	return $this->db->get()-> result_first_assoc();
}
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function FieldFormVoice()
 {
	$arrs_fields = array();
	
	$fields = $this->db->list_fields('ivr_voice_mail');
	$num = 0;
	foreach( $fields as $field_keys => $field_values )
	{
		if( in_array($field_values, array_keys($this->_arrs_labels_voice) ) )
		{
			$_componens = $this->_arrs_labels_voice[$field_values];
			if( is_array($_componens) ) {
				$arrs_fields[$num] = $_componens;
			}	
			$num++;
		}
	}
	
	return $arrs_fields;
	
 }
 
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function FieldFormCustomer()
 {	
	$arrs_fields = array();
	
	$fields = $this->db->list_fields('t_gn_customer');
	$num = 0;
	foreach( $fields as $field_keys => $field_values )
	{
		if( in_array($field_values, array_keys($this->_arrs_labels_customer) ) )
		{
			$_componens = $this->_arrs_labels_customer[$field_values];
			if( is_array($_componens) ) {
				$arrs_fields[$num] = $_componens;
			}	
			$num++;
		}
	}
	sort($arrs_fields);
	return $arrs_fields;
 }
  
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
private function is_ready($CustomerNumber = 0, $CampaignId = 0 )
{
	$conds = false;
	
	$this->db->select("COUNT(a.CustomerId) as jum ", FALSE);
	$this->db->from("t_gn_customer a ");
	$this->db->where("a.CustomerNumber", $CustomerNumber);
	$this->db->where("a.CampaignId", $CampaignId);
	
	if( $rows = $this->db->get()->result_first_assoc() ) {
		$conds = (INT)$rows['jum'];
	}
	
	return $conds;
}  
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _setSaveVoiceMail( $vars = null  )
{
 
 $conds = 0;
 
 // default generate
	
	$md516chars = substr(md5($vars['VoiceMailId']), 0, 16);  
	$is_ready   = $this->is_ready($md516chars, $vars['CampaignId']);
	$is_dates	= date('Y-m-d H:i:s');
	
	if((!is_null($vars)) AND ($is_ready!=TRUE) )
	{
		
	/** insert jika sama dengan data customer **/
	 foreach( $vars as $fields => $value ) 
		{ 
			if( in_array($fields, array_keys($this->_arrs_labels_customer) ) )
			{
				$this->db->set($fields, $value);
			}
		}
		
		
	/** @ ddd : field tambahan ***/
	
		$this->db->set('CallReasonId', $vars['CallReasonId']);
		$this->db->set('CampaignId', $vars['CampaignId']);
		$this->db->set('CustomerNumber', $md516chars);
		$this->db->set('CustomerUploadedTs', $is_dates );
		$this->db->insert('t_gn_customer');
		
		if($this->db->affected_rows() > 0 )
		{
			$CustomerId  = $this->db->insert_id(); 
			
		 /* step 1 : set to assignment **/
			
			if( $CustomerId!=FALSE ) 
			{
				$this->db->set('CustomerId', $CustomerId);
				$this->db->set('AssignAdmin', 2);
				$this->db->set('AssignDate', $is_dates );
				$this->db->set('AssignMode', 'INC');
				$this->db->insert('t_gn_assignment');
				$conds++;
				
			}
			 
		 /* step 2 : set to history call **/
			
			$this->db->set('CustomerId', $CustomerId);
			$this->db->set('CallReasonId', $vars['CallReasonId']);
			$this->db->set('CallHistoryNotes', $vars['VoiceMemo']);
			$this->db->set('CallHistoryCreatedTs', $is_dates);
			$this->db->set('CreatedById', $this->EUI_Session->_get_session('UserId'));
			$this->db->insert('t_gn_callhistory');
			
		/* step 3 : update ivr_voice_mail **/
			if( $this->db->affected_rows() > 0 )
			{
				$conds++;
				$this->db->set('memo', $vars['VoiceMemo']);
				$this->db->set('assignment_data', $CustomerId);
				$this->db->set('vm_status',1);
				$this->db->where('id', $vars['VoiceMailId']);
				
				$this->db->update('ivr_voice_mail');
				if( $this->db->affected_rows() > 0 ){
					$conds++;
				}
			}	
			
		}
		
	}
	
	return $conds;
 }

}

?>