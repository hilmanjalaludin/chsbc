<?php 
 
 class M_ActiveMenu extends EUI_Model
{
	
 private static $Instance = null;	
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 public static function &Instance()
{
 
 if( is_null(self::$Instance) ){
	self::$Instance = new self();
 }
 return self::$Instance;
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
function __construct(){ }	

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 public function  _select_user_privilege()
{
	
 $arr_user_privilege = array();	
 $this->db->reset_select();
 $this->db->select("ConfigName, ConfigCode, ConfigValue", FALSE);
 $this->db->from("t_lk_configuration");
 $this->db->where("ConfigCode","USER_LEVEL");
 $rs = $this->db->get();

  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $rows )
 {
	$arr_user_privilege[$rows['ConfigName']] = (int)$rows['ConfigValue'];
 }
 
  return (array)$arr_user_privilege;
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 protected function _select_toolbar_label()
{
  $arr_toolbar = NULL;
  $this->db->reset_select();
  $this->db->select("*", false);
  $this->db->from("t_gn_toolbar_label a ");
  $this->db->order_by("toolbar_label_order", "ASC");
 
  $rs = $this->db->get();
  
  if( $rs->num_rows() > 0 )
	foreach( $rs->result_assoc() as $row )
 {
	if( $row['toolbar_label_type'] == 'combo')
	{	
		$arr_toolbar[$row['toolbar_code']][] = array (
			'render' => $row['toolbar_lebel_render'],
			'type' 	 => $row['toolbar_label_type'],
			'triger' => $row['toolbar_label_triger'],
			'store'  => $row['toolbar_label_store'],
			'header' => $row['toolbar_lebel_header'],
			'id'	 => $row['toolbar_lebel_id'],
			'name'   =>	$row['toolbar_lebel_id'],
			'width'	 => $row['toolbar_label_width'],
			'value'  => $row['toolbar_label_value']
		);
	}
	else if( $row['toolbar_label_type'] == 'input') {
		$arr_toolbar[$row['toolbar_code']][] = array (
			'render' => $row['toolbar_lebel_render'],
			'type' 	 => $row['toolbar_label_type'],
			'triger' => $row['toolbar_label_triger'],
			'header' => $row['toolbar_lebel_header'],
			'id'	 => $row['toolbar_lebel_id'],
			'name'   =>	$row['toolbar_lebel_id'],
			'width'	 => $row['toolbar_label_width'],
			'value'  => $row['toolbar_label_value']
		);
	}	
	else if( $row['toolbar_label_type'] == 'label') {
		$arr_toolbar[$row['toolbar_code']][] = array (
			'render' => $row['toolbar_lebel_render'],
			'type' 	 => $row['toolbar_label_type'],
			'label'  => $row['toolbar_lebel_header'],
			'id'	 => $row['toolbar_lebel_id'],
			'name'   =>	$row['toolbar_lebel_id'],
			'value'  => $row['toolbar_label_value']
		);
	}
 }

 return $arr_toolbar;
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 public function _select_toolbar_user()
{

// --------------------------------------------
 $arrToolbar = $this->_select_toolbar_label();	 
 
 // --------------------------------------------
 $arr_toolbar = array();
 $this->db->reset_select();
 
 $this->db->select("	
	a.toolbar_user_group, b.toolbar_event, 
	b.toolbar_class, c.id,
	b.toolbar_code", FALSE);
	
 $this->db->from("t_gn_toolbar_user a ");
 $this->db->join("t_lk_toolbar_master b ","a.toolbar_code=b.toolbar_code", "LEFT");
 $this->db->join("tms_agent_profile c","a.toolbar_user_group=c.id");
 $this->db->where("a.toolbar_user_group",_get_session('HandlingType'));
 $this->db->where("b.toolbar_active",1);
 $this->db->where("a.toolbar_user_active", 1);
 $this->db->order_by("b.toolbar_order", "ASC"); 
 
  //echo $this->db->print_out();
 
 $qry = $this->db->get();
 
// --------------------- like ist ----------------------------

 $no = 0;
 if( $qry ->num_rows() > 0 ) 
	foreach( $qry ->result_assoc() as $rows )
 {
	 
	$arr_label_toolbars = ( isset( $arrToolbar[$rows['toolbar_code']] ) ? $arrToolbar[$rows['toolbar_code']] : array()); 
	if( count($arr_label_toolbars) > 0 )
	{
		foreach( $arr_label_toolbars as $k => $value ){
			$arr_toolbar['title'][$no] = '';
			$arr_toolbar['event'][$no] = '';
			$arr_toolbar['icons'][$no] = '';
			$no++;
		}
		 
		
		$arr_toolbar['title'][$no] = $rows['toolbar_class'];
		$arr_toolbar['event'][$no] = $rows['toolbar_event'];
		$arr_toolbar['icons'][$no] = '';
		/////// INI DATA YGDICARI////////
		$arr_toolbar['option'][$no]= $arr_label_toolbars;
		/////////////////////////////////
		
	} else {
		
		$arr_toolbar['title'][$no] = $rows['toolbar_class'];
		$arr_toolbar['event'][$no] = $rows['toolbar_event'];
		$arr_toolbar['icons'][$no] = '';
	}
	
	$no++;
	
	
 }
 
 //print_r( $arr_toolbar );
 return $arr_toolbar; //array_slice($arr_toolbar,0, count($arr_toolbar)-1); 
 
} 
 
// ============= END CLASS ======================

}
?>