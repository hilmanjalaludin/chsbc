<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
 
class M_SetField extends EUI_Model
{
var $set_limit_page = 10;
 
// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */
 
 private static $Instance   = null; 
  public static function &Instance()
 {
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
 }

 
// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */
 
 public function __construct() 
 { 
	$this->load->model(array('M_SetCampaign'));
 }
 
 
// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */
function _getFieldByCampaignId( $CampaignId = 0 )
{ 
  $this ->db -> select('*');
  $this ->db -> from('t_gn_field_campaign a');
  $this ->db -> where("a.CampaignId", $CampaignId);
  $this ->db -> where("a.Field_Active", 1);
  
  if( $rows = $this -> db -> get() -> result_first_assoc() )  
	return $rows;
  else
	return false;
}

// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */

 protected function _select_row_hide_table_contact( $arr_table = null )
{
	
 $arr_contact_hide = array();
 
 if( !is_array($arr_table) ){
	$arr_table = array($arr_table);
 }
 
 $this->db->reset_select();
 $this->db->select("table_field_name", FALSE);
 $this->db->from("t_gn_hide_tables");
 $this->db->where_in("table_name", $arr_table);
 
 $rs = $this->db->get();
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $rows ) 
 {
	$arr_contact_hide[$rows['table_field_name']] =  $rows['table_field_name'];
 }
 return (array)$arr_contact_hide;
 
}




// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */

 
function _select_row_field_campaign( $field = 0 )
{
	$arr_field = array();
	$this->db->reset_select();
	$this->db->select("*", FALSE);
	$this->db->from("t_gn_field_campaign");
	$this->db->where_in("Field_Id", array($field));
	
	$rs= $this->db->get();
	if( $rs->num_rows() > 0 )
	{
		$arr_field = (array)$rs->result_first_assoc();
	}
	
	return $arr_field;
	
}


// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */

 protected function _select_row_field_contact( $arr_table = null )
{
	
 $arr_field_contact = array();	
 
 $this->db->reset_select();
 
 $rs_field = $this->db->list_fields('t_gn_customer');
 if( count($rs_field) > 0 ) 
	 foreach( $rs_field as $k => $val ) 
 {
	 $arr_field_contact[$val] = $val;
 }
 
 return (array)$arr_field_contact;
 
}



// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */

 public function _select_row_field_data()
 {
	return (array) $this->_select_row_field_contact();
 }
 
// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */

 public function _select_row_call_function()
{
	$arr_call_label = array();
	
	$arr_call_function = get_defined_functions();
	$arr_call_userfunc = (array)$arr_call_function['user'];
	 
	 if(is_array($arr_call_userfunc) AND count($arr_call_userfunc) ) 
		 foreach( $arr_call_userfunc as $k => $val )
	{
		$arr_call_label[$val] = $val;
	}
	return (array)$arr_call_label;
 }
 
 
// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */

 public function _select_row_field_num()
 {
	$ob_field = $this->_select_row_field_contact();
	$arr_size = array();
	
	$i = 1;
	if(is_array($ob_field))
		foreach( $ob_field  as $k  => $val )
	{
		$arr_size[$i] = $val;
		$i++;
	}
	
	return (array)$arr_size;	
 }
 
 
 
// ----------------------------------------------------------
/*
 * @ package 		instance class 
 * 
 */
