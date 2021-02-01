<?php 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: customerId if tru section not / all  
 * @ return 	: array();
 */

 
class M_CallGroupTeam extends EUI_Model
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: customerId if tru section not / all  
 * @ return 	: array();
 */

 
public function M_CallGroupTeam() {
	// & run of class model 
}
	

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: customerId if tru section not / all  
 * @ return 	: array();
 */
 
public function _getGroupTeamUserId( $UserId = NULL ) 
{
	$_conds = 0;
	
	$this->db->select('COUNT(b.GroupTeamId) as QTY');
	$this->db->from('t_gn_group_call a');
	$this->db->join('t_gn_group_team b','a.GroupId= b.GroupCallId','LEFT');
	$this->db->where('b.GroupUserId', $UserId);
	$this->db->where('b.GroupTeamFlags', 1);
	if( $rows = $this->db->get()-> result_first_assoc() ) 
	{
		$_conds = (INT)$rows['QTY'];
	}
	
	return $_conds;
 }
 


}