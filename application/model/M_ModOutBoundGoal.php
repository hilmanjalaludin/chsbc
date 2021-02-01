<?php
class M_ModOutBoundGoal extends EUI_Model
{
 private static $instance = null;
 
 /*
 * @def : instance class 
 * -------------------------------
 * 
 * @param : Unit Test 
 * @param : Unit Test
 */
 
 
 public static function & get_instance()
 {
	if( is_null(self::$instance) ) {
		self::$instance = new self();
	}
	return self::$instance;
 }
 
 /*
 * @def : get outbound call ID 
 * -------------------------------
 * 
 * @param : Unit Test 
 * @param : Unit Test
 */
 
 
 function _getOuboundGoals() 
 {
	$_conds = array();
	$sql = "select * from t_lk_outbound_goals a";
	$qry = $this->db->query($sql);
	foreach($qry -> result_assoc() as $rows ) 
	{
		$_conds[$rows['OutboundGoalsId']] = $rows['Description'];
	}
	return $_conds;
}

/*
 * @def : get outbound call ID 
 * -------------------------------
 * 
 * @param : Unit Test 
 * @param : Unit Test
 */
 
 public function _getOutboundId()
 {
	$_conds = 0;
	$this ->db ->select("*");
	$this ->db ->from("t_lk_outbound_goals a");
	$this ->db ->where("a.Name",'outbound');
	if( $rows = $this -> db -> get() -> result_first_assoc() ) {
		$_conds = $rows['OutboundGoalsId'];
	}
	
	return $_conds;
 }
 
 
 /*
 * @def : get outbound call ID 
 * -------------------------------
 * 
 * @param : Unit Test 
 * @param : Unit Test
 */
 
 public function _getInboundId()
 {
	$_conds = 0;
	
	$this ->db ->select("*");
	$this ->db ->from("t_lk_outbound_goals a");
	$this ->db ->where("a.Name",'inbound');
	if( $rows = $this -> db -> get() -> result_first_assoc() ) {
		$_conds = $rows['OutboundGoalsId'];
	}
	
	return $_conds;
 }



}
?>