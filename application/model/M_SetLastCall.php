<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetLastCall modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SetLastCall extends EUI_Model
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	
	$this -> EUI_Page -> _setQuery(" SELECT LastCallId FROM t_gn_lastcall a left join tms_agent b on a.LasCallCreateBy=b.UserId "); 
	
	$filter = '';
	
	if( $this->URI->_get_have_post('key_words') ) 
	{
		$filter ="";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	if( $this -> EUI_Page -> _get_query() ) {
		return $this -> EUI_Page;
	}
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_content()
{

  $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
  $this -> EUI_Page->_setPage(10);
  $this -> EUI_Page ->_setQuery
		(
			"SELECT LastCallId, LastCallStartDate, LastCallEndDate,LastCallReason,
			 LastCallStartTime, LastCallEndTime, IF(LastCallStatus<>0,'Active','Not Active') as LastCallStatus, 
			 LasCallCreateBy, LastCallCreateDate, b.id, b.full_name 
			 FROM t_gn_lastcall a left join tms_agent b on a.LasCallCreateBy=b.UserId"
		);
  
  $filter = '';
  if( $this -> URI -> _get_have_post('key_words') ) {
	$filter = " ";	
  }				
		
  $this -> EUI_Page->_setWhere();
  $this -> EUI_Page->_setLimit();
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
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setActive( $data = array() )
 {
	$_conds = 0;
	if(is_array($data))
	{
		foreach( $data['LastCallId'] as $keys => $LastCallId )
		{
			if( $this -> db ->update('t_gn_lastcall', 
				array('LastCallStatus'=> $data['Active']), 
				array('LastCallId' => $LastCallId)
			))
			{
				$_conds++;
			}	
		}
	}	
	return $_conds;
 }
 
/*
 * @ def 		: _setActive
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getDataWorkTime( $Call_Id=0 )
 {
	$_conds = array();
	$this -> db -> select('*');
	$this -> db -> from('t_gn_lastcall');
	$this -> db -> where('LastCallId', $Call_Id );
	if( $rows = $this -> db->get()->result_first_assoc() )
	{
		$_conds = $rows;
	}
	
	return $_conds;
	
 }
 
 
/*
 * @ def 		: _setActive
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setUpdateWorkTime($_post=array() )
 {
	$_conds = 0; $update = array(); $where = array();
	foreach( $_post as $fields => $values )
	{
		if( $fields=='LastCallId' ){
			$where[$fields] = $values;
		}
		else if( $fields=='LasCallCreateBy' ){
			$update[$fields] = $this -> EUI_Session->_get_session('UserId');
		}
		else if( $fields=='LastCallStartDate'){
			$update[$fields] = $this->EUI_Tools->_date_english($values);
		}
		else if( $fields=='LastCallEndDate'){
			$update[$fields] = $this->EUI_Tools->_date_english($values);
		}
		else if($fields=='LastCallCreateDate' ){
			$update[$fields] = $this->EUI_Tools->_date_time($values);
		}
		else{
			$update[$fields] = $values;
		}
	}
	
	//print_r($update);
	if( $this -> db -> update('t_gn_lastcall',$update,$where)){
		$_conds++;	
	}
	
	return $_conds;
 }
 
/*
 * @ def 		: _setActive
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _setSaveWorkTime($data = array())
{
	$_Insert = array();
	
	foreach($data as $fields => $values )
	{
		if( $fields=='LastCallStartDate')
			$_Insert[$fields] = $this->EUI_Tools->_date_english($values);
			
		else if( $fields=='LastCallEndDate')
			$_Insert[$fields] = $this->EUI_Tools->_date_english($values);
			
		else if( $fields=='LasCallCreateBy')
			$_Insert[$fields] = $this -> EUI_Session->_get_session('UserId');
			
		else if( $fields=='LastCallCreateDate')
			$_Insert[$fields] = $this->EUI_Tools->_date_time();
			
		else
			$_Insert[$fields] = $values;
	}
	
	
	$_conds = 0;
	if( $this -> db -> insert('t_gn_lastcall', $_Insert ))
	{
		$_conds++;
	}
	
	return $_conds;
}

function _getLastCallToday()
{
	$_conds = array();
	$this->db->select('LastCallStartTime, LastCallEndTime');
	$this->db->from('t_gn_lastcall');
	$this->db->where('LastCallStartDate', date('Y-m-d') );
	$this->db->where('LastCallStatus', 1 );
	// $rows = $this -> db->get()->result_first_assoc()
	$query = $this->db->get();
	if( $query->num_rows() > 0 )
	{
		$rows = $query->row_array();
		$_conds['StartTime'] = $rows['LastCallStartTime'];
		$_conds['EndTime'] 	 = $rows['LastCallEndTime'];
	}
	
	return $_conds;
}

}

?>