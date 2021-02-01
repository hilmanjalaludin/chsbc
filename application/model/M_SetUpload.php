<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_SetUpload extends EUI_Model
{
	
/*
 * EUI :: _get_product() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
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
 
 function M_SetUpload()
 {
	$this->load->model(array('M_Loger','M_Configuration'));
 }
 
 
 
/*
 * @ def 		: blaklist data 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _LimitDays()
 {
	$limit = array();
	for( $i = 1; $i<=12; $i++){
		if( $s_i = ($i * 30) ){
			$limit[$s_i] = "$s_i Days"; 
		}
	}
	return $limit;
 }

/*
 * @ def 		: blaklist data 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _BlackList() {
	return $list = array( 'Y'=>'YES', 'N'=>'NO');
 }
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _get_default()
{
	$this->EUI_Page->_setPage(10); 
	$this->EUI_Page->_setSelect("a.TemplateId");
	$this->EUI_Page->_setFrom("t_gn_template a", true);
	
// ------- filter data jika ada =------------------------

	return $this -> EUI_Page;
	
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
 
 $conds1 = " IF(a.TemplateFlags=1, 'Active','Not Active') as TemplateFlags ";
 if( QUERY == 'mssql') {
 	$conds1 = " CASE WHEN a.TemplateFlags=1 THEN 'Active' ELSE 'Not Active' END as TemplateFlags ";
 }

 $this->EUI_Page->_postPage(_get_post('v_page') );
 $this->EUI_Page->_setPage(10); 
 $this->EUI_Page->_setArraySelect(array(
	"a.TemplateId as TemplateId" => array("TemplateId", "TemplateId", "primary"),
	"a.TemplateTableName as TemplateTableName" => array("TemplateTableName", "Table"),
	"a.TemplateName as TemplateName" => array("TemplateName", "Name"),
	"a.TemplateMode as TemplateMode" => array("TemplateMode", "Mode"),
	"a.TemplateFileType as TemplateFileType" => array("TemplateFileType", "File Type"),
	"a.TemplateSparator as TemplateSparator" => array("TemplateSparator", "Separator"),
	"a.TemplateBlacklist as TemplateBlacklist" => array("TemplateBlacklist", "Blacklist"),
	"a.TemplateLimitDays as TemplateLimitDays" => array("TemplateLimitDays", "Expired Days"),
	"a.TemplateCreateTs as TemplateCreateTs" => array("TemplateCreateTs", "Created Date"),
	"{$conds1}" => array("TemplateFlags", "Status")
 ));
 
 $this->EUI_Page->_setFrom("t_gn_template a", TRUE);
// --------------- set order  -------------------
 
  if( !_get_have_post('order_by')){
		$this->EUI_Page->_setOrderBy('a.TemplateId','DESC');
  } else {
		$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
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
	if( $this -> EUI_Page -> _get_query()!='' )
	{
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
 
 function _get_list_tables()
 {
	$_conds = array(); 
	$_mixed = $this->M_Configuration->_getTemplateLayout();
	if( !is_null($_mixed))
	{
		foreach( $this -> db -> list_tables(true) as $k => $n)
		{	
			if( in_array($n, array_keys($_mixed)))
			{
				$_conds[$n] = $_mixed[$n];
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
 
 function _get_field_column($table)
 {
	$_conds= array();
	
	if(!is_null($table))
	{
		$field = $this->db->list_fields($table);
		$hide = $this -> _get_hide_schema($table);
		
		foreach( $field as $k => $v )
		{
			if(!in_array($v, array_keys($hide)))
			{
				$_conds[$v] = $v;
			}
		}
	}
	
	return $_conds;
 }
 
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _get_hide_schema($table = null )
 {
	$schema = array();
	
	$sql = " select a.table_field_name from t_gn_hide_tables a where a.table_name='$table'";
	$qry = $this -> db ->query($sql);
	foreach( $qry -> result_assoc() as $rows )
	{
		$schema[$rows['table_field_name']] = $rows['table_field_name'];
	}
	
	return $schema;
 }
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public  function _getTypeUpload()
 {
	return array
	(
		'insert' => 'Insert',
		'update' => 'Update'
	);
 }
 
 
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
  public function _getTypeFile()
  {
	return array
	(
		'excel' => 'Excel',
		'txt' => 'TXT'
	);
 }
 
 
// ---------------------------------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 protected  function  & _set_row_order_field( $out = null )
{
  $arr_field = array();
  $var_field = $out->get_array_value("order_by");
  
  if(is_array($var_field))
	  foreach( $var_field as $k => $value )
  {
	$arr_cell = explode('-', $value);
	if( count($arr_cell)==2 ){
		$arr_field[$arr_cell[0]] = $arr_cell[1];
	}
  }
  
  return (array)$arr_field;
  
}

// ---------------------------------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 protected  function & _set_row_map_keys( $out = null, $Field = ''  )
{
  $arr_keys = array();	
  
 // -------- list array data -------------------------------
 
  $list_keys = $out->get_array_value('list_keys');
  if(count($list_keys) > 0 )
	  foreach( $list_keys as $k => $Field )
 {
	$arr_keys[$Field]  = $Field;	
  }	  
  
  if( in_array($Field, $arr_keys ) ){
	return 1;
  } else {
	  return 0;
  }
 }
// ---------------------------------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 protected  function & _set_row_map_field( $out = null )
{
  $arr_alias = array();	
  
 // -------- list array data -------------------------------
 
  $list_check = $out->get_array_value('list_check');
  $arr_order =& $this->_set_row_order_field( $out );	
  
  if(count($list_check) > 0 )
	  foreach( $list_check as $k => $Field )
 {
	 $arr_alias[$Field] = array
	(
		'keys'  => (string)$this->_set_row_map_keys($out, $Field),
		'alias' => (string)$out->get_value($Field),
		'order' => (string)$arr_order[$Field],
		'name'	=> (string)$Field
	);
  }	  
  
  return (array)$arr_alias;
}

// ---------------------------------------------------------------------------------------------------------- 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _set_saveInsert( $out = null )
{
   if( !$out->fetch_ready() ) { 
	 return FALSE; 
   }
   
   $totals = 0;
 // ------------------- release data ------------------
 
   $this->db->reset_write();
   $this->db->set("TemplateTableName", $out->get_value('table_name') );
   $this->db->set("TemplateName",$out->get_value('templ_name') );
   $this->db->set("TemplateMode", $out->get_value('mode_input') );
   $this->db->set("TemplateFileType", $out->get_value('file_type') );
   $this->db->set("TemplateSparator", $out->get_value('delimiter') );
   $this->db->set("TemplateBlacklist",$out->get_value('black_list') );
   $this->db->set("TemplateLimitDays",$out->get_value('expired_days') );
   $this->db->set("TemplateBucket",$out->get_value('bucket_data') );
   $this->db->set("TemplateCreateTs",date('Y-m-d H:i:s'));
   $this->db->set("TemplateFlags",1);
   $this->db->insert("t_gn_template");
   
   $TemplateId =(int)$this->db->insert_id();
   if($TemplateId)
   {
	    $arr_field =& $this->_set_row_map_field( $out );
		if(count($arr_field) > 0 ) 
			foreach( $arr_field as $k => $rows )
		{
			$row = new EUI_Object($rows);
			$this->db->reset_write(); // reset cache 
			$this->db->set("UploadTmpId", $TemplateId);
			$this->db->set("UploadColsName", $row->get_value('name') );
			$this->db->set("UploadColsAlias",$row->get_value('alias'));
			$this->db->set("UploadColsOrder",$row->get_value('order'));
			if( $this->db->insert("t_gn_detail_template") )
			{
				$totals++;
			}
		}	
   }
	if( $totals == 0 ){
		return FALSE;
	}	
	
	return TRUE;
} 
// ======== END FUNCTION =============>

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 public function _set_saveUpdate($out = null ) 
{
 if( !$out->fetch_ready() ) { 
	return FALSE; 
   }
   
   $totals = 0;
 // ------------------- release data ------------------
 
   $this->db->reset_write();
   $this->db->set("TemplateTableName", $out->get_value('table_name') );
   $this->db->set("TemplateName",$out->get_value('templ_name') );
   $this->db->set("TemplateMode", $out->get_value('mode_input') );
   $this->db->set("TemplateFileType", $out->get_value('file_type') );
   $this->db->set("TemplateSparator", $out->get_value('delimiter') );
   $this->db->set("TemplateBlacklist",$out->get_value('black_list') );
   $this->db->set("TemplateLimitDays",$out->get_value('expired_days') );
   $this->db->set("TemplateBucket",$out->get_value('bucket_data') );
   $this->db->set("TemplateCreateTs",date('Y-m-d H:i:s'));
   $this->db->set("TemplateFlags",1);
   $this->db->insert("t_gn_template");
   
   $TemplateId =(int)$this->db->insert_id();
   if($TemplateId)
   {
	    $arr_field =& $this->_set_row_map_field( $out );
		if(count($arr_field) > 0 ) 
			foreach( $arr_field as $k => $rows )
		{
			$row = new EUI_Object($rows);
			$this->db->reset_write(); // reset cache 
			$this->db->set("UploadTmpId", $TemplateId);
			$this->db->set("UploadColsName", (string)$row->get_value('name') );
			$this->db->set("UploadColsAlias",(string)$row->get_value('alias'));
			$this->db->set("UploadKeys", $row->get_value('keys'));
			$this->db->set("UploadColsOrder",$row->get_value('order'));
			if( $this->db->insert("t_gn_detail_template") )
			{
				$totals++;
			}
		}	
   }
	if( $totals == 0 ){
		return FALSE;
	}	
	
	return TRUE;
	
	// $_conds = false;
	// if( !is_null($_array) && is_array($_array) )
	// {
		// $_post = false;
		
		// if( isset($_array['mode']) AND !is_null($_array['mode']) ) $_post  = true;
		// if( isset($_array['table']) AND !is_null($_array['table']) ) $_post  = true;
		// if( isset($_array['tplname']) AND !is_null($_array['tplname']) ) $_post  = true;
		// if( isset($_array['filetype']) AND !is_null($_array['filetype']) ) $_post  = true;
		// if( isset($_array['content']) AND !is_null($_array['content']) ) $_post  = true;
		// if( isset($_array['keys']) AND !is_null($_array['keys']) ) $_post  = true;
		// if( isset($_array['delimiter']) AND !is_null($_array['delimiter']) ) $_post  = true;
		// if( isset($_array['order_by']) AND !is_null($_array['order_by']) ) $_post  = true;
		// if( isset($_array['black_list']) AND !is_null($_array['black_list']) ) $_post  = true;
		// if( isset($_array['expired_days']) AND !is_null($_array['expired_days']) ) $_post  = true;
		// if( isset($_array['bucket_data']) AND !is_null($_array['bucket_data']) ) $_post  = true;
		
		// if( $_post )
		// {
			// if( $this -> db -> insert('t_gn_template', array
			// (
				// 'TemplateTableName' => $_array['table'], 
				// 'TemplateName' 		=> $_array['tplname'],
				// 'TemplateMode' 		=> $_array['mode'],
				// 'TemplateFileType' 	=> $_array['filetype'],
				// 'TemplateBlacklist' => $_array['black_list'],
				// 'TemplateLimitDays' => $_array['expired_days'],
				// 'TemplateBucket'	=> $_array['bucket_data'],
				// 'TemplateFlags'		=> 1,
				// 'TemplateCreateTs'	=> date('Y-m-d H:i:s') 
				
			// )))
			// {
				// $insert_id = $this -> db -> insert_id();
				// if( $insert_id )
				// {
					// $total = 0; 
					// $Order = 0;
					// $order_list = $_array['order_by'];
					// foreach($_array['content'] as $Keys => $Names )
					// {
						
						// if( in_array($Keys,array_keys($_array['keys']) )) {
							// $this -> db -> set('UploadKeys',1);
						// }
						
						// $this->db->set('UploadTmpId',$insert_id);
						// $this->db->set('UploadColsName',$Keys);
						// $this->db->set('UploadColsAlias',$Names);
						// $this->db->set('UploadColsOrder',$order_list[$Order]);
						
						// $this -> db -> insert("t_gn_detail_template");
						// if( $this->db->affected_rows() > 0 )
						// {
							// $totals++;
						// }
						// $Order++;
						
					// }
				// }
			// }
		// }
	// }
	
	//return ( ($totals>0) ? true : $_conds );
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_name_template($TemplateId = null)
 {	
	$_data = array();
	
	if( !is_null($TemplateId))
	{
		$this -> db -> select('TemplateName,TemplateSparator, TemplateFileType');
		$this -> db -> from('t_gn_template');
		$this -> db -> where( array('TemplateId'=>$TemplateId) );
		
		$qry = $this -> db -> get();
		#var_dump( $this->db->last_query() );die();
		#if( !$qry->EOF() )
		if( $qry->num_rows() > 0 )
		{
			$_data = $qry -> result_first_assoc();
		}
	}
	
	return $_data;
}

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_detail_template($TemplateId = null)
 {	
	$_data = array();
	
	if( !is_null($TemplateId))
	{
		$this -> db -> select('*');
		$this -> db -> from('t_gn_template');
		$this -> db -> where( array('TemplateId'=>$TemplateId) );
		
		$qry = $this -> db -> get();
		if( !$qry->EOF() )
		{
			$_data = $qry -> result_first_assoc();
		}
	}
	
	return $_data;
}
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function _get_download_template($TemplateId = null)
 {	
	$_data = array();
	
	if( !is_null($TemplateId))
	{
		$this -> db -> select('*');
		$this -> db -> from('t_gn_detail_template');
		$this -> db -> where(array('UploadTmpId'=>$TemplateId));
		$this -> db -> order_by('UploadColsOrder','ASC');
		
		$qry = $this -> db -> get();
		#var_dump( $this->db->last_query() ); die();
		foreach( $qry -> result_assoc() as $rows )
		{	
			$_data[$rows['UploadColsName']] = $rows['UploadColsAlias']; 
		}
	}
	return $_data;
 }
 
 
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _set_active_template( $_flags, $TemplateId )
{
	$_conds = false;
	if( !is_null($_flags) AND !is_null($TemplateId)  )
	{
		if( $this -> db -> update('t_gn_template', array( 'TemplateFlags' => $_flags ), array( 'TemplateId' => $TemplateId )))
		{
			$_conds = true;
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
 * query-mssql 	[OK]
 */
 
function _get_ready_template()
{
	$_conds = array();
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$this -> db -> select('TemplateId,TemplateName');
		$this -> db -> from('t_gn_template');
		$this -> db -> where('TemplateFlags',1);
		foreach( $this -> db -> get() -> result_assoc() as $rows )
		{
			$_conds[$rows['TemplateId']] = $rows['TemplateName'];
		}
	}	
	
	return $_conds;
}
 
 
// _set_delete_template

function _set_delete_template($id = null)
{
	
	$_conds = 0;
	if( !is_null($id))
	{
		foreach( $id as $k => $TemplateId )
		{	
			//t_gn_template
			$this ->db->where('UploadTmpId',$TemplateId);
			$this ->db->delete('t_gn_detail_template');
			
			if( $this ->db->affected_rows() > 0 )
			{
				$this -> db->where('TemplateId',$TemplateId);
				$this -> db->delete('t_gn_template'); 
				 
				if($this ->db->affected_rows() > 0)
				{
					$_conds++;
				}
				
			}
		}
	}
	
	return $_conds;
} 

}

?>
