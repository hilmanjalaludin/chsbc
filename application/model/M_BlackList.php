<?php
class M_BlackList extends EUI_Model
{

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 private static $intance = null;
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 private static $self_tables = null;
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 private static $self_indicates = null;
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 private static $self_input_log = null;
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
private static $self_join = null;

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
public function __construct()
{
	self::$self_tables = array('t_lk_blacklist');
	self::$self_join = array('t_gn_blacklist_trx');
	self::$self_indicates = array('CustomerNumber' => 'CIF');
	self::$self_input_log = array('CustomerNumber'=>'CIF','CustomerFirstName'=>'Customer_Name');
} 

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
public function get_self_indicates()
{
	if( !is_null(self::$self_indicates) )
	{
		return self::$self_indicates;
	}
	else
		return null;
}

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
public function get_self_join()
{
	if( !is_null(self::$self_join) )
	{
		return self::$self_join[0];
	}
	else
		return null;
}

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
public function get_self_table()
{
	if( !is_null(self::$self_tables) )
	{
		return self::$self_tables[0];
	}
	else
		return null;
}

/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 public static function & get_instance() 
 {
	if( is_null(self::$intance)){
		self::$intance = new self();
	}
	return self::$intance;
 }
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
 public function field()
 {
	$labels = array();
	if( $fields = $this -> db -> list_fields($this->get_self_table())) 
	{
		foreach( $fields as $k => $label )
		{
			$labels[$label] = $label;
		}	
	}
	
	return $labels;
 }
 
/* 
 * @ def  : 	
 * ---------------------------------------------
 * @ param : test unit
 */
 
  public function get_count( $_wheres = null, $UploadId = 0 )
 {
	$_conds = 0; $stack = 0;
	
// ------------------ clear cache --------------------------------	
	$this->db->reset_select(); 
	$this->db->select("Id");
	$this->db->from($this->get_self_table());
	
//-------------------- cek if is true string -----------------------------------
	
	$fields = $this -> get_self_indicates();
	
	if( !is_null( $_wheres ) AND !is_array($_wheres) ){
		$this->db->where("CIF", $_wheres);
		$stack = TRUE;
	}
	
	// cek if is true array
	
	if( !is_null( $_wheres ) AND is_array($_wheres) )
	{
		foreach($_wheres as $field => $values )
		{
			if( in_array($field, array_keys($fields) ) ) {
				$this -> db -> where($fields[$field], $values);
				$stack = true;
			}	
		}
	}
	
	// cek if is true 
	
	if( $stack ) 
	{
		$rs = $this ->db->get();
		if( mysql_error() ){ 
			return false; 
		}
		
		$_conds = $rs->num_rows();
		if( $_conds  > 0 )
		{
			$this->db->reset_write();
			foreach($_wheres as $field => $values ) {
				if( in_array($field, array_keys(self::$self_input_log) ) ) 
				{
					$this -> db -> set(self::$self_input_log[$field], $values);
				}
			}
			
			$this -> db->set('Upload_Id', $UploadId , false); 
			$this -> db->set('Upload_DateTs', date('Y-m-d H:i:s')); 
			$this -> db->set('Upload_ById', $this -> EUI_Session -> _get_session('UserId')); 
			$this -> db->insert( $this -> get_self_join() );
			
		}
	}
	
	return $_conds;
	
 }
 
 
}
?>