<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_CtiUserSkill extends EUI_Model
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function M_CtiUserSkill(){
	$this -> load -> meta('_cc_extension_agent');
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
	$this -> EUI_Page -> _setPage(10); 
	
	$this -> EUI_Page -> _setQuery
			("select a.id, a.score, b.name, c.skill_code, c.skill_type,c.description from cc_agent_skill a
				left join cc_agent b on a.agent=b.id 
				left join cc_skill c on a.skill=c.id "); 
	
	
	$filter = '';
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$keywords = $this -> URI -> _get_post("keywords");
		
		$filter = " AND ( a.id LIKE '%$keywords%' 
							OR b.name LIKE '%$keywords%' 
							OR c.skill_code LIKE '%$keywords%' 
							OR c.skill_type LIKE '%$keywords%'  
							OR c.description LIKE '%$keywords%' 
						   )";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	
	if( $this -> EUI_Page -> _get_query() )
	{
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
 
	$this -> EUI_Page -> _setQuery
			("
				select a.id, a.score, b.name, c.skill_code, c.skill_type, c.description  
				from cc_agent_skill a
			left join cc_agent b on a.agent=b.id 
			left join cc_skill c on a.skill=c.id "); 
	
			
	$filter = '';
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$keywords = $this -> URI -> _get_post("keywords");
		
		$filter = " AND ( a.id LIKE '%$keywords%' 
							OR b.name LIKE '%$keywords%' 
							OR c.skill_code LIKE '%$keywords%' 
							OR c.skill_type LIKE '%$keywords%'  
							OR c.description LIKE '%$keywords%' 
						   )";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	
	if( $this -> URI ->_get_have_post('order_by') )
	{
		$this -> EUI_Page->_setOrderBy($this -> URI ->_get_post('order_by'),$this -> URI ->_get_post('type') );
	} else {
		$this -> EUI_Page->_setOrderBy('a.id');
	}
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
 
 
 function _getUserSkill()
 {
	$_conds = array();
	
	$this -> db -> select('*');
	$this -> db -> from('cc_skill');
	
	foreach( $this -> db -> get()->result_assoc() as $rows ){
		$_conds[$rows['id']] = $rows['description'];
	}
	
	return $_conds;
	
 }
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setSaveUserSkill($post)
 {
	$_conds = 0;
	
	if(is_array($post) )
	{
		if( $this -> db->insert('cc_agent_skill',$post) )
		{
			$_conds++;
		}
	}
	
	return $_conds;
 }
 
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 function _setUpdateUserSkill($post)
 {
	$_conds = 0;
	
	if(is_array($post) )
	{
		$update = array(); $where = array();
		
		foreach( $post as $fields => $values )
		{
			if( $fields=='id'){
				$where[$fields] = $values;
			}
			else{
				$update[$fields] = $values;
			}
		}
		
		if( $this -> db->update('cc_agent_skill',$update, $where ))
		{
			$_conds++;
		}
	}
	
	return $_conds;
 }
 
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getUserSkillData( $SkillId=0 )
 {
	$_conds = array();
	
	$this -> db->select('*');
	$this -> db->from('cc_agent_skill');
	$this -> db->where('id', $SkillId);
	if( $rows = $this -> db->get() -> result_first_assoc() ) {
		$_conds  = $rows;
	}
	
	return $_conds;
	
 }

 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setDeleteUserSkill($Skill=array() )
 {
	$_conds = 0;
	foreach( $Skill as $k => $SkillId )
	{
		if( $this -> db -> delete('cc_agent_skill',array( 'id' => $SkillId )) )
		{
			$_conds++;
		}
	}
	
	return $_conds;	
 }
 
 
}

?>