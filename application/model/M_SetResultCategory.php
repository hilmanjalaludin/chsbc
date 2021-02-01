<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_SetResultCategory extends EUI_Model
{

 
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */

 
 private $set_limit_page = 10;
 
// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */
 
  private static $Instance = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

// ---------------------------------------------------------------------------------------------------
/*
 * @ package 		 __construct // constructor class 
 * @ return 	: void(0)
 */

 function __construct()
{ 
	$this->load->model(array('M_ModOutBoundGoal'));
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
	$this ->EUI_Page->_setPage($this->set_limit_page);
	$this ->EUI_Page->_setSelect("a.CallReasonCategoryId", FALSE);
	$this ->EUI_Page->_setFrom("t_lk_callreasoncategory a");
	$this ->EUI_Page->_setJoin("t_lk_outbound_goals b", "a.CallOutboundGoalsId=b.OutboundGoalsId", "LEFT", TRUE);
	
// --- set filter if OK ---
	$this->EUI_Page->_setAndOr(array(
		"a.CallReasonCategoryCode" => array("LIKE",_get_post('keywords')),
		"a.CallReasonCategoryName" => array("LIKE",_get_post('keywords')),
		"a.CallReasonInterest" => array("LIKE",_get_post('keywords')),
		"a.CallReasonCategoryFlags" => array("LIKE",_get_post('keywords')),
		"a.CallOutboundGoalsId" => array("LIKE",_get_post('keywords') )
	));
	
	return $this->EUI_Page;	
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_content() 
{
  $this->EUI_Page->_postPage(_get_post('v_page') );
  $this->EUI_Page->_setPage($this->set_limit_page);
  
  $conds1 = " IF( a.CallReasonInterest =1, 'YES', 'NO') as CallReasonInterest ";
  $conds2 = " IF(a.CallReasonCategoryFlags = 1, 'Active', 'Not Active') as Flags ";
  if( QUERY == 'mssql') {
  	$conds1 = " CASE WHEN a.CallReasonInterest=1 THEN 'YES' ELSE 'NO' END as CallReasonInterest ";
  	$conds2 = " CASE WHEN a.CallReasonCategoryFlags= 1 THEN 'Active' ELSE 'Not Active' END as Flags ";
  }

  $this->EUI_Page->_setArraySelect(array(
	"a.CallReasonCategoryId as CategoryId" => array("CategoryId", "CategoryId", "primary"),
	"a.CallReasonCategoryCode as CallReasonCategoryCode" => array("CallReasonCategoryCode", "Category Code"),
	"a.CallReasonCategoryName as CallReasonCategoryName" => array("CallReasonCategoryName", "Category Name"),
	"{$conds1}" => array("CallReasonInterest", "Interest"),
	"b.Description as CallDirection" => array("CallDirection","Call Type"),
	"a.CallReasonCategoryOrder  as Sorter" => array("Sorter", "Sort Order"),
	"{$conds2}" => array("Flags", "Status")
  ));
  
  $this->EUI_Page->_setFrom("t_lk_callreasoncategory a");
  $this->EUI_Page->_setJoin("t_lk_outbound_goals b", "a.CallOutboundGoalsId=b.OutboundGoalsId", "LEFT", TRUE);
	
 // --- set filter if OK ---
 $this->EUI_Page->_setAndOr(array(
	"a.CallReasonCategoryCode" => array("LIKE",_get_post('keywords')),
	"a.CallReasonCategoryName" => array("LIKE",_get_post('keywords')),
	"a.CallReasonInterest" => array("LIKE",_get_post('keywords')),
	"a.CallReasonCategoryFlags" => array("LIKE",_get_post('keywords')),
	"a.CallOutboundGoalsId" => array("LIKE",_get_post('keywords') )
 ));

	// ------------ set order field  ----------------------------
	// echo $this->EUI_Page->_getCompiler();	

   if(_get_have_post('order_by')) 
   {
	 $this->EUI_Page->_setOrderBy($this ->URI->_get_post('order_by'),$this ->URI->_get_post('type'));
   } else {
	   $this->EUI_Page->_setOrderBy("a.CallReasonCategoryId","ASC");
   }
   
  $this->EUI_Page->_setLimit();
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
function _getOutboundCategory()
{ 
	$_conds = array();
	
	$this -> db ->select("*");
	$this -> db ->from("t_lk_callreasoncategory a");
	$this -> db ->join("t_lk_outbound_goals b","a.CallOutboundGoalsId=b.OutboundGoalsId","LEFT");
	$this -> db ->where('b.Name','outbound');
	$this -> db ->where('a.CallActivityShow','1');
	
	foreach( $this ->db ->get() ->result_assoc() as $rows)
	{
		$_conds[$rows['CallReasonCategoryId']] = $rows['CallReasonCategoryName'];
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
 
function _getInboundCategory()
{
	$_conds = array();
	
	$this -> db -> select("*");
	$this -> db -> from("t_lk_callreasoncategory a");
	$this -> db -> join("t_lk_outbound_goals b","a.CallOutboundGoalsId=b.OutboundGoalsId","LEFT");
	$this -> db -> where('b.Name','inbound');
	$this -> db ->where('a.CallActivityShow','1');
	
	foreach( $this ->db ->get() ->result_assoc() as $rows)
	{
		$_conds[$rows['CallReasonCategoryId']] = $rows['CallReasonCategoryName'];
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
 
 function _setActive($data=array())
 {
	$_conds = 0;
	if(is_array($data))
	{
		foreach( $data['CategoryId'] as $keys => $CategoryId )
		{
			if( $this -> db ->update('t_lk_callreasoncategory', 
				array('CallReasonCategoryFlags'=> $data['Active']), 
				array('CallReasonCategoryId'=>$CategoryId)
			))
			{
				$_conds++;
			}	
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
 
 function _setDelete( $data=array() )
 {
	$_conds = 0;
	if(is_array($data))
	{
		foreach( $data as $keys => $CategoryId )
		{
			if( $this -> db ->delete('t_lk_callreasoncategory', 
				array('CallReasonCategoryId'=>$CategoryId)
			)){
				$_conds++;
			}	
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
 
 function _getOrder( $param=0 )
 {
	$_order = array();
	for($i = 0; $i <=(INT)$param; $i++) {
		$_order[$i] = $i;
	}
	
	return $_order;
 }
 
 function _getOuboundGoals() 
 {
	$_conds = array();
	$this -> db -> select('*');
	$this -> db -> from('t_lk_outbound_goals');
	foreach( $this -> db ->get()->result_assoc() as $rows ) 
	{
		$_conds[$rows['OutboundGoalsId']] = $rows['Description'];
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
 
 function _getCategoryInterest()
 {
	$_order = array( '1'=> 'YES','0' => 'NO');
	return $_order;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */	
 
 function _getDataCategory( $CategoryId=0 )
 {
	$this ->db ->select('*');
	$this ->db ->from('t_lk_callreasoncategory');
	$this ->db ->where('CallReasonCategoryId',$CategoryId);
	
	$_conds = array();
	if( $rows = $this -> db -> get() -> result_first_assoc() ) {
		$_conds = $rows;
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
 
 function _setSaveCategory($data = array() )
 {
	$_conds = 0;
	if( $this -> db -> insert('t_lk_callreasoncategory', $data ))
	{
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
 
 function _setUpdateCategory($data = array() )
 {
	$_conds = 0; $_update = array(); $_where = array();
	foreach( $data as $fields => $values ) {
		if( ( $fields!='CallReasonCategoryId') )
			$_update[$fields] = $values; 
		else
			$_where[$fields]= $values;
	}
	
	if( $this -> db->update('t_lk_callreasoncategory',$_update, $_where ))
	{
		$_conds++;
	}	
	
	return $_conds;
 }
 
 
}

?>