<?php 
 class EUI_Extendpager 
{
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
var $arr_pager_print		 	= array();
var $arr_order_style 		 	= array();
var $arr_align_cols  	 	 	= array();
var $arr_label_rows  		 	= array();
var $arr_func_cols   			= array();
var $arr_width_cols  		 	= array();
var $arr_breakword_cols 	 	= array();
var $arr_row_format          	= array();
var $arr_event_row_click	 	= array();	
var $arr_event_forbiden  	 	= array(); 
var $arr_event_row_click_field 	= array();
var $arr_checkbox_attribute     = array();
	

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
var $arr_class_table 		 = array();
var $arr_cell_spacing_table  = array();
var $arr_cell_padding_table  = array();
var $arr_source_table		 = array();
var $arr_role_table 		 = array();
var $arr_align_header		 = array();
var $arr_pager_rows			 = array();
var $arr_disable_order		 = array();



//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
var $arr_checkbox_func		 = false;
var $arr_onechecked_func	 = false;	
var $arr_page_number		 = 0;
var $arr_height_row_header 	 = 0;
var $arr_height_row_content  = 0;
var $arr_width_table 		 = 0;


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
private static $Instance = null;

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public static function &Instance() 
{
  if( is_null(self::$Instance) ) {
	self::$Instance = new self();
  }
  return self::$Instance;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  function set_event_role( $role  = null  )
{
	$this->arr_event_role = (array)$role;  
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  function set_role_table( $role  = null  )
{
	$this->arr_role_table = (array)$role;  
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function set_source_table( $row = null, $num = 0  )
{
  if( is_object($row) )
  {
	$this->arr_source_table = $row->result_assoc();	
	$this->arr_page_number = $num;
  }
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 /*
 function set_checkbox_attr( $row = 0, $atr = null ) 
{
	if( is_null($atr)){
		$this->arr_checkbox_attribute[$row] = null;
	} 
	else {
		$arr_attr = array(); //['disabled']
		if( !strcmp( $atr, 'disabled' ) ){
			$arr_attr['disabled'] = true;	
		}
		else if( !strcmp( $atr, 'checked' ) ){
			$arr_attr['checked'] = true;	
		}
		if( count($arr_attr) > 0 ){
			$this->arr_checkbox_attribute[$row] = $arr_attr;
		}
	} 
}
*/

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 /*
function select_checkbox_attr( $row = null ){
	if( isset( $this->arr_checkbox_attribute[$row] ) ){
		return $this->arr_checkbox_attribute[$row];
	}
	return null;
}
*/
//$arr_checkbox_attribute

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function select_pager_row_value( $val = null  ){
	
	$this->field_index_primary = $this->select_pager_primary();
	$ar_list = $this->select_pager_rows();
	
	if( is_array( $ar_list ) ) 
		foreach( $ar_list as $key => $row ) 
	{	
		if( !strcmp( $val, $row[$this->field_index_primary] ) ) {
			return call_user_func('Objective', $row);
		} 	
	}	
	return null;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  function select_row_field()
{ 
	$out = new EUI_Object( $this->arr_source_table );
	return $out;
 }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  function select_pager_debug()
{ 
	$this->select_row_field()->debug_field();
 }
 
 
 
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function set_order_style( $key = null, $val='' )
{
  if( !is_array($key) ) 
  {  
	 $key = array($key => $val );  
  }
  
  $this->arr_order_style = $key;
  page_set_style($this->arr_order_style);
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public  function set_align_cols($key =NULL, $val='' )
{
   if( !is_array($key) )
  {
		$key = array( $key => $val );
  }
  
  $this->arr_align_cols = $key;
  page_set_align($this->arr_align_cols);
  
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_label_row($key, $val )
{
  if( !is_array($key) ){
	$key = array($key => $val );
  }
  $this->arr_label_rows = $key;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_event_row_forbiden_click( $key = array() )
 {
	$this->arr_event_forbiden = $key; 
 }
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
  function set_event_row_index( $key, $val='' )
{	
	if( !is_array($key ) ){
	 $key = array( $key => $val );
	}
	foreach( $key as $k => $v ){
		$this->arr_event_row_click_field[$k] = $v;	
	}
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function set_event_row_click( $key=null, $val='', $forbiden = array() )
{	
 if( is_null($key) ) return false;
 
 if( !is_array( $key ) AND !is_null( $key ) ){
 	$key = array( $key => $val );
 }
 foreach( $key as $k => $v ){
	$this->arr_event_row_click[$k] = $v;		
 } 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_width_cols($key, $val )
{
	if( !is_array($key) ){
		$key = array($key => $val );
	}
	
	$this->arr_width_cols = $key;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_header_wrap($key, $val='' )
{
	if( !is_array($key) ){
		$key = array($key => $val );
	}
	foreach( $key as $k => $v ){
		$this->arr_header_wrap[$k] = $v;
	}
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_hidden_column( $key = null )
{
	if( !is_array($key) ){
		$key = array( $key );
	}
	foreach( $key as $k => $v ){
		$this->ar_hidden_column[$v] = $v; 
	}
	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_content_wrap($key, $val='' )
{
	if( !is_array($key) ){
		$key = array($key => $val );
	}
	
	foreach( $key as $k => $v ){
		$this->arr_content_wrap[$k] = $v;
	}
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function set_height_row_header( $val = 0 ){
	$this->arr_breakword_cols = $val;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public  function set_height_row_content( $val  = 0 )
{
	$this->arr_height_row_content = $val;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public  function set_title_row_content( $val = '' )
{
	$this->arr_title_row_content = $val;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function set_width_table($val= '' )
{ 
	$this->arr_width_table = $val;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function set_disable_order( $key = null, $val='')
{
	if( !is_array($key) and !is_null($key)  ){
		$key = array( $key => $val );
	}
	foreach( $key as $k => $v ){
		$this->arr_disable_order[$k] = $v;
	}  
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function set_class_table($key=null, $val='' )
{
  if( !is_array($key) ){
	$key = array($key => $val );
  }
  $this->arr_class_table = $key;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

function set_cell_spacing_table( $key = '' ){
	$this->arr_cell_spacing_table = $key;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function set_cell_padding_table($key, $val ){
	$this->arr_cell_padding_table = $key;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function set_row_format($key=NULL, $val='' )
{
  if( !is_array($key) ){
	$key = array($key => $val );
  }
   $this->arr_row_format = $key;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			@chekbok rows @chek on header 
 * @author			uknown 
 */
 public function set_checkbox_func( $chkbox = false, $onechecked = false ) 
{
	$this->arr_checkbox_func = $chkbox;
	$this->arr_onechecked_func = $onechecked;
 }
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			@chekbok rows @chek on header 
 * @author			uknown 
 */
 
 public function set_align_header( $key, $val='' ){
	if( !is_array($key) ){
		$key = array( $key => $val );
	}
	$this->arr_align_header = $key;  
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function reset_pager_object( )
{
	$arr_pager = array
	(
		"arr_event_row_click"		=> array(),
		"arr_pager_print"			=> array(),
		"arr_order_style" 			=> array(),
		"arr_align_cols" 			=> array(),
		"arr_label_rows" 			=> array(),
		"arr_func_cols"				=> array(),
		"arr_width_cols"			=> array(),
		"arr_breakword_cols" 		=> array(),
		"arr_class_table" 			=> array(),
		"arr_cell_spacing_table" 	=> array(),
		"arr_cell_padding_table" 	=> array(),
		"arr_source_table" 			=> array(),
		"arr_event_row_click_field" => array(),
		"arr_header_wrap"			=> array(),
		"arr_content_wrap"			=> array(),
		"arr_disable_order"			=> array(),
		"arr_checkbox_func" 		=> FALSE,
		"arr_onechecked_func"		=> FALSE,
		"arr_page_number" 			=> 0,
		"arr_height_row_header" 	=> 0,
		"arr_height_row_content"	=> 0,
		"arr_width_table" 			=> 0
	);
	
	foreach( $arr_pager as $object => $value ){
		$this->$object = $value;
	}
} 

// // $this->arr_class_table = $key; $this->arr_width_table

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_width_table() 
{
  return (string)$this->arr_width_table;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function select_pager_disable_order( $key  = null ){
	if( isset($this->arr_disable_order[$key]) ){
		return (bool)$this->arr_disable_order[$key];
	}
	return false;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_class_table() 
{
 
 $classes = array();
 $this->arr_class_table = array_values( $this->arr_class_table);
 if( is_array( $this->arr_class_table )  AND count($this->arr_class_table) > 0   ) 
	foreach( $this->arr_class_table as $class => $value ) 
 {
	$classes[] = $value;	
 }
 
 return join(" ", $classes);
 
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_row_format() 
{
  return (array)$this->arr_row_format;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_row_title() 
{
  return (string)$this->arr_title_row_content;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function select_pager_hidden_column()
{
 	if( is_array($this->ar_hidden_column)){
		return $this->ar_hidden_column;
	}
	return null;
}	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_label() 
{
	
 $ar_label = page_labels();
 $ar_column = $this->select_pager_hidden_column();	
 $ar_result = array();
 if( is_array($ar_column) ) 
	 foreach( $ar_label as $key => $val )
 {
	if( !in_array( $key,  $ar_column)){
		$ar_result[$key] = $val;	
	}
 } else {
	$ar_result =  $ar_label;
 }
 return $ar_result;
  
}



//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 function select_event_row_index( $row = null )
{
 $ar_field = null;
 if( !is_object($row) ){
	return false;
 }
	
 if( is_array( $this->arr_event_row_click_field ) 
	and count( $this->arr_event_row_click_field ) > 0 ) 
 {
	$ar_field = reset($this->arr_event_row_click_field);
 }
 
 if( !is_null($ar_field) ){
	return $row->get_value( $ar_field );
 }
 return false;
 
}
 
//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_row_click( $id = '' )
{
  $arr_click = array();
  
 // debug($this->arr_event_row_click);
  
  if( is_array($this->arr_event_row_click) 
	AND count($this->arr_event_row_click) > 0 ) 
	foreach( $this->arr_event_row_click as $event => $func )
 {
	if( strlen($func) > 0 ) {
		$arr_click[] = sprintf( " %s=\"%s.%s('%s');\" ", $event, 'window', $func, $id);
	}
 }
 
 return join("\t", $arr_click);
 
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_primary() 
{
  return page_primary();
}



//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 function select_pager_content_wrap()
 {
	$ar_list = null; 
	if( is_array( $this->arr_content_wrap ) ) {
		foreach( $this->arr_content_wrap as $k => $val ){
			if( in_array($val, array('yes','wrap')) ){
				$ar_list[$k] = 'table-white-space-ys-wrap';
			}
			else if( in_array($val, array('no','nowrap')) ){
				$ar_list[$k] = 'table-white-space-no-wrap';
			} else {
				$ar_list[$k] = 'table-white-space-ys-wrap';
				}
		}
	}
	return $ar_list;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  function select_pager_header_wrap() 
 {
	$ar_list = null; 
	if( is_array( $this->arr_header_wrap ) ) {
		foreach( $this->arr_header_wrap as $k => $val ){
			if( in_array($val, array('yes','wrap')) ){
				$ar_list[$k] = 'table-white-space-ys-wrap';
			}
			else if( in_array($val, array('no','nowrap')) ){
				$ar_list[$k] = 'table-white-space-no-wrap';
			} else {
				$ar_list[$k] = 'table-white-space-ys-wrap';
				}
		}
	}
	return $ar_list;
 }
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_class_header( $field = null ) {
  return page_header( $field );
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_class_column( $field = null ) {
  return page_column( $field );
}

	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_align_header() {
  return $this->arr_align_header;
} 

	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_align() {
  return page_get_align();
}

	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_pager_role_table() 
{
  $select_port = $this->select_pager_primary();
 
  return null;
  //page_set_role($this->arr_role_table,  $select_port);
}

	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_border() 
{
  return page_border();
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_width_cols( )  
{
  return (array)$this->arr_width_cols;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_breakword_cols()  
{
  return (array)$this->arr_breakword_cols;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_rows() 
{
  return (array)$this->arr_source_table;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_number() 
{
  return $this->arr_page_number;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function select_pager_content()
{
	$breack_word = $this->select_pager_breakword_cols();
	$arr_width 	 = $this->select_pager_width_cols();
	$labels  	 = $this->select_pager_label();
	$primary 	 = $this->select_pager_primary();
	$aligns  	 = $this->select_pager_align();
	$alignh  	 = $this->select_pager_align_header();
	$border  	 = $this->select_pager_border();
	$number  	 = $this->select_pager_number();
	$format  	 = $this->select_pager_row_format();
	$title   	 = $this->select_pager_row_title();
	$width   	 = $this->select_pager_width_table();
	$class 	 	 = $this->select_pager_class_table();
	$role        = $this->select_pager_role_table();
	$cwrap       = $this->select_pager_content_wrap();
	$hwrap       = $this->select_pager_header_wrap();
	//debug( $hwrap );
	
	
// ---------- event row detail argument -------------	
	printf("<div id=\"ui-content-extends-pager\" class=\"%s\" style=\"margin:-1px 0px 0px 0px;width:%s;\">\n", 
		   "ui-widget-form-table-compact table-body-content",
		   "99.9%" );
		   
	printf("<div class=\"table-row-extend ui-widget-header table-row-header\" style=\"width:%s;\">\n", $width);
	
	if( $this->arr_checkbox_func ) 
	{
		if( $this->arr_onechecked_func ) {
			printf( "\t<div class=\"table-cell-header-extend ui-corner-top table-cell-header %s\"><a href=\"javascript:void(0);\"><i class=\"fa fa-check-square\"></i></a></div>\n", 'center');
		} 
		else
		{
			if( $role->onEdit ){
				printf( "\t<div class=\"table-cell-header-extend ui-corner-top table-cell-header center\" style=\"width:%s;\"> <a href=\"javascript:void(0);\" onclick=\"%s\"><i class=\"fa fa-check-square\"></i></a></div>\n", "3%", $role->onEvent);
			
			} else{
				printf("\t<div class=\"table-cell-header-extend ui-corner-top table-cell-header center\" style=\"width:%s;\"> <a href=\"javascript:void(0);\"><i class=\"fa fa-check-square\"></i></a></div>\n", "3%");
			}
		}
	}	
	printf("\t<div class=\"table-cell-header-extend ui-corner-top table-cell-header center\">%s</div>\n", lang("GM_Label_No"));
	
	if( is_array($labels) ) 
		foreach( $labels as $Field => $LabelName) 
	{
		$class = $this->select_pager_class_header($Field); 
		$align_header = (is($alignh, $Field) ? is( $alignh, $Field) : ( is($aligns,$Field) ?  is($aligns, $Field) : 'left') );
		
		
		$order_disable = $this->select_pager_disable_order( $Field );
		// jika nilai false maka active 
		if( !$order_disable ){
			printf("<div class=\"table-cell-header-extend ui-corner-top table-cell-header %s $hwrap[$Field]\"><span class=\"ui-widget-tooltip header_order %s\"  ui-extend-title=\"Sort By %s\" onclick=\"Ext.EQuery.orderBy('%s');\">&nbsp;%s</span></div>",
					$align_header, $class, $LabelName, $Field, $LabelName );
		}
		// jika ada 
		else {
			printf("<div class=\"table-cell-header-extend ui-corner-top table-cell-header %s $hwrap[$Field]\"> <span class=\"ui-widget-tooltip\">&nbsp;%s</span></div>", $align_header, $LabelName );
		}
				 
				 
	}
	
	printf("%s", "</div>\n");
	
	foreach( $this->select_pager_rows() as $rows )
	{ 
		$row = new EUI_Object( $rows ); 
		$color = ( ( $number %2 == 0 ) ? "table-cell-selcted-one" : "table-cell-selcted-two" );
		
	//---------------------- chekcbox argument ---------------> 
		printf("<div class=\"table-row-extend ui-extend-pager-row-%s %s onselect\">\n",$number, $color);
		if( $this->arr_checkbox_func )
		{
			if( $this->arr_onechecked_func ){
				if( $role->onEdit ){
					printf("\t<div class=\"table-cell-content-extend table-cell-content center\">%s</div>\n", form()->checkbox( $primary, NULL, $row->get_value($primary), array("change" => "Ext.Cmp('$primary').oneChecked(this);")));
				} else {
					printf("\t<div class=\"table-cell-content-extend table-cell-content center\">%s</div>\n", form()->checkbox( $primary, NULL, $row->get_value($primary), array("change" => "Ext.Cmp('$primary').oneChecked(this);")));
				}
			} 
			else{
				if( $role->onEdit ){
					printf("\t<div class=\"table-cell-content-extend table-cell-content center\" style=\"padding-left:5px;vertical-align:middle;\" >%s</div>", form()->checkbox( $primary, NULL, $row->get_value($primary), null, Call( $row->get_value($primary), "set_checkbox_attr")  ));
				} else{ 
					printf("\t<div class=\"table-cell-content-extend table-cell-content center\" style=\"padding-left:5px;vertical-align:middle;\">%s</div>", form()->checkbox( $primary, NULL, $row->get_value($primary), null, Call( $row->get_value($primary), "set_checkbox_attr") ));
				}
			}
		}	 
		
		printf("\t<div class=\"table-cell-content-extend table-cell-content center\">%s</div>\n", $number);
				
	// ----------------- label on the grid -------------------------------------------
		
		$num_cell = 0;
		
		if(is_array( $labels ) ) 
			foreach( $labels as $Field => $LabelName )
		{
			$arr_cwarp  = (is($cwrap, $Field) ? is($cwrap, $Field) : 'table-white-space-ys-wrap');
			$arr_values = $this->select_event_row_index( $row );
			$arr_event 	= ($arr_values == FALSE ? $this->select_pager_row_click($row->get_value($primary)) : $this->select_pager_row_click( $arr_values ));
			$arr_color 	= $this->select_pager_class_column($Field); 
			$call_event = sprintf("%s style=\"cursor:pointer;\" title=\"%s\" %s ", $arr_color, $title, $arr_event);
			
			if( !in_array($Field, $this->arr_event_forbiden)){
				$label = $row->get_value( $Field, is($format, $Field));
				printf("\t<div id=\"ui-extend-pager-id-%s-%s-%s\" class=\"table-cell-content-extend table-cell-content $arr_cwarp %s\" %s %s >%s</div>\n", 
					strtolower($Field),
					$number,
					$num_cell,
					( is($aligns, $Field) ? is($aligns, $Field) : "left"),
					$call_event, 
					is($breack_word, $Field), 
					(is_array($label) ? "-" : $label));
					
			} else {
				$label = $row->get_value( $Field, is($format, $Field));
				printf("\t<div id=\"ui-extend-pager-id-%s-%s-%s\" class=\"table-cell-content-extend table-cell-content $arr_cwarp %s\" %s >%s</div>\n", 
					strtolower($Field),	
					$number,
					$num_cell,
					( is($aligns, $Field) ? is($aligns, $Field) : "left"),
					is($breack_word, $Field), 
					(is_array($label) ? "-" : $label) );
			}
			$num_cell++;
		}	
		
		printf("%s", "</div>\n");
		$number++;
	}
	
	printf("%s\n", "</div>\n");
}

// --------------------------------------------------------------------------------
// end Class 
	
}
?>