function _getFieldByLayoutId( $LayoutId = 0 )
{  
	$this ->db -> select('*');
	$this ->db -> from('t_gn_field_campaign a');
	$this ->db -> where("a.Field_Id", $LayoutId);
	$this ->db -> where("a.Field_Active", 1);
	
	 if( $rows = $this -> db -> get() -> result_first_assoc() )  
		return $rows;
	else
		return FALSE;
 }
 
 
 /*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getLabelLayout( $Field_Id = 0 )
{
	$Layout = array();
	
	$this ->db -> select('*');
	$this ->db -> from('t_gn_field_rowset a');
	$this ->db -> where("a.Field_Id", $Field_Id);
	$this ->db -> order_by("a.Rows_Orders","ASC");
	
	$i = 0;
	foreach( $this ->db -> get() -> result_assoc() as $rows )
	{
		$Layout['Names'][$i]  = $rows['Rows_Names'];
		$Layout['Labels'][$i] = $rows['Rows_Labels'];
		$Layout['Ordes'][$i]  = $rows['Rows_Orders'];
		$i++;
	}
	
	return $Layout;

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
	$this->EUI_Page->_setPage($this->set_limit_page);
	$this->EUI_Page->_setSelect("a.Field_Id", false);
	$this->EUI_Page->_setFrom("t_gn_field_campaign a");
	$this->EUI_Page->_setJoin("t_gn_campaign b ","a.CampaignId=b.CampaignId","LEFT", true);
	
	
// -------- set filter --------------------------------------
	
	if(_get_have_post('keywords')) 
	{
		$this->EUI_Page->_setAndOr(array (
			"a.Field_Id" => array("LIKE", ),
			"a.Field_Header" => array("LIKE", _get_post('keywords')),
			"a.Field_Columns" => array("LIKE",_get_post('keywords')),
			"a.Field_Active" => array("LIKE", _get_post('keywords')),
			"a.Field_Create_Ts" => array("LIKE", _get_post('keywords')),
			"a.Field_Create_UserId" => array("LIKE", _get_post('keywords'))
		));	
	}
	
	return $this->EUI_Page;
	
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
	//#		 No		 Campaign Name 	 Header 	 Columns 	 Field Size 	 Create Date 	 User Create 	 Status
	 
	$this->EUI_Page->_postPage(_get_post('v_page') );
	$this->EUI_Page->_setPage($this->set_limit_page);
	
	$this->EUI_Page->_setArraySelect(array(
		"a.Field_Id" => array("Field_Id", "Field_Id","primary"),
		"b.CampaignName" => array("CampaignName","Campaign Name"),
		"a.Field_Header" => array("Field_Header","Section Title"),
		"a.Field_Columns" => array("Field_Columns","Column"),
		"a.Field_Size" => array("Field_Size","Field Size"),
		"a.Field_Create_Ts" => array("Field_Create_Ts","Date Created"),
		"( Select ts.full_name from tms_agent ts where ts.UserId = a.Field_Create_UserId) as Field_Create_UserId " => array("Field_Create_UserId","Create By")
	));
	
	$this->EUI_Page->_setFrom("t_gn_field_campaign a");
	$this->EUI_Page->_setJoin("t_gn_campaign b ","a.CampaignId=b.CampaignId","LEFT", true);
	
	// -------- set filter --------------------------------------
	
	if(_get_have_post('keywords')) 
	{
		$this->EUI_Page->_setAndOr(array (
			"a.Field_Id" => array("LIKE", ),
			"a.Field_Header" => array("LIKE", _get_post('keywords')),
			"a.Field_Columns" => array("LIKE",_get_post('keywords')),
			"a.Field_Active" => array("LIKE", _get_post('keywords')),
			"a.Field_Create_Ts" => array("LIKE", _get_post('keywords')),
			"a.Field_Create_UserId" => array("LIKE", _get_post('keywords'))
		));	
	}
	
		
// ----------- set order -----------------------
		
	 if(_get_have_post('order_by'))
	{
		$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
	}
	else
		$this->EUI_Page->_setOrderBy('a.Field_Id');
// --- set limit ----------------------------------	
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
 public function _select_field_size()
{
	$ob_field = $this->_select_row_field_contact();
	$arr_size = array();
	
	$i = 1;
	if(is_array($ob_field))
		foreach( $ob_field  as $k  => $val )
	{
		$arr_size[$i] = $i;
		$i++;
	}
	
	return (array)$arr_size;	
 }
 
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
function _setDeleted( $params ){
$_conds = 0; 	
	foreach( $params as $keys => $fld_id ) 
	{
		$this -> db -> where("Field_Id", $fld_id);
		if( $this -> db ->delete('t_gn_field_campaign') )
		{
			$this -> db -> where("Field_Id", $fld_id);
			if( $this -> db ->delete('t_gn_field_rowset') )
			{
				$_conds++;
			}
		}
	}
	return $_conds;
} 
 
// ----------------------------------------------------------
/*
 * @ package 		_set_row_copy_field
 * 
 */

 protected function _select_row_set_field_id( $field_id = 0 )
{
	
 $arr_field = array();
 $this->db->reset_select();
 $this->db->select("*", FALSE);
 $this->db->from("t_gn_field_rowset");
 $this->db->where_in("Field_Id", array($field_id));
 $rs = $this->db->get();
 
 if( $rs->num_rows() > 0 ){
	$arr_field=(array)$rs->result_assoc();
 }	
 
 return $arr_field;
} 
 
// ----------------------------------------------------------
/*
 * @ package 		_set_row_copy_field
 * 
 */

 
