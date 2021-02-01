<?php
// VoiceLoger

class M_VoiceLoger extends EUI_Model{
	

// 	
function M_VoiceLoger() {
// constructor && instance by super class 
}



/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{

 // set pages 
 
 $this -> EUI_Page -> _setPage(10); 
 $this -> EUI_Page -> _setQuery(" 
		SELECT 
			a.id as tot from cc_recording a inner join cc_call_session b on a.session_key=b.session_id
		LEFT JOIN cc_agent c on b.agent_id = c.id
		LEFT JOIN cc_agent_group d on c.agent_group=d.id ");

// filter

	$filter = null;

	if( $this -> URI->_get_have_post('agent_ext') )
		$filter.= " AND a.agent_ext='".$this -> URI->_get_post('agent_ext')."'";
		

	if( $this -> URI->_get_have_post('agent_id') )
		$filter.= " AND a.agent_id='".$this -> URI->_get_post('agent_id')."'";


	if( $this -> URI->_get_have_post('agent_group') )
		$filter.= " AND a.agent_group = '".$this -> URI->_get_post('agent_group')."'";


	if( $this -> URI->_get_have_post('start_time') )
		$filter.= " AND a.start_time >= '"._getDateEnglish($this -> URI->_get_post('start_time'))." 00:00:00' 
					AND a.start_time <= '"._getDateEnglish($this -> URI->_get_post('end_time'))." 23:59:59' ";


	if( $this -> URI->_get_have_post('b_number') )
		$filter.= " AND b.b_number ='" . $this -> URI->_get_post('b_number') . "'";

	$this -> EUI_Page -> _setWhere($filter);
	
	if($this -> EUI_Page -> _get_query() ) {
		return $this -> EUI_Page;
	}
}


// voice content display 

function _get_content()
{

 // set pages 
 $this -> EUI_Page -> _postPage((INT)$this -> URI -> _get_post('v_page'));
 $this -> EUI_Page -> _setPage(10); 
 $this -> EUI_Page -> _setQuery("
			SELECT 
				a.*, d.description as GroupName, c.name as AgentName, e.Name as asDirection 
			FROM cc_recording a inner join cc_call_session b on a.session_key=b.session_id
			LEFT JOIN cc_agent c on b.agent_id = c.id
			LEFT JOIN cc_agent_group d on c.agent_group=d.id
			LEFT JOIN t_lk_outbound_goals e on a.direction=e.OutboundGoalsId ");
			
// filter

	$filter = null;

	if( $this -> URI->_get_have_post('agent_ext') )
		$filter.= " AND a.agent_ext='".$this -> URI->_get_post('agent_ext')."'";
		

	if( $this -> URI->_get_have_post('agent_id') )
		$filter.= " AND a.agent_id='".$this -> URI->_get_post('agent_id')."'";


	if( $this -> URI->_get_have_post('agent_group') )
		$filter.= " AND a.agent_group = '".$this -> URI->_get_post('agent_group')."'";


	if( $this -> URI->_get_have_post('start_time') )
		$filter.= " AND a.start_time >= '"._getDateEnglish($this -> URI->_get_post('start_time'))." 00:00:00' 
					AND a.start_time <= '"._getDateEnglish($this -> URI->_get_post('end_time'))." 23:59:59' ";


	if( $this -> URI->_get_have_post('b_number') )
		$filter.= " AND b.b_number ='" . $this -> URI->_get_post('b_number') . "'";

	$this -> EUI_Page -> _setWhere($filter);
  
  // look order by 
  
  if( !$this -> URI ->_get_have_post('order_by') )
  {
	$this -> EUI_Page -> _setOrderBy('a.start_time', 'DESC'); 
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

 
// @  get voice data 

function _getVoiceLogerById($Id = 0 )
{
	$this -> db -> select('*');
	$this -> db -> from('cc_recording');
	$this -> db -> where('id', $Id);
	
	$_result =  array();
	if( $_conds = $this -> db->get() -> result_first_assoc() )
	{
		foreach($_conds as $fld => $values )
		{
			if( $fld=='file_voc_size' ) 
				$_result[$fld] = $this->EUI_Tools->_get_format_size($values);
				
			else if( $fld=='duration' ) 
				$_result[$fld] = $this->EUI_Tools->_set_duration($values);
				
			else if( $fld=='anumber' ) 
				$_result[$fld] = $this->EUI_Tools->_getPhoneNumber($values);	
				
			else if( $fld=='start_time' ) 
				$_result[$fld] = $this->EUI_Tools->_datetime_indonesia($values);	
				
			else 
				$_result[$fld] = $values;
		}
		
		return $_result;
	}
	else
		return null;
}

}
?>