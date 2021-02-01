<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SetResultQuality extends EUI_Model
{

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
private static $Instance  = null;	

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 
function __construct(){ }

// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery("SELECT a.ApproveId FROM t_lk_aprove_status a"); 
	$flt = '';
	 if( $this -> URI -> _get_have_post('keywords') ) {
		$flt.= " AND ( 
				AproveCode LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.AproveName LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ApproveEskalasi LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfirmFlags LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.AproveFlags LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.CancelFlags LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.UserPrivileges LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.AproveVeryfied  LIKE '%{$this->URI->_get_post('keywords')}%' 
			 ) ";	
	}						
			
	$this -> EUI_Page -> _setWhere( $flt );   
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
  $this -> EUI_Page ->_setQuery("SELECT * FROM t_lk_aprove_status a  LEFT JOIN tms_agent_profile b on a.UserPrivileges=b.id");
  
  $flt = '';
  if( $this -> URI -> _get_have_post('keywords') ) {
	$flt.= " AND ( 
				AproveCode LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.AproveName LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ApproveEskalasi LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfirmFlags LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.AproveFlags LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.CancelFlags LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.UserPrivileges LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.AproveVeryfied  LIKE '%{$this->URI->_get_post('keywords')}%'	
			 ) ";	
  }				
  		
  $this -> EUI_Page->_setWhere($flt);
  if( $this->URI->_get_have_post('order_by'))
  {
	 $this -> EUI_Page->_setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
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
  
function _getQualityBackLevel()
{ 
	$_conds = array();
	$this -> db->select('a.ApproveId');
	$this -> db->from('t_lk_aprove_status a');
	$this -> db->where('a.AproveFlags', 1); 
	$this -> db->where('a.ApproveEskalasi',1);
	$this -> db->where('a.ConfirmFlags',0);
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_conds[$rows['ApproveId']] = $rows['ApproveId'];
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

 public function _getQualityVeryfied()
 {
	$_conds = array();
	$this -> db ->reset_select();
	$this -> db ->select('ApproveId, AproveCode, AproveName');
	$this -> db ->from('t_lk_aprove_status');
	$this -> db ->where('AproveVeryfied',1);

	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_conds[$rows['ApproveId']]= array (
			'name' => $rows['AproveName'],
			'code' => $rows['AproveCode'] 
		);	
	}
	
	return $_conds;
 }
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * query-mssql [OK]
 */

 public function _getQualityConfirm()
 {
	$_conds = array();
	$this -> db ->reset_select();
	$this -> db ->select('ApproveId, AproveCode, AproveName');
	$this -> db ->from('t_lk_aprove_status');
	$this -> db ->where('AproveFlags',1);
	$this -> db ->where('ConfirmFlags',1);
	
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_conds[$rows['ApproveId']]= array (
			'name' => $rows['AproveName'],
			'code' => $rows['AproveCode'] 
		);	
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

 public function _getQualityInterest()
 {
	$_conds = array();
	
	$this->db->reset_select();
	$this->db->select('
		a.ApproveId, 
		a.AproveCode, 
		a.AproveName,
		(SELECT count(*) 
			FROM t_lk_aprove_status qs 
		WHERE qs.ApproveParent= a.ApproveId ) as Summary', 
	FALSE);

	$this->db->from('t_lk_aprove_status a');
	$this->db->where('AproveFlags',1);
	$this->db->having("Summary",0);
	$rs = $this->db->get();
	if( $rs->num_rows() > 0)
		foreach( $rs->result_assoc() as $rows )
	{
		$_conds[$rows['ApproveId']]= array (
			'name' => $rows['AproveName'],
			'code' => $rows['AproveCode'] 
		);	
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

 public function _getQualityResult()
 {
	$_conds = array();
	
	$this->db->reset_select();
	$this->db->select('
		a.ApproveId, 
		a.AproveCode, 
		a.AproveName,
		(SELECT count(*) FROM t_lk_aprove_status qs 
		WHERE qs.ApproveParent= a.ApproveId ) as Summary', 
	FALSE);

	$this->db->from('t_lk_aprove_status a');
	$this->db->where('AproveFlags',1);
	#$this->db->having("Summary",0);
	$rs = $this->db->get();
	#var_dump( $this->db->last_query() );die();

	if( $rs->num_rows() > 0)
		foreach( $rs->result_assoc() as $rows )
	{
		$_conds[$rows['ApproveId']]= array (
			'name' => $rows['AproveName'],
			'code' => $rows['AproveCode'] 
		);	
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
 
 function _setActive($data=array())
 {
	$_conds = 0;
	if(is_array($data))
	{
		foreach( $data['QualityResultId'] as $keys => $QualityResultId )
		{
			if( $this -> db ->update('t_lk_aprove_status', 
				array('AproveFlags'=> $data['Active']), 
				array('ApproveId' => $QualityResultId)
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
 
function  _setDeleteQualityResult( $data = null )
 {
	$_conds = 0;
	if(is_array($data))
	{
		foreach( $data as $keys => $ApproveId )
		{
			if( $this -> db ->delete('t_lk_aprove_status', 
				array('ApproveId'=>$ApproveId)
			)){
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
 
function _setSaveQualityResult($data = array())
{
	$_conds = 0;
	if( $this -> db -> insert('t_lk_aprove_status', $data )) {
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

function _getQualityData( $QualityId=null )
{
	$_conds = array();
	
	$this -> db->select('*');
	$this -> db->from('t_lk_aprove_status a');
	$this -> db->where('a.ApproveId',$QualityId);
	
	if( $rows = $this->db->get()->result_first_assoc() )
	{
		$_conds = $rows;
	}
	
	return $_conds;
}

/*
 * @ def 		: _getEventSale
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _setUpdateQualityResult($_post = array() )
{
	$_conds = 0; $update = array(); $where = array();
	foreach( $_post as $fields => $values )
	{
		if(($fields!='ApproveId'))
			$update[$fields] = $values;
		else
			$where[$fields] = $values;
	}
	
	if( $this -> db -> update('t_lk_aprove_status',$update,$where)){
		$_conds++;	
	}
	
	return $_conds;
 }
 
 
 
/*
 * @ def 		: _getEventSale
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _getQualityStatusByCode( $Code = 0 )
{
	$ResultId = 0;
	$this -> db -> select("a.ApproveId");
	$this -> db -> from("t_lk_aprove_status a");
	$this -> db -> where("a.AproveCode", $Code);
	if( $rows = $this -> db -> get() -> result_first_assoc() )
	{
		$ResultId = $rows['ApproveId'];
	}
	return $ResultId;
} 

}

?>