function _set_row_copy_field( $out = null )
{
  if( !$out->fetch_ready() ){
	return FALSE;
 }
 
 
 $arr_fiel_original = $this->_select_row_set_field_id($out->get_value('Field_Id','intval'));
 if( is_array( $arr_fiel_original ) ) 
 {
	$Field_Id = 0;
	
	$this->db->set("CampaignId", $out->get_value('CopyCampaignId'));
	$this->db->set("Field_Header",$out->get_value('CopyField_Header')); 
	$this->db->set("Field_Columns", $out->get_value('CopyField_Columns'));
	$this->db->set("Field_Size", $out->get_value('CopyField_size'));
	$this->db->set("Field_Active",$out->get_value('CopyField_Active'));
	$this->db->set("Field_Create_Ts",date('Y-m-d H:i:s'));
	$this->db->set("Field_Create_UserId",_get_session('UserId'));
	$this->db->insert("t_gn_field_campaign");
	if( $this->db->affected_execute() )
	{
	 	$Field_Id = $this->db->insert_id();
	}
	
	if(!$Field_Id){
		return FALSE;
	}
	
	
	$arr_total = 0;
	if( is_array($arr_fiel_original)  AND count($arr_fiel_original) > 0  ) 
		 foreach($arr_fiel_original as $k => $rows )
	 {
		$row =new EUI_Object( $rows );
		if( $row->fetch_ready() )
		{	
			$this->db->reset_write();
			$this->db->set("Field_Id", $Field_Id);
			$this->db->set("Rows_Names",$row->get_value('Rows_Names'));
			$this->db->set("Rows_Labels",$row->get_value('Rows_Labels'));
			$this->db->set("Rows_Function",$row->get_value('Rows_Function'));
			$this->db->set("Rows_Orders",$row->get_value('Rows_Orders'));
			 if( $this->db->insert("t_gn_field_rowset") )
			{
				$arr_total+=1;
			}
		}
		
		
	 }
	 
	if( $arr_total ) {
		return TRUE;
	}
 }
 
 return FALSE;
 
} 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
  public function _setSaveGenerate( $out = null )
{
 if( !$out->fetch_ready() ){
	return FALSE;
 }
 
// --------------------
 $arr_check = $out->get_array_value('field_checkbox');
 if( is_array($arr_check) and count($arr_check) > 0 ) 
	 foreach( $arr_check as $k => $val )
{
	$arr_field_contact[$val] = array
	(
		'order' => $out->get_value("field_order_{$val}", 'trim'),
		'label' => $out->get_value("field_label_{$val}", 'trim'),
		'name'  => $out->get_value("field_name_{$val}", 'trim'),
		'funct' => $out->get_value("field_funct_{$val}", 'trim')
	);
}
 
 
// -- clear cache -----------------------------------------

 $SetFieldId = 0;
 $this->db->reset_write();
 $this->db->set("CampaignId",$out->get_value('CampaignId'));
 $this->db->set("Field_Header",$out->get_value('Field_Header'));
 $this->db->set("Field_Columns",$out->get_value('Field_Columns','intval'));
 $this->db->set("Field_Size",$out->get_value('Field_size','intval'));
 $this->db->set("Field_Active", $out->get_value('Field_Active','intval'));
 $this->db->set("Field_Create_Ts",date('Y-m-d H:i:s'));
 $this->db->set("Field_Create_UserId",_get_session('UserId'));
 $this->db->insert("t_gn_field_campaign");
 
 if($this->db->affected_execute()) {
	$SetFieldId = (int)$this->db->insert_id();
 }
 
 if( !$SetFieldId ){
	 return FALSE;
 }
 
 
 $arr_total = 0;
 
 if( is_array($arr_field_contact)  AND count($arr_field_contact) > 0  ) 
	 foreach( $arr_field_contact as $k => $rows )
 {
	$row = new EUI_Object( $rows );
	if( $row->fetch_ready() )
	{	
		$this->db->reset_write();
		$this->db->set("Field_Id", $SetFieldId);
		$this->db->set("Rows_Names",$row->get_value('name'));
		$this->db->set("Rows_Labels",$row->get_value('label'));
		$this->db->set("Rows_Function",$row->get_value('funct'));
		$this->db->set("Rows_Orders",$row->get_value('order'));
		 if( $this->db->insert("t_gn_field_rowset") )
		{
			$arr_total+=1;
		}
	}
	
	
 }
 
 if( $arr_total ) {
		return true;
 }

  return FALSE;
 
}
 
 
 // ================== END CLAS ==============================================
 // ================== END CLAS ==============================================
}

/*
 * END OF CLASS 
 */