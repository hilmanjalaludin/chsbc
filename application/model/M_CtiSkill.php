<?php
class M_CtiSkill extends EUI_Model
{

// meta table ;

 private static $meta = null; 
 private static $Instance = null;
 
// ------------------- select rows skil define -----------------
 
  public static function &Instance()
{
	 if( is_null(self::$Instance) )
	{
		self::$Instance = new self();
	} 
	return self::$Instance;
 }
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function __construct()
 {
	if( is_null(self::$meta) ) {
		self::$meta = 'cc_skill';
	}
 }
 
 
// ------------------- select rows skil define -----------------

 public function getSelectSkillUser()
{
	$arr_skill = array();
	$this->db->reset_select();
	$this->db->select("a.id, a.description", FALSE);
	$this->db->from("cc_skill  a");
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 )
		foreach( $rs->result_assoc() as $rows )
	{
		$arr_skill[$rows['id']]	 = $rows['description'];
	}
	
	return (array)$arr_skill;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getData( $id = NULL )
{
	$this -> db -> select('*');
	$this -> db -> from(self::$meta);
	$this -> db -> where('id',$id);
	return $this -> db -> get()->result_first_assoc();
}


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getFieldName() 
{
	return $this->db->list_fields(self::$meta);
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
	$this -> EUI_Page -> _setQuery(" SELECT * FROM " . self::$meta ." a "); 
	$flt = '';
	
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$flt .=" AND ( 
				a.domain LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.skill_code LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.skill_type LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.description LIKE '%{$this->URI->_get_post('keywords')}%'  
			)";
	}				
			
	$this -> EUI_Page -> _setWhere($flt);   
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
  
  $sql =" SELECT * FROM " . self::$meta . " a ";
  $this -> EUI_Page ->_setQuery($sql);
  $flt = '';
  
  if( $this->URI->_get_have_post('keywords') ) 
  {
	$flt .=" AND ( 
				a.domain LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.skill_code LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.skill_type LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.description LIKE '%{$this->URI->_get_post('keywords')}%'  
			)";
  }
  
  $this -> EUI_Page->_setWhere($flt);
  if( $this -> URI ->_get_have_post('order_by'))
  {
	$this -> EUI_Page->_setOrderBy($this ->URI->_get_post('order_by'),$this ->URI->_get_post('type'));
  } else {
  	$this -> EUI_Page->_setOrderBy('a.domain');
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
 
 
 function _setSave($params=array())
 {
	$_conds= 0;
	foreach($params  as $k => $v ) {
		$this -> db -> set($k,$v);
	}
	
	$this -> db -> insert( self::$meta );
	if( $this -> db -> affected_rows()>0 ) {
		$_conds++;
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
 
  function _setUpdate($params=array())
 {
	$_conds= 0;
	foreach($params  as $k => $v )  
	{
		if( $k=='id')
			$this -> db -> where($k,$v);
		else
			$this -> db -> set($k,$v);
	}
	
	if($this -> db -> update(self::$meta)) 
	{
		$_conds++;
	}
	
	return $_conds;
 }
 
 /// _setDelete
 
 function _setDelete($params = null )
 {
	$_conds = 0;
	
	$this -> db-> where_in('id',$params);
	
	if( $this ->db ->delete( self::$meta )){
		$_conds++;
	}
	
	return $_conds;
	
 }
 
 
 
}
?>