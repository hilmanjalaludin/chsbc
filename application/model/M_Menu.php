<?php
/*
 * EUI Model  
 *
 
 * Section  : < M_User > get information user on table 
 * author 	: razaki team  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class M_Menu extends EUI_Model {

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
private static $Instance = null;

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
 public static function &Instance()  
{
  if( is_null( self::$Instance ) ){
	self::$Instance = new self();
  }
  return self::$Instance;	
}
	
	
// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */

function __construct() { }

// -------------------------------------------------------
/*
 * @ package 	: copyright
 */
protected function  _select_row_group( $GroupId = 0, $where_not_in = 0 )
{
  if( !is_array($where_not_in) ){
	$where_not_in = array( $where_not_in );
  }
  
 $arr_select_row_group = array();
 $this->db->reset_select();
 $this->db->select("*", FALSE);
 $this->db->from("tms_application_menu a ");
 $this->db->join("tms_group_menu b","a.group_menu=b.GroupId","LEFT");
 $this->db->where('a.group_menu',$GroupId);
 $this->db->where('a.flag',1);
 
 if( is_array($where_not_in) AND count($where_not_in) > 0 )
 {
	$this->db->where_not_in('b.GroupId',$where_not_in);	
 }
 
 $this->db->order_by('a.OrderId', 'ASC');
 $rs = $this->db->get();
 
 #var_dump( $this->db->last_query() );die();
 if( $rs->num_rows() > 0 ){
	$arr_select_row_group  = $rs->result_assoc(); 
 }
 return (array) $arr_select_row_group;
}

// -------------------------------------------------------
/*
 * @ package 	: copyright
 * 
 */
 
 public function _get_acess_menu( $escape = 0)
{
  $arr_merge_user  = array();
  $arr_list_menu   = $this->_get_list_menu();
  $arr_list_aksess = $this->_get_akses_menu();

  
  if( is_array( $arr_list_menu ) AND count($arr_list_menu) > 0 )  
	  foreach( $arr_list_menu as $key => $GroupId ) 
  {
		$row = $this->_select_row_group( $GroupId, $escape);
		if( is_array( $row ) ) foreach( $row as $rows )
		{
			$out = new EUI_Object( $rows );
		
			// ========== > wil scan on list data <=============================
			
			 if( in_array($out->get_value('id'),  $arr_list_aksess ) )
			{
				 $arr_merge_user[$out->get_value('GroupName')][$out->get_value('id')] =  array
				(
					'file_name' => $out->get_value('file_name'),
					'menu' 		=> $out->get_value('menu'),
					'id' 		=> $out->get_value('el_id'),
					'groupid' 	=> $out->get_value('GroupId'),
					'images'	=> $out->get_value('images'),
					'style' 	=>'cssmenus'
				);
			}	
		}
	}
	
 return (array)$arr_merge_user;
} 

// -------------------------------------------------------------------------------------------------
/* is  version */

 public function _get_list_menu()
{
	
 $arr_userlist = array();
 $this->db->reset_select();
 $this->db->select("menu_group", false);
 $this->db->from("tms_agent_profile");
 $this->db->where("id", _get_session('HandlingType'));
 
 $rs = $this->db->get();
 #var_dump( $this->db->last_query() );die();
 if( $rs->num_rows() AND ( $rows = $rs->result_first_assoc() ))
 {
	$out = new EUI_Object( $rows );	
	if( $out->fetch_ready() )  
	{
		$arr_userlist = explode(',',$out->get_value('menu_group') );		
		// var_dump( $arr_userlist );die();
	}
 }	 
 
 return (array)$arr_userlist;
 
}
// end function  ================>
  
  
// -------------------------------------------------------------------------------------------------
/* is  version */
 public function _get_akses_menu()
{
	
 $arr_menu = array();
 $this->db->reset_select();
 $this->db->select("menu", FALSE);
 $this->db->from("tms_agent_profile");
 $this->db->where('id', _get_session('HandlingType'));
 $rs = $this->db->get();
 
 #var_dump( $this->db->last_query() );die();
 if( $rs->num_rows() > 0 ) 
 {
	$row = new EUI_Object( $rs->result_first_assoc() ); 	
	if( $row->fetch_ready() ) {
		$arr_menu = explode(',', $row->get_value('menu'));
	}	
 }	
 return (array)$arr_menu;
  
} 
// end function  ================>
  
  
  // ============================= END CLASS ==================================
}
 
 
 ?>