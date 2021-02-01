<?php 

class M_Backdor extends EUI_Model
{
	
var $InstanceId = 0;	
// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */
 
private static $Instance = null;

// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */
public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}
	
	return self::$Instance;
}

// ----------------------------------------------------------------------------------
 protected function InstanceId( $Extension = '' )
{
	
 $this->db->reset_select();
 $this->db->select("b.instance_id", FALSE);
 $this->db->from("cc_extension_agent a ");
 $this->db->join("cc_settings b ","a.pbx=b.set_value AND b.set_modul='cti'", "LEFT");
 $this->db->where("a.ext_number", $Extension);
 
 $rs  = $this->db->get();
 if( $rs->num_rows() )
 {
	$this->InstanceId = (int)$rs->result_singgle_value();	
  }
  
  
  
  return $this->InstanceId;
  
}


// ---------------------------------------------------------------------------------
/*
 *  @ pack 			_select_row_cc_setting
 */
 
 public function _select_row_cc_setting( $Extension = '', $modul='manager')
{

$ar_row_cc_setting = array();

$InstanceId = $this->InstanceId( $Extension );
 if( !$InstanceId )
{
  return FALSE;	
}	

// ----------------------------------------------------------------------

 $this->db->reset_select();
 $this->db->select("*", FALSE);
 $this->db->from("cc_settings a");
 $this->db->where("a.instance_id", $InstanceId);
 $this->db->where("a.set_modul",$modul);
 
 $rs = $this->db->get();
 if(  $rs->num_rows() >  0 ) 
	 foreach( $rs->result_assoc() as $rows )
 {
	$ar_row_cc_setting[$rows['set_name']] = $rows['set_value'];
 }
 return $ar_row_cc_setting;
 
}	

// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */
 
function __construct() {
	
}	

// ================================ END CLASS ====================================
	